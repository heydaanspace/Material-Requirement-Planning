 "use strict";

 $(document).ready(function() {

   //show hide varian form
   $("#material_variancheck").click(function () {
    if ($(this).is(":checked")) {

      $("#variant_frm").show();
      $("#imaterialsku_nonvar").attr('disabled','disabled');
      $("#iprice_nonvar").attr('disabled','disabled');
      $("#ileadtime_nonvar").attr('disabled','disabled');
      $("#istok_nonvar").attr('disabled','disabled');
      $("#ivalue_stok_nonvar").attr('disabled','disabled');
      $("#iprice_nonvar").val();
      $("#istok_nonvar").val();
      $("#ivalue_stok_nonvar").val();

      $(".ivarianval_material_trigger").attr('disabled','disabled');
      $(".imaterialsku_trigger").attr('disabled','disabled');
      $(".iprice_trigger").attr('disabled','disabled');
      $(".ileadtime_trigger").attr('disabled','disabled');
    } else {

      $("#variant_frm").hide();
      $("#imaterialsku_nonvar").removeAttr('disabled');
      $("#iprice_nonvar").removeAttr('disabled');
      $("#ileadtime_nonvar").removeAttr('disabled');
      $("#istok_nonvar").removeAttr('disabled');
      $("#ivalue_stok_nonvar").removeAttr('disabled');

      $(".ivarianval_material_trigger").removeAttr('disabled');
      $(".imaterialsku_trigger").removeAttr('disabled');
      $(".iprice_trigger").removeAttr('disabled');
      $(".ileadtime_trigger").removeAttr('disabled');

      document.getElementById("selectvarian").disabled = true;
      $('#selectvarian_material').tagsinput('removeAll');
      $('#tbvarian_material tr td').remove();
      $('#material_varianopt').val(null).trigger('change');


    }
  });
   // mengecek value select variant
  //  $('#material_varianopt').on('change', function() {
  //   var data = $("#material_varianopt option:selected").text();
  //   document.getElementById("selectvarian_material").disabled = false;
  // });

    //select varian option
    $('#material_varianopt').select2({
      width: '100%',
      placeholder: 'Pilih opsi varian',
      escapeMarkup: function (markup) { return markup; }
    }).on('select2:open', function () {
      var a = $(this).data('select2');
      if (!$('.select2-link').length) {
        a.$results.parents('.select2-results')
        .append('<div class="select2-link"><button type="button" style="background-color: #fff; color: #6777ef; margin: 3px ;padding: 6px;height: 40px;display: inline-table;" class="btn" data-toggle="modal" data-target="#varianmodal"><i class="fas fa-edit"></i> Tambah Data</button></div>')
        .on('click', function (b) {
          a.trigger('close');
        });
      }
    });

  //select category
  $('#selcategory').select2({
    width: '100%',
    placeholder: 'Pilih kategori',
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

  $('.iunit').select2({
    width: '100%',
    placeholder: 'Pilih satuan ukur',
    escapeMarkup: function (markup) { return markup; }
  }).on('select2:open', function () {
    var a = $(this).data('select2');
    if (!$('.select2-link').length) {
      a.$results.parents('.select2-results')
      .append('<div class="select2-link"><button type="button" style="background-color: #fff; color: #6777ef; margin: 3px ;padding: 6px;height: 40px;display: inline-table;" class="btn" data-toggle="modal" data-target="#unitmodal"><i class="fas fa-edit"></i> Tambah Data</button></div>')
      .on('click', function (b) {
        a.trigger('close');
      });
    }
  });
});

