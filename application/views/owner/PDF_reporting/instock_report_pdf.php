
<html>
<head>
	<meta charset="utf-8">
	<title>Laporan mutasi stok</title>
	
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
								<p style="font-size: 15px; color: #d46e2a;"><strong>LAPORAN STOK MASUK</strong></p>
								<p style="font-size: 12px;"><strong>Periode Pembelian:</strong> 
									<?php if (!empty($start) && !empty($end)) { ?>
										<?= tgl_indo($start); ?> Sampai <?= tgl_indo($end); ?>
									<?php } else { ?>
										Keseluruhan.
									<?php } ?>
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
					<th>Tanggal Pembelian</th>
					<th>SKU</th>
					<th>Kategori</th>
					<th>Item Bahan Baku/Varian</th>
					<th>Harga beli per Unit</th>
					<th>Stok Masuk</th>
					<th>Nilai Akumulasi Stok</th>
				</tr>
				<?php if(!empty($report_stock)): foreach($report_stock as $data): ?>
					<tr class="border">
						<td style="text-align:center;"><div style="width: 100px;">
							<?= formatDMY($data['created_date']);  ?>
						</div>
					</td>
					<td style="text-align:center;"><div style="width: 100px;">
						<?= $data['material_sku'];?>
					</div>
				</td>
				<td>
					<?= $data['category_name']; ?>
				</td>
				<td>
					<div style="width: 150px;">
						<?php if (!empty($data['mv_option'])) { ?>
							<strong><?= $data['material_name']; ?></strong>/<?= $data['mv_value']; ?>
						<?php } else { ?>
							<strong><?= $data['material_name']; ?></strong>
						<?php } ?>
					</div>
				</td>
				<td>
					<div style="width: 100px;">
						Rp. <?= rupiah($data['material_price']) ?>
					</div>
				</td>
				<td>
					<div style="width: 100px;"><?= $data['quantity_po'];?> <?php echo  $data['material_unit']; ?> <div style="width: 100px;"></div>
				</td>
				<td>
					<div style="width: 100px;">
						Rp. <?php 
						$qty = $data['quantity_po'];
						$price = $data['material_price'];
						echo rupiah($qty*$price);
						?>
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
</body>
</html>

