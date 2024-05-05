<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url('assets/') ?>"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>PT - Tornado (Manajemen Sistem)</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/') ?>img/favicon/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

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
        <div class="authentication-wrapper authentication-basic container-p-y">
        <!-- Register -->
        <div class="card mx-auto" style="width: 65%;"> <!-- Adjusted width here -->
            <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-4">
                <h4 class="fw-bold">Daftar Sekarang</h4>
            </div>
            <!-- /Logo -->

            <form class="mb-3" method="post" action="<?= base_url('auth/registration') ?>">
                <div class="row mb-3">
                    <label for="nama_lengkap" class="col-sm-3 col-form-label text-end">Nama Lengkap :</label>
                    <div class="col-sm-9">
                        <input
                        type="text"
                        class="form-control"
                        id="nama_lengkap"
                        name="nama_lengkap"
                        value="<?= set_value('nama_lengkap') ?>"
                        placeholder="Masukkan Nama Lengkap . . ."
                        autofocus />
                        <?= form_error('nama_lengkap', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label text-end">Username :</label>
                    <div class="col-sm-9">
                        <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        value="<?= set_value('username') ?>"
                        placeholder="Masukkan Username . . ."
                        autofocus />
                        <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label text-end">Email :</label>
                    <div class="col-sm-9">
                        <input
                        type="text"
                        class="form-control"
                        id="email"
                        name="email"
                        value="<?= set_value('email') ?>"
                        placeholder="Masukkan Email . . ."
                        autofocus />
                        <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password1" class="col-sm-3 col-form-label text-end">Kata Sandi :</label>
                    <div class="col-sm-9 input-group input-group-merge">
                        <input
                        type="password"
                        id="password1"
                        class="form-control"
                        name="password1"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password2" class="col-sm-3 col-form-label text-end">Konfirmasi Kata Sandi :</label>
                    <div class="col-sm-9 input-group input-group-merge">
                        <input
                        type="password"
                        id="password2"
                        class="form-control"
                        name="password2"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 ">
                            <?= form_error('password1', '<small class="text-danger" style="padding-left: 8px;">', '</small>') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label text-end">Jenis Kelamin :</label>
                    <div class="col-sm-3 pt-1">
                        <input
                            name="jenis_kelamin"
                            class="form-check-input"
                            type="radio"
                            value="pria"
                            id="pria" />
                        <label class="form-check-label" for="pria">Pria</label>
                    </div>
                    <div class="col-sm-3 pt-1">
                        <input
                            name="jenis_kelamin"
                            class="form-check-input"
                            type="radio"
                            value="wanita"
                            id="wanita" />
                        <label class="form-check-label" for="wanita">Wanita</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 ">
                            <?= form_error('jenis_kelamin', '<small class="text-danger" style="padding-left: 8px;">', '</small>') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_lahir" class="col-sm-3 col-form-label text-end">Tanggal Lahir :</label>
                    <div class="col-sm-9">
                        <input
                            type="date"
                            class="form-control"
                            id="tanggal_lahir"
                            name="tanggal_lahir"
                            value="<?= set_value('tanggal_lahir') ?>"
                            autofocus />
                            <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-3 col-form-label text-end">Alamat :</label>
                    <div class="col-sm-9">
                        <input
                        type="text"
                        class="form-control"
                        id="alamat"
                        name="alamat"
                        value="<?= set_value('alamat') ?>"
                        placeholder="Masukkan Alamat . . ."
                        autofocus />
                        <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <!-- Add other fields with similar row and col structure -->
                <div class="row mb-3">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <button class="btn btn-primary w-100" type="submit">Daftar</button>
                </div>
                </div>
            </form>

            <p class="text-center">
                <span>Sudah Punya Akun?</span>
                <a href="<?= base_url('auth') ?>">
                <span>Masuk Disini</span>
                </a>
            </p>
            </div>
        </div>
        <!-- /Register -->
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

