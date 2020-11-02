
<html>
<head>
	<meta charset="utf-8">
	<title>Laporan Rekap Manufacturing Orders</title>
	
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
								<p style="font-size: 15px; color: #d46e2a;"><strong>LAPORAN REKAP <i>MANUFACTURING ORDERS</i></strong></p>
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
				<th>No. Pesanan</th>
				<th>Konsumen</th>
				<th>Item Produk</th>
				<th>Total Biaya</th>
				<th>Tanggal Pesan Dibuat</th>
				<th>Tanggal Dimulai</th>
				<th>Deadline Produksi</th>
				<th>Info Tambahan</th>
				<th>Status</th>
			</tr>
			<?php if(!empty($manufacturing)): foreach($manufacturing as $data): ?>
				<tr>
					<td><?= $data['mo_code'];?></td>
					<td><?= $data['customer_name'];?></td>
					<td><?= $data['jumlah_produk'];?> Item Produk</td>
					<td>Rp. <?= rupiah($data['total_cost']);?></td>
					<td><?= formatDMY($data['created_date']);?></td>
					<td><?= formatDMY($data['production_start']); ?></td>
					<td><?= formatDMY($data['prod_deadline']);?></td>
					<td><?= $data['additional_info'];?></td>
					<td><p><?= $data['status']  ?></p></td>
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

