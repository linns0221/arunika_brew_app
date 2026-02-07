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

    public function cek_transaksi($id)
    {
        return $this->select("
          tbl_transaksi.id_transaksi,
          tbl_user.username,
          tbl_transaksi.tgl_transaksi")
      ->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id_user')
      ->where('tbl_transaksi.id_transaksi', $id)
      ->groupBy('tbl_transaksi.id_transaksi')
      ->first();   
    }

    public function getDataWithUser()
    {
        return $this->select("
        tbl_transaksi.id_transaksi,
        tbl_user.username,
        tbl_transaksi.tgl_transaksi,
        SUM(tbl_detail_transaksi.jumlah * tbl_item.harga) AS total_biaya
    ")
    ->join('tbl_user', 'tbl_transaksi.id_user = tbl_user.id_user')
    ->join('tbl_detail_transaksi', 'tbl_transaksi.id_transaksi = tbl_detail_transaksi.id_transaksi')
    ->join('tbl_item', 'tbl_detail_transaksi.id_item = tbl_item.id_item')
    ->groupBy('tbl_transaksi.id_transaksi')
    ->findAll();
    }
}
