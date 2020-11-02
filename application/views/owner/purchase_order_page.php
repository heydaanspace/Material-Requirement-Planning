<section class="section">
  <div class="section-header">
    <h1>Pesanan Pembelian</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashbor</a></div>
      <div class="breadcrumb-item">Pesanan Pembelian</div>
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
              <h4>Tabel Pesanan Pembelian (PO)</h4>
            </div>
            <div class="col-7 text-right">
              <div class="dropdown d-inline mr-2">
               <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>owner/purchase_order/newpo"><i class="fa fa-plus-circle"></i> Pesanan Pembelian Baru</a>
               <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-file-export"></i> Unduh
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">PDF</a>
                <a class="dropdown-item" href="#">Excel</a>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="card-body">
          <div class="form-row">
           <div class="form-group col-md-3">
            <select class="form-control" id="sortBy" onchange="searchFilter()">
              <option value="" selected>Urutkan</option>
              <option value="asc">Terbaru</option>
              <option value="desc">Terdahulu</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <select class="form-control" id="filterBy" onchange="searchFilter()">
              <option value="" selected>Filter Status</option>
              <option value="Sudah Diterima">Diterima</option>
              <option value="Belum diterima">Belum diterima</option>
              <option value="Dibatalkan">Dibatalkan</option>
            </select>
          </div>
        </div>
        <div class="card-body p-0" id="poList">
         <div class="table-responsive">
          <table class="table table-striped">
            <tr>
              <th></th>
              <th><div style="width: 100px;">No. PO</div></th>
              <th><div style="width: 100px;">Jenis PO</div></th>
              <th><div style="width: 70px;">Dibuat Pada</div></th>
              <th><div style="width: 90px;">Total Biaya</div></th>
              <th><div style="width: 150px;">Jumlah Item</div></th>
              <th>Status PO</th>
            </tr>
            <?php foreach ($po_list as $data): ?>
             <tr>
              <td><i class="fas fa-shopping-basket"></i></td>
              <td>
                <a href="<?php echo base_url() ?>owner/purchase_order/showdetailPO/<?php echo $data['po_id']; ?>"><?= $data['po_code'] ?></a>
              </td> 
              <td><a href="#"><?= $data['po_type']; ?></a></td>
              <td><div class="badge badge-info"><?= formatDMY($data['created_date']); ?></div></td> 
              <td>Rp. <?= rupiah($data['total_cost']); ?></td> 
              <td><a href="#" data-toggle="modal" data-target="#modal_item_po" onclick="javascript:load_itemPO(<?= $data['po_id']; ?>)"><?= $data['jml_item']; ?> Item Pembelian</a>
              </td> 
              <td>
               <?php if ($data['status_po'] === "Sudah diterima") { ?>
                <div class="badge badge-success">Selesai</div>
              <?php } else { ?>
                <div class="badge badge-danger">Belum Selesai</div>
              <?php } ?>
            </td> 
          </tr>
        <?php endforeach; ?>
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

<!---------- Modal Place -------->
<!-- Modal view BOM -->
<div class="modal fade displayitempo" id="modal_item_po" style="width: 100%;">
  <?php include('modal_view/modal_view_item_po.php') ?>
</div>

<!-- Modal Confirmation Status-->
<div class="modal fade" id="statusmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"><strong>Apakah anda yakin akan mengubah status PO?</strong></strong></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-status" class="btn btn-info" href="#">Ya</a>
      </div>
    </div>
  </div>
</div>


<!-- Modal Delete Confirmation-->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"><strong>Hapus produk juga akan menghapus semua data varian dan tidak bisa dikembalikan.</strong></strong></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>


<!------ Embeded JS ------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  function UpdateStatus(url)
  {
   $('#btn-status').attr('href', url);
   $('#statusmodal').modal();
 }
  //JS Live search & pagination
  function searchFilter(page_num) 
  {
    page_num = page_num?page_num:0;
    var sortBy = $('#sortBy').val();
    var filterBy = $('#filterBy').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>owner/purchase_order/ajaxPaginationData/'+page_num,
      data:'page='+page_num+'&sortBy='+sortBy+'&filterBy='+filterBy,
      beforeSend: function () {
        $('.manufacturingloading').show();
      },
      success: function (html) {
        $('#poList').html(html);
        $('.manufacturingloading').fadeOut("slow");
      }
    });
  }

  function load_itemPO(po_id)
  {
    $.ajax({
      url: "<?php echo site_url('owner/purchase_order/showitemPO');?>",
      type: "POST",
      data: {po_id: po_id},
      success: function (response) {
        $(".displayitempo").html(response);
      }
    });

  }
</script>

