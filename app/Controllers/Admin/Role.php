<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Role extends BaseController
{
    public function index(): string
    {
        return view('admin/role/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_role->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->role;
                $datas['id'] = $rows->idrole;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_role->count_all(),
            "recordsFiltered" => $this->m_role->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        return view('admin/role/tambah');
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['role'] = $this->m_role->get_by_id($id)->getResult();
        return view('admin/role/edit', $data);
    }
    public function simpan()
    {

        $idrole         = $this->request->getPost('idrole');
        $role         = $this->request->getPost('role');
        $ltambah        = $this->request->getPost('ltambah');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $data = array(
                'idrole'     => $idrole,
                'role'     => $role,
            );
            $simpan = $this->m_role->simpan($data);
        } else { // ini kondisi jika edit data


            $data = array(
                'role'     => $role,
            );

            $simpan = $this->m_role->updateWhere($data, $idrole);
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
        return redirect()->to('role');
    }

    public function delete($encode)
    {
        $id = decode($encode);

        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => session()->get('nama')
        );

        $simpan = $this->m_role->updateWhere($data, $id);


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
        return redirect()->to('role');
    }
}
