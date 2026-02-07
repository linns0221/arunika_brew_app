<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\ShippingModel;
use App\Models\ItemModel;

class Cart extends BaseController
{
    /* =========================
       HALAMAN CART
    ==========================*/
    public function index()
    {
        if (!session()->get('username')) {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }

        $kategori  = new KategoriModel();
        $transaksi = new TransaksiModel();
        $detail    = new DetailTransaksiModel();

        $userID = session()->get('id_user');

        // Ambil transaksi PENDING (status = pending)
        $cek = $transaksi
            ->where('id_user', $userID)
            ->where('status', 'pending')
            ->first();

        $idTransaksi = $cek ? $cek['id_transaksi'] : 0;

        $data = [
            'kat'           => $kategori->findAll(),
            'statushalaman' => '',
            'jmlitem'       => $detail->countDataWithCriteria($idTransaksi),
            'detail'        => $detail->getItemsWithDetail($idTransaksi)
        ];

        echo view('part/header');
        echo view('part/topbar', $data);
        echo view('cart', $data);
        echo view('part/footer');
    }

    /* =========================
       TAMBAH KE CART
    ==========================*/
    public function tambahCart()
    {
        if (!session()->get('username')) {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }

        $transaksi = new TransaksiModel();
        $detail    = new DetailTransaksiModel();

        $userID = session()->get('id_user');
        $idItem = $this->request->getPost('id_item');
        $jumlah = $this->request->getPost('jumlah');

        // Cari transaksi PENDING
        $cek = $transaksi
            ->where('id_user', $userID)
            ->where('status', 'pending')
            ->first();

        if (!$cek) {
            // Buat transaksi baru
            $transaksi->insert([
                'tgl_transaksi' => date('Y-m-d'),
                'id_user'       => $userID,
                'status'        => 'pending'
            ]);
            $idTransaksi = $transaksi->insertID();
        } else {
            $idTransaksi = $cek['id_transaksi'];
        }

        // Cek item di detail transaksi
        $cekDetail = $detail
            ->where('id_transaksi', $idTransaksi)
            ->where('id_item', $idItem)
            ->first();

        if ($cekDetail) {
            // Update jumlah jika item sudah ada
            $detail->update($cekDetail['id_detail'], [
                'jumlah' => $cekDetail['jumlah'] + $jumlah
            ]);
        } else {
            // Insert item baru
            $detail->insert([
                'id_transaksi' => $idTransaksi,
                'id_item'      => $idItem,
                'jumlah'       => $jumlah
            ]);
        }

        return redirect()->to('cart');
    }

    /* =========================
       HAPUS ITEM DARI CART
    ==========================*/
    public function delete($id)
    {
        $detail = new DetailTransaksiModel();
        $detail->delete($id);
        return redirect()->to('cart');
    }

    /* =========================
       HALAMAN CHECKOUT
    ==========================*/
    public function checkout()
    {
        if (!session()->get('username')) {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('login'));
        }

        $kategori  = new KategoriModel();
        $transaksi = new TransaksiModel();
        $detail    = new DetailTransaksiModel();

        $userID = session()->get('id_user');

        $cek = $transaksi
            ->where('id_user', $userID)
            ->where('status', 'pending')
            ->first();

        if (!$cek) {
            return redirect()->to('cart');
        }

        $idTransaksi = $cek['id_transaksi'];

        $data = [
            'kat'           => $kategori->findAll(),
            'statushalaman' => '',
            'jmlitem'       => $detail->countDataWithCriteria($idTransaksi),
            'detail'        => $detail->getItemsWithDetail($idTransaksi),
            'idtrans'       => $idTransaksi
        ];

        echo view('part/header');
        echo view('part/topbar', $data);
        echo view('checkout', $data);
        echo view('part/footer');
    }

    /* =========================
       FINAL CHECKOUT
    ==========================*/
    public function finishTrans($id)
    {
        $transaksi = new TransaksiModel();
        $shipping  = new ShippingModel();
        $detail    = new DetailTransaksiModel();
        $item      = new ItemModel();

        /* === VALIDATION (WAJIB: nama_lengkap & no_meja) === */
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_lengkap' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi'
                ]
            ],
            'no_meja' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor meja wajib diisi',
                    'numeric'  => 'Nomor meja harus berupa angka'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput();
        }

        // Pastikan transaksi masih PENDING
        $cekTrans = $transaksi
            ->where('id_transaksi', $id)
            ->where('status', 'pending')
            ->first();

        if (!$cekTrans) {
            return redirect()->to('cart');
        }

        // Kurangi stok barang
        $items = $detail->getItemsWithDetail($id);
        foreach ($items as $row) {
            $item->minus_Stok($row['id_item'], $row['jumlah']);
        }

        // Simpan shipping (ANTI DOBEL)
        $cekShip = $shipping->where('id_transaksi', $id)->first();
        if (!$cekShip) {
            $shipping->insert([
                'id_transaksi'   => $id,
                'tgl_pengiriman' => date('Y-m-d'),
                'nama_lengkap'   => $this->request->getPost('nama_lengkap'),
                'email'          => $this->request->getPost('email'),
                'no_hp'          => $this->request->getPost('no_hp'),
                'no_meja'        => $this->request->getPost('no_meja'),
                'catatan'        => $this->request->getPost('catatan'),
            ]);
        }

        // Update status transaksi menjadi SELESAI
        $transaksi->update($id, [
            'status' => 'done'
        ]);

        $data = [
            'detail'    => $detail->getItemsWithDetail($id),
            'shipping'  => $shipping->where('id_transaksi', $id)->first(),
            'transaksi' => $transaksi->find($id)
        ];

        return view('thank_you', $data);
    }
}
