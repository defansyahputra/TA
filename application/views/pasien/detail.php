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
                        <!-- Breadcrumbs -->
                        <?php foreach ($breadcrumbs as $breadcrumb): ?>
                            <span class="<?= $breadcrumb['class']; ?>">
                                <?= ($breadcrumb['active'] == TRUE) ? '<a href="' . $breadcrumb['href'] . '" class="pe-3 text-grey-300">' : NULL; ?>
                                <?= $breadcrumb['text']; ?>
                                <?= ($breadcrumb['active'] == TRUE) ? '</a>' : NULL; ?>
                            </span>
                        <?php endforeach; ?>
                    </h6>
                    <div class="row">
                        <!-- Tabel Data Pasien -->
                        <div class="card">
                            <div class="mt-3 col-sm-2">
                                <a href="<?= base_url('Pasien') ?>">
                                    <button class="btn btn-sm btn-outline-danger justify-content-center" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                        <i class='bx bx-chevron-left'></i>
                                        <span>Kembali</span> 
                                    </button>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header fw-bold px-1 pt-3 pb-3">Detail Rekam Medis</h4>
                                <div class="">
                                    <a href="#" onclick="exportToExcel('pegawai', 'rekam-medis')">
                                        <button class="btn btn-sm btn-outline-primary justify-content-center" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                            <i class="bx bx-export me-sm-1 pb-1"></i>
                                            <span class="d-none d-sm-inline-block">Export</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <table id="pegawai" class="table table-hover"> 
                                <thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <!-- <th class="text-center">Nama</th> -->
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Object</th>
                                        <th class="text-center">Plan</th>
                                        <th class="text-center">Kategori Tindakan</th>
                                        <th class="text-center">Tindakan</th>
                                        <th class="text-center">Gigi</th>
                                        <th class="text-center">Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                <?php foreach ($rekam_medis as $rekam): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $rekam->date; ?></td>
                                        <!-- <td><?php echo $rekam->pasien_name; ?></td> -->
                                        <td><small><?php echo $rekam->subject; ?></small></td>
                                        <td><small><?php echo $rekam->object; ?></small></td>
                                        <td><small><?php echo $rekam->plan; ?></small></td>
                                        <td class="text-center"><?php echo $rekam->kategori_tindakan; ?></td>
                                        <td class="text-center"><?php echo $rekam->tindakan; ?></td>
                                        <td class="text-center"><?php echo $rekam->gigi; ?></td>
                                        <td class="text-center"><?php echo rupiah($rekam->harga); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function exportToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    filename = filename?filename+'.xls':'excel_data.xls';

    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        downloadLink.download = filename;

        downloadLink.click();
    }
}
</script>