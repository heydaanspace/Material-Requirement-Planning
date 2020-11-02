 "use strict";

 $(document).ready(function() {

  $('.selprod_bom').on('change', function() {
    var data = $(".selprod_bom option:selected").text();
    $("#selitem_material").removeAttr('disabled');
    $("#save_btn").removeAttr('disabled');
  });

   //select produk on create BOM
   $('#selprod_bom').select2({
    width: '100%',
    placeholder: 'Pilih Produk'
  });

  //select customer on create MO
  $('#selcustomer_mo').select2({
    width: '100%',
    placeholder: 'Pilih mitra konsumen',
    escapeMarkup: function (markup) { return markup; }
  }).on('select2:open', function () {
    var a = $(this).data('select2');
    if (!$('.select2-link').length) {
      a.$results.parents('.select2-results')
      .append('<div class="select2-link"><button type="button" style="background-color: #fff; color: #6777ef; margin: 3px ;padding: 6px;height: 40px;display: inline-table;" class="btn" data-toggle="modal" data-target="#categorymodal"><i class="fas fa-edit"></i> Tambah Data</button></div>')
      .on('click', function (b) {
        a.trigger('close');
      });
    }
  });



});

