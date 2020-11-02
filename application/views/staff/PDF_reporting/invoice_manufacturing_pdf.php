
<html>
<head>
	<meta charset="utf-8">
	<title>Invoices Pesanan Produksi</title>
	
	<style>
		.invoice-box {
			max-width: 800px;
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
			background: #186630;
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
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
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
								<p style="font-size: 15px; color: #d46e2a;"><strong>Invoices Pesanan Produksi</strong></p>
							</td>
							<td>
								No Produksi <strong>#<?= $mo_list->mo_code; ?></strong><br>
								Dibuat pada: <?= $mo_list->created_date; ?><br>
								Mulai Produksi: <?= $mo_list->production_start; ?><br>
								Deadline: <?= $mo_list->prod_deadline; ?>
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
								<?= $mo_list->customer_name; ?><br>
								<?= $mo_list->customer_address; ?>
							</td>
							
							<td>
								<strong>Kontak.</strong><br>
								<?= $mo_list->customer_telp; ?><br>
								<?= $mo_list->customer_email; ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			
		</table>
		<table>
			<tr>
				<td><p style="font-size: 14px;"><strong>Rinician Item Pesanan Produksi</strong></p></td>
			</tr>
		</table>
		<table>
			<tr class="heading">
				<td style="text-align:center;">Item Produk</td>
				<td style="text-align:center;">Jumlah Produksi</td>
				<td style="text-align:center;">Harga Per Item</td>
				<td style="text-align:center;">Subtotal</td>
			</tr>
			<?php foreach($mo_array as $manufacturing):?>
				<tr class="detail">
					<td style="text-align:center;">
						<?php if(!empty($manufacturing->variant_option)) {   ?>
							<?= $manufacturing->product_name; ?> / <?= $manufacturing->option_value ?>
						<?php } else {  ?>
							<?= $manufacturing->product_name; ?>
						<?php }  ?>
					</td>
					<td style="text-align:center;"><?= $manufacturing->quantity ?></td>
					<td style="text-align:center;"><?= rupiah($manufacturing->sales_price); ?></td>
					<td style="text-align:center;">
						<?php 
						$qty = $manufacturing->quantity;
						$price = $manufacturing->sales_price;
						echo rupiah($qty*$price);
						?>
					</td>
				</tr>
			<?php endforeach; ?>

			<tr>
				<td></td>
				<td></td>
				<td>
					<hr>
					<strong>Biaya Produksi:</strong><br><br>
					<strong>Total Biaya   :</strong>
				</td>

				<td>
					<hr>
					<strong>Rp. <?= rupiah($mo_list->production_cost); ?></strong><br><br>
					<strong>Rp. <?= rupiah($mo_list->total_cost); ?></strong>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>

