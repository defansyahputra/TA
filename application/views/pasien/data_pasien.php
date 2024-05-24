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
                        <!-- Breadcrumbs -->
                        <?php foreach ($breadcrumbs as $breadcrumb): ?>
                            <span class="<?= $breadcrumb['class']; ?>">
                                <?= ($breadcrumb['active'] == TRUE) ? '<a href="' . $breadcrumb['href'] . '" class="pe-3 text-grey-300">' : NULL; ?>
                                <?= $breadcrumb['text']; ?>
                                <?= ($breadcrumb['active'] == TRUE) ? '</a>' : NULL; ?>
                            </span>
                        <?php endforeach; ?>
                    </h6>
                    <div class="row">
                        <!-- Select Klinik -->
                        <div class="card py-3 px-4 mb-2">
                            <div class="d-flex align-items-center" >
                                <div class="px-2">
                                    <select id="selectKlinik" class="form-select">
                                        <option value="">Pilih Klinik</option>
                                        <!-- Menampilkan daftar klinik -->
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
                        <!-- Tabel Data Pasien -->
                        <div class="card pb-3 px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header fw-bold px-1 pt-3 pb-3">List Pasien</h4>
                                <div class="table-responsive text-nowrap">
                                    <div class="pb-3 pt-4">
                                        <!-- Tombol Tambah Pasien -->
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
                                <tbody id="tablePasienBody" class="table-border-bottom-0">
                                    <!-- Menampilkan data pasien -->
                                    <?php $no = 1; ?>
                                    <?php foreach ($list_pasien->result() as $pasien): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $pasien->name; ?></td>
                                            <td class="text-center"><?= $pasien->kategori_pasien; ?></td>
                                            <td class="text-center"><?= $pasien->alamat; ?></td>
                                            <td class="text-center"><?= $pasien->nohp; ?></td>
                                            <td class="text-center"><?= $pasien->jenis_kelamin; ?></td>
                                            <td class="text-center"><?= $pasien->tanggal_lahir; ?></td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="<?php echo site_url('Pasien/rekammedis/' . $pasien->id); ?>">
                                                            <i class="bx bx-edit-alt me-1"></i> Rekam Medis
                                                        </a>
                                                        <a class="dropdown-item" href="<?php echo site_url('Usersmanagement/delete/' . $pasien->id); ?>" onclick="return confirm('Are You Sure Want to Delete This Data?')">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#selectKlinik').change(function() {
            var idKlinik = $(this).val();
            $.ajax({
                url: "<?= site_url('Pasien/load_pasien_by_klinik'); ?>",
                type: "POST",
                data: {id_klinik: idKlinik},
                success: function(data) {
                    $('#tablePasienBody').html(data);
                }
            });
        });
    });
</script>
