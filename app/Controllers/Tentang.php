<?php

namespace App\Controllers;

class Tentang extends BaseController
{
    public function index()
    {
        $data = [
            'jmlitem' => 0 // default kalau belum ada cart
        ];

        echo view('part/header');
        echo view('part/topbar', $data);
        echo view('tentang');
        echo view('part/footer');
    }
}
