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
                                <h4 class="card-header fw-bold px-1 pt-3 pb-3">Rekam Medis</h4>
                            </div>
                            <div>
                                Tes
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->
            </div>
        </div>
    </div>
</div>