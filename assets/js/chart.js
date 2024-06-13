
    $(document).ready(function() {
        $.ajax({
            url: "<?php echo site_url('Income/chartData'); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                const labels = data.map(entry => `${entry.year}-${('0' + entry.month).slice(-2)}`);
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
                            legend: { display: true },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const value = context.raw;
                                        return 'Rp. ' + new Intl.NumberFormat('id-ID').format(value);
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
                                    display: true,
                                    text: 'Total Income'
                                },
                                ticks: {
                                    callback: function(value, index, values) {
                                        return 'Rp. ' + new Intl.NumberFormat('id-ID').format(value);
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