<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table      = 'tbl_detail_transaksi';
    protected $primaryKey = 'id_detail';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_transaksi','id_item','jumlah'];

    public function item()
    {
        return $this->belongsTo(ItemModel::class, 'id_item');
    }

    public function getItemsWithDetail($idTransaksi)
    {
        return $this->join('tbl_item', 'tbl_detail_transaksi.id_item = tbl_item.id_item')
                    ->join('tbl_barang', 'tbl_item.kode_barang = tbl_barang.kode_barang')
                    ->where(array('id_transaksi' => $idTransaksi))
                    ->select('tbl_detail_transaksi.*, tbl_item.warna, tbl_item.harga, tbl_barang.nama_barang, tbl_barang.gambar')
                    ->findAll();
    }
    public function cek_data($id_transaksi,$id_item)
    {
      return $this->db->table('tbl_detail_transaksi')
      ->where(array('id_transaksi' => $id_transaksi, 'id_item' => $id_item))
      ->get()->getRowArray();
    }
    public function countDataWithCriteria($idTransaksi)
    {
        return $this->where(array('id_transaksi' => $idTransaksi))->countAllResults();
    }
    public function getProdukTerlaris()
    {
        $builder = $this->db->table('tbl_detail_transaksi');
        $builder->select('tbl_detail_transaksi.*, SUM(tbl_detail_transaksi.jumlah) as total, tbl_item.kode_barang, tbl_barang.nama_barang, tbl_barang.gambar');
        $builder->join('tbl_item', 'tbl_detail_transaksi.id_item = tbl_item.id_item');
        $builder->join('tbl_barang', 'tbl_item.kode_barang = tbl_barang.kode_barang');
        $builder->groupBy('tbl_item.kode_barang');
        $builder->orderBy('total', 'DESC');
        $builder->limit(4);

        $query = $builder->get();

        return $query->getResult();
    }
}
