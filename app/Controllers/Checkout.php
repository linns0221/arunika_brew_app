<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

class Checkout extends BaseController
{
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }

        $kategori  = new KategoriModel();
        $transaksi = new TransaksiModel();
        $detail    = new DetailTransaksiModel();

        $userID = session()->get('id_user');

        // ambil transaksi yang masih aktif (awal)
        $cek = $transaksi->cek_data($userID);
        if (!$cek) {
            return redirect()->to(base_url('cart'));
        }

        $idTransaksi = $cek['id_transaksi'];

        $data = [
            'kat'        => $kategori->findAll(),
            'detail'     => $detail->getItemsWithDetail($idTransaksi),
            'jmlitem'    => $detail->countDataWithCriteria($idTransaksi),
            'idtrans'    => $idTransaksi,
            'statushalaman' => ''
        ];

        echo view('part/header');
        echo view('part/topbar', $data);
        echo view('checkout', $data);
        echo view('part/footer');
    }
}
