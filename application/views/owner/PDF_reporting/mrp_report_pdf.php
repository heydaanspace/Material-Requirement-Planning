
<html>
<head>
	<meta charset="utf-8">
	<title>Laporan Rekap MRP</title>
	
	<style>
		.invoice-box {
			max-width: 1100px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, .15);
			font-size: 12px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
		}

		.tb-border tr td {
			border: 1px solid black;
			font-size: 10px;
		}
		.tb-border tr th {
			border: 1px solid black;
			font-size: 11px;
		}

		.header-table {
			color: #fff;
			background:  #d46e2a;
		}


		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;

		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 500%;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 500%;
				text-align: center;
			}
		}

		/** RTL **/
		.rtl {
			direction: rtl;
			font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		}

		.rtl table {
			text-align: right;
		}

		.rtl table tr td:nth-child(2) {
			text-align: left;
		}
	</style>
</head>

<body>
	<div class="invoice-box">
		<table cellpadding="0" cellspacing="0">
			<tr class="top">
				<td colspan="2">
					<table>
						<tr>
							<td class="title">
								<img src="<?php echo base_url();?>assets/img/astodayagiri-logo.png" style="width:100%; max-width:200px;">
							</td>
							<td>
								<p style="font-size: 15px; color: #d46e2a;"><strong>LAPORAN REKAP MRP</strong></p>
								<p style="font-size: 12px;"><strong>Periode Produksi:</strong> 
									<?php if (!empty($start) && !empty($end)) { ?>
									<?= tgl_indo($start); ?> Sampai <?= tgl_indo($end); ?>
									<?php } else { ?>
									Keseluruhan.
									<?php } ?>
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<hr>
		<table>
			<br>
			<br>
		</table>
		<table cellpadding="0" cellspacing="0" class="tb-border">
			<tr class="header-table">
				<th style="width: 100px;">No. MRP</th>
				<th>No. Produksi</th>
				<th>Produk</th>
				<th>Jumlah Produksi</th>
				<th><div style="width: 100px;">Total Bahan Baku</div></th>
			</tr>
			<?php if(!empty($mrp_list)): foreach($mrp_list as $data): ?>
			<tr>
				<td style="text-align: center;">
					<p class="badge badge-primary"><?= $data['mrp_code'] ?></p>
				</td> 
				<td style="text-align: center;">
					<p><strong><?= $data['mo_code'] ?></strong></p>
				</td> 
				<td style="text-align: center;">
					<?php if (empty($data['variant_option'])) { ?>
					<p class="badge badge-success"><?= $data['product_name'] ?></p>
					<?php } else { ?>
					<p class="badge badge-success"><?= $data['product_name'] ?> | <?= $data['option_value'] ?></p>
					<?php } ?>
				</td> 
				<td style="text-align: center;"><?= $data['jml_prod'] ?> <?= $data['unit']; ?></td> 
				<td style="text-align: center;">
					<div class="false" style="text-align: center;">
						<p class="btn_td"><?= $data['qty_material']; ?> Komponen</p>
					</div>
				</td> 
			</tr>
			<?php endforeach; else: ?>
			<tr>
				<td><div class="badge badge-danger">Tidak ditemukan.</div></td>
			</tr>
			<?php endif; ?>
		</table>


	</div>
</body>
</html>

