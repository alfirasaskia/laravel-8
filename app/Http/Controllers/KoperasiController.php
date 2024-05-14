<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoperasiModel;
use Dompdf\Dompdf;

class KoperasiController extends Controller
{

    public function __construct() 
    {
        $this->KoperasiModel = new KoperasiModel;
        $this->middleware('auth');
    }


    public function index()
    {
        $data =[
            'koperasi' => $this->KoperasiModel->allData(),
        ];
        return view('v_koperasi', $data);
    }


    public function print()
    {
        $data =[
            'koperasi' => $this->KoperasiModel->allData(),
        ];
        return view('v_print', $data);
    }

    public function printpdf()
    {
        $data =[
            'koperasi' => $this->KoperasiModel->allData(),
        ];
        $html = view('v_printpdf', $data);



        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

       // Output the generated PDF to Browser
       $dompdf->stream();
    }
}
