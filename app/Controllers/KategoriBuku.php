<?php

namespace App\Controllers;
use App\Models\KategoriModel;
use App\Models\BarangModel;
use App\Models\ItemModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

class KategoriBuku extends BaseController
{
    public function index()
    {
        $kategori = new KategoriModel();
        $barang = new BarangModel();
        $transaksi = new TransaksiModel();
        $detail = new DetailTransaksiModel();
        $data['kat'] = $kategori->findAll();
        $data['brg'] = $barang->findAll();
        $data['statushalaman']="";
        $userID=session()->get('id_user');
        $cek = $transaksi->cek_data($userID);
        $idTransaksi = 0;
        if($cek)
            $idTransaksi = $cek['id_transaksi'];
        $data['jmlitem'] = $detail->countDataWithCriteria($idTransaksi);
        echo view('part/header');
        echo view('part/topbar', $data);
        echo view('kategoribuku',$data);
        echo view('part/footer');
    }

    public function view($id)
    {
        $kategori = new KategoriModel();
        $barang = new BarangModel();
        $transaksi = new TransaksiModel();
        $detail = new DetailTransaksiModel();
        $data['kat'] = $kategori->findAll();
        $data['statushalaman']="";
        $userID=session()->get('id_user');
        $cek = $transaksi->cek_data($userID);
        $idTransaksi = 0;
        if($cek)
            $idTransaksi = $cek['id_transaksi'];
        $data['jmlitem'] = $detail->countDataWithCriteria($idTransaksi);
        $data['brg'] = $barang->where('id_kategori', $id)->findAll();
        echo view('part/header');
        echo view('part/topbar',$data);
        echo view('kategoribuku',$data);
        echo view('part/footer');
    }

    public function detail($id)
    {
        $kategori = new KategoriModel();
        $barang = new BarangModel();
        $item = new ItemModel();
        $transaksi = new TransaksiModel();
        $detail = new DetailTransaksiModel();
        $data['kat'] = $kategori->findAll();
        $data['statushalaman']="";
        $userID=session()->get('id_user');
        $cek = $transaksi->cek_data($userID);
        $idTransaksi = 0;
        if($cek)
            $idTransaksi = $cek['id_transaksi'];
        $data['jmlitem'] = $detail->countDataWithCriteria($idTransaksi);
        $data['brg'] = $barang->where('kode_barang', $id)->first();
        $data['item'] = $item->where('kode_barang', $id)->findAll();
        echo view('part/header');
        echo view('part/topbar',$data);
        echo view('detail',$data);
        echo view('part/footer');
    }
}

