<section class="section">
  <div class="section-header">
    <h1>Material Requirements Planning | MRP</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">MRP</div>
    </div>
  </div>
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="col-5 text-left">
              <h4>Tabel MRP / Rencana Kebutuhan Bahan Baku</h4>
            </div>
            <div class="col-7 text-right">
             <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>owner/mrp/newmrp"><i class="fa fa-calendar-plus"></i> MRP Baru</a>
           </div>
         </div>
         <br>
         <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="">Urutkan Data</label>
              <select class="form-control" id="sortBy" onchange="searchFilter()">
                <option value="" selected>Urutkan</option>
                <option value="asc">Terbaru</option>
                <option value="desc">Terdahulu</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="">Tampilkan berdasarkan Nomor Produksi</label>
              <select class="form-control filterDate" id="filterDate" onchange="searchFilter()">
                <option></option>
                <?php foreach ($mo_list as $mo_data): ?>
                  <option value="<?= $mo_data->mo_id; ?>"><strong><?= $mo_data->mo_code ?></strong> | <?= $mo_data->customer_name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="card-body p-0" id="mrpList">
           <div class="table-responsive">
            <table class="table table-striped">
              <tr>
               <th style="text-align: center;"></th>
               <th style="width: 100px;">No. MRP</th>
               <th>No. Produksi</th>
               <th>Produk</th>
               <th>Jumlah Produksi</th>
               <th><div style="width: 100px;"></div></th>
             </tr>
             <?php if(!empty($mrp_data)): foreach($mrp_data as $data): ?>
               <tr>
                 <td><i class="fa fa-calculator"></i></td> 
                 <td><a class="badge badge-primary" href="<?php echo base_url() ?>owner/mrp/showdetailmrp/<?php echo $data['mrp_code']; ?>"><?= $data['mrp_code'] ?></a></td> 
                 <td><a class="badge badge-primary" href="<?php echo base_url() ?>owner/mrp/showRecapPorel/<?= $data['mo_id']; ?>"><?= $data['mo_code'] ?></a></td> 
                 <td>
                  <?php if (empty($data['variant_option'])) { ?>
                    <p class="badge badge-success"><?= $data['product_name'] ?></p>
                  <?php } else { ?>
                    <p class="badge badge-success"><?= $data['product_name'] ?> | <?= $data['option_value'] ?></p>
                  <?php } ?>
                </td> 
                <td><?= $data['jml_prod'] ?> <?= $data['unit'] ?></td> 
                <td>
                 <div class="false" style="text-align: center;">
                  <a class="btn_td" href="<?php echo base_url() ?>owner/mrp/showRecapPorel/<?= $data['mo_id']; ?>">Lihat Rekap <i class="fa fa-eye"></i></a>
                </div>
              </td> 
            </tr>
          <?php endforeach; else: ?>
          <tr>
            <td><div class="badge badge-danger">Tidak ditemukan.</div></td>
          </tr>
        <?php endif; ?>
      </table>
    </div>
    <?php echo $this->ajax_pagination->create_links(); ?>
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


<!------ Embeded JS ------->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  //JS Live search & pagination
  function searchFilter(page_num) 
  {
    page_num = page_num?page_num:0;
    var sortBy = $('#sortBy').val();
    var filterDate = $('#filterDate').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>owner/mrp/ajaxPaginationData/'+page_num,
      data:'page='+page_num+'&sortBy='+sortBy+'&filterDate='+filterDate,
      beforeSend: function () {
        $('.manufacturingloading').show();
      },
      success: function (html) {
        $('#mrpList').html(html);
        $('.manufacturingloading').fadeOut("slow");
      }
    });
  }

  function load_itemProduct(mo_id)
  {
    $.ajax({
      url: "<?php echo site_url('owner/manufacturing/showitemproduct');?>",
      type: "POST",
      data: {mo_id: mo_id},
      success: function (response) {
        $(".displayitemproduct").html(response);
      }
    });

  }
</script>

