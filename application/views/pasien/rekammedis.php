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
                  <map name="gigi">
                    <area shape="rect" coords="47,49,84,86" href="" alt="gigi18">
                    <area shape="rect" coords="91,48,131,87" href="" alt="gigi17">
                    <area shape="rect" coords="145,50,179,84" href="" alt="gigi16">
                    <area shape="rect" coords="191,51,222,85" href="" alt="gigi15">
                    <area shape="rect" coords="234,51,266,85" href="" alt="gigi14">
                    <area shape="rect" coords="277,54,311,83" href="" alt="gigi13">
                    <area shape="rect" coords="320,54,355,82" href="" alt="gigi12">
                    <area shape="rect" coords="366,53,399,81" href="" alt="gigi11"> 

                    <area shape="rect" coords="396,47,438,90" href="" alt="gigi21">
                    <area shape="rect" coords="439,47,483,90" href="" alt="gigi22">
                    <area shape="rect" coords="483,47,527,90" href="" alt="gigi23">
                    <area shape="rect" coords="527,47,571,90" href="" alt="gigi24">
                    <area shape="rect" coords="571,47,614,90" href="" alt="gigi25">
                    <area shape="rect" coords="614,47,659,90" href="" alt="gigi26">
                    <area shape="rect" coords="659,47,703,90" href="" alt="gigi27">
                    <area shape="rect" coords="703,47,747,90" href="" alt="gigi28">

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
                    <area shape="rect" coords="703,319,745,362" href="" alt="gigi38">

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
                    <area shape="rect" coords="571,222,614,265" href="" alt="gigi75">
                  </map>
                </div>
              </div>
            </div>
          </div>
          <div class="row pt-2">
            <!-- Basic Layout -->
            <div class="col-xxl">
              <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 fw-bold">Data Pasien</h4>
                </div>
                <div class="card-body">
                  <form class="form-horizontal" role="form" action="<?php echo $action; ?>" method="POST">
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Nama</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" autocomplete="off" value="<?php if (isset($name)) { echo $name; } ?>" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Subject</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="subject" id="subject"></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Object</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="object" id="object"></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Assesment</label>
                      <div class="col-sm-1">
                        <input type="number" name="assesment" class="form-control">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row pt-2">
            <!-- Basic Layout -->
            <div class="col-xxl">
              <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 fw-bold">Rekam Medis</h4>
                </div>
                <div class="card-body">
                  <form class="form-horizontal" role="form" action="<?php echo $action; ?>" method="POST">
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Kategori Tindakan</label>
                      <div class="col-sm-10">
                        <select name="kategori_tindakan" class="form-select kategori-tindakan" data-control="select2" data-placeholder="Pilih Kategori tindakan . . .">
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
                      <label class="col-sm-2 col-form-label">Tindakan</label>
                      <div class="col-sm-10">
                      <select name="kategori_tindakan" class="form-select select-tindakan" data-control="select2" data-placeholder="Pilih tindakan . . .">
                            <option value="">Pilih tindakan</option>
                            <?php
                            foreach ($list_tindakan as $tindakan) {
                              if ($tindakan->id_tindakan == $selected_tindakan) {
                                ?>
                                <option value="<?php echo encrypt_url($tindakan->id_tindakan); ?>" selected><?php echo $tindakan->tindakan; ?></option>
                              <?php } else { ?>
                                <option value="<?php echo encrypt_url($tindakan->id_tindakan); ?>"><?php echo $tindakan->tindakan; ?></option>
                                <?php
                              }
                            }
                            ?>
                        </select>
                        <span style="color: red;"><?= form_error('tindakan'); ?></span>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Harga</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="object" id="object"></textarea>
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
        <!-- / Content -->
      </div>
    </div>
  </div>
</div>

<!-- <script>
	$(function () {
		$('.select-kategori-tindakan').change(function () {
			if ($('.select-kategori-tindakan').val() != 'eWl3UGNRYXpVcHFpM1loY1NkVmIzUT09') {
				$('.attr-produk').hide();
				$('.attr-input').append(
					'<div class="attr-project">'
					+ '<input type="text" class="form-control" name="rekammedis">'
					+ '</div>'
				);
			} else {
				$('.attr-produk').show();
				$('.attr-project').remove();
			}
		});
		
		$('.add-content-target').click(function () {
			
		});

		$('.select-kategori-tindakan').change(function () {
			var id_tindakan = $(this).val();

			$.ajax({
				url: "<?php echo site_url('Pasien/rekammedis' . $id); ?>",
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

					$(".select-tindakan").html(option);
					$('.select-tindakan').select2().trigger('change');
				}
			});
		});
	})
</script> -->

<script>
	$(function () {
		// Ketika dropdown kategori tindakan berubah
		$('.select-kategori-tindakan').change(function () {
			// Ambil nilai yang dipilih pada dropdown kategori tindakan
			var selectedValue = $(this).val();
			
			// Lakukan pengecekan nilai yang dipilih
			if (selectedValue != '') {
				// Jika nilai yang dipilih tidak kosong
				// Lakukan AJAX untuk mengambil daftar tindakan berdasarkan kategori yang dipilih
				$.ajax({
					url: "<?php echo site_url('Pasien/rekammedis'.$id); ?>", // Ganti dengan URL atau endpoint yang sesuai
					type: 'post',
					data: {
						id_kategori_tindakan: selectedValue // Gunakan nilai kategori yang dipilih sebagai parameter
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

						$(".select-tindakan").html(option);
						$('.select-tindakan').select2().trigger('change');
					}
				});
			}
		});
	})
</script>
