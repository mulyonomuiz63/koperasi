<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        return view('user/index');
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
                $row[] =
                    '<a href="' . site_url('user/edit/' . ($rows->iduser)) . '" class="btn btn-sm btn-warning btn-circle" data-toggle="tooltip" data-placement="left" title="Ubah data menu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                            <a href="' . site_url('user/delete/' . ($rows->iduser)) . '" class="btn btn-sm btn-danger btn-circle" id="hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                            </a>';
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
        return view('user/tambah', $data);
    }
    public function edit($id)
    {
        $data['user'] = $this->m_user->get_by_id($id)->getRow();
        $data['role'] = $this->m_menurole->get_role()->getResult();
        return view('user/edit', $data);
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

    public function delete($id)
    {


        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => 'admin'
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
