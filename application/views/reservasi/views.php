<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="layout-page">
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h6 class="mb-2">
                        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                            <span class="<?php echo $breadcrumb['class']; ?>">
                                <?php if ($breadcrumb['active']) { ?>
                                    <a href="<?= $breadcrumb['href']; ?>" class="pe-3 text-grey-300">
                                <?php } ?>
                                    <?= $breadcrumb['text']; ?>
                                <?php if ($breadcrumb['active']) { ?>
                                    </a>
                                <?php } ?>
                            </span>
                        <?php } ?>
                    </h6>
                    <div class="row">
                        <div class="card pb-3 px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header fw-bold px-1 pt-3 pb-3">List Pasien</h4>
                            </div>
                            <div class="table-responsive text-nowrap">
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
                                    <tbody class="table-border-bottom-0" id="pasien-table-body">
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>