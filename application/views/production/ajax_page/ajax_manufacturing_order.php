 <div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th></th>
      <th>No. Pesanan</th>
      <th>Konsumen</th>
      <th>Item Produk</th>
      <th>Total Biaya</th>
      <th>Tanggal Pesan Dibuat</th>
      <th>Tanggal Dimulai</th>
      <th>Deadline Produksi</th>
      <th>Info Tambahan</th>
      <th>Status</th>
      <th></th>
      <th></th>
    </tr>
    <?php if(!empty($manufacturing)): foreach($manufacturing as $data): ?>
      <tr>
        <td><i class="fa fa-calendar"></i></td>
        <td><div style="width: 150px;">
          <a href="<?php echo base_url() ?>production/manufacturing/editmanufacturing/<?php echo $data['mo_id']; ?>"><?= $data['mo_code'];?></a>
        </div></td>
        <td><div style="width: 100px"><?= $data['customer_name'];?></div></td>
        <td>
          <div style="width: 100px;">
            <a href="#" data-toggle="modal" data-target="#modal_item_produk" onclick="javascript:load_itemProduct(<?= $data['mo_id']; ?>)"><?= $data['jumlah_produk'];?> Item Produk</a>
          </div>
        </td>
        <td><div style="width: 100px;">Rp. <?= rupiah($data['total_cost']);?></div></td>
        <td><div style="width: 100px;"><?= formatDMY($data['created_date']);?></div></td>
        <td>
          <?php if ($data['production_start']== "Belum ditetapkan") { ?>
            <div class="badge badge-light"><?= $data['production_start'];?> <i class="fa fa-info-circle"></i></div>
          <?php } else { ?>
            <div class="badge badge-warning"><?= formatDMY($data['production_start']); ?></div>
          <?php } ?>
        </td>
        <td><div style="width: 100px;"><?= formatDMY($data['prod_deadline']);?></div></td>
        <td><?= $data['additional_info'];?></td>
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
          <td>
            <div class="dropdown d-inline">
              <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Status Produksi
              </button>
              <div class="dropdown-menu">
                <a onclick="UpdateStatus('<?php echo base_url() ?>production/manufacturing/updatestatusstart/<?php echo $data['mo_id']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-hourglass-start"></i>Mulai</a>
                <a onclick="UpdateStatus('<?php echo base_url() ?>production/manufacturing/updatestatusdone/<?php echo $data['mo_id']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-check-circle"></i> Selesai</a>
                <a onclick="UpdateStatus('<?php echo base_url() ?>production/manufacturing/updatestatusreject/<?php echo $data['mo_id']; ?>')"class="dropdown-item has-icon" href="#!"><i class="fas fa-times-circle"></i> Batalkan</a>
                <a onclick="UpdateStatus('<?php echo base_url() ?>production/manufacturing/updatestatusnotstart/<?php echo $data['mo_id']; ?>')"class="dropdown-item has-icon" href="#!"><i class="fas fa-times-circle"></i> Belum dimulai</a>
              </div>
            </div>
          </td>
          <td>
            <div class="dropdown d-inline">
              <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tindakan
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item has-icon" href="<?php echo base_url() ?>production/manufacturing/editmanufacturing/<?php echo $data['mo_id']; ?>"><i class="fas fa-cog"></i>Ubah</a>
                <a onclick="deleteConfirm()" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
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