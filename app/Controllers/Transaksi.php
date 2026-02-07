<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $transaksi = new TransaksiModel();
        $data['transaksi'] = $transaksi->getDataWithUser();
        echo view('part_adm/header');
        echo view('part_adm/top_menu', $data);
        echo view('part_adm/side_menu', $data);
        echo view('transaksi', $data);
        echo view('part_adm/footer');
    }

    public function detail($id)
    {
        $transaksi = new TransaksiModel();
        $detail = new DetailTransaksiModel();
        $data['transaksi'] = $transaksi->cek_transaksi($id);
        $data['detail'] = $detail->getItemsWithDetail($id);
        echo view('part_adm/header');
        echo view('part_adm/top_menu', $data);
        echo view('part_adm/side_menu', $data);
        echo view('transaksi_detail', $data);
        echo view('part_adm/footer');
    }

}
