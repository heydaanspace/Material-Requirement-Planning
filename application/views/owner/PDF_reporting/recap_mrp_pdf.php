
<html>
<head>
	<meta charset="utf-8">
	<title>Rekap MRP</title>
	
	<style>
		.invoice-box {
			max-width: 1000px;
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

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading td {
			background: #d46e2a;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
			color: #fff;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td{
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
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
								<p style="font-size: 15px; color: #d46e2a;"><strong>DRAFT REKAP MRP</strong></p>
							</td>
							<td>
								No Produksi <strong>#<?= $mrp_data->mo_code; ?></strong><br>
								Dibuat pada: <?= $mrp_data->created_date; ?><br>
								Deadline Pasokan: <?= tgl_indo($mrp_data->production_start); ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr class="information">
				<td colspan="2">
					<table>
						<tr>
							<td>
								<strong>Konsumen.</strong><br>
								<?= $mrp_data->customer_name; ?><br>
								<?= $mrp_data->customer_address; ?>
							</td>
							
							<td>
								<strong>Kontak.</strong><br>
								<?= $mrp_data->customer_telp; ?><br>
								<?= $mrp_data->customer_email; ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><strong>Rinician Produk</strong></td>
			</tr>
			
		</table>
		<table>
			<tr class="heading">
				<td style="text-align:center;">Item Produk</td>
				<td style="text-align:center;">Jumlah Produksi</td>
			</tr>
			<?php foreach ($mrp_array2 as $data): ?>
				<tr class="details">
					<td style="text-align:center;">
						<?php if (!empty($data->variant_option)) { ?>
							<p><strong><?= $data->product_name; ?></strong> / <?= $data->option_value; ?></p>
						<?php }else{  ?>
							<p><strong><?= $data->product_name; ?></strong></p>
						<?php } ?>
					</td>
					<td style="text-align:center;">
						<div class="false">
							<p><?= $data->jml_prod; ?> <?= $data->unit; ?>  <i class="fa fa-info-circle"></i></p>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<table>
			<tr>
				<td><p style="font-size: 16px;"><strong>Rinician Kebutuhan Bahan Bakuuu</strong></p></td>
			</tr>
		</table>
		<br>
		<table cellpadding="0" cellspacing="0" class="tb-border">
			
			<?php foreach ($mrp_array1 as $data): ?>
				<tr class="border">
					<td>
						<?php if (empty($data->mv_option)) { ?>
							<?= $data->material_name; ?>
						<?php } else {?>
							<strong><?= $data->material_name; ?></strong> / <?= $data->mv_value; ?>
						<?php } ?>
					</td>
					<td style="text-align:center;"><?= $data->leadtime; ?> Hari</td>
					<td style="text-align:center;"><?= $data->qty; ?> <?= $data->material_unit; ?></td>
					<td style="text-align:center;">
						<p><?= $data->grossreq; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></p>
					</td>
					<td style="text-align:center;">
						<p><?= $data->netreq; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></p>
					</td>
					<td style="text-align:center;">
						<p><?= formatDMY($data->PORel); ?> <i class="fa fa-info-circle"></i></p>
					</td>
					<td style="text-align:center;">
						<p><?= $data->qtyporel; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></p>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</body>
</html>

