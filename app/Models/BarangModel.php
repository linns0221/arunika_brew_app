<?php
namespace App\Models;
use CodeIgniter\Model;
class BarangModel extends Model
{
    protected $table      = 'tbl_barang';
    protected $primaryKey = 'kode_barang';
    protected $allowedFields = ['kode_barang','id_kategori','nama_barang','gambar','deskripsi'];
    public function generateKodeBarang()
    {
        $prefix = 'BRG';
        $query = $this->db->table($this->table)
            ->select('RIGHT(kode_barang,2) AS idbar')
            ->orderBy('kode_barang', 'DESC')
            ->limit(1)
            ->get();

        $result = $query->getRow();
        $lastId = $result ? $result->idbar : 0;
        $lastId = (int) $lastId + 1;
        $kodeBarang = $prefix . str_pad($lastId, 2, '0', STR_PAD_LEFT);
        return $kodeBarang;
    }
}
