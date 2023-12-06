<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        return view('admin/user/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_user->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->nama;
                $row[] = $rows->role;
                $row[] = $rows->email;
                $row[] = $rows->hp;
                $row[] = $rows->verifikasi_email == "1" ? '<span class="badge bg-success">Verifikasi</span>' : '<span class="badge bg-danger">No Verifikasi</span>';
                $row[] = $rows->status == "1" ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>';
                $datas['id'] = $rows->iduser;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_user->count_all(),
            "recordsFiltered" => $this->m_user->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        $data['role'] = $this->m_menurole->get_role()->getResult();
        return view('admin/user/tambah', $data);
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['user'] = $this->m_user->get_by_id($id)->getRow();
        $data['role'] = $this->m_menurole->get_role()->getResult();
        return view('admin/user/edit', $data);
    }
    public function simpan()
    {

        $ltambah        = $this->request->getPost('ltambah');
        $iduser         = $this->request->getPost('iduser');
        $idrole         = $this->request->getPost('idrole');
        $nama         = $this->request->getPost('nama');
        $email         = $this->request->getPost('email');
        $hp         = $this->request->getPost('hp');
        $password         = $this->request->getPost();
        $status         = $this->request->getPost('status');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $data = array(
                'idrole'     => $idrole,
                'nama'     => $nama,
                'email'     => $email,
                'hp'     => $hp,
                'verifikasi_email'     => 1,
                'password'     => md5($password['password']),
                'status'     => $status,
            );
            $simpan = $this->m_user->simpan($data);
        } else { // ini kondisi jika edit data


            $data = array(
                'idrole'     => $idrole,
                'nama'     => $nama,
                'email'     => $email,
                'hp'     => $hp,
                'verifikasi_email'     => 1,
                'password'     => md5($password['password']),
                'status'     => $status,
            );

            $simpan = $this->m_user->updateWhere($data, $iduser);
        }

        if ($simpan) {
            $pesan = '<div>
						<div class="alert alert-success alert-dismissable">
			                <strong>Berhasil.</strong> Data telah disimpan
					    </div>
					</div>';
        } else {
            $eror = $this->db->error();
            $pesan = '<div>
						<div class="alert alert-danger alert-dismissable">
			                <strong>Gagal!</strong> Data gagal disimpan! <br>
			                Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '
					    </div>
					</div>';
        }

        $this->session->setFlashdata('pesan', $pesan);
        return redirect()->to('user');
    }

    public function delete($encode)
    {
        $id = decode($encode);

        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => session()->get('nama')
        );

        $simpan = $this->m_user->updateWhere($data, $id);


        if ($simpan) {
            $pesan = '<div>
						<div class="alert alert-success alert-dismissable">
			                <strong>Berhasil.</strong> Data telah dihapus
					    </div>
					</div>';
        } else {
            $eror = $this->db->error();
            $pesan = '<div>
						<div class="alert alert-danger alert-dismissable">
			                <strong>Gagal!</strong> Data gagal dihapus! <br>
			                Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '
					    </div>
					</div>';
        }

        $this->session->setFlashdata('pesan', $pesan);
        return redirect()->to('user');
    }

    function cek_status_email()
    {
        $email = $this->request->getPost('email');

        $hasil_email = $this->m_user->cek_email($email);

        if ($hasil_email != 0) {
            echo "1";
        } else {
            echo "2";
        }
    }
    function cek_status_hp()
    {
        $hp = $this->request->getPost('hp');

        $hasil_hp = $this->m_user->cek_hp($hp);

        if ($hasil_hp != 0) {
            echo "1";
        } else {
            echo "2";
        }
    }
}
