<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, All Rights Reserved.
              </div>
              <div class="d-none d-lg-inline-block">
                Version 1.0
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="<?= base_url('assets/') ?>vendor/libs/jquery/jquery.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/libs/popper/popper.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/js/bootstrap.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/libs/hammer/hammer.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/libs/i18n/i18n.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="<?= base_url('assets/') ?>vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="<?= base_url('assets/') ?>js/main.js"></script>

  <!-- Bootstrap4 Duallistbox -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <script type="text/javascript">
	$('.duallistbox').bootstrapDualListbox();

	$('#bootstrap-duallistbox-nonselected-list_permission_id').css({
		'display': 'inline-block',
		'background-color': '#fff',
		'position': 'relative'
	});
</script>

  <!-- Datatables -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/scripts.bundle.js"></script>

  <script>
    new DataTable('#pegawai', {
      search: {
            return: true
        }
    });
  </script>

</body>

</html>

<!-- beautify ignore:end -->