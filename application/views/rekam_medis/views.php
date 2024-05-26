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
                                <h4 class="card-header fw-bold px-1 pt-3 pb-3">Rekam Medis</h4>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table id="pegawai" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Kategori Tindakan</th>
                                            <th class="text-center">Tindakan</th>
                                            <th class="text-center">Subject</th>
                                            <th class="text-center">Object</th>
                                            <th class="text-center">Plan</th>
                                            <th class="text-center">Gigi</th>
                                            <th class="text-center">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php 
                                        $no = 1;
                                        foreach ($list_rekammedis as $rekammedis) { 
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td class="text-center"><?= $rekammedis->date; ?></td>
                                            <td class="text-center"><?= $rekammedis->kategori_tindakan; ?></td>
                                            <td class="text-center"><?= $rekammedis->tindakan; ?></td>
                                            <td class="text-center"><?= $rekammedis->subject; ?></td>
                                            <td class="text-center"><?= $rekammedis->object; ?></td>
                                            <td class="text-center"><?= $rekammedis->plan; ?></td>
                                            <td class="text-center"><?= $rekammedis->gigi; ?></td>
                                            <td class="text-center"><?= rupiah($rekammedis->harga); ?></td>
                                        </tr>
                                        <?php 
                                        $no++;
                                        } ?>
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