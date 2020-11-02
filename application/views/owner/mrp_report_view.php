<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Laporan Rekap MRP</h4>
          </div>
          <div class="card-body">
            <form action="<?php echo site_url('owner/report/printmrpreport') ?>" method="post" enctype="multipart/form-data" >
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Nomor Produksi</label>
                  <select class="form-control selprod" id="selprod">
                    <option value="">Semua Produksi</option>
                    <?php foreach ($mo_list as $data): ?>
                      <option value="<?= $data->mo_id; ?>"><?= $data->mo_code; ?> | <?= $data->customer_name; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>Dari</label>
                  <input type="date" class="form-control" id="startDate">
                </div>
                <div class="form-group col-md-4">
                  <label>Sampai</label>
                  <input type="date" class="form-control" id="endDate">
                </div>
              </div>
              <button type="submit" id="btn-printmrp" class="btn btn-outline-success" formtarget="_blank" disabled><i class="fas fa-print"></i> Cetak</button>
            </form>
            <div class="card-body p-0" id="mrpList">

            </div>
            <div class="card-footer text-right">
              <button onclick="filterMrpReport()" class="btn btn-success">Terapkan</button>
              <button onclick="searchFilter()" class="btn btn-success">Reset</button>
            </div>
            <div class="manufacturingloading" style="display: none;">
              <div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $(document).ready(function(){  
    $('.selprod').select2({
      width: '100%',
      escapeMarkup: function (markup) { return markup; }
    }); 
  }); 

  function filterMrpReport(page_num) 
  {
    page_num = page_num?page_num:0;
    var selprod = $('#selprod').val();
    var startDate = $('#startDate').val();
    var endDate   = $('#endDate').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>owner/report/ajaxMrpReport/'+page_num,
      data:'page='+page_num+'&selprod='+selprod+'&startDate='+startDate+'&endDate='+endDate,
      beforeSend: function () {
        $('.manufacturingloading').show();
      },
      success: function (html) {
        $('#mrpList').html(html);
        $('.manufacturingloading').fadeOut("slow");
        $('#btn-printmrp').prop("disabled", false);
      }
    });
  }
</script>