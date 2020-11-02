<section class="section">
  <!-- Breadcrumb -->
 <!--  <div class="section-header">
    <h1>Bahan Baku Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Kartu Produk</div>
    </div>
  </div> -->
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
          <form action="<?php echo site_url('owner/users/adduser') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Nama Pengguna</label>
                  <input type="text" class="form-control" name="ifullname" placeholder="">
                </div>
                <div class="form-group col-md-6" id="divmaterialcode">
                  <label for="inputEmail4">Posisi</label>
                  <select class="form-control selposition" name="selposition">
                    <option value=""></option>
                    <?php foreach ($posisi as $data): ?>
                      <option value="<?= $data->id_role; ?>"><?= $data->name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email</label>
                  <input type="email" class="form-control" name="iemail" placeholder="">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Username</label>
                  <input type="text" class="form-control" name="iusername" placeholder="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Kata Sandi</label>
                  <input type="password" class="form-control" name="ipassword" placeholder="">
                </div>
              </div>
              <hr>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">No telp</label>
                  <input type="number" class="form-control" name="itelp" placeholder="">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Alamat</label>
                  <textarea class="form-control" name="iaddress"></textarea>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4" id="divprice">
                 <label for="inputEmail4">Dibuat Pada</label>
                 <input type="text" class="form-control" name="icreated_date" value="<?= date('Y-m-d h:i:s') ?>" placeholder="" readonly>
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





