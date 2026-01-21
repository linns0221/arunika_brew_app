<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Login extends BaseController
{
    public function index()
    {
        echo view('login');
    }

    public function login_action()
    {
        $muser = new UserModel(); 
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password'); 
        $cek = $muser->get_data($username, $password); 
        if($cek)
        {
            session()->set('username', $cek['username']);
            session()->set('hak_akses', $cek['hak_akses']);
            session()->set('id_user', $cek['id_user']);
            if($cek['hak_akses']=="admin")
                return redirect()->to(base_url('/dashboard'));
            else
                return redirect()->to(base_url('/'));
        } else {
            session()->setFlashdata('gagal', 'Username / Password salah');
            return redirect()->to(base_url('login'));
        }
    }
    
    public function logout() 
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}