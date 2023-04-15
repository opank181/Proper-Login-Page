<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Create New Password</h5>
                                    <p class="text-center small">Enter your new Password</p>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <form class="row g-3 needs-validation" novalidate action="<?= base_url('auth/gantipassword') ?>" method="post">
                                    <input type="hidden" class="form-control" placeholder="New Password" name="email" value="<?= $this->input->get('email'); ?>">
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">New Password</label>
                                        <div class="input-group has-validation">

                                            <input type="text" name="PasswordUser" class="form-control" id="yourUsername">
                                            <?= form_error('PasswordUser', '<div style="display:block" class="invalid-feedback">', '</div>'); ?>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Repeat Password</label>
                                        <input type="text" name="PasswordUser2" class="form-control" id="yourPassword">
                                        <?= form_error('PasswordUser2', '<div style="display:block" class="invalid-feedback">', '</div>'); ?>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Submit</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Have account? <a href="<?= base_url('auth') ?>">Log In</a></p>
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