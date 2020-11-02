

<!-- General JS Scripts -->
<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.nicescroll.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/stisla.js')?>"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="<?php echo base_url('assets/js/scripts.js')?>"></script>
<script src="<?php echo base_url('assets/js/custom.js')?>"></script>

	<!-- Page Specific JS File -->

 <script>
 	window.onload = function() {
 		<?php if ($this->session->flashdata('msg') != '') {
 			echo "effect_msg();";
 		}?>
 	}

 	function effect_msg_form() {
 		$('.form-msg').slideDown(1000),
 		setTimeout(function() {
 			$('.form-msg').slideUp(1000);
 		}, 3000)
 	}

 	function effect_msg() {
 		$('.msg').show(1000),
 		setTimeout(function() {
 			$('.msg').fadeOut(1000);
 		}, 3000)
 	}
 </script>