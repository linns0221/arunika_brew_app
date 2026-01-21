<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }
        echo view('part_adm/header');
        echo view('part_adm/top_menu');
        echo view('part_adm/side_menu');
        echo view('dashboard');
        echo view('part_adm/footer');
    }
}