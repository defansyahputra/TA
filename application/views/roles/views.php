<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Layout container -->
    <div class="layout-page">
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <h6 class="mb-2">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <span class="<?php echo $breadcrumb['class']; ?>"><?php echo ($breadcrumb['active'] == TRUE) ? '<a href="' . $breadcrumb['href'] . '" class="pe-3 text-grey-300">' : NULL; ?><?php echo $breadcrumb['text']; ?><?php echo ($breadcrumb['active'] == TRUE) ? '</a>' : NULL; ?>
            <?php } ?>
          </h6>
          <div class="row">
            <!-- Hoverable Table rows -->
            <div class="card pb-3 px-4">
                <table id="pegawai" class="table table-hover">
                <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-header fw-bold px-1 pt-3 pb-3">List Hak Akses</h4>
                <div class="table-responsive text-nowrap">
                    <div class="pb-3 pt-4">
                      <a href="<?= site_url('Roles/add') ?>">
                        <button class="btn btn-outline-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                          <i class="bx bx-plus-circle me-sm-1"></i>
                          <span href="" class="d-none d-sm-inline-block">Tambah Hak Akses</span>
                        </button>
                      </a>
                    </div>
                </div>
                </div>

                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Hak Akses</th>
                      <th>Nama Lengkap Hak Akses</th>
                      <th class="min-w-150px">Default</th>
                      <th class="min-w-350px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  <?php
                    $no = 1;
                    foreach ($listRoles->result() as $role) {
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $role->role; ?></td>
                            <td><?php echo $role->full; ?></td>
                            <td><?php if ($role->default == '1') {
                                    echo '<span class="badge bg-label-success">Aktif</span>';
                                } else {
                                    echo '<span class="badge bg-label-danger">Tidak Aktif</span>';
                                }; ?></td>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo site_url('Roles/change_default/' . $role->role_id); ?>"
                                    ><i class="bx bx-check-square me-1"></i> Default</a
                                >
                                <a class="dropdown-item" href="<?php echo site_url('Roles/role_permission/' . $role->role_id); ?>"
                                    ><i class="bx bx-cog me-1"></i> Modul</a
                                >
                                <a class="dropdown-item" href="<?php echo site_url('Roles/update/' . $role->role_id); ?>"
                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="<?php echo site_url('Roles/delete/' . $role->role_id); ?>" onclick="return confirm('Are You Sure Want to Delete This Data?')"
                                    ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                                </div>
                            </div>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Hoverable Table rows -->
          </div>
        </div>
        <!-- / Content -->
      </div>
    </div>
  </div>
</div>