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
					<?php
					if (!empty($message)) {
					?>
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
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
								</button>
								<!--end::Close-->
							</div>
							<!--end::Alert-->
						</div>
					<?php } ?>

					<!-- Breadcrumb -->
					<h6 class="mb-2">
						<?php foreach ($breadcrumbs as $breadcrumb) { ?>
							<span class="<?php echo $breadcrumb['class']; ?>"><?php echo ($breadcrumb['active'] == TRUE) ? '<a href="' . $breadcrumb['href'] . '" class="pe-3 text-muted">' : NULL; ?><?php echo $breadcrumb['text']; ?><?php echo ($breadcrumb['active'] == TRUE) ? '</a>' : NULL; ?>
							<?php } ?>
					</h6>
					<div class="row pt-2">
						<!-- Basic Layout -->
						<div class="col-xxl">
							<div class="card mb-4">
								<div class="card-header d-flex align-items-center justify-content-between">
									<h4 class="mb-0 fw-bold">Form Menu</h4>
									<small class="text-muted float-end">Tambah Menu</small>
								</div>
								<div class="card-body">
									<form class="form-horizontal" role="form" action="<?php echo $action; ?>" method="POST">
										<div class="row mb-3">
											<label class="col-sm-2 col-form-label" for="nama_menu">Nama Menu</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama_menu" placeholder="Masukkan Nama Menu . . ." autocomplete="off" value="<?php if (isset($nama_menu)) {
																																												echo $nama_menu;
																																											} ?>">
											</div>
										</div>
										<div class="row mb-3">
											<label class="col-sm-2 col-form-label" for="icon">Icon</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="icon" placeholder="Masukkan Icon . . ." autocomplete="off" value="<?php if (isset($icon)) {
																																									echo $icon;
																																								} ?>">
											</div>
										</div>
										<div class="row mb-3">
											<label class="col-sm-2 col-form-label" for="basic-default-email">Parent Menu</label>
											<div class="col-sm-10">
												<select class="form-select" data-control="select2" data-placeholder="Pilih Parent Menu..." name="id_menu_parent">
													<option value="">Pilih Parent Menu</option>
													<?php
													foreach ($listMenu->result() as $menu) {
														if ($menu->id_menu == $id_menu_parent) {
															echo '<option value="' . $menu->id_menu . '" selected >' . $menu->nama_menu . '</option>';
														} else {
															echo '<option value="' . $menu->id_menu . '">' . $menu->nama_menu . '</option>';
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="row mb-3">
											<label class="col-sm-2 col-form-label" for="basic-default-phone">Kategori</label>
											<div class="col-sm-10">
												<?php
												if (isset($kategori) && $kategori == "Link") {
												?>
													<label class="radio-inline radio-primary">
														<input type="radio" name="kategori" value="Controller" class="form-check-input">
														Controllers
													</label>
													&nbsp
													<label class="radio-inline radio-primary">
														<input type="radio" name="kategori" value="Link" class="form-check-input" checked="checked">
														Link
													</label>
												<?php
												} else {
												?>
													<label class="radio-inline radio-primary">
														<input type="radio" name="kategori" value="Controller" class="form-check-input" checked="checked">
														Controllers
													</label>
													&nbsp
													<label class="radio-inline radio-primary">
														<input type="radio" name="kategori" value="Link" class="form-check-input">
														Link
													</label>
												<?php
												}
												?>
											</div>
										</div>
										<div class="row mb-3">
											<label class="col-sm-2 col-form-label" for="basic-default-message">Link</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="href" placeholder="Masukkan Link . . ." autocomplete="off" value="<?php if (isset($href)) {
																																									echo $href;
																																								} ?>">
											</div>
										</div>
										<div class="row mb-3">
											<label class="col-sm-2 col-form-label" for="basic-default-message">Urutan Menu</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="sort" placeholder="Masukkan Urutan Menu . . ." autocomplete="off" value="<?php if (isset($sort)) {
																																											echo $sort;
																																										} ?>">
											</div>
										</div>
										<div class="row mb-3">
											<label class="col-sm-2 col-form-label" for="basic-default-message">Status</label>
											<div class="col-sm-10">
												<?php
												if (isset($status) && $status == "N") {
												?>
													<label class="radio-inline radio-success">
														<input type="radio" name="status" value="Y" class="form-check-input">
														Aktif
													</label>
													<label class="radio-inline radio-danger">
														<input type="radio" name="status" value="N" class="form-check-input" checked="checked">
														Non Aktif
													</label>
												<?php
												} else {
												?>
													<label class="radio-inline radio-success">
														<input type="radio" name="status" value="Y" class="form-check-input" checked="checked">
														Aktif
													</label>
													&nbsp
													<label class="radio-inline radio-danger">
														<input type="radio" name="status" value="N" class="form-check-input">
														Non Aktif
													</label>
												<?php
												}
												?>
											</div>
										</div>
										<div class="row justify-content-end">
											<div class="col-sm-10">
												<button type="submit" class="btn btn-primary">
													<i class='bx bx-save'></i>&nbsp Simpan
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