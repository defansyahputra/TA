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
                        <div class="card pb-3 px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header fw-bold px-1 pt-3 pb-3">Pengaturan Tindakan</h4>
                                <div class="table-responsive text-nowrap">
                                    <div class="pb-3 pt-4">
                                        <a href="<?= site_url('Pengaturan_Tindakan/add') ?>">
                                            <button class="btn btn-outline-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                                <i class="bx bx-plus-circle me-sm-1"></i>
                                                <span class="d-none d-sm-inline-block">Tambah Kategori Tindakan</span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <table id="pegawai" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class='text-center'>No</th>
                                        <th class='text-center'>Kategori Tindakan</th>
                                        <th class='text-center'>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php
                                    $no = 1;
                                    foreach ($listkategori->result() as $kategori) {
                                    ?>
                                        <tr>
                                            <td class='text-center'><?php echo $no; ?></td>
                                            <td class='text-center'><?php echo $kategori->kategori_tindakan; ?></td>
                                            <td class='text-center'>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="<?php echo site_url('Pengaturan_Tindakan/edit/' . $kategori->id_kategori_tindakan); ?>">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item" href="<?php echo site_url('Pengaturan_Tindakan/delete/' . $kategori->id_kategori_tindakan); ?>">
                                                            <i class='bx bx-trash'></i> Hapus
                                                        </a>
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
                </div>
                <!-- / Content -->
            </div>
        </div>
    </div>
</div>
