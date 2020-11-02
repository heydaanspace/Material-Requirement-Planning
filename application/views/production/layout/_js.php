 <!-- General JS Scripts -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/stisla.js"></script>


 <!-- Template JS File -->
 <script src="<?php echo base_url();?>assets/js/scripts.js"></script>
 <script src="<?php echo base_url();?>assets/js/custom.js"></script>
 

 <!-- Page Specific JS File -->
 <script src="<?php echo base_url();?>assets/js/custom/page-create-produk.js"></script>
 <script src="<?php echo base_url();?>assets/js/custom/page-create-material.js"></script>
 <script src="<?php echo base_url();?>assets/js/custom/page-create-manufacturing.js"></script>
 <script src="<?php echo base_url();?>assets/js/custom/page-create-mrp.js"></script>
 <script src="<?php echo base_url();?>assets/js/custom/page-create-po.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/bootstrap-tagsinput.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/autoNumeric.js"></script>


 
 
 
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


