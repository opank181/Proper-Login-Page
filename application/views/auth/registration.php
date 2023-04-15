<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">



                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Enter your personal details to create account</p>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <form class="row g-3 needs-validation" novalidate enctype="multipart/form-data" action="<?= base_url('auth/registration') ?>" method="post">
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Your Name</label>
                                        <input type="text" name="NamaUser" class="form-control" id="yourName">

                                        <?= form_error('NamaUser', '<div style="display:block" class="invalid-feedback">', '</div>'); ?>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your Email</label>
                                        <input type="email" name="EmailUser" class="form-control" id="yourEmail">

                                        <?= form_error('EmailUser', '<div style="display:block" class="invalid-feedback">', '</div>'); ?>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Password</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="PasswordUser" class="form-control" id="yourUsername">

                                            <?= form_error('PasswordUser', '<div style="display:block" class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Repeat Password</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="PasswordUser2" class="form-control" id="yourUsername">
                                            <?= form_error('PasswordUser2', '<div style="display:block" class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Insert Picture</label>
                                        <div class="input-group has-validation">
                                            <input type="file" name="gambar" class="form-control" id="yourUsername">
                                            <?= form_error('gambar', '<div style="display:block" class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Already have an account? <a href="<?= base_url('auth') ?>">Log in</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->