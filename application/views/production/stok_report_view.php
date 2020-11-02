<section class="section">
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Laporan Mutasi Stok</h4>
          </div>
          <br>
          <div class="card-body">
            <!-- Navigasi -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" style="font-weight: bold;" id="stok-tab" data-toggle="tab" href="#stok" role="tab" aria-controls="home" aria-selected="true">Laporan Stok Masuk</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="font-weight: bold;" id="mutasi-tab" data-toggle="tab" href="#mutasistok" role="tab" aria-controls="profile" aria-selected="false">Laporan Stok Keluar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="font-weight: bold;" id="adjust-tab" data-toggle="tab" href="#adjusment" role="tab" aria-controls="profile" aria-selected="false">Laporan Rekap Mutasi Stok</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="stok" role="tabpanel" aria-labelledby="stok-tab">
                <br>
                <form action="<?php echo site_url('production/report/printinstock') ?>" method="post" enctype="multipart/form-data" >
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Item Material</label>
                      <select class="form-control selmaterial" id="selmaterial" name="selmaterial">
                        <option value="">Semua Material</option>
                        <?php foreach ($material as $data): ?>
                          <?php if (!empty($data->mv_option)) { ?>
                            <option value="<?= $data->material_sku; ?>"><?= $data->material_name ?> / <?= $data->mv_value ?></option>
                          <?php } else { ?>
                            <option value="<?= $data->material_sku; ?>"><?= $data->material_name ?></option>
                          <?php } ?>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Dari</label>
                      <input type="date" class="form-control" id="startDate" name="startDate">
                    </div>
                    <div class="form-group col-md-4">
                     <label>Sampai</label>
                     <input type="date" class="form-control" id="endDate" name="endDate">
                   </div>
                 </div>
                 <button type="submit" id="btn-printinstock" class="btn btn-outline-success" formtarget="_blank" disabled><i class="fas fa-print"></i> Cetak</button>
                 <br>
                 <br>
               </form>
               <div class="card-body p-0" id="instockList">


               </div>
               <div class="card-footer text-right">
                <button class="btn btn-success" onclick="filterInStockReport()">Terapkan</button>

              </div>
              <div class="manufacturingloading" style="display: none;">
                <div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
              </div>

            </div>
            <!-- start out stok -->
            <div class="tab-pane fade" id="mutasistok" role="tabpanel" aria-labelledby="mutasi-tab">
              <br>
              <form action="<?php echo site_url('production/report/printoutstock') ?>" method="post" enctype="multipart/form-data" >
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Item Material</label>
                    <select class="form-control selmaterial" id="selmaterialoutstock" name="selmaterialoutstock">
                      <option value="">Semua Material</option>
                      <?php foreach ($material as $data): ?>
                        <?php if (!empty($data->mv_option)) { ?>
                          <option value="<?= $data->material_sku; ?>"><?= $data->material_name ?> / <?= $data->mv_value ?></option>
                        <?php } else { ?>
                          <option value="<?= $data->material_sku; ?>"><?= $data->material_name ?></option>
                        <?php } ?>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Dari</label>
                    <input type="date" class="form-control" id="startDateOutStock" name="startDateOutStock">
                  </div>
                  <div class="form-group col-md-4">
                   <label>Sampai</label>
                   <input type="date" class="form-control" id="endDateOutStock" name="endDateOutStock">
                 </div>
               </div>
               <button type="submit" id="btn-printoutstock" class="btn btn-outline-success" formtarget="_blank" disabled><i class="fas fa-print"></i> Cetak</button>
               <br>
               <br>
             </form>
             <div class="card-body p-0" id="outstockList">


             </div>
             <div class="card-footer text-right">
              <button class="btn btn-success" onclick="filterOutStockReport()">Terapkan</button>
            </div>
            <div class="manufacturingloading" style="display: none;">
              <div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
            </div>
          </div>
          <!-- end out stok -->

          <!-- start recap stok -->
          <div class="tab-pane fade" id="adjusment" role="tabpanel" aria-labelledby="adjust-tab">
            <form action="<?php echo site_url('production/report/printrecapstock') ?>" method="post" enctype="multipart/form-data" >
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Item Material</label>
                  <select class="form-control selmaterial" id="selmaterialrecap" name="selmaterialrecap">
                    <option value="">Semua Material</option>
                    <?php foreach ($material as $data): ?>
                      <?php if (!empty($data->mv_option)) { ?>
                        <option value="<?= $data->material_sku; ?>"><?= $data->material_name ?> / <?= $data->mv_value ?></option>
                      <?php } else { ?>
                        <option value="<?= $data->material_sku; ?>"><?= $data->material_name ?></option>
                      <?php } ?>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>Dari</label>
                  <input type="date" class="form-control" id="startDateRecap" name="startDateRecap">
                </div>
                <div class="form-group col-md-4">
                 <label>Sampai</label>
                 <input type="date" class="form-control" id="endDateRecap" name="endDateRecap">
               </div>
             </div>
             <button type="submit" id="btn-printrecapstock" class="btn btn-outline-success" formtarget="_blank" disabled><i class="fas fa-print"></i> Cetak</button>
             <br>
             <br>
           </form>
           <div class="card-body p-0" id="recapstockList">


           </div>
           <div class="card-footer text-right">
            <button class="btn btn-success" onclick="filterRecapStockReport()">Terapkan</button>
          </div>
          <div class="manufacturingloading" style="display: none;">
            <div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
          </div>
        </div>
        <!-- end recap stok -->
      </div>
    </div>
  </div>
</div>
</div>
</div>
</section>


<!------ Embeded JS ------->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $(document).ready(function(){  
    $('.selmaterial').select2({
      width: '100%',
      escapeMarkup: function (markup) { return markup; }
    }); 
  }); 

  function filterInStockReport(page_num) 
  {
    page_num = page_num?page_num:0;
    var selmaterial = $('#selmaterial').val();
    var startDate = $('#startDate').val();
    var endDate   = $('#endDate').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>production/report/ajaxInStockReport/'+page_num,
      data:'page='+page_num+'&selmaterial='+selmaterial+'&startDate='+startDate+'&endDate='+endDate,
      beforeSend: function () {
        $('.manufacturingloading').show();
      },
      success: function (html) {
        $('#instockList').html(html);
        $('.manufacturingloading').fadeOut("slow");
        $('#btn-printinstock').prop("disabled", false);
      }
    });
  }

  function filterOutStockReport(page_num) 
  {
    page_num = page_num?page_num:0;
    var selmaterialoutStock = $('#selmaterialoutstock').val();
    var startDateOutStock   = $('#startDateOutStock').val();
    var endDateOutStock     = $('#endDateOutStock').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>production/report/ajaxOutStockReport/'+page_num,
      data:'page='+page_num+'&selmaterialoutstock='+selmaterialoutStock+'&startDateOutStock='+startDateOutStock+'&endDateOutStock='+endDateOutStock,
      beforeSend: function () {
        $('.manufacturingloading').show();
      },
      success: function (html) {
        $('#outstockList').html(html);
        $('.manufacturingloading').fadeOut("slow");
        $('#btn-printoutstock').prop("disabled", false);
      }
    });
  }

  function filterRecapStockReport(page_num) 
  {
    page_num = page_num?page_num:0;
    var selmaterialrecap = $('#selmaterialrecap').val();
    var startDateRecap   = $('#startDateRecap').val();
    var endDateRecap     = $('#endDateRecap').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>production/report/ajaxRecapStockReport/'+page_num,
      data:'page='+page_num+'&selmaterialrecap='+selmaterialrecap+'&startDateRecap='+startDateRecap+'&endDateRecap='+endDateRecap,
      beforeSend: function () {
        $('.manufacturingloading').show();
      },
      success: function (html) {
        $('#recapstockList').html(html);
        $('.manufacturingloading').fadeOut("slow");
        $('#btn-printrecapstock').prop("disabled", false);
      }
    });
  }

</script>
