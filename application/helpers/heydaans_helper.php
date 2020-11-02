<?php

function konfigurasi($title, $c_des=null)
{
  $CI = get_instance();
  $CI->load->model('Konfigurasi_model');
  $CI->load->model('Auth_model');
  $auth = $CI->Auth_model->get_by_id('id');
  $site = $CI->Konfigurasi_model->listing();
  $data = array(
    'title' => $title.' | '.$site['website_name'],
    'logo' => $site['logo'],
    'favicon' => $site['favicon'],
    'userdata'=> $auth,
  );

  return $data;
}


function show_msg($content='', $type='success', $icon='fa-info-circle', $size='14px')
{
  if ($content != '') {
    return  '<p class="box-msg">
    <div class="info-box alert-' .$type .'">
    <div class="info-box-icon">
    <i class="fa ' .$icon .'"></i>
    </div>
    <div class="info-box-content" style="font-size:' .$size .'">
    ' .$content
    .'</div>
    </div>
    </p>';
  }
}

function show_succ_msg($content='')
{
  if ($content != '') {
    return   '<div class="alert alert-success alert-has-icon">
    <div class="alert-icon"><i class="far fa-check-circle"></i></div>
    <div class="alert-body">
    <div class="alert-title">Sukses</div> ' .$content.'</div>
    </div>';
  }
}



function show_err_msg($content='')
{
  if ($content != '') {
    return   '<div class="alert alert-danger alert-has-icon">
    <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div"></i></div>
    <div class="alert-body">
    <div class="alert-title">Kesalahan</div> ' .$content.'</div>
    </div>';
  }
}

function show_err_form_msg($content='', $size='14px')
{
  if ($content != '') {
    return   '<div class="box-body" style="text-align:center">
    <div class="alert alert-danger alert-dismissible">'
    .$content.
    '</div>
    </div>';
  }
}

function alert($class, $title, $description)
{
  return '<div class="alert '.$class.' alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-ban"></i> '.$title.'</h4>
  '.$description.'
  </div>';
}

function tanggal()
{
  date_default_timezone_set('Asia/Jakarta');
  return date('Y-m-d');
}
function formatDMY($date){
 // ubah string menjadi format tanggal
 return date('d-m-Y', strtotime($date));
}

function tanggal_indo()
{
  date_default_timezone_set('Asia/Jakarta');
  return date('d-m-Y');
}

function tanggal_new()
{
  date_default_timezone_set('Asia/Jakarta');
  /* script menentukan hari */
  $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
  $hr = $array_hr[date('N')];
  /* script menentukan tanggal */
  $tgl= date('j');
  /* script menentukan bulan */
  $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
  $bln = $array_bln[date('n')];
  /* script menentukan tahun */
  $thn = date('Y');
  /* script perintah keluaran*/
  return $hr . ", " . $tgl . " " . $bln . " " . $thn . " " . date('H:i');
}

function rupiah($angka)
{
  $rupiah = number_format($angka, 0, ',', '.');
  return $rupiah;
}

function tgl_indo($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = substr($tgl, 5, 2);
  $tahun = substr($tgl, 0, 4);
  $time = substr($tgl, 11, 5);
  return $tanggal . ' ' . bulan($bulan) . ' ' . $tahun;
}

function tgl_lengkap($tanggals)
{
  $tanggal = substr($tanggals, 8, 2);
  $bulan = substr($tanggals, 5, 2);
  $tahun = substr($tanggals, 0, 4);
  $time = substr($tanggals, 11, 5);
  return $tanggal . ' ' . bulan($bulan) . ' ' . $tahun . ' ' . $time;
}

function bulan($bln)
{
  switch ($bln) {
    case 1:
    return "Januari";
    break;
    case 2:
    return "Februari";
    break;
    case 3:
    return "Maret";
    break;
    case 4:
    return "April";
    break;
    case 5:
    return "Mei";
    break;
    case 6:
    return "Juni";
    break;
    case 7:
    return "Juli";
    break;
    case 8:
    return "Agustus";
    break;
    case 9:
    return "September";
    break;
    case 10:
    return "Oktober";
    break;
    case 11:
    return "November";
    break;
    case 12:
    return "Desember";
    break;
  }
}

function nama_hari($tanggal)
{
  $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
  $pecah = explode("-", $ubah);
  $tgl = $pecah[2];
  $bln = $pecah[1];
  $thn = $pecah[0];
  $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
  $nama_hari = "";
  if ($nama == "Sunday") {
    $nama_hari = "Minggu";
  } elseif ($nama == "Monday") {
    $nama_hari = "Senin";
  } elseif ($nama == "Tuesday") {
    $nama_hari = "Selasa";
  } elseif ($nama == "Wednesday") {
    $nama_hari = "Rabu";
  } elseif ($nama == "Thursday") {
    $nama_hari = "Kamis";
  } elseif ($nama == "Friday") {
    $nama_hari = "Jumat";
  } elseif ($nama == "Saturday") {
    $nama_hari = "Sabtu";
  }
  return $nama_hari;
}

function xTimeAgo($oldTime, $newTime, $timeType)
{
  $timeCalc = strtotime($newTime) - strtotime($oldTime);
  if ($timeType == "x") {
    if ($timeCalc = 60) {
      $timeType = "m";
    }
    if ($timeCalc = (60*60)) {
      $timeType = "h";
    }
    if ($timeCalc = (60*60*24)) {
      $timeType = "d";
    }
  }
  if ($timeType == "s") {
    $timeCalc .= " seconds ago";
  }
  if ($timeType == "m") {
    $timeCalc = round($timeCalc/60) . " menit yang lalu";
  }
  if ($timeType == "h") {
    $timeCalc = round($timeCalc/60/60) . " jam yang lalu";
  }
  if ($timeType == "d") {
    $timeCalc = round($timeCalc/60/60/24) . " hari yang lalu";
  }

  return $timeCalc;
}

function timeAgo2($timestamp)
{
  date_default_timezone_set('Asia/Jakarta');
  $skrg=date("Y-m-d H:i:s");
  $isi= str_replace("-", "", xTimeAgo($skrg, $timestamp, "m"));
  $isi2= str_replace("-", "", xTimeAgo($skrg, $timestamp, "h"));
  $isi3= str_replace("-", "", xTimeAgo($skrg, $timestamp, "d"));
  $go="";
  if ($isi > 60) {
    $go=$isi2;
  } elseif ($isi2 > 24) {
    $go=$isi3;
  } elseif ($isi < 61) {
    $go=$isi;
  }
  return $go;
}
