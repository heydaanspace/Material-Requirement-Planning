<section class="section">
  <!-- Notification Session -->
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Tetapkan Pengguna Baru</h4>
          </div>
          <form action="<?php echo site_url('owner/users/updateuser') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Nama Pengguna</label>
                  <input type="text" class="form-control" name="ifullname" value="<?= $edit_user->fullname ?>">
                  <input type="hidden" class="form-control" name="iuser_id" value="<?= $edit_user->user_id ?>">
                </div>
                <div class="form-group col-md-6" id="divmaterialcode">
                  <label for="inputEmail4">Posisi</label>
                  <select class="form-control selposition" name="selposition">
                    <option value=""></option>
                    <?php foreach ($posisi as $data): ?>
                      <option value="<?= $data->id_role; ?>" <?php if ($data->id_role == $edit_user->id_role) { echo "selected='selected'";}?>>
                        <?= $data->name; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email</label>
                  <input type="email" class="form-control" name="iemail" value="<?= $edit_user->email ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Username</label>
                  <input type="text" class="form-control" name="iusername" value="<?= $edit_user->username ?>">
                </div>
              </div>
              <hr>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">No telp</label>
                  <input type="number" class="form-control" name="itelp" value="<?= $edit_user->no_telp ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Alamat</label>
                  <textarea class="form-control" name="iaddress"><?= $edit_user->address ?></textarea>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                 <label for="inputEmail4">Status</label>
                 <select class="form-control" name="istatus">
                  <?php if ($edit_user->is_active == "1"){?>
                    <option value="1" selected>Aktif</option>
                    <option value="0">Nonaktif</option>
                  <?php } ?>
                  <?php if  ($edit_user->is_active == "0"){?>
                    <option value="1">Aktif</option>
                    <option value="0" selected>Nonaktif</option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="card-footer text-right">
            <a class="btn btn-light" href="<?php echo base_url(); ?>production/kontak">Batal</a> &nbsp;
            <button class="btn btn-primary" type="submit" name="btn">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</section>


<!------------------------------------- Embeded File ----------------------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $(document).ready(function(){ 
    $('.selposition').select2({
      width: '100%',
      placeholder: 'Tetapkan Posisi',
      escapeMarkup: function (markup) { return markup; }
    }); 
  });
</script>





