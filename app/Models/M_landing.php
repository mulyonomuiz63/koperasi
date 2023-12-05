<?php

namespace App\Models;

use CodeIgniter\Model;

class M_landing extends Model
{

    function get_dataproduk()
    {
        $this->builder = $this->db->table('produk a');
        $this->builder->where('a.deleted_at', null);
        $this->builder->where('a.status', 'B');
        return $this->builder->get();
    }
}
