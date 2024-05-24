<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Layout container -->
    <div class="layout-page">
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <!-- Message -->
          <?php if (!empty($message)) { ?>
            <div class="col-xxl-3">
              <!--begin::Alert-->
              <div class="alert alert-success alert-dismissible position-fixed" style="top: 20px; right: 20px;" role="alert">
                <!--begin::Content-->
                <div class="d-flex flex-column pe-0 pe-sm-10">
                  <h4 class="fw-bold">Pesan</h4>
                  <span><?php echo $message; ?></span>
                </div>
                <!--end::Content-->
                <!--begin::Close-->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <!--end::Close-->
              </div>
              <!--end::Alert-->
            </div>
          <?php } ?>

          <!-- Breadcrumb -->
          <span>
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
              <span class="<?php echo $breadcrumb['class']; ?>">
                <?php echo ($breadcrumb['active'] == TRUE) ? '<a href="' . $breadcrumb['href'] . '" class="pe-3 text-muted">' : NULL; ?>
                <?php echo $breadcrumb['text']; ?>
                <?php echo ($breadcrumb['active'] == TRUE) ? '</a>' : NULL; ?>
              </span>
            <?php } ?>
          </span>
          <div class="row">
            <div class="col-xxl">
              <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 fw-bold">Rekam Medis</h4>
                  <small class="text-muted float-end">Tambah Rekam Medis</small>
                </div>
                <div class="card-body" style="display:flex; justify-content:center;">
                  <img usemap="#gigi" src="<?= base_url('assets/public/gigi-800.png') ?>" alt="gigi">
                  <!-- Area Map untuk gambar gigi -->
                  <map name="gigi">
                    <!-- Area Gigi -->
                    <area shape="rect" coords="47,49,84,86" href="" alt="gigi18">
                    <area shape="rect" coords="91,48,131,87" href="" alt="gigi17">
                    <area shape="rect" coords="145,50,179,84" href="" alt="gigi16">
                    <area shape="rect" coords="191,51,222,85" href="" alt="gigi15">
                    <area shape="rect" coords="234,51,266,85" href="" alt="gigi14">
                    <area shape="rect" coords="277,54,311,83" href="" alt="gigi13">
                    <area shape="rect" coords="320,54,355,82" href="" alt="gigi12">
                    <area shape="rect" coords="366,53,399,81" href="" alt="gigi11"> 

                    <area shape="rect" coords="396,47,438,90" href="" alt="gigi21">
                    <area shape="rect" coords="439,47,483,90" href="" alt="gigi22">
                    <area shape="rect" coords="483,47,527,90" href="" alt="gigi23">
                    <area shape="rect" coords="527,47,571,90" href="" alt="gigi24">
                    <area shape="rect" coords="571,47,614,90" href="" alt="gigi25">
                    <area shape="rect" coords="614,47,659,90" href="" alt="gigi26">
                    <area shape="rect" coords="659,47,703,90" href="" alt="gigi27">
                    <area shape="rect" coords="703,47,747,90" href="" alt="gigi28">

                    <area shape="rect" coords="45,318,88,361" href="" alt="gigi48">
                    <area shape="rect" coords="90,320,132,362" href="" alt="gigi47">
                    <area shape="rect" coords="134,319,175,361" href="" alt="gigi46">
                    <area shape="rect" coords="177,318,219,363" href="" alt="gigi45">
                    <area shape="rect" coords="221,318,263,362" href="" alt="gigi44">
                    <area shape="rect" coords="264,319,308,362" href="" alt="gigi43">
                    <area shape="rect" coords="309,319,351,361" href="" alt="gigi42">
                    <area shape="rect" coords="352,319,395,362" href="" alt="gigi41">

                    <area shape="rect" coords="396,318,439,362" href="" alt="gigi31">
                    <area shape="rect" coords="439,319,483,362" href="" alt="gigi32">
                    <area shape="rect" coords="483,319,526,362" href="" alt="gigi33">
                    <area shape="rect" coords="528,319,570,362" href="" alt="gigi34">
                    <area shape="rect" coords="572,319,614,362" href="" alt="gigi35">
                    <area shape="rect" coords="616,319,658,362" href="" alt="gigi36">
                    <area shape="rect" coords="659,319,702,362" href="" alt="gigi37">
                    <area shape="rect" coords="703,319,745,362" href="" alt="gigi38">

                    <area shape="rect" coords="178,148,214,187" href="" alt="gigi55">
                    <area shape="rect" coords="224,151,258,184" href="" alt="gigi54">
                    <area shape="rect" coords="265,150,301,183" href="" alt="gigi53">
                    <area shape="rect" coords="310,150,344,182" href="" alt="gigi52">
                    <area shape="rect" coords="364,152,399,180" href="" alt="gigi51">

                    <area shape="rect" coords="408,154,441,180" href="" alt="gigi61">
                    <area shape="rect" coords="452,152,486,182" href="" alt="gigi62">
                    <area shape="rect" coords="496,152,530,181" href="" alt="gigi63">
                    <area shape="rect" coords="540,150,572,182" href="" alt="gigi64">
                    <area shape="rect" coords="582,150,617,185" href="" alt="gigi65">

                    <area shape="rect" coords="177,222,219,265" href="" alt="gigi85">
                    <area shape="rect" coords="221,222,264,265" href="" alt="gigi84">
                    <area shape="rect" coords="264,222,307,265" href="" alt="gigi83">
                    <area shape="rect" coords="309,222,351,265" href="" alt="gigi82">
                    <area shape="rect" coords="352,222,395,265" href="" alt="gigi81">

                    <area shape="rect" coords="396,222,439,265" href="" alt="gigi71">
                    <area shape="rect" coords="440,222,483,265" href="" alt="gigi72">
                    <area shape="rect" coords="484,222,526,265" href="" alt="gigi73">
                    <area shape="rect" coords="527,222,570,265" href="" alt="gigi74">
                    <area shape="rect" coords="571,222,614,265" href="" alt="gigi75">
                  </map>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xxl">
              <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 fw-bold">Rekam Medis</h4>
                </div>
                <div class="card-body">
                  <form class="form-horizontal" role="form" action="<?php echo $action; ?>" method="POST">
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="name">Nama Pasien</label>
                      <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="name" id="name" placeholder="Masukkan Nama Pasien . . ." autocomplete="off" value="<?php echo encrypt_url($list_pasien->id); ?>">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Pasien . . ." autocomplete="off" value="<?php echo ($list_pasien->name); ?>" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="subject">Subject</label>
                      <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="subject" id="subject" placeholder="Masukkan Subject . . ." autocomplete="off" value="<?php if (isset($subject)) { echo $subject; } ?>"></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="object">Object</label>
                      <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="object" id="object" placeholder="Masukkan Object . . ." autocomplete="off" value="<?php if (isset($object)) { echo $object; } ?>"></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="plan">Plan</label>
                      <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="plan" id="plan" placeholder="Masukkan Plan . . ." autocomplete="off" value="<?php if (isset($plan)) { echo $plan; } ?>"></textarea>
                      </div>
                    </div>
                    <hr>
                    <div class="row mb-3 d-flex justify-content-between">
                      <div class="col-sm-auto">
                        <button type="button" class="btn btn-sm btn-outline-primary btn-add-field">
                          <i class='bx bx-plus'></i>&nbsp;Add Assesment
                        </button>
                      </div>
                      <div class="col-sm-auto ms-auto">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-field">
                          <i class='bx bx-x'></i>&nbsp;remove
                        </button>
                      </div>
                    </div>
                    <br>
                    <div id="dynamic-fields-container">
                      <div class="dynamic-field">

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="kategori_tindakan">Kategori Tindakan</label>
                          <div class="col-sm-10">
                            <select name="kategori_tindakan" id="kategori_tindakan" class="form-select kategori-tindakan" data-placeholder="Pilih Kategori tindakan . . .">
                                <option value="">Pilih Kategori tindakan</option>
                                <?php
                                foreach ($list_kategori_tindakan as $kategori_tindakan) {
                                  if ($kategori_tindakan->id_kategori_tindakan == $selected_kategori_tindakan) {
                                    ?>
                                    <option value="<?php echo encrypt_url($kategori_tindakan->id_kategori_tindakan); ?>" selected><?php echo $kategori_tindakan->kategori_tindakan; ?></option>
                                  <?php } else { ?>
                                    <option value="<?php echo encrypt_url($kategori_tindakan->id_kategori_tindakan); ?>"><?php echo $kategori_tindakan->kategori_tindakan; ?></option>
                                    <?php
                                  }
                                }
                                ?>
                            </select>
                            <span style="color: red;"><?= form_error('kategori_tindakan'); ?></span>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="tindakan">Tindakan</label>
                          <div class="col-sm-10">
                            <select class="form-select selected-tindakan" id="tindakan" data-placeholder="Pilih Tindakan..." name="tindakan">
                            </select>
                            <div class="text-danger"><?php echo form_error('tindakan'); ?></div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="gigi">Gigi</label>
                          <div class="col-sm-10">
                            <input class="form-control" name="gigi" id="gigi">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="harga">Harga</label>
                          <div class="col-sm-10">
                            <input class="form-control" name="harga" id="harga">
                          </div>
                        </div>
                        <br>
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
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Get Tindakan By Kategori
  $('.kategori-tindakan').change(function () {
    var id_kategori_tindakan = $(this).val();

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

        $(".selected-tindakan").html(option);
        $('.selected-tindakan').trigger('change');
      }
    });
  });


  // Add More Assesment
  // function updateTindakanOption(element) {
  //   var id_kategori_tindakan = element.val();
  //   var tindakanSelect = element.closest('.dynamic-field').find('.selected-tindakan');

  //   $ajax({
  //     url : "<?= site_url('Pasien/get_tindakan') ?>",
  //     type : 'post',
  //     data : {
  //       id_kategori_tindakan: id_kategori_tindakan
  //     },
  //     dataType: 'json',
  //     success: function (response) {
  //       var len = response.length;
  //       var option = '<option value="">Pilih Tindakan</option>';
  //       for (var i = 0; i < len; i++) {
  //         var id_tindakan = response[i]['id_tindakan'];
  //         var tindakan = response[i]['tindakan'];
  //         option += "<option value='" + id_tindakan + "'>" + tindakan + "</option>";
  //       }
  //       tindakanSelect.html(option);
  //       tindakanSelect.trigger('change');
  //     }
  //   });
  // }

  // $(document).ready(function () {
  //   $(document).on('change', '.kategori_tindakan', function () {
  //     updateTindakanOption($(this));
  //   });

  //   $('.btn-add-field').click(function () {
  //     var newField = $('.dynamic-field:first').clone();
  //     newField.find('input, select').val('');
  //     $('#dynamic-fields-container').append(newField);
  //   });

  //   $(document).on('click', '.btn-remove-field', function () {
  //     if($('.dynamic-field').length > 1) {
  //       $(this).closest('.dynamic-field').remove();
  //     } else {
  //       alert('At least one set of fields must be present.');
  //     }
  //   });
  // });
</script>