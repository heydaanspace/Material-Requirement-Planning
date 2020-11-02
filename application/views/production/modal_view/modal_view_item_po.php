
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Daftar Item Pesanan Pembelian</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
     <div class="table-responsive">
       <table class="table table-bordered">
        <tbody>
          <tr>
            <th></th>
            <th><div style="width: 100px;">Item Pembelian</div></th>
            <th><div style="width: 100px;">Supplier</div></th>
            <th><div style="width: 150px;">QTY</div></th>
            <th><div style="width: 100px;">Jadwal Penerimaan</div></th>
            <th><div style="width: 100px;">Status Item</div></th>
          </tr>
          <?php foreach ($item_po as $data): ?>
            <tr>
              <td>
                <div class="dropdown d-inline">
                  <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Status Pesanan
                  </button>
                  <div class="dropdown-menu">
                    <a onclick="UpdateStatus('<?php echo base_url() ?>production/purchase_order/updatestatusaccepted/<?php echo $data['id_det_po']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fa fa-hourglass-start"></i>Sudah diterima</a>
                    <a onclick="UpdateStatus('<?php echo base_url() ?>production/purchase_order/updatestatusnotaccepted/<?php echo $data['id_det_po']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fa fa-check-circle"></i> Belum diterima</a>
                    <a onclick="UpdateStatus('<?php echo base_url() ?>production/purchase_order/updatestatusreject/<?php echo $data['id_det_po']; ?>')"class="dropdown-item has-icon" href="#!"><i class="fa fa-times-circle"></i> Batalkan</a>
                  </div>
                </div>
              </td>
              <td>
                <?php if(!empty($data['mv_option'])) {   ?>
                  <strong><?php echo $data['material_name']; ?></strong> 
                  / <?php echo $data['mv_value']; ?>
                <?php } else {  ?>
                  <strong><?php echo $data['material_name']; ?></strong>
                <?php }  ?>
              </td>
              <td>
                <?= $data['supplier_name']; ?>
              </td>
              <td>
                <div class="true">
                 <input type="hidden" name="istokinv" value="<?= $data['quantity']; ?>">
                 <input type="hidden" name="inv_id" value="<?= $data['inv_id']; ?>">
                 <p class="btn_td"><?= $data['quantity_po'];?> <?= $data['material_unit']; ?>  <i class="fa fa-info-circle"></i></p>
               </div>
             </td>
             <td><?php echo formatDMY($data['schedule_receipt']); ?></td>
             <td>
              <?php if ($data['status_po'] === "Sudah diterima") { ?>
                <div class="badge badge-success"><?php echo $data['status_po']; ?></div>
              <?php } else { ?>
                <div class="badge badge-danger"><?php echo $data['status_po']; ?></div>
              <?php } ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>



