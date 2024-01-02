<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pengepul extends Model
{
    var $tabel     = 'pengepul';

    var $column_order = array('nama', 'email', 'hp'); //set nama field yang bisa diurutkan
    var $column_search = array('nama', 'email', 'hp'); //set nama field yang akan di cari
    var $order = array('idpengepul' => 'asc'); // default order 

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (!empty($_POST['length']) && $_POST['length'] != -1)
            $this->builder->limit($_POST['length'], $_POST['start']);
        return $this->builder->get();
    }

    private function _get_datatables_query()
    {
        $this->builder = $this->db->table('pengepul a');
        $this->builder->select('a.*, b.email, b.hp');
        $this->builder->join('users b', 'a.iduser=b.iduser');
        if (session()->get('idrole') == '3') {
            $this->builder->where('a.iduser', session()->get('iduser'));
        }
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
        $this->_get_datatables_query();
        $builder = $this->builder;
        return $builder->countAllResults();
    }

    public function simpan($data)
    {
        $this->db->transBegin();

        //update data di table pengepul
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
        $this->builder = $this->db->table('pengepul a');
        $this->builder->select('a.*, b.email, b.hp, c.idkelurahan, d.idkecamatan, e.idkota, f.idprovinsi');
        $this->builder->join('users b', 'a.iduser=b.iduser');
        $this->builder->join('kelurahan c', 'a.idkelurahan=c.idkelurahan', 'left');
        $this->builder->join('kecamatan d', 'c.idkecamatan=d.idkecamatan', 'left');
        $this->builder->join('kota e', 'd.idkota=e.idkota', 'left');
        $this->builder->join('provinsi f', 'e.idprovinsi=f.idprovinsi', 'left');
        if (session()->get('idrole') == '3') {
            $this->builder->where('a.idpengepul', $id);
            $this->builder->orWhere('a.iduser', $id);
        }
        return $this->builder->get();
    }

    public function get_keltani($id)
    {
        $this->builder = $this->db->table('tani a');
        $this->builder->select('a.*');
        $this->builder->join('kel_tani b', 'a.idkeltani=b.idkeltani', 'left');

        $this->builder->where('b.idpengepul', $id);
        return $this->builder->get();
    }

    public function updateWhere($data, $pengepul)
    {

        $this->db->transBegin();

        $builder = $this->db->table($this->tabel);
        $builder->where('idpengepul', $pengepul);
        $builder->update($data);

        //proses insert data di table user
        $user = $this->db->table('users')->getWhere(array('iduser' => session()->get('iduser')))->getRow();
        if ($user->status != '1') {
            $dataUser = array(
                'iduser' => $user->iduser,
                'idrole' => $user->idrole,
                'nama' => $user->nama,
                'email' => $user->email,
                'hp' => $user->hp,
                'status' => '1',
                'password' => $user->password,
                'privasi' => $user->privasi,
            );
            $builder1 = $this->db->table('user');
            $builder1->insert($dataUser);

            //delete data di table re_user

            $builder2 = $this->db->table('re_user');
            $builder2->where('iduser', $user->iduser);
            $builder2->delete();
        }

        $result = $this->db->table('users')->getWhere(array('iduser' => session()->get('iduser')))->getRow();

        $data = array(
            'iduser' => $result->iduser,
            'nama' => $result->nama,
            'email' => $result->email,
            'idrole' => $result->idrole,
            'isLoggedIn' => TRUE,
            'status' => $result->status
        );

        session()->set($data);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }
    public function hapus($data, $pengepul)
    {
        $this->db->transBegin();

        $builder = $this->db->table($this->tabel);
        $builder->where('idpengepul', $pengepul);
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
        $this->builder = $this->db->table('users');
        $this->builder->select('count(*) as jlh');
        $this->builder->where('email', $email);

        $query = $this->builder->get();
        return $query->getRow()->jlh;
    }

    function cek_hp($hp)
    {
        $this->builder = $this->db->table('users');
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
