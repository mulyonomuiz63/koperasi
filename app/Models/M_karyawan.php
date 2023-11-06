<?php

namespace App\Models;

use CodeIgniter\Model;

class M_karyawan extends Model
{
    var $tabel     = 'karyawan';

    var $column_order = array('nama', 'email', 'hp'); //set nama field yang bisa diurutkan
    var $column_search = array('nama', 'email', 'hp'); //set nama field yang akan di cari
    var $order = array('idkaryawan' => 'asc'); // default order 

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (!empty($_POST['length']) && $_POST['length'] != -1)
            $this->builder->limit($_POST['length'], $_POST['start']);
        return $this->builder->get();
    }

    private function _get_datatables_query()
    {
        $this->builder = $this->db->table('karyawan a');
        $this->builder->select('a.*, b.email, b.hp');
        $this->builder->join('user b', 'a.iduser=b.iduser');
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
        $this->builder = $this->db->table('karyawan a');
        $this->builder->select('a.*, b.email, b.hp, c.idkelurahan, d.idkecamatan, e.idkota, f.idprovinsi');
        $this->builder->join('user b', 'a.iduser=b.iduser');
        $this->builder->join('kelurahan c', 'a.idkelurahan=c.idkelurahan');
        $this->builder->join('kecamatan d', 'c.idkecamatan=d.idkecamatan');
        $this->builder->join('kota e', 'd.idkota=e.idkota');
        $this->builder->join('provinsi f', 'e.idprovinsi=f.idprovinsi');
        $this->builder->where('a.idkaryawan', $id);
        return $this->builder->get();
    }

    public function updateWhere($data, $karyawan)
    {

        $this->db->transBegin();

        $builder = $this->db->table($this->tabel);
        $builder->where('idkaryawan', $karyawan);
        $builder->update($data);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }
    public function hapus($data, $karyawan)
    {
        $this->db->transBegin();

        $builder = $this->db->table($this->tabel);
        $builder->where('idkaryawan', $karyawan);
        $builder->update($data);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }

    function cek_email($email)
    {
        $this->builder = $this->db->table('user');
        $this->builder->select('count(*) as jlh');
        $this->builder->where('email', $email);

        $query = $this->builder->get();
        return $query->getRow()->jlh;
    }

    function cek_hp($hp)
    {
        $this->builder = $this->db->table('user');
        $this->builder->select('count(*) as jlh');
        $this->builder->where('hp', $hp);

        $query = $this->builder->get();
        return $query->getRow()->jlh;
    }

    public function get_provinsi()
    {
        $builder = $this->db->table('provinsi');
        return $builder->get();
    }

    public function kota($id)
    {
        $builder = $this->db->table('kota');
        $builder->where('idprovinsi', $id);
        return $builder->get();
    }
    public function kecamatan($id)
    {
        $builder = $this->db->table('kecamatan');
        $builder->where('idkota', $id);
        return $builder->get();
    }
    public function kelurahan($id)
    {
        $builder = $this->db->table('kelurahan');
        $builder->where('idkecamatan', $id);
        return $builder->get();
    }
}
