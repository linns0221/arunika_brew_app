<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Kategori extends BaseController
{
    public function index()
    {
        $kategori = new KategoriModel();
        $data['kat'] = $kategori->findAll();
        echo view('part_adm/header');
        echo view('part_adm/top_menu',$data);
        echo view('part_adm/side_menu',$data);
        echo view('kategori',$data);
        echo view('part_adm/footer');
    }

    public function tambah()
    {
        // lakukan validasi
        $validation = \Config\Services::validation();
        $validation->setRules(['nama_kategori' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data valid, simpan ke database
        if($isDataValid){
            $kat = new KategoriModel(); 
            $kat->insert([
                "nama_kategori" => $this->request->getPost('nama_kategori')
            ]);
            return redirect('kategori');
        }
        echo view('part_adm/header');
        echo view('part_adm/top_menu');
        echo view('part_adm/side_menu');
        echo view('kategori_add');
        echo view('part_adm/footer');
    }

    public function edit($id)
    {
        //ambil artikel yang akan diedit
        $kat = new KategoriModel();
        $data ['kategori'] = $kat->where('id_kategori', $id)->first();
        //lakukan validasi
        $validation= \Config\Services::validation();
        $validation->setRules([
            'nama_kategori' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        //jika data valid maka simpan ke database
        if($isDataValid){
            $kat->update($id,[
                "nama_kategori" => $this->request->getPost('nama_kategori')
            ]);
            return redirect('kategori');
        }
        //tampilkan form edit
        echo view('part_adm/header');
        echo view('part_adm/top_menu');
        echo view('part_adm/side_menu');
        echo view('kategori_edit',$data);
        echo view('part_adm/footer');
    }

    public function delete($id){
        $kat = new KategoriModel();
        $kat->delete($id);
        return redirect('kategori');
    }
}