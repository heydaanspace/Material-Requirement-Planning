<section class="section">

  <!-- Breadcrumb -->
  <div class="section-header">
    <h1>Mitra Bisnis Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Kontak</a></div>
      <div class="breadcrumb-item">Buat Supplier Baru</div>
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
            <h4>Tambah Supplier</h4>
          </div>

          <form action="<?php echo site_url('production/kontak/addsupplier') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Nama Supplier / Toko</label>
                  <input type="text" class="form-control <?php echo form_error('supplier_name') ? 'is-invalid':'' ?>" name="supplier_name" placeholder="Nama perusahaan / gerai supplier">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Nama Pemilik</label>
                  <input type="text" class="form-control <?php echo form_error('owner_name') ? 'is-invalid':'' ?>" name="owner_name" placeholder="Nama pemilik">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputAddress">No. Telp</label>
                  <input type="text" class="form-control <?php echo form_error('supplier_telp') ? 'is-invalid':'' ?>" 
                  name="supplier_telp" placeholder="No telp supplier">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">Email</label>
                  <input type="email" class="form-control <?php echo form_error('supplier_email') ? 'is-invalid':'' ?>" 
                  name="supplier_email" placeholder="Email supplier">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Alamat</label>
                  <textarea name="supplier_address" class="form-control <?php echo form_error('supplier_address') ? 'is-invalid':'' ?>"></textarea>
                </div>
              </div>
            </div>

            <div class="card-footer text-right">
              <a class="btn btn-light" href="<?php echo base_url(); ?>production/kontak">Batal</a>
              <button class="btn btn-primary" type="submit" name="btn">Simpan</button>
            </div>
            
          </form>

        </div>
      </div>
    </div>
  </div>

</section>
