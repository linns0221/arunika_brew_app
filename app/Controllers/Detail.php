<?php

namespace App\Controllers;

class Detail extends BaseController
{
    public function index()
    {
        echo view('part/header');
        echo view('part/topbar');
        echo view('detail');
        echo view('part/footer');
    }
}