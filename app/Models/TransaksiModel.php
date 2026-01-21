<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'tbl_transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['tgl_transaksi','id_user','status'];
    // Relasi dengan Detail Transaksi
    public function detail()
    {
        return $this->hasMany(DetailTransaksiModel::class, 'id_transaksi');
    }

    public function cek_data($id_user)
    {
      return $this->db->table('tbl_transaksi')
      ->where(array('id_user' => $id_user, 'status' => 'awal'))
      ->get()->getRowArray();
    }
}
