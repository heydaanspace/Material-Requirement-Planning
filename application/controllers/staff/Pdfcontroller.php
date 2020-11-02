<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pdfcontroller extends MY_Controller
{
   public function laporan_pdf(){

    $data = array(
        "dataku" => array(
            "nama" => "Petani Kode",
            "url" => "http://petanikode.com"
        )
    );

    $this->load->library('pdfgenerator');

    $this->pdfgenerator->setPaper('A4', 'potrait');
    $this->pdfgenerator->filename = "laporan-petanikode.pdf";
    $this->pdfgenerator->load_view('production/laporan_pdf', $data);

}
}
