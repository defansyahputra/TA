<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h3 class="mb-4 fw-bold">Income</h3>
                        <div class="row">
                            <div class="col-sm-6 col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Klinik Cibadak</h6>
                                            <small class="text-muted">Current Month</small>
                                        </div>
                                        <hr class="my-2">
                                        <h2 class="fw-bold"><?= rupiah($TotalIncomeCibadak) ?></h2>
                                        <h6><a class="list-group-item-success">+33% </a>&nbspdari bulan lalu</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Klinik Lembang </h6>
                                            <small class="text-muted">Current Month</small>
                                        </div>
                                        <hr class="my-2">
                                        <h2 class="fw-bold"><?= rupiah($TotalIncomeLembang) ?></h2>
                                        <h6><a class="list-group-item-danger">-33% </a>&nbspdari bulan lalu</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Klinik Bojongsoang</h6>
                                            <small class="text-muted">Current Month</small>
                                        </div>
                                        <hr class="my-2">
                                        <h2 class="fw-bold"><?= rupiah($TotalIncomeBojongsoang) ?></h2>
                                        <h6><a class="list-group-item-danger">-33% </a>&nbspdari bulan lalu</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 col-lg-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="fw-bold">Total Income</h4>
                                            <!-- <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <input type="date" id="startDate" class="form-control">
                                                </div>
                                                <div class="">
                                                    <p class="pt-2">To :</p>
                                                </div>
                                                <div class="">
                                                    <input type="date" id="endDate" class="form-control">
                                                </div>
                                            </div> -->
                                        </div>
                                        <canvas id="myChart" height="100px"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
<script>
  $(document).ready(function() {
    $.ajax({
        url: "<?php echo site_url('Income/chartData'); ?>",
        type: "GET",
        dataType: "json",
        success: function(data) {
            const dates = data.map(entry => entry.date);
            const prices = data.map(entry => entry.harga);

            new Chart("myChart", {
                type: "line",
                data: {
                    labels: dates,
                    datasets: [{
                        fill: true,
                        pointRadius: 3,
                        borderColor: "rgba(39,146,245,0.68)",
                        backgroundColor: "rgba(39,146,245,0.22)",
                        data: prices
                    }]
                },
                options: {
                    responsive: true,
                    legend: { display: false },
                    animations: {
                        radius: {
                            duration: 400,
                            easing: 'linear',
                            loop: (context) => context.active
                        }
                    },
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("Error while fetching chart data: ", error);
        }
    });
});
</script>
</body>