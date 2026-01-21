<?php
namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model
{
    protected $table  = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username','password','hak_akses'];
    
    public function get_data($username, $password)
    {
        return $this->db->table('tbl_user')
        ->where(array('username' => $username, 'password' => md5($password)))
        ->get()->getRowArray();
    }        
}
