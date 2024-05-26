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
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-lg-9">
                            <div class="card pb-3 px-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-header fw-bold px-0 pt-3 pb-3">Reservasi Jadwal</h4>
                                </div>
                                <div>
                                    Content
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card pb-3 px-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-header fw-bold px-0 pt-3 pb-3">Kalender</h4>
                                </div>
                                <div>
                                    Content
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>