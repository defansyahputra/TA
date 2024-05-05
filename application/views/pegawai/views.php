<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Layout container -->
    <div class="layout-page">
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <h3 class="mb-4 fw-bold">Pegawai</h3>
          <div class="row">
            <!-- Hoverable Table rows -->
            <div class="card pb-3 px-4">
                <table id="pegawai" class="table table-hover">
                <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header fw-bold px-1 pt-3 pb-3">List Data Pegawai</h5>
                <div class="table-responsive text-nowrap">
                    <div class="pb-3 pt-4">
                    <button class="btn btn-outline-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                        <i class="bx bx-export me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Export</span>
                    </button>
                    </div>
                </div>
                </div>

                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Pegawai</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Hak Akses</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php 
                    $no = 1;
                    foreach ($listuser->result() as $user) {
                      $this->db->select('roles.role');
                      $this->db->from('users');
                      $this->db->join('user_roles', 'user_roles.user_id = users.id');
                      $this->db->join('roles', 'roles.role_id = user_roles.role_id');
                      $this->db->where('users.id', $user->id);
                      $this->db->where_in('user_roles.role_id', array(1, 3));
                      $role_query = $this->db->get();

                      if ($role_query->num_rows() > 0) {
                        $role_row = $role_query->row();
                        $role = $role_row->role;
                    ?>
                    <tr>
                      <td class="text-center"><?= $no; ?></td>
                      <td class="text-center"><?= $user->name; ?></td>
                      <td class="text-center"><?php echo ($user->activated == '1') ? '<span class="badge bg-label-success">Aktif</span>' : '<span class="badge bg-label-danger">Tidak Aktif</span>'; ?></td>
                      <td class="text-center"><?php echo $role; ?></td>
                    </tr>
                    <?php 
                    $no++;
                    }
                  }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Hoverable Table rows -->
          </div>
        </div>
        <!-- / Content -->
      </div>
    </div>
  </div>
</div>