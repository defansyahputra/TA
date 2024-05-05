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
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header fw-bold px-1 pt-3 pb-3">List Pasien</h4>
                                <div class="table-responsive text-nowrap">
                                    <div class="pb-3 pt-4">
                                        <a href="<?= site_url('Usersmanagement/add') ?>">
                                            <button class="btn btn-outline-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                                <i class="bx bx-plus-circle me-sm-1"></i>
                                                <span class="d-none d-sm-inline-block">Tambah Pasien</span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <table id="pegawai" class="table table-hover"> 
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NAMA</th>
                                        <th>Jenis Kelamin</th>
                                        <th>alamat</th>
                                        <th>NO.HP</th>
                                        <th>Tanggal Lahir</th>
                                        <!-- <th>Status</th>
                                        <th>Banned</th> -->
                                        <th class="min-w-350px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php
                                    $no = 1;
                                    foreach ($listuser->result() as $user) {
                                    $this->db->select('roles.role');
                                    $this->db->from('users');
                                    $this->db->join('user_roles', 'user_roles.user_id = users.id');
                                    $this->db->join('roles', 'roles.role_id = user_roles.role_id');
                                    $this->db->where('users.id', $user->id);
                                    $this->db->where('user_roles.role_id', 2);
                                    $role_query = $this->db->get();

                                    if ($role_query->num_rows() > 0) { // Memeriksa apakah user memiliki role_id = 2
                                        $role_row = $role_query->row();
                                        $role = $role_row->role;
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $user->name; ?></td>
                                            <td><?php echo $user->gender; ?></td>
                                            <td><?php echo $user->alamat; ?></td>
                                            <td><?php echo $user->nohp; ?></td>
                                            <td><?php echo $user->tanggal_lahir; ?></td>
                                            <!-- <td><?php echo ($user->activated == '1') ? '<span class="badge bg-label-success">Aktif</span>' : '<span class="badge bg-label-danger">Tidak Aktif</span>'; ?></td>
                                            <td><?php echo ($user->banned == '1') ? '<span class="badge bg-label-danger">Banned</span>' : '<span class="badge bg-label-success">Unbanned</span>'; ?></td> -->
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <?php if ($user->activated != 0) { ?>
                                                            <a class="dropdown-item" href="<?php echo site_url('Pasien/RekamMedis/' . $user->id_user); ?>">
                                                                <i class="bx bx-edit-alt me-1"></i> Rekam Medis
                                                            </a>
                                                        <?php } ?>
                                                        <?php
                                                        if ($user->banned == '1') {
                                                        ?>
                                                            <a class="dropdown-item" href="<?php echo site_url('Usersmanagement/unbanned/' . $user->id_user); ?>">
                                                                <i class="bx bx-recycle me-1"></i> Unbanned
                                                            </a>
                                                            <?php
                                                        } else {
                                                            if ($user->activated != 0) {
                                                            ?>
                                                                <a class="dropdown-item" href="<?php echo site_url('Usersmanagement/banned/' . $user->id_user); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin akan membanned ?')">
                                                                    <i class="bx bx-trash me-1"></i> Banned
                                                                </a>
                                                            <?php
                                                            }
                                                        }
                                                        if ($user->activated == '0') {
                                                            ?>
                                                            <a class="dropdown-item" href="<?php echo site_url('Usersmanagement/activate/' . $user->id_user); ?>">
                                                                <i class="bx bx-check-square me-1"></i> Aktifasi
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php if ($user->activated != 0) { ?>
                                                            <a class="dropdown-item" href="<?php echo site_url('Usersmanagement/change_role/' . $user->id_user); ?>">
                                                                <i class="bx bx-universal-access me-1"></i> p

                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- / Content -->
            </div>
        </div>
    </div>
</div>
