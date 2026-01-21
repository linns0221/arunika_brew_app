<?php
namespace App\Models;

use CodeIgniter\Model;

class ShippingModel extends Model
{
    protected $table      = 'tbl_shipping';
    protected $primaryKey = 'id_shipping';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_transaksi','tgl_pengiriman','nama_lengkap','email','no_hp','alamat','kota','kodepos'];

    public function Transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi');
    }
}
