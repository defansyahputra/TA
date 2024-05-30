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
                                            <h6 class="mb-0">Total Pendapatan</h6>
                                            <small class="text-muted">1 - 30 Januari 2024</small>
                                        </div>
                                        <hr class="my-2">
                                        <h2 class="fw-bold"><?= rupiah($TotalIncome) ?></h2>
                                        <h6><a class="list-group-item-success">+33% </a>&nbspdari bulan lalu</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Total </h6>
                                            <small class="text-muted">1 - 30 Januari 2024</small>
                                        </div>
                                        <hr class="my-2">

                                        <h6><a class="list-group-item-danger">-33% </a>&nbspdari bulan lalu</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Total </h6>
                                            <small class="text-muted">1 - 30 Januari 2024</small>
                                        </div>
                                        <hr class="my-2">

                                        <h6><a class="list-group-item-danger">-33% </a>&nbspdari bulan lalu</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-9 col-lg-12 mb-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">pendapatan Bersih</h5>
                                        <canvas id="myChart" height="100px"></canvas>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script>
        const xBersih = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const yBersih = [1000, 1200, 1400, 1300, 1800, 2000, 2200, 2400, 2600, 2800, 3000, 3200];
        const yKotor = [2200, 2400, 1200, 1800, 1300, 2200, 2000, 2600, 2400, 3000, 2800, 3200];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xBersih,
                datasets: [{
                        label: 'pendapatan Bersih',
                        fill: true,
                        pointRadius: 3,
                        borderColor: "rgba(39,146,245,0.68)",
                        backgroundColor: "rgba(39,146,245,0.22)",
                        data: yBersih
                    },
                    {
                        label: 'pendapatan Kotor',
                        fill: true,
                        pointRadius: 3,
                        borderColor: "rgba(255,45,45,0.68)",
                        backgroundColor: "rgba(255,45,45,0.22)",
                        data: yKotor
                    }
                ]
            },
            options: {
                responsive: true,
                legend: {
                    display: true
                },
                animations: {
                    radius: {
                        duration: 400,
                        easing: 'linear',
                        loop: (context) => context.active
                    }
                },
            }
        });
    </script> -->

</body>