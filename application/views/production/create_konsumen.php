
<section class="section">

	<!-- Breadcrumb -->
	<div class="section-header">
		<h1>Mitra Bisnis Baru</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="#">Kontak</a></div>
			<div class="breadcrumb-item">Buat Konsumen Baru</div>
		</div>
	</div>
	<!-- Notif from helper (Lanjutkan karne belum selesai Ref=> Susantokun) -->
	<div class="msg" style="display:none;">
		<?= @$this->session->flashdata('msg'); ?>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Tambah Konsumen</h4>
					</div>

					<form action="<?php echo site_url('production/kontak/addkonsumen') ?>" method="post" enctype="multipart/form-data" >
						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail4">Nama Lengkap</label>
									<input type="text" class="form-control <?php echo form_error('customer_name') ? 'is-invalid':'' ?>" name="customer_name" placeholder="Nama Konsumen">
								</div>
								<div class="form-group col-md-6">
									<label for="inputPassword4">Brand / Merk / Perusahaan</label>
									<input type="text" class="form-control <?php echo form_error('brand_name') ? 'is-invalid':'' ?>" name="brand_name" placeholder="Brand / Merk / Perusahaan">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputAddress">No. Telp</label>
									<input type="text" class="form-control <?php echo form_error('customer_telp') ? 'is-invalid':'' ?>" 
									name="customer_telp" placeholder="No Telp Konsumen">
								</div>
								<div class="form-group col-md-6">
									<label for="inputAddress">Email</label>
									<input type="email" class="form-control <?php echo form_error('customer_email') ? 'is-invalid':'' ?>" 
									name="customer_email" placeholder="Email Konsumen">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Alamat</label>
									<textarea name="customer_address" class="form-control <?php echo form_error('customer_address') ? 'is-invalid':'' ?>"></textarea>
								</div>
								<div class="form-group col-md-6">
									<label>Katerangan</label>
									<textarea name="keterangan" class="form-control <?php echo form_error('keterangan') ? 'is-invalid':'' ?>"></textarea>
								</div>
							</div>
						</div>

						<div class="card-footer text-right" id="btnsub">
							<a class="btn btn-light" href="<?php echo base_url(); ?>production/kontak">Batal</a>
							<button class="btn btn-primary" type="submit" name="btn">Simpan</button>
						</div>
						
					</form>

				</div>
			</div>
		</div>
	</div>

</section>
<!--
<script>
	setTimeout(function() {
		$('#msg').fadeOut('fast');
	}, 2000);
</script>
-->

