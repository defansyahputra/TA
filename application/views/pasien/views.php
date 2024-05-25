<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="layout-page">
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h6 class="mb-2">
                        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                            <span class="<?php echo $breadcrumb['class']; ?>">
                                <?php if ($breadcrumb['active']) { ?>
                                    <a href="<?= $breadcrumb['href']; ?>" class="pe-3 text-grey-300">
                                <?php } ?>
                                    <?= $breadcrumb['text']; ?>
                                <?php if ($breadcrumb['active']) { ?>
                                    </a>
                                <?php } ?>
                            </span>
                        <?php } ?>
                    </h6>
                    <div class="row">
                        <div class="card pb-3 px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header fw-bold px-1 pt-3 pb-3">List Pasien</h4>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <div class="mb-3 col-sm-2">
                                    <select id="selectKlinik" class="form-select">
                                        <option value="">Pilih Klinik</option>
                                        <?php foreach ($list_klinik as $klinik): ?>
                                            <option value="<?= $klinik->id_klinik; ?>"><?= $klinik->klinik; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <table id="pegawai" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Kategori Pasien</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">NO.HP</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">Tanggal Lahir</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0" id="pasien-table-body">
                                        <?php 
                                        $no = 1;
                                        foreach ($list_pasien->result() as $pasien) { 
                                            $this->db->select('roles.role');
                                            $this->db->from('users');
                                            $this->db->join('user_roles', 'user_roles.user_id = users.id');
                                            $this->db->join('roles', 'roles.role_id = user_roles.role_id');
                                            $this->db->where('users.id', $pasien->id);
                                            $this->db->where('user_roles.role_id', 2);
                                            $role_query = $this->db->get();

                                            if ($role_query->num_rows() > 0) {
                                                $role_row = $role_query->row();
                                                $role = $role_row->role;
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $no; ?></td>
                                                    <td class="text-center"><?= $pasien->username; ?></td>
                                                    <td class="text-center"><?= $pasien->kategori_pasien; ?></td>
                                                    <td class="text-center"><?= $pasien->alamat; ?></td>
                                                    <td class="text-center"><?= $pasien->nohp; ?></td>
                                                    <td class="text-center"><?= $pasien->jenis_kelamin; ?></td>
                                                    <td class="text-center"><?= $pasien->tanggal_lahir; ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="<?= site_url('Pasien/rekammedis/' . $pasien->id); ?>">
                                                                    <i class="bx bx-edit-alt me-1"></i> Rekam Medis
                                                                </a>
                                                                <a class="dropdown-item" href="<?= site_url('Pasien/detail/' . $pasien->id); ?>">
                                                                    <i class='bx bx-spreadsheet'></i> Detail Rekam Medis
                                                                </a>
                                                                <a class="dropdown-item" href="<?= site_url('Usersmanagement/delete/' . $pasien->id); ?>" onclick="return confirm('Are You Sure Want to Delete This Data?')">
                                                                    <i class="bx bx-trash me-1"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php 
                                                $no++;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#selectKlinik').change(function() {
            var id_klinik = $(this).val();
            if (id_klinik) {
                $.ajax({
                    url: '<?= site_url('Rekam_Medis/getPasienByKlinik') ?>',
                    type: 'POST',
                    data: {id_klinik: id_klinik},
                    dataType: 'json',
                    success: function(data) {
                        var tableBody = $('#pasien-table-body');
                        tableBody.empty();
                        if (data.length > 0) {
                            $.each(data, function(index, pasien) {
                                tableBody.append('<tr>' +
                                    '<td class="text-center">' + (index + 1) + '</td>' +
                                    '<td class="text-center">' + pasien.username + '</td>' +
                                    '<td class="text-center">' + pasien.kategori_pasien + '</td>' +
                                    '<td class="text-center">' + pasien.alamat + '</td>' +
                                    '<td class="text-center">' + pasien.nohp + '</td>' +
                                    '<td class="text-center">' + pasien.jenis_kelamin + '</td>' +
                                    '<td class="text-center">' + pasien.tanggal_lahir + '</td>' +
                                    '<td class="text-center">' +
                                        '<div class="dropdown">' +
                                            '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                                                '<i class="bx bx-dots-vertical-rounded"></i>' +
                                            '</button>' +
                                            '<div class="dropdown-menu">' +
                                                '<a class="dropdown-item" href="<?= site_url('Pasien/rekammedis/') ?>' + pasien.id + '">' +
                                                    '<i class="bx bx-edit-alt me-1"></i> Rekam Medis' +
                                                '</a>' +
                                                '<a class="dropdown-item" href="<?= site_url('Usersmanagement/delete/') ?>' + pasien.id + '" onclick="return confirm(\'Are You Sure Want to Delete This Data?\')">' +
                                                    '<i class="bx bx-trash me-1"></i> Delete' +
                                                '</a>' +
                                            '</div>' +
                                        '</div>' +
                                    '</td>' +
                                '</tr>');
                            });
                        } else {
                            tableBody.append('<tr><td colspan="8" class="text-center">No data available</td></tr>');
                        }
                    }
                });
            } else {
                $('#pasien-table-body').empty();
            }
        });
    });
</script>