<?php

namespace App\Controllers;
use App\Models\KategoriModel;
use App\Models\CarouselModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
class Beranda extends BaseController
{
    public function index()
    {
        $kategori = new KategoriModel();
        $carousel = new CarouselModel();
        $transaksi = new TransaksiModel();
        $detail = new DetailTransaksiModel();
        $data['brg'] = $detail->getProdukTerlaris();
        $data['kat'] = $kategori->findAll();
        $data['crs'] = $carousel->findAll();
        $data['statushalaman']="beranda";
        $userID=session()->get('id_user');
        $cek = $transaksi->cek_data($userID);
        $idTransaksi = 0;
        if($cek)
            $idTransaksi = $cek['id_transaksi'];
        $data['jmlitem'] = $detail->countDataWithCriteria($idTransaksi);
        echo view('part/header');
        echo view('part/topbar', $data);
        echo view('part/navbar',$data);
        echo view('beranda',$data);
        echo view('part/footer');
    }
}
