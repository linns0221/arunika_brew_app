<?php

namespace App\Models;

use CodeIgniter\Model;

class CarouselModel extends Model
{
    protected $table      = 'tbl_carousel';
    protected $primaryKey = 'id_carousel';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['desc_carousel','pic_carousel'];
}
