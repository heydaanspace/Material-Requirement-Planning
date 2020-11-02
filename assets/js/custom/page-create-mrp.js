"use strict";

$(document).ready(function() {

	$('.selprod_bom').on('change', function() {
		var data = $(".selprod_bom option:selected").text();
		$("#selitem_material").removeAttr('disabled');
		$("#save_btn").removeAttr('disabled');
	});

	$('#selmo_code').select2({
		width: '100%',
		placeholder: 'Pilih No. Produksi'
	});

	$('#sel_prod').select2({
		width: '100%',
		placeholder: 'Tentukan Produk'
	});
	$('.filterDate').select2({
		width: '100%',
		placeholder: 'Pilih No. Produksi'
	});	


});

