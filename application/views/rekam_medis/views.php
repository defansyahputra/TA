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
                                <button type="button" id="addAssesment" name="addAssesment" class="btn btn-primary"><i class='bx bx-plus'></i></button>
                            </div>
                            <div id="dynamic_field">
                                <!-- Input fields will be dynamically added here -->
                            </div>
                            <div>
                                <form class="form-horizontal" role="form" action="#" method="POST">
                                <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Kategori Tindakan</label>
                                        <div class="col-sm-10">
                                            <select name="kategori_tindakan" class="form-select kategori-tindakan" data-placeholder="Pilih Kategori tindakan . . .">
                                                <option value="">Pilih Kategori tindakan</option>
                                                <?php foreach ($list_kategori_tindakan as $kategori_tindakan) { ?>
                                                    <?php if ($kategori_tindakan->id_kategori_tindakan == $selected_kategori_tindakan) { ?>
                                                        <option value="<?php echo encrypt_url($kategori_tindakan->id_kategori_tindakan); ?>" selected><?php echo $kategori_tindakan->kategori_tindakan; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo encrypt_url($kategori_tindakan->id_kategori_tindakan); ?>"><?php echo $kategori_tindakan->kategori_tindakan; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <span style="color: red;"><?= form_error('kategori_tindakan'); ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Tindakan</label>
                                        <div class="col-sm-10">
                                            <select class="form-select select-tindakan" data-placeholder="Pilih Tindakan..." name="tindakan">
                                            </select>
                                            <div class="text-danger"><?php echo form_error('tindakan'); ?></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Harga</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="harga" id="harga">
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">
                                                <i class='bx bx-save'></i>&nbsp;Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->
            </div>
        </div>
    </div> 
</div>

<script>
    $(document).ready(function(){
        var i = 0;

        $('#addAssesment').click(function(){
            i++;
            var newRow = 
                '<div id="row'+i+'" class="row mb-3">' +
                    '<label class="col-sm-2 col-form-label">Kategori Tindakan</label>' +
                    '<div class="col-sm-10">' +
                        '<select name="kategori_tindakan[]" class="form-select kategori-tindakan" data-placeholder="Pilih Kategori tindakan . . .">' +
                            '<option value="">Pilih Kategori tindakan</option>' +
                        '</select>' +
                        '<span style="color: red;"></span>' +
                    '</div>' +
                '</div>' +
                '<div class="row mb-3">' +
                    '<label class="col-sm-2 col-form-label">Tindakan</label>' +
                    '<div class="col-sm-10">' +
                        '<select class="form-select select-tindakan" data-placeholder="Pilih Tindakan..." name="tindakan_'+i+'[]">' +
                            '<option value="">Pilih Tindakan</option>' +
                        '</select>' +
                        '<div class="text-danger"></div>' +
                    '</div>' +
                '</div>' +
                '<div class="row mb-3">' +
                    '<label class="col-sm-2 col-form-label">Harga</label>' +
                    '<div class="col-sm-10">' +
                        '<input class="form-control" name="harga_'+i+'" id="harga_'+i+'">' +
                    '</div>' +
                '</div>' +
                '<hr>';
            
            $('#dynamic_field').append(newRow);
            
            // Bind change event to the newly added select elements
            $('.kategori-tindakan').last().change(function () {
                var id_kategori_tindakan = $(this).val();
                var selectTindakan = $(this).closest('.row').next().find('.select-tindakan');

                $.ajax({
                    url: "<?php echo site_url('Pasien/get_tindakan'); ?>",
                    type: 'post',
                    data: {
                        id_kategori_tindakan: id_kategori_tindakan
                    },
                    dataType: 'json',
                    success: function (response) {
                        var len = response.length;

                        var option = '<option value="">Pilih Tindakan</option>';
                        for (var i = 0; i < len; i++) {
                            var id_tindakan = response[i]['id_tindakan'];
                            var tindakan = response[i]['tindakan'];

                            option += "<option value='" + id_tindakan + "'>" + tindakan + "</option>";
                        }

                        selectTindakan.html(option);
                        selectTindakan.trigger('change');
                    }
                });
            });
        });
    });
</script>
