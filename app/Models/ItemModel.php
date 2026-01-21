<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table      = 'tbl_item';
    protected $primaryKey = 'id_item';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kode_barang','warna','stok','harga'];

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'kode_barang');
    }

    public function minus_Stok($id_item, $jumlah)
    {
        $item = $this->find($id_item);
        if (!$item) {
            return false; // Barang tidak ditemukan
        }
        $stok_sekarang = $item['stok'];
        if ($stok_sekarang < $jumlah) {
            return false; // Stok tidak mencukupi
        }
        $stok_baru = $stok_sekarang - $jumlah;
        $data = ['stok' => $stok_baru];
        $this->update($id_item, $data);
        return true; // Stok berhasil dikurangi
    }
}
