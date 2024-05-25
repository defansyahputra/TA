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
                  <img src="<?= base_url('assets/public/gigi-800.png') ?>" alt="gigi">
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

                    <!-- Dynamic Fields Section -->
                    <div id="dynamic-form-fields">
                      <!-- Dynamic form fields will be added here -->
                    </div>

                    <div class="row mb-3">
                      <div class="col-sm-10 offset-sm-2">
                        <button type="button" id="add-field" class="btn btn-sm btn-outline-primary">Add Assesment</button>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
      <!-- Content wrapper -->
    </div>
    <!-- / Layout container -->
  </div>
  <!-- / Layout wrapper -->

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const addFieldButton = document.getElementById('add-field');
      const dynamicFormFields = document.getElementById('dynamic-form-fields');
      let fieldCounter = 0;

      addFieldButton.addEventListener('click', function () {
        fieldCounter++;
        const fieldSet = document.createElement('div');
        fieldSet.className = 'row mb-3';
        fieldSet.id = 'field-set-' + fieldCounter;  

        fieldSet.innerHTML = `
        <div class="row mb-3">
          <div class="col-sm-4">
            <input type="hidden" name="id_assesment" class="form-control" value="${fieldCounter}">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="kategori_tindakan[${fieldCounter}]">Kategori Tindakan</label>
          <div class="col-sm-4">
          <select name="kategori_tindakan[${fieldCounter}]" id="kategori_tindakan[${fieldCounter}]" class="form-select kategori-tindakan" data-placeholder="Pilih Kategori tindakan . . .">
            <option value="">Pilih Kategori tindakan</option>
            <?php
            foreach ($list_kategori_tindakan as $kategori_tindakan) {
              if ($kategori_tindakan->id_kategori_tindakan == $selected_kategori_tindakan) {
                ?>
                <option value="<?php echo $kategori_tindakan->id_kategori_tindakan; ?>" selected><?php echo $kategori_tindakan->kategori_tindakan; ?></option>
              <?php } else { ?>
                <option value="<?php echo $kategori_tindakan->id_kategori_tindakan; ?>"><?php echo $kategori_tindakan->kategori_tindakan; ?></option>
                <?php
              }
            }
            ?>
        </select>
          </div>
          <label class="col-sm-2 col-form-label" for="tindakan[${fieldCounter}]">Tindakan</label>
          <div class="col-sm-4">
          <select name="tindakan[${fieldCounter}]" id="tindakan[${fieldCounter}]" class="form-select kategori-tindakan" data-placeholder="Pilih tindakan . . .">
            <option value="">Pilih tindakan</option>
            <?php
            foreach ($list_tindakan as $tindakan) {
              if ($tindakan->id_tindakan == $selected_tindakan) {
                ?>
                <option value="<?php echo $tindakan->id_tindakan; ?>" selected><?php echo $tindakan->tindakan; ?></option>
              <?php } else { ?>
                <option value="<?php echo $tindakan->id_tindakan; ?>"><?php echo $tindakan->tindakan; ?></option>
                <?php
              }
            }
            ?>
        </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="gigi-${fieldCounter}">Gigi</label>
          <div class="col-sm-4">
            <input type="text" name="gigi[${fieldCounter}]" class="form-control" placeholder="Gigi" required>
          </div>
          <label class="col-sm-2 col-form-label" for="harga-${fieldCounter}">Harga</label>
          <div class="col-sm-4">
            <input type="number" name="harga[${fieldCounter}]" class="form-control" placeholder="Harga" required>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-2 offset-sm-10">
            <button type="button" class="btn btn-sm btn-outline-danger remove-field" data-id="${fieldCounter}">Hapus</button>
          </div>
        </div>
      `;

        dynamicFormFields.appendChild(fieldSet);

        const removeFieldButtons = document.querySelectorAll('.remove-field');
        removeFieldButtons.forEach(button => {
          button.addEventListener('click', function () {
            const fieldId = this.getAttribute('data-id');
            const fieldSetToRemove = document.getElementById('field-set-' + fieldId);
            dynamicFormFields.removeChild(fieldSetToRemove);
          });
        });
      });
    });
  </script>
</div>