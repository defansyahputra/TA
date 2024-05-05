<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Layout container -->
    <div class="layout-page">
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <!-- Message -->
          <?php if (!empty($message)) { ?>
            <div class="col-xxl-3">
              <!--begin::Alert-->
              <div class="alert alert-success alert-dismissible position-fixed" style="top: 20px; right: 20px;" role="alert">
                <!--begin::Content-->
                <div class="d-flex flex-column pe-0 pe-sm-10">
                  <h4 class="fw-bold">Pesan</h4>
                  <span><?php echo $message; ?></span>
                </div>
                <!--end::Content-->
                <!--begin::Close-->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <!--end::Close-->
              </div>
              <!--end::Alert-->
            </div>
          <?php } ?>
          
          <!-- Breadcrumb -->
          <h6 class="mb-2">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
              <span class="<?php echo $breadcrumb['class']; ?>">
                <?php echo ($breadcrumb['active'] == TRUE) ? '<a href="' . $breadcrumb['href'] . '" class="pe-3 text-muted">' : NULL; ?>
                <?php echo $breadcrumb['text']; ?>
                <?php echo ($breadcrumb['active'] == TRUE) ? '</a>' : NULL; ?>
            <?php } ?>
            </h6>
          
          <div class="row pt-2">
            <!-- Basic Layout -->
            <div class="col-xxl">
              <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 fw-bold">Hak Akses</h4>
                  <small class="text-muted float-end">Edit Hak Akses</small>
                </div>
                <div class="card-body">
                  <form class="form-horizontal" role="form" action="<?php echo $action; ?>" method="POST">
                    <div class="mb-3 row">
                      <label for="inputPassword" class="col-sm-2 col-form-label text-end">Hak Akses<span style="color:red;">*</span></label>
                      <div class="col-sm-10">
                        <select class="form-control role" name="role_id" tabindex="2">
                          <?php foreach ($listRoles->result() as $role) { ?>
                            <option value="<?php echo $role->role_id ?>" <?php if ($role->role_id == $role_id_change) echo 'selected="selected"'; ?>>
                              <?php echo $role->full; ?>
                            </option>
                          <?php } ?>
                        </select>
                        <span style="color: red;"><?php echo form_error('role_id'); ?></span>
                      </div>
                    </div>
                    <div class="row justify-content-end">
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">
                          <i class='bx bx-save' ></i>&nbsp; Simpan
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- / Content -->
      </div>
    </div>
  </div>
</div>
