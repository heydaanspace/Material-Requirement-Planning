<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap MRP</title>
    
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
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
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
                                <p style="font-size: 15px;"><strong>DRAFT REKAP MRP</strong></p>
                            </td>
                            <td>
                                No Produksi <strong>#<?= $mrp_data->mo_code; ?></strong><br>
                                Dibuat pada: January 1, 2015<br>
                                Deadline Pasokan: February 1, 2015
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
            <br>
            <tr class="heading">
                <td>
                    Item Produk
                </td>
                
                <td>
                    Jumlah Produksi
                </td>
            </tr>
            <?php foreach ($mrp_array2 as $data): ?>
            <tr class="details">
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
  <table cellpadding="0" cellspacing="0">
     <tr class="heading">
        <td>Item Bahan Baku</td>
        <td>Leadtime Pasokan</td>
        <td>Kebutuhan Per Unit</td>
        <td>Kebutuhan Kotor</td>
        <td>Kebutuhan Bersih</td>
        <td>Waktu Maksimal Pemesanan</td>
        <td>Jumlah Harus Dipesan</td>
    </tr> 
    <?php foreach ($mrp_array1 as $data): ?>
    <tr>
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
          <a class="btn_td" href=""> <?= $data->grossreq; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></a>
      </div>
  </td>
  <td>
   <div class="true">
    <a class="btn_td" href=""><?= $data->netreq; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></a>
</div>
</td>
<td>
 <div class="true">
  <a class="btn_td" href=""><?= formatDMY($data->PORel); ?> <i class="fa fa-info-circle"></i></a>
</div>
</td>
<td>
   <div class="true">
    <a class="btn_td" href=""><?= $data->qtyporel; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></a>
</div>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>
</body>
</html>

