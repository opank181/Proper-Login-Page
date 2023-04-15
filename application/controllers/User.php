<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User extends CI_Controller
{
    public function index()
    {
        $user = $this->db->get_where("tb_user", ['email_user' => $this->session->userdata('imel')])->row_array();

        $data = array(
            "title" => 'User Page',
            "user" => $user
        );
        $this->load->view('templates/auth_header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/auth_footer');
    }
}
