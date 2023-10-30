<?php

namespace App\Models;

use CodeIgniter\Model;

class M_produk extends Model
{
    var $tabel     = 'produk';

    var $column_order = array('komoditi', 'prodak'); //set komoditi field yang bisa diurutkan
    var $column_search = array('komoditi', 'prodak'); //set komoditi field yang akan di cari
    var $order = array('idproduk' => 'asc'); // default order 

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (!empty($_POST['length']) && $_POST['length'] != -1)
            $this->builder->limit($_POST['length'], $_POST['start']);
        return $this->builder->get();
    }

    private function _get_datatables_query()
    {
        $this->builder = $this->db->table('produk a');
        $this->builder->select('a.*, b.komoditi, c.nama');
        $this->builder->join('komoditi b', 'a.idkomoditi=b.idkomoditi');
        $this->builder->join('pengepul c', 'a.idpengepul=c.idpengepul');
        $this->builder->where('a.deleted_at', null);
        $i = 0;

        foreach ($this->column_search as $item) {
            if (!empty($_POST['search']['value'])) {
                if ($i === 0) {
                    $this->builder->groupStart(); // Untuk Menggabung beberapa kondisi "AND"
                    $this->builder->like($item, $_POST['search']['value']);
                } else {
                    $this->builder->orLike($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->builder->groupEnd();
            }
            $i++;
        }

        // -------------------------> Proses Order by        
        if (isset($_POST['order'])) {
            $this->builder->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->builder->orderBy(key($order), $order[key($order)]);
        }
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->builder->select('count(*) as jlh');
        $query = $this->builder->get();
        return $query->getRow()->jlh;
    }

    public function count_all()
    {
        $builder = $this->db->table($this->tabel);
        return $builder->countAllResults();
    }

    public function simpan($data)
    {
        $this->db->transBegin();

        $builder = $this->db->table($this->tabel);
        $builder->insert($data);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }

    public function get_by_id($id)
    {
        $this->builder = $this->db->table('produk a');
        $this->builder->select('a.*');
        $this->builder->where('a.idproduk', $id);
        return $this->builder->get();
    }

    public function updateWhere($data, $produk)
    {

        $this->db->transBegin();

        $builder = $this->db->table($this->tabel);
        $builder->where('idproduk', $produk);
        $builder->update($data);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }
    public function hapus($data, $produk)
    {
        $this->db->transBegin();

        $builder = $this->db->table($this->tabel);
        $builder->where('idproduk', $produk);
        $builder->update($data);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }


    public function get_Komoditi()
    {
        $builder = $this->db->table('komoditi');
        return $builder->get();
    }
}
