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
                            <span class="<?php echo $breadcrumb['class']; ?>">
                                <?php echo ($breadcrumb['active'] == TRUE) ? '<a href="' . $breadcrumb['href'] . '" class="pe-3 text-grey-300">' : NULL; ?>
                                <?php echo $breadcrumb['text']; ?>
                                <?php echo ($breadcrumb['active'] == TRUE) ? '</a>' : NULL; ?>
                            </span>
                        <?php } ?>
                    </h6>
                    <div class="row">
                        <!-- Hoverable Table rows -->
                        <div class="card py-3 px-4 mb-2">
                            <div class="d-flex align-items-center" >
                                <div class="px-2">
                                    <select id="selectKlinik" class="form-select">
                                    <option value="">Pilih Klinik</option>
                                    <?php foreach ($list_klinik as $klinik): ?>
                                        <option value="<?= encrypt_url($klinik->id_klinik); ?>">
                                            <?= $klinik->klinik; ?>
                                        </option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <button id="btnSetKlinik" class="btn btn-outline-primary" type="button">Set</button>
                                </div>
                            </div>
                        </div>
                        <div class="card pb-3 px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header fw-bold px-1 pt-3 pb-3">List Pasien</h4>
                                <div class="table-responsive text-nowrap">
                                    <div class="pb-3 pt-4">
                                        <a href="<?= site_url('Pasien/add') ?>">
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
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Kategori Pasien</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">NO.HP</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="pegawai" class="table-border-bottom-0">
                                <?php 
                                    $no = 1;
                                    foreach ($listpasien->result() as $pasien) {
                                    $this->db->select('roles.role');
                                    $this->db->from('users');
                                    $this->db->join('user_roles', 'user_roles.user_id = users.id');
                                    $this->db->join('roles', 'roles.role_id = user_roles.role_id');
                                    $this->db->where('users.id', $pasien->id);
                                    $this->db->where('user_roles.role_id', 2);
                                    $role_query = $this->db->get();

                                    if ($role_query->num_rows() > 0) { // Memeriksa apakah user memiliki role_id = 2
                                        $role_row = $role_query->row();
                                        $role = $role_row->role;

                                    ?>
                                    <tr>
                                    <td class="text-center"><?= $no; ?></td>
                                    <td class="text-center"><?= $pasien->name; ?></td>
                                    <td class="text-center"><?= $pasien->kategori_pasien; ?></td>
                                    <td class="text-center"><?= $pasien->alamat; ?></td>
                                    <td class="text-center"><?= $pasien->nohp; ?></td>
                                    <td class="text-center"><?= $pasien->jenis_kelamin; ?></td>
                                    <td class="text-center"><?= $pasien->tanggal_lahir; ?></td>
                                    <td class="text-center"><?= $pasien->username; ?></td>
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