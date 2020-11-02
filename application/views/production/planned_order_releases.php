<section class="section">
  <!-- Notification Session -->
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="invoice">
      <div class="invoice-print">
        <div class="row">
          <div class="col-lg-12">
            <div class="invoice-title">
              <div class="row">
                <div class="col-md-6">
                  <img src="<?php echo base_url();?>assets/img/astodayagiri-logo.png" alt="logo" width="150" class="mb-5 mt-2"><br>
                  <h4><strong>Rekap Rencana Pemesanan Material</strong></h4>
                  <p><i>Planned Order Releases</i></p>
                </div>
                <div class="col-md-6 text-md-right">
                  <strong>No. Produksi</strong><br>
                  <p class="badge badge-success">#<?= $mrp_data->mo_code; ?></p><br>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <address>
                  <strong>Konsumen:</strong><br>
                  <?= $mrp_data->customer_name; ?><br>
                  <?= $mrp_data->customer_address; ?><br>
                </address>
              </div>
              <div class="col-md-6 text-md-right">
                <address>
                  <strong>Batas Waktu Pasokan:</strong><br><br>
                  <p class="badge badge-warning"> <?= formatDMY($mrp_data->production_start); ?></p><br><br>
                </address>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <address>
                  <strong>Kontak:</strong><br>
                  <strong>Telp:</strong> <?= $mrp_data->customer_telp; ?><br>
                  <strong>Email:</strong><?= $mrp_data->customer_email; ?>
                </address>
              </div>
              <div class="col-md-6 text-md-right">
               <address>
                <strong>Brand</strong><br><br>
                <p class="badge badge-primary"><?= $mrp_data->brand_name; ?></p>
              </address>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="section-title">Rincian Produk</div>
          <!-- <p class="section-lead">All items here cannot be deleted.</p> -->
          <div class="table-responsive">
            <table class="table table-bordered">
              <tr>
                <th>Item Produk</th>
                <th>Jumlah Produksi</th>
              </tr>
              <?php foreach ($mrp_array2 as $data): ?>
                <tr>
                  <td>
                    <?php if (!empty($data->variant_option)) { ?>
                     <p><strong><?= $data->product_name; ?></strong> / <?= $data->option_value; ?></p>
                   <?php }else{  ?>
                     <p><strong><?= $data->product_name; ?></strong></p>
                   <?php } ?>
                 </td>
                 <td>
                  <div class="false">
                    <p class="btn_td" href=""><?= $data->jml_prod; ?> <?= $data->unit; ?>  <i class="fa fa-info-circle"></i></p>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
    <div class="row mt-4">
     <div class="col-md-12">
      <div class="section-title">Rincian Kebutuhan Bahan Baku</div>
      <!--  <p class="section-lead">All items here cannot be deleted.</p> -->
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <th></th>
            <th><div style="width: 100px">Item Bahan Baku</div></th>
            <th><div style="width: 100px">Leadtime Pasokan</div></th>
            <th><div style="width: 120px">Kebutuhan per unit produk</div></th>
            <th><div style="width: 100px">Kebutuhan Kotor</div></th>
            <th><div style="width: 100px">Kebutuhan Bersih</div></th>
            <th><div style="width: 100px">Waktu Maksimal Pemesanan</div></th>
            <th><div style="width: 100px">Jumlah harus dipesan</div></th>
            <!--  <th><div style="width: 100px;"></div></th> -->
          </tr>
          <?php foreach ($mrp_array1 as $data): ?>
            <tr>
              <th><i class="fa fa-calculator"></i></th>
              <td>
                <?php if (empty($data->mv_option)) { ?>
                  <p class="badge badge-primary"><?= $data->material_name; ?></p>
                <?php } else {?>
                  <p class="badge badge-primary"><?= $data->material_name; ?> / <?= $data->mv_value; ?></p>
                <?php } ?>
              </td>
              <td><?= $data->leadtime; ?> Hari</td>
              <td><?= $data->qty; ?> <?= $data->material_unit; ?></td>
              <td>
               <div class="true">
                <p class="btn_td"> <?= $data->grossreq; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></p>
              </div>
            </td>
            <td>
             <div class="true">
              <p class="btn_td"><?= $data->netreq; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></p>
            </div>
          </td>
          <td>
           <div class="true">
            <p class="btn_td"><?= formatDMY($data->PORel); ?> <i class="fa fa-info-circle"></i></p>
          </div>
        </td>
        <td>
         <div class="true">
          <p class="btn_td"><?= $data->qtyporel; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></p>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
</div>
</div>
</div>
</div>
<hr>
<div class="text-md-right">
  <div class="float-lg-left mb-lg-0 mb-3">
    <a href="<?php echo base_url() ?>production/purchase_order/newpo_recap_mrp/<?= $mrp_data->mo_id; ?>" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Buat Rujukan Pemesanan Pembelian</a>
    <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
  </div>
  <a class="btn btn-warning" target="_blank" href="<?php echo base_url() ?>production/mrp/pdfrecapmrp/<?= $mrp_data->mo_id; ?>"><i class="fas fa-print"></i> Print</a>
</div>
</div>
</div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

