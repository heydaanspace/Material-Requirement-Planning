<div class="d-flex flex-wrap align-items-stretch">
	<div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
		<div class="p-4 m-3">
			<img src="<?php echo base_url();?>assets/img/logo.png" alt="logo" width="80" class="mb-5 mt-2">
			<h4 class="text-dark font-weight-normal">Masuk ke <span class="font-weight-bold">MRP APPS</span></h4>
			<!--<p class="text-muted">Sistem Informasi Perencanaan & Pengengalian Produksi Dengan Metode Material Requirement Planning.</p>-->
			<form method="post" action="<?php echo base_url('auth/login'); ?>" role="login">
				<div class="msg" style="display:none;">
					<?= @$this->session->flashdata('msg'); ?>
				</div>
				<br>
				<div class="form-group">
					<label for="email">Email</label>
					<input id="email" type="email" class="form-control" name="email" tabindex="1">
					<div class="invalid-feedback">
						Please fill in your email
					</div>
				</div>

				<div class="form-group">
					<div class="d-block">
						<label for="password" class="control-label">Password</label>
					</div>
					<input id="password" type="password" class="form-control" name="password" tabindex="2">
					<div class="invalid-feedback">
						please fill in your password
					</div>
				</div>
				<div class="form-group">
					<div class="d-block">
						<p id="image"><?php echo $showcaptcha ?></p>
					</div>
					<input style="width:300px;" id="icaptcha" height="40" type="text" class="form-control" tabindex="2" placeholder="Masukan kode keamanan diatas" name="icaptcha" id="icaptcha">
				</div>

				<div class="form-group text-right">
					<a href="#" class="float-left mt-3">
						Forgot Password? <i>(Coming Soon)</i>
					</a>
					<button type="submit" name="submit" value="login" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
						Login
					</button>
				</div>

				<div class="mt-5 text-center">
					Tidak punya akses? <a href="auth-register.html">Buat permohonan akun (<i>Coming Soon</i>)</a>
				</div>
			</form>
			
			<div class="text-center mt-5 text-small">
				Copyright &copy; heydaans&co. Made with 💙 by Danang Stiawan
				<div class="mt-2">
					<a href="#">Privacy Policy</a>
					<div class="bullet"></div>
					<a href="#">Terms of Service</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 position-relative overlay-gradient-bottom" data-background="<?php echo base_url();?>assets/img/unsplash/login-bg3.jpg">
		<div class="absolute-bottom-left index-2">
			<div class="text-light p-5 pb-2">
				<div style="padding-bottom: 10rem;">
					<h1 class="mb-2 display-4 font-weight-bold" style="color: white;"><?= $salam; ?></h1>
					<h5 class="font-weight-normal text-muted-transparent" style="color: white;">Yogyakarta, Indonesia</h5>
				</div>
				<!--Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>-->
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});
	$('#myalert').delay('slow').slideDown('slow').delay(4100).slideUp(600);
</script>

<!---->
