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
                        <h3 class="mb-4 fw-bold">Klinik Bojongsoang</h3>
                        <div class="row">
                            <div class="col-sm-6 col-lg-12 mb-4">
                                <div class="card">
                                    <div class="mt-3 col-sm-2 mx-3">
                                        <a href="<?= base_url('Income') ?>">
                                            <button class="btn btn-sm btn-outline-danger justify-content-center" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                                <i class='bx bx-chevron-left'></i>
                                                <span>Kembali</span>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0">Total Income</h6>
                                            <small class="text-muted">Total Income</small>
                                        </div>
                                        <hr class="my-2">
                                        <h1 class="fw-bold text-center"><?= rupiah($TotalIncomeBojongsoang) ?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 col-lg-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="fw-bold">Income Chart</h4>
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

    <script type="module" src="https://unpkg.com/chart.js@4.2.1/dist/chart.umd.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "<?php echo site_url('Klinik/Klinik_Cibadak/chartData'); ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    const labels = data.map(entry => {
                        const date = new Date(entry.year, entry.month - 1);
                        const monthName = date.toLocaleString('default', {
                            month: 'long'
                        });
                        return `${monthName} ${entry.year}`;
                    });
                    const incomes = data.map(entry => entry.total_income);

                    new Chart("myChart", {
                        type: "line",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Total Income",
                                fill: true,
                                pointRadius: 3,
                                borderColor: "rgba(39,146,245,0.68)",
                                backgroundColor: "rgba(39,146,245,0.22)",
                                data: incomes
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const value = context.raw;
                                            return 'Rp.' + new Intl.NumberFormat('id-ID').format(value);
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Month'
                                    }
                                },
                                y: {
                                    title: {
                                        display: false,
                                        text: 'Total Income'
                                    },
                                    ticks: {
                                        callback: function(value, index, values) {
                                            return 'Rp.' + new Intl.NumberFormat('id-ID').format(value);
                                        }
                                    }
                                }
                            }
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