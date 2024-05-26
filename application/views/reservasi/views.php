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
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-6">
                            <div class="card pb-3 px-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-header fw-bold px-0 pt-3 pb-3">Reservasi Jadwal</h4>
                                </div>
                                <div>
                                    <form class="form-horizontal" role="form" action="<?= $action ?>" method="post">
                                        <div class="pt-3">
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="klinik">Klinik</label>
                                                <div class="col-sm-10">
                                                    <select name="klinik" id="klinik" class="form-select" data-control="select2" data-placeholder="Pilih Klinik . . .">
                                                        <option value="">Pilih Klinik</option>
                                                        <?php foreach ($list_klinik as $klinik): ?>
                                                            <option value="<?= encrypt_url($klinik->id_klinik); ?>" <?= ($klinik->id_klinik == $selected_klinik) ? 'selected' : ''; ?>>
                                                                <?= $klinik->klinik; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span style="color: red;"><?= form_error('klinik'); ?></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="date">Tanggal</label>
                                                <div class="col-sm-10">
                                                    <input type="date" id="date" class="form-control" name="tanggal" value="<?php if (isset($tanggal)) { echo $tanggal; } ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="jam">Jam</label>
                                                <div class="col-sm-10">
                                                    <input type="time" class="form-control" id="jam" name="jam" value="<?php if (isset($jam)) { echo $jam; } ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                <i class='bx bx-save'></i>&nbsp;Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card pb-3 px-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-header fw-bold px-0 pt-3 pb-3">Apointment</h4>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table id="pegawai" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Klinik</th>
                                                <th class="text-center">Jam</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach ($list_reservasi as $reservasi) { 
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= $reservasi->tanggal; ?></td>
                                                <td class="text-center"><?= $reservasi->klinik; ?></td>
                                                <td class="text-center"><?= $reservasi->jam; ?></td>
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
</div>