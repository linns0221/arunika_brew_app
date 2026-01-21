<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Barang extends BaseController
{
    public function index()
    {
        $barang = new BarangModel();
        $data['brg'] = $barang->findAll();
        echo view('part_adm/header');
        echo view('part_adm/top_menu',$data);
        echo view('part_adm/side_menu',$data);
        echo view('barang',$data);
        echo view('part_adm/footer');
    }
    public function tambah()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules(['nama_barang' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
            $brg = new BarangModel();
            $dataGambar = $this->request->getFile('gambar');
            $fileName = $dataGambar->getRandomName();
            $dataGambar->move('file_gambar/', $fileName);
            $brg->insert([
                "kode_barang" => $this->request->getPost('kode_barang'),
                "id_kategori" => $this->request->getPost('id_kategori'),
                "nama_barang" => $this->request->getPost('nama_barang'),
                "gambar" => $fileName
            ]);
            return redirect('barang');
        }
        $barang = new BarangModel();
        $kategori = new KategoriModel();
        $data['barang'] = $barang->generateKodeBarang();
        $data['kategori'] = $kategori->findAll();
        echo view('part_adm/header');
        echo view('part_adm/top_menu');
        echo view('part_adm/side_menu');
        echo view('barang_add',$data);
        echo view('part_adm/footer');
    }
    public function edit($id)
    {
        $brg = new BarangModel();
        $data['barang'] = $brg->where('kode_barang', $id)->first();
        $validation =  \Config\Services::validation();
        $validation->setRules(['nama_barang' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
            $brg = new BarangModel();
            $dataGambar = $this->request->getFile('gambar');
            if($dataGambar){
                $fileName = $dataGambar->getRandomName();
                $dataGambar->move('file_gambar/', $fileName);
                $brg->update($id, [
                    "id_kategori" => $this->request->getPost('id_kategori'),
                    "nama_barang" => $this->request->getPost('nama_barang'),
                    "gambar" => $fileName
                ]);
            }else{
                $brg->update($id, [
                    "id_kategori" => $this->request->getPost('id_kategori'),
                    "nama_barang" => $this->request->getPost('nama_barang'),
                ]);
            }
            return redirect('barang');
        }
        $kategori = new KategoriModel();
        $data['kategori'] = $kategori->findAll();
        echo view('part_adm/header');
        echo view('part_adm/top_menu');
        echo view('part_adm/side_menu');
        echo view('barang_edit',$data);
        echo view('part_adm/footer');
    }
    public function delete($id){
        $bar = new BarangModel();
        $bar->delete($id);
        return redirect('barang');
    }
}
