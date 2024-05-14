<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuruModel;
 

class GuruController extends Controller
{
    protected $GuruModel;

    public function __construct() 
    {
        $this->GuruModel = new GuruModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'guru' => $this->GuruModel->allData(),
        ];
        return view('v_guru', $data);
    }

    public function detail($id_guru)
    {
   
        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        return view('v_detailguru', $data);
    }

    public function add()
    {
        return view('v_addguru');
    }


    public function insert()
    {
        // Validating the incoming request data
        Request()->validate([
            'nip' => 'required|unique:tbl_guru,nip|min:4|max:5',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'required|mimes:jpg,jpeg,bmp,png|max:1024',
        ] , [
            
                'nip.required' => 'NIP wajib diisi',
                'nip.unique' => 'NIP Ini Sudah Ada!!',
                'nip.min' => 'NIP minimal 4 Karakter',
                'nip.max' => 'NIP maksimal Ini Sudah Ada',
                'nama_guru.required' => 'Nama Guru wajib diisi !!',
                'mapel.required' => 'wajib diisi !!',
                'foto_guru.image' => 'wajib diisi !!',
                'foto_guru.mimes' => 'Format gambar yang didukung: jpg, jpeg, bmp, png.',
                'foto_guru.max' => 'Ukuran file gambar tidak boleh melebihi 1MB',



        ]);
    

        // jika validasi tidak ada maka lakukan simpan data
       // upload gambar/foto
        $file = Request()->foto_guru;

        $fileName = Request()->nip.'.'. $file->extension();

        $file->move(public_path('foto_guru'), $fileName);

        $data = [
            'nip' => Request()->nip,
            'nama_guru' => Request()->nama_guru,
            'mapel' => Request()->mapel,
            'foto_guru' => Request()->$fileName,

        ];


        $this->GuruModel->addData($data);
        return redirect()->route('guru')->with('pesan','Data Berhasil Di Tambahkan :::');
    }

    public function edit($id_guru)
    {
        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        return view('v_editguru', $data);
    }

    public function update($id_guru)
    {
        // Validating the incoming request data
        Request()->validate([
            'nip' => 'required|min:4|max:5',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ] , [
            
                'nip.required' => 'NIP wajib diisi',
                'nip.min' => 'NIP minimal 4 Karakter',
                'nip.max' => 'NIP maksimal Ini Sudah Ada',
                'nama_guru.required' => 'Nama Guru wajib diisi !!',
                'mapel.required' => 'wajib diisi !!',
                'foto_guru.image' => 'wajib diisi !!',
                'foto_guru.mimes' => 'Format gambar yang didukung: jpg, jpeg, bmp, png.',
                'foto_guru.max' => 'Ukuran file gambar tidak boleh melebihi 1MB',



        ]);
    

        // jika validasi tidak ada maka lakukan simpan data
        if (Request()->foto_guru <> "") {
            //jika ingin ganti foto
            // upload gambar/foto
        
       
        $file = Request()->foto_guru;

        $fileName = Request()->nip.'.'. $file->extension();

        $file->move(public_path('foto_guru'), $fileName);

        $data = [
            'nip' => Request()->nip,
            'nama_guru' => Request()->nama_guru,
            'mapel' => Request()->mapel,
            'foto_guru' => Request()->$fileName,

        ];


        $this->GuruModel->editData($id_guru, $data);

    } else {
        //jika tidak ingin ganti foto
        $data = [
            'nip' => Request()->nip,
            'nama_guru' => Request()->nama_guru,
            'mapel' => Request()->mapel,
            
        ];


        $this->GuruModel->editData($id_guru, $data);

    }


        
        return redirect()->route('guru')->with('pesan','Data Berhasil Di Update :::');
    }

    public function delete($id_guru)
     {
        //hapus atau delete foto
        $guru = $this->GuruModel->detailData($id_guru);
        if ($guru->foto_guru <> "" ) {

            $this->GuruModel->deleteData($id_guru);
            return redirect()->route('guru')->with('pesan', 'Data Berhasil Di Hapus');
        }
    }

}

