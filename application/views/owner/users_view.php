<section class="section">
  <div class="section-header">
    <h1>Manajemen Pengguna</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Manajemen Pengguna</div>
    </div>
  </div>
  <div class="row">

  </div>
  <br>
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="col-4 text-left">
              <h4>Daftar Pengguna</h4>
            </div>
            <div class="col-8 text-right">
              <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>owner/users/newuser">
                <i class="fa fa-user-plus"></i> Pengguna Baru</a>
                <div class="dropdown d-inline mr-2">
                  <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-file-export"></i> Unduh
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">PDF</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
             <div class="form-row">
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="keywords" placeholder="Cari bahan baku" onkeyup="searchFilter()">
              </div>
              <div class="form-group col-md-2">
                <select class="form-control" id="sortBy" onchange="searchFilter()">
                  <option value="">Urutkan</option>
                  <option value="asc">A-Z</option>
                  <option value="desc">Z-A</option>
                </select>
              </div>
            </div>
            <div class="card-body p-0" id="userList">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th></th>
                    <th><div style="width: 120px;">Nama Lengkap</div></th>
                    <th><div style="width: 120px;">Posisi</div></th>
                    <th><div style="width: 120px;">Email</div></th>
                    <th><div style="width: 100px;">Username</div></th>
                    <th><div style="width: 100px;">Kata Sandi</div></th>
                    <th><div style="width: 100px;">No. Telp</div></th>
                    <th><div style="width: 100px;">Status</div></th>
                    <th><div style="width: 100px;">Dibuat Pada</div></th>
                    <th><div style="width: 100px;">Terakhir Login</div></th>
                    <th></th>
                  </tr>
                  <?php foreach ($users as $datauser ): ?>
                    <tr>
                      <td><i class="fas fa-user"></i></td>
                      <td><a href="<?php echo base_url()?>owner/users/showdetailusers/<?= $datauser['user_id']; ?>"><?= $datauser['fullname']; ?></a></td>
                      <td><p class="badge badge-primary"><?= $datauser['name']; ?></p></td>
                      <td><p><?= $datauser['email']; ?></p></td>
                      <td><p><?= $datauser['username']; ?></p></td>
                      <td><p><?= $datauser['password']; ?></p></td>
                      <td><p><?= $datauser['no_telp']; ?></p></td>
                      <td>
                        <?php if ($datauser['is_active'] == "1") { ?>
                         <p class="badge badge-success">Aktif</p>
                       <?php } else { ?>
                        <p class="badge badge-danger">Nonktif</p>
                      <?php } ?> 
                    </td>
                    <td> <p><?= $datauser['created_date']; ?></p></td>
                    <td> <p><?= $datauser['last_login']; ?></p></td>
                    <td>
                      <div class="dropdown d-inline">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Tindakan
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item has-icon" href="owner/users/showdetailusers/<?= $datauser['user_id']; ?>"><i class="fas fa-cog"></i>Ubah</a>
                          <a onclick="deleteConfirm('<?php echo base_url() ?>owner/users/actdeleteuser/<?= $datauser['user_id']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
            <?php echo $this->ajax_pagination->create_links(); ?>
          </div>
          <div class="prodloading" style="display: none;">
            <div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>


<!------------------------------------------------------------- Embeded File -------------------------------------------------------------->



<!-- JS Live Search & Pagination --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  function searchFilter(page_num) {
   page_num = page_num?page_num:0;
   var keywords = $('#keywords').val();
   var sortBy = $('#sortBy').val();
   $.ajax({
    type: 'POST',
    url: '<?php echo base_url(); ?>owner/users/ajaxPaginationData/'+page_num,
    data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
    beforeSend: function () {
     $('.prodloading').show();
   },
   success: function (html) {
     $('#userList').html(html);
     $('.prodloading').fadeOut("slow");
   }
 });
 }
</script>


<!-- JS Delete Confirmation-->
<script>
  function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
  }
</script>




<!-- Modal Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Data Pengguna yang terhapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>