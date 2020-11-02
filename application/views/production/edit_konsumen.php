<section class="section">

  <!-- Breadcrumb -->
  <div class="section-header">
    <h1>Mitra Bisnis Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Kontak</a></div>
      <div class="breadcrumb-item">Buat Konsumen Baru</div>
    </div>
  </div>

  <!-- Notification Session -->
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Ubah Data Konsumen</h4>
          </div>

          <form action="" method="post" enctype="multipart/form-data" >
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Nama Lengkap</label>
                  <input type="hidden" class="form-control" name="customer_id" value="<?php echo $customer->customer_id ?>">
                  <input type="text" class="form-control" name="customer_name" placeholder="Nama Konsumen" value="<?php echo $customer->customer_name ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Brand / Merk / Perusahaan</label>
                  <input type="text" class="form-control" name="brand_name" placeholder="Brand / Merk / Perusahaan" value="<?php echo $customer->brand_name ?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputAddress">No. Telp</label>
                  <input type="text" class="form-control" 
                  name="customer_telp" placeholder="No Telp Konsumen" value="<?php echo $customer->customer_telp ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">Email</label>
                  <input type="email" class="form-control" 
                  name="customer_email" placeholder="Email Konsumen" value="<?php echo $customer->customer_email ?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Alamat</label>
                  <textarea name="customer_address" class="form-control"><?php echo $customer->customer_address ?></textarea>
                </div>
                <div class="form-group col-md-6">
                  <label>Keterangan</label>
                  <textarea name="keterangan" class="form-control"><?php echo $customer->keterangan ?></textarea>
                </div>
              </div>
            </div>

            <div class="card-footer text-right">
              <a class="btn btn-light" href="<?php echo base_url(); ?>production/kontak_view">Batal</a>
              <button class="btn btn-primary" type="submit" name="btn">Simpan</button>
            </div>
            
          </form>

        </div>
      </div>
    </div>
  </div>

</section>
