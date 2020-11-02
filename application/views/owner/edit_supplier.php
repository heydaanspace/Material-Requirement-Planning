<section class="section">

  <!-- Breadcrumb -->
  <div class="section-header">
    <h1>Mitra Bisnis Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Kontak</a></div>
      <div class="breadcrumb-item">Ubah Supplier</div>
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
            <h4>Ubah Data Supplier</h4>
          </div>

          <form action="" method="post" enctype="multipart/form-data" >
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Nama Supplier / Toko</label>
                  <input type="hidden" class="form-control" name="supplier_id" value="<?php echo $supplier->supplier_id ?>">
                  <input type="text" class="form-control <?php echo form_error('supplier_name') ? 'is-invalid':'' ?>" name="supplier_name" placeholder="Nama perusahaan / gerai supplier" value="<?php echo $supplier->supplier_name ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Nama Pemilik</label>
                  <input type="text" class="form-control <?php echo form_error('owner_name') ? 'is-invalid':'' ?>" name="owner_name" placeholder="Nama pemilik" value="<?php echo $supplier->owner_name ?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputAddress">No. Telp</label>
                  <input type="text" class="form-control <?php echo form_error('supplier_telp') ? 'is-invalid':'' ?>" 
                  name="supplier_telp" placeholder="No telp supplier" value="<?php echo $supplier->supplier_telp?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">Email</label>
                  <input type="email" class="form-control <?php echo form_error('supplier_email') ? 'is-invalid':'' ?>" 
                  name="supplier_email" placeholder="Email supplier" value="<?php echo $supplier->supplier_email ?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Alamat</label>
                  <textarea name="supplier_address" class="form-control <?php echo form_error('supplier_address') ? 'is-invalid':'' ?>">
                    <?php echo $supplier->supplier_address ?>
                  </textarea>
                </div>
              </div>
            </div>

            <div class="card-footer text-right">
              <a class="btn btn-light" href="<?php echo base_url(); ?>owner/kontak">Batal</a>
              <button class="btn btn-primary" type="submit" name="btn">Simpan</button>
            </div>
            
          </form>

        </div>
      </div>
    </div>
  </div>

</section>
