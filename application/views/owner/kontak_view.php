<section class="section">
	<div class="section-header">
		<h1>Mitra Bisnis Baru</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
			<div class="breadcrumb-item">Kontak</div>
		</div>
	</div>
	<div class="row">

	</div>
	<br>
	<!-- Notification Session -->
	<div class="msg" style="display:none;">
		<?= @$this->session->flashdata('msg'); ?>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<div class="col-4 text-left">
							<h4>Daftar Kontak</h4>
						</div>
						<div class="col-8 text-right">
							<div class="dropdown d-inline mr-2">
								<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user-plus"></i> Buat Baru
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="<?php echo base_url(); ?>owner/kontak/custfrm">Konsumen</a>
									<a class="dropdown-item" href="<?php echo base_url(); ?>owner/kontak/supfrm">Supplier</a>
								</div>
							</div>
							<div class="dropdown d-inline mr-2">
								<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-file-export"></i> Export
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#">PDF</a>
								</div>
							</div>
							<!-- <a class="btn btn-outline-primary" href="#"><i class="fa fa-upload"></i> Import</a> -->
						</div>
					</div>
					<div class="card-body">
						<!-- Navigasi -->
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" style="font-weight: bold;" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Konsumen</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="font-weight: bold;" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Supplier</a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<!-- Start Tabel Konsumen -->
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="form-row">
									<div class="form-group col-md-4">
										<input type="text" class="form-control" id="keywords" placeholder="Cari kontak konsumen" onkeyup="searchFilter()">
									</div>
									<div class="form-group col-md-2">
										<select class="form-control" id="sortBy" onchange="searchFilter()">
											<option value="">Urutkan</option>
											<option value="asc">A-Z</option>
											<option value="desc">Z-A</option>
										</select>
									</div>
								</div>
								<div class="card-body p-0" id="konsumenList">
									<div class="table-responsive">
										<table class="table table-striped">
											<tr>
												<th></th>
												<th><div style="width: 100px;">Nama Lengkap</div></th>
												<th><div style="width: 100px;">Merk / Perusahaan</div></th>
												<th><div style="width: 100px;">No Telp.</div></th>
												<th><div style="width: 100px;">Email</div></th>
												<th><div style="width: 100px;">Alamat</div></th>
												<th><div style="width: 100px;">Keterangan</div></th>
												<th></th>
											</tr>
											<?php if(!empty($customer)): foreach($customer as $post): ?>
												<tr>
													<td><i class="fa fa-address-book"></i></td>
													<td><strong><?php echo $post['customer_name']; ?></strong></td>
													<td><?php echo $post['brand_name']; ?></td>
													<td><?php echo $post['customer_telp']; ?></td>
													<td><?php echo $post['customer_email']; ?></td>
													<td><?php echo $post['customer_address']; ?></td>
													<td><?php echo $post['keterangan']; ?></td>
													<td>
														<div class="dropdown d-inline">
															<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																Tindakan
															</button>
															<div class="dropdown-menu">
																<a class="dropdown-item has-icon" href="<?php echo base_url() ?>owner/kontak/editkonsumen/<?php echo $post['customer_id']; ?>"><i class="fas fa-cog"></i>Ubah</a>
																<a onclick="deleteConfirm('<?php echo base_url() ?>owner/kontak/delkonsumen/<?php echo $post['customer_id']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
															</div>
														</div>
													</td>
												</tr>
											<?php endforeach; else: ?>
											<tr>
												<td>Not Found</td>
											</tr>
										<?php endif; ?>
									</table>
								</div>
								<?php echo $this->ajax_pagination->create_links(); ?>
							</div>
							<div class="custloading" style="display: none;">
								<div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
							</div>
						</div>
						<!-- End Tabel Konsumen -->
						<!-- Start Tabel Supplier -->
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" id="supkeywords" placeholder="Cari kontak supplier" onkeyup="supsearchFilter()">
								</div>
								<div class="form-group col-md-2">
									<select class="form-control" id="supsortBy" onchange="supsearchFilter()">
										<option value="">Urutkan</option>
										<option value="asc">A-Z</option>
										<option value="desc">Z-A</option>
									</select>
								</div>
							</div>
							<div class="card-body p-0" id="supplierList">
								<div class="table-responsive">
									<table class="table table-striped">
										<tr>
											<th></th>
											<th><div style="width: 100px;">Nama Lengkap</div></th>
											<th><div style="width: 100px;">No Telp.</div></th>
											<th><div style="width: 100px;">Email</div></th>
											<th><div style="width: 100px;">Pemilik</div></th>
											<th><div style="width: 100px;">Alamat</div></th>
											<th></th>
										</tr>
										<?php if(!empty($supplier)): foreach($supplier as $supplier): ?>
											<tr>
												<td><i class="fa fa-address-book"></i></td>
												<td><strong><?php echo $supplier['supplier_name']; ?></strong></td>
												<td><?php echo $supplier['supplier_telp']; ?></td>
												<td><?php echo $supplier['supplier_email']; ?></td>
												<td><?php echo $supplier['owner_name']; ?></td>
												<td><?php echo $supplier['supplier_address']; ?></td>
												<td>
													<div class="dropdown d-inline">
														<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Tindakan
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item has-icon" href="<?php echo base_url() ?>owner/kontak/editsupplier/<?php echo $supplier['supplier_id']; ?>"><i class="fas fa-cog"></i>Ubah</a>
															<a onclick="supdeleteConfirm('<?php echo base_url() ?>owner/kontak/delsupplier/<?php echo $supplier['supplier_id']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
														</div>
													</div>
												</td>
											</tr>
										<?php endforeach; else: ?>
										<tr>
											<td>Not Found</td>
										</tr>
									<?php endif; ?>
								</table>
							</div>
							<?php echo $this->supajax_pagination->create_links(); ?>
						</div>
						<div class="suploading" style="display: none;">
							<div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
						</div>
					</div>
					<!-- End Tabel Supplier -->
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>

<!-- Modal Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Apa kamu yakin ingin menghapus data ini?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				Data yang dihapus tidak akan bisa dikembalikan.
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
			</div>
		</div>
	</div>
</div>


<!-------------Embeded JS File------------------->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	//customer pagination 
	function searchFilter(page_num) {
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>owner/kontak/ajaxPaginationData/'+page_num,
			data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
			beforeSend: function () {
				$('.custloading').show();
			},
			success: function (html) {
				$('#konsumenList').html(html);
				$('.custloading').fadeOut("slow");
			}
		});
	}
	//supplier pagination
	function supsearchFilter(page_num) {
		page_num = page_num?page_num:0;
		var supkeywords = $('#supkeywords').val();
		var supsortBy = $('#supsortBy').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>owner/kontak/supajaxPaginationData/'+page_num,
			data:'page='+page_num+'&supkeywords='+supkeywords+'&supsortBy='+supsortBy,
			beforeSend: function () {
				$('.suploading').show();
			},
			success: function (html) {
				$('#supplierList').html(html);
				$('.suploading').fadeOut("slow");
			}
		});
	}
//JS delete Confirm.
function deleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
function supdeleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
</script>

<script>
	$(document).ready(function(){
		$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
			localStorage.setItem('activeTab', $(e.target).attr('href'));
		});
		var activeTab = localStorage.getItem('activeTab');
		if(activeTab){
			$('#myTab a[href="' + activeTab + '"]').tab('show');
		}
	});
</script>