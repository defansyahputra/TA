<?php
$login = array(
  'name' => 'login',
  'id' => 'user',
  'value' => set_value('login'),
  'placeholder' => 'Username',
  'class' => 'form-control',
  'autocomplete' => 'off'
);
if ($login_by_username and $login_by_email) {
  $login_label = 'Email or username';
} else if ($login_by_username) {
  $login_label = 'Login';
} else {
  $login_label = 'Email';
}
$password = array(
  'name' => 'password',
  'id' => 'pass',
  'data-type' => 'password',
  'value' => set_value('password'),
  'class' => 'form-control',
  'placeholder' => 'Katasandi',
  'autocomplete' => 'off'
);
$remember = array(
  'name' => 'remember',
  'id' => 'monthly',
  'class' => 'form-check-input',
  'value' => 1,
  'checked' => set_value('remember'),
  'autocomplete' => 'off',
  'style' => 'display: block !important;'
);
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/') ?>" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>KLINIK GIGI</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/') ?>img/favicon/klinik.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= base_url('assets/') ?>css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/css/pages/page-auth.css" />

  <!-- Helpers -->
  <script src="<?= base_url('assets/') ?>vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?= base_url('assets/') ?>js/config.js"></script>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <!-- Pendaftaran Berhasil -->
    <?php
    if ($this->session->flashdata('message')) {
    ?>
      <div class="col-xxl-3">
        <div class="alert alert-success alert-dismissible position-fixed" style="top: 20px; right: 20px;" role="alert">
          <?= $this->session->flashdata('message'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    <?php } ?>

    <!-- Gagal Login -->
    <?php
    if ($this->session->flashdata('err_message')) {
    ?>
      <div class="col-xxl-3">
        <div class="alert alert-danger alert-dismissible position-fixed" style="top: 20px; right: 20px;" role="alert">
          <?= $this->session->flashdata('err_message'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    <?php } ?>

    <!-- Logout -->
    <?php
    if ($this->session->flashdata('logout_message')) {
    ?>
      <div class="col-xxl-3">
        <div class="alert alert-dark alert-dismissible position-fixed" style="top: 20px; right: 20px;" role="alert">
          <?= $this->session->flashdata('logout_message'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    <?php } ?>

    <?php
    if ($this->session->flashdata('err_pass_message')) {
    ?>
      <div class="col-xxl-3">
        <div class="alert alert-danger alert-dismissible position-fixed" style="top: 20px; right: 20px;" role="alert">
          <?= $this->session->flashdata('err_pass_message'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    <?php } ?>

    <!-- Akun Belum Aktif -->
    <?php
    if ($this->session->flashdata('err_email_message')) {
    ?>
      <div class="col-xxl-3">
        <div class="alert alert-warning alert-dismissible position-fixed" style="top: 20px; right: 20px;" role="alert">
          <?= $this->session->flashdata('err_email_message'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    <?php } ?>

    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <span class="app-brand-logo demo">
                <img src="<?= base_url('assets/') ?>img/logo/klinik.png" alt="KLINIK GIGI">
                <!-- <span class="app-brand-text align-self-center demo">tes</span> -->
            </div>
            <!-- /Logo -->

            <?php echo form_open($this->uri->uri_string(), array('class' => 'form w-100', 'novalidate' => 'novalidate', 'id' => 'kt_sign_in_form')); ?>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <?php echo form_input($login, array('class' => 'form-control form-control-lg form-control-solid', 'autocomplete' => 'off')); ?>
              <span style="color:red;">
                <?php echo form_error($login['name']); ?>
                <?php echo isset($errors[$login['name']]) ? $errors[$login['name']] : ''; ?>
              </span>
              <span class="form-bar"></span>
              <?= form_error('username', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Kata Sandi</label>
                <a href="auth-forgot-password-basic.html">
                  <small>Lupa Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <?php echo form_password($password, array('class' => 'form-control form-control-lg form-control-solid', 'autocomplete' => 'off')); ?>
                <span class="form-bar"></span>
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
              <div class="col-sm-9 ">
                <span style="color:red;">
                  <?php echo form_error($password['name']); ?>
                  <?php echo isset($errors[$password['name']]) ? $errors[$password['name']] : ''; ?>
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <?php echo form_checkbox($remember, array('class' => 'form-check-input', 'id' => 'flexCheckDefault')); ?>
                <label class="form-check-label" for="remember-me"> Ingatkan Saya </label>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
            </div>
            <?php echo form_close(); ?>

            <!-- <p class="text-center">
                <span>Belum Punya Akun?</span>
                <a href="<?= base_url('Auth/register') ?>">
                  <span>Buat Disini</span>
                </a>
              </p> -->
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->

  <script src="<?= base_url('assets/') ?>vendor/libs/jquery/jquery.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/libs/popper/popper.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/js/bootstrap.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="<?= base_url('assets/') ?>js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>