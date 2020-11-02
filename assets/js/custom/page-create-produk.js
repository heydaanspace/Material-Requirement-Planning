 "use strict";

 $(document).ready(function() {

   //show hide varian form
   $("#variancheck").click(function () {
    if ($(this).is(":checked")) {
      $("#mainfrm").show();
      //$("#divproductcode").hide();
      //$("#divsalesprice").hide();
      $("#iproductsku_nonvar").attr('disabled','disabled');
      $("#price_nonvar").attr('disabled','disabled');
      $("#isalesprice_nonvar").attr('disabled','disabled');
      $(".ivarianvaltrigger").attr('disabled','disabled');
      $(".iskutrigger").attr('disabled','disabled');
      $(".isalespricetrigger").attr('disabled','disabled');
    } else {
      $("#mainfrm").hide();
      //$("#divproductcode").show();
      //$("#divsalesprice").show();
      document.getElementById("selectvarian").disabled = true;
      $("#price_nonvar").removeAttr('disabled');
      $('#selectvarian').tagsinput('removeAll');
      $('#tbvarian tr td').remove();
      $('#varianopt').val(null).trigger('change');
      $(".ivarianvaltrigger").removeAttr('disabled');
      $(".iskutrigger").removeAttr('disabled');
      $(".isalespricetrigger").removeAttr('disabled');
      $("#iproductsku_nonvar").removeAttr('disabled');
      $("#isalesprice_nonvar").removeAttr('disabled');
    }
  });
   // mengecek value select variant
  //  $('#varianopt').on('change', function() {
  //   var data = $("#varianopt option:selected").text();
  //   document.getElementById("selectvarian").disabled = false;
  // });

    //select varian option
    $('#varianopt').select2({
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

    $('#editvarianopt').select2({
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

  $('#iunit').select2({
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

