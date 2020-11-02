 <div class="table-responsive">
 	<table class="table table-striped">
 		<tr>
 			<th></th>
 			<th>No. Invoices</th>
 			<th>Tanggal</th>
 			<th>Konsumen</th>
 			<th>Total Biaya</th>
 			<th>Tanggal Dimulai</th>
 			<th>Deadline Produksi</th>
 			<th>Status</th>
 		</tr>
 		<?php if(!empty($manufacturing)): foreach($manufacturing as $data): ?>
 			<tr>
 				<td><i class="fa fa-calendar"></i></td>
 				<td>
 					<div style="width: 150px;">
 						<p class="badge badge-success"><?= $data['mo_code'];?></a>
 						</div>
 					</td>
 					<td><div style="width: 100px;"><?= formatDMY($data['created_date']);?></div></td>
 					<td><div style="width: 100px"><?= $data['customer_name'];?></div></td>
 					<td><div style="width: 100px;">Rp. <?= rupiah($data['total_cost']);?></div></td>
 					<td>
 						<?php if ($data['production_start']== "Belum ditetapkan") { ?>
 							<div class="badge badge-light"><?= $data['production_start'];?> <i class="fa fa-info-circle"></i></div>
 						<?php } else { ?>
 							<div class="badge badge-warning"><?= formatDMY($data['production_start']); ?></div>
 						<?php } ?>
 					</td>
 					<td><div style="width: 100px;"><?= formatDMY($data['prod_deadline']);?></div></td>
 					<td>
 						<?php switch ($data['status']) { 
 							case 'Belum dilaksanakan':
 							echo '<div class="badge badge-light">'.$data['status'].' <i class="fa fa-info-circle"></i></div>';
 							break;

 							case 'Sedang Berjalan':
 							echo '<div class="badge badge-info">'.$data['status'].' <i class="fa fa-hourglass"></i></div>';
 							break;


 							case 'Selesai':
 							echo '<div class="badge badge-success">'.$data['status'].' <i class="fa fa-check-circle"></i></div>';
 							break;

 							case 'Dibatalkan':
 							echo '<div class="badge badge-danger">'.$data['status'].' <i class="fa fa-times"></i></div>';
 							break; } ?>
 						</td>
 					</tr>
 				<?php endforeach; else: ?>
 				<tr>
 					<td>Record Tidak ditemukan</td>
 				</tr>
 			<?php endif; ?>
 		</table>
 	</div>
 	<?php echo $this->ajax_pagination->create_links(); ?>