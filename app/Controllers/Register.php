<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
class Register extends BaseController
{
    public function index()
    {
        $transaksi = new TransaksiModel();
        $detail = new DetailTransaksiModel();
        $userID=session()->get('id_user');
        $cek = $transaksi->cek_data($userID);
        $idTransaksi = 0;
        if($cek)
            $idTransaksi = $cek['id_transaksi'];
        $data['jmlitem'] = $detail->countDataWithCriteria($idTransaksi);
        echo view('part/header');
        echo view('part/topbar', $data);
        echo view('register');
        echo view('part/footer');
    }
    public function simpan()
    {
        $usr = new UserModel();
        $usr->insert([
                "username" => $this->request->getPost('username'),
                "password" => md5($this->request->getPost('password')),
                "hak_akses" => "user"
        ]);
        return redirect('beranda');
        
    }
}