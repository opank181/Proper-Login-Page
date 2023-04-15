<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    public function index()
    {
        $this->form_validation->set_rules("EmailUser", "Email", "required|trim|valid_email", [
            "valid_email" => "Ini bukan email!",
            'required'      => "Email Wajib Di isi!"

        ]);
        $this->form_validation->set_rules("PasswordUser", "Password", "required|min_length[6]", [

            "min_length"    => 'Minimal password yang dimasukkan adalah 6 karakter',
            'required'      => "Password Wajib Di isi"
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $emailUser = $this->input->post('EmailUser');
        $passwordUser = $this->input->post('PasswordUser');
        $user = $this->db->get_where("tb_user", ['email_user' => $emailUser])->row_array();
        $data = [
            'imel' => $user['email_user'],
            'role' => $user['role_id'],
            'nama' => $user['nama_user']
        ];
        $this->session->set_userdata($data);
        if ($user) {
            if (password_verify($passwordUser, $user['password'])) {
                if ($user['role'] == 'Manager') {
                    //Manager
                    redirect('manager');
                } else {
                    // karyawan
                    redirect('user');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
            Password anda salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Email Belum Terdaftar
            </div>
          ');

            redirect('auth');
        }
    }
    public function registration()
    {

        $this->form_validation->set_rules("NamaUser", "Nama User", "required|min_length[5]", [
            "min_length" => "Nama minimal 5 Huruf",
            "required" => "Nama Harus di isi"
        ]);
        $this->form_validation->set_rules("EmailUser", "Email", "required|trim|valid_email|is_unique[tb_user.email_user]", [
            "valid_email" => "Ini bukan email!",
            "is_unique" => "Email ini sudah Terdaftar!"
        ]);
        $this->form_validation->set_rules("PasswordUser", "Password", "required|min_length[6]", [

            "min_length"    => 'Minimal password yang dimasukkan adalah 6 karakter',
            'required'      => "Password Wajib Di isi"
        ]);
        $this->form_validation->set_rules("PasswordUser2", "RPassword", "required|min_length[6]|matches[PasswordUser]", [

            "matches"   => "Password tidak sama!",
            "required" => "Password Wajib Di Isi"
        ]);


        // statement apabila terdapat wrong input or incorrect
        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
            // echo "ada yang salah";
        } else {
            // $nama = $request->nama input; 
            $nama = $this->input->post('NamaUser');
            $email = $this->input->post('EmailUser');
            $password = $this->input->post('PasswordUser');
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $file_name =  uniqid();
            $config['upload_path']          = './aset/img/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;
            $config['max_size']             = 1024; // 1MB


            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $foto = "";
            if (!$this->upload->do_upload('gambar')) {

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                redirect('auth/registration');
            } else {
                $foto = $this->upload->data('file_name');
            }


            $data = array(

                'nama_user' => $nama,
                'email_user' => $email,
                'password' => $password_hash,
                "gambar"  => $foto,
                "role" => "Karyawan"

            );

            $this->db->insert("tb_user", $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat Akun anda telah di buat, Silahkan Login!
          </div>
          ');

            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('imel');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('nama');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat anda telah Log Out!
          </div>
          ');
        redirect('auth');
    }


    public function forgot()
    {
        $this->form_validation->set_rules('EmailUser', 'Email User', 'trim|required|valid_email', [
            'required' => 'Email Harus Di Isi!',
            'valid_email' => 'Masukkan Email Anda dengan benar!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot_password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('EmailUser');
            $data = $this->db->where("email_user", $email)->get("tb_user")->row();
            if ($data) {
                $config = [
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'protocol'  => 'smtp',
                    'smtp_host' => 'smtp.gmail.com',
                    'smtp_user' => '1818086@scholar.itn.ac.id',  // Email gmail
                    'smtp_pass'   => 'Estehpanas12',  // Password gmail
                    'smtp_crypto' => 'ssl',
                    'smtp_port'   => 465,
                    'crlf'    => "\r\n",
                    'newline' => "\r\n"
                ];
                $this->email->initialize($config);
                // Load library email dan konfigurasinya
                $this->load->library('email', $config);

                // Email dan nama pengirim
                $this->email->from('no-reply@opank.com', 'opank.com');

                // Email penerima
                $this->email->to($email); // Ganti dengan email tujuan

                // Subject email
                $this->email->subject('Kirim Email dengan SMTP Gmail CodeIgniter | MasRud.com');

                // Isi email
                $gantipassword = "http://localhost:8080/Ci2/auth/gantipassword?email=$email";

                $this->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='$gantipassword' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                Coba Cek email Anda!</div>');
                $this->email->send();
                redirect('auth/index');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Email ' . $email . ' tidak terdaftar di sistem!</div>');
                redirect('auth/index');
            }
        }
    }

    public function gantipassword()
    {
        $this->form_validation->set_rules("PasswordUser", "Password", "required|min_length[6]", [

            "min_length"    => 'Minimal password yang dimasukkan adalah 6 karakter',
            'required'      => "Password Wajib Di isi"
        ]);
        $this->form_validation->set_rules("PasswordUser2", "RPassword", "required|min_length[6]|matches[PasswordUser]", [

            "matches"   => "Password tidak sama!",
            "required" => "Password Wajib Di Isi"
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/gantipassword');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('PasswordUser');
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $data = array(
                'password' => $password_hash
            );

            //$this->db->update("tb_user", $data)->where('email_user', $email);
            $this->db->where('email_user', $email)->update('tb_user', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Selamat Password Anda telah diperbarui!
          </div>
          ');

            redirect('auth');
        }
    }


    function test()
    {

        $SQL = "SELECT * FROM tb_user";
        $user = $this->db->query($SQL)->result();


        // $SQL = "DELETE FROM tb_user WHERE id = x";
        // $this->db->query($SQL);
        /**
         * 
         * 
         *  $user = $this->db->get("tb_user")->result();
         *  $user = $this->db->select("*")->from("tb_user)->get()->result();
         */

        foreach ($user as $isi) {

            echo $isi->email_user;
            echo "<br>";
        }


        echo "-----------------<br>";
        $email = "sinauka@gmail.com";
        // $SQL2 = "SELECT * FROM tb_user WHERE email_user = '" . $email . "'";
        // $user = $this->db->query($SQL2)->row();

        // $user = $this->db->where("email_user", $email)->get("tb_user")->row();
        $user = $this->db->get_where("tb_user", array(
            "email_user" => $email
        ))->row();

        echo $user->nama_user;



        // ---------------------------------


    }
}
