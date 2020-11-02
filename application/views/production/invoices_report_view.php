<section class="section">
	<!-- <div class="section-header">
		<h1>Inventori</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
			<div class="breadcrumb-item">Inventori</div>
		</div>
	</div> -->
	<div class="msg" style="display:none;">
		<?= @$this->session->flashdata('msg'); ?>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<div class="col-4 text-left">
							<h4>Laporan Invoices</h4>
						</div>
						<div class="col-8 text-right">
							<div class="dropdown d-inline mr-2">
								<button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-file-export"></i> Unduh
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#">PDF</a>
									<a class="dropdown-item" href="#">Excel</a>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="card-body">
						<!-- Navigasi -->
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" style="font-weight: bold;" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Laporan Invoices Produksi</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" style="font-weight: bold;" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Laporan Invoices Pembelian</a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<br>
								<div class="form-row">
									<div class="form-group col-md-3">
										<label>Mitra Konsumen</label>
										<select class="form-control selcustomer" id="selcustomer">
											<option value="">Semua</option>
											<?php foreach ($customer as $data): ?>
												<option value="<?= $data->customer_name; ?>"><?= $data->customer_name; ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label>Dari</label>
										<input type="date" class="form-control" id="startDate">
									</div>
									<div class="form-group col-md-4">
										<label>Sampai</label>
										<input type="date" class="form-control" id="endDate">
									</div>
								</div>
								<div class="card-footer text-right">
									<button onclick="filterInvoiceProductionReport()" class="btn btn-success">Terapkan</button>
									<button onclick="searchFilter()" class="btn btn-success">Reset</button>
								</div>
								<div class="card-body p-0" id="manufacturingList">

								</div>
								<div class="manufacturingloading" style="display: none;">
									<div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
								</div>
							</div>
							<!-- start penyesesuain stok -->
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<br>
								<div class="form-row">
									<div class="form-group col-md-3">
										<label>Jenis Pembelian</label>
										<select class="form-control selcustomer" name="selcustomer_mo">
											<option></option>
											<option value="Rujukan MRP">Rujukan MRP</option>
											<option value="Non Rujukan">Non Rujukan</option>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label>Dari</label>
										<input type="date" class="form-control" id="sortDate" onchange="searchFilter()">
									</div>
									<div class="form-group col-md-4">
										<label>Sampai</label>
										<input type="date" class="form-control" id="sortDate" onchange="searchFilter()">
									</div>
								</div>
								<div class="card-footer text-right">
									<button class="btn btn-success" type="submit" name="btn">Terapkan</button>
								</div>
							</div>
							<!-- end penyesesuaian stok -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!------ Embeded JS ------->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function(){  
		$('.selcustomer').select2({
			width: '100%',
			escapeMarkup: function (markup) { return markup; }
		}); 
	}); 

	function filterInvoiceProductionReport(page_num) 
	{
		page_num = page_num?page_num:0;
		var selcustomer = $('#selcustomer').val();
		var startDate = $('#startDate').val();
		var endDate   = $('#endDate').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>production/report/ajaxInvoiceProductionReport/'+page_num,
			data:'page='+page_num+'&selcustomer='+selcustomer+'&startDate='+startDate+'&endDate='+endDate,
			beforeSend: function () {
				$('.manufacturingloading').show();
			},
			success: function (html) {
				$('#manufacturingList').html(html);
				$('.manufacturingloading').fadeOut("slow");
			}
		});
	}


</script>

