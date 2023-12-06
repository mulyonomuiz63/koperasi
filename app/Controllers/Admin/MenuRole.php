<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class MenuRole extends BaseController
{
    public function index(): string
    {
        return view('admin/menurole/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_menurole->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->menu;
                $row[] = $rows->role;
                $row[] = $rows->lihat != '0' ?  '<span class="badge bg-success text-white">True</span>' : '<span class="badge bg-danger text-white">False</span>';
                $row[] = $rows->tambah != '0' ?  '<span class="badge bg-success text-white">True</span>' : '<span class="badge bg-danger text-white">False</span>';
                $row[] = $rows->ubah != '0' ?  '<span class="badge bg-success text-white">True</span>' : '<span class="badge bg-danger text-white">False</span>';
                $row[] = $rows->hapus != '0' ?  '<span class="badge bg-success text-white">True</span>' : '<span class="badge bg-danger text-white">False</span>';
                $row[] = $rows->aprove != '0' ?  '<span class="badge bg-success text-white">True</span>' : '<span class="badge bg-danger text-white">False</span>';
                $row[] = $rows->cetak != '0' ?  '<span class="badge bg-success text-white">True</span>' : '<span class="badge bg-danger text-white">False</span>';
                $row[] = $rows->export != '0' ?  '<span class="badge bg-success text-white">True</span>' : '<span class="badge bg-danger text-white">False</span>';
                $datas['id'] = $rows->idmenurole;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_menurole->count_all(),
            "recordsFiltered" => $this->m_menurole->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        $data['menu'] = $this->m_menurole->get_menu()->getResult();
        $data['role'] = $this->m_menurole->get_role()->getResult();
        return view('admin/menurole/tambah', $data);
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['menurole'] = $this->m_menurole->get_by_id($id)->getRow();
        $data['menu'] = $this->m_menurole->get_menu()->getResult();
        $data['role'] = $this->m_menurole->get_role()->getResult();
        return view('admin/menurole/edit', $data);
    }
    public function simpan()
    {

        $idmenurole   = $this->request->getPost('idmenurole');
        $idmenu   = $this->request->getPost('idmenu');
        $idrole         = $this->request->getPost('idrole');
        $lihat         = $this->request->getPost('lihat');
        $tambah         = $this->request->getPost('tambah');
        $ubah         = $this->request->getPost('ubah');
        $hapus         = $this->request->getPost('hapus');
        $aprove         = $this->request->getPost('aprove');
        $cetak         = $this->request->getPost('cetak');
        $export         = $this->request->getPost('export');
        $ltambah        = $this->request->getPost('ltambah');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 
            $data = array(
                'idrole'     => $idrole,
                'idmenu'     => $idmenu,
                'lihat'      => $lihat == null ? '0' : $lihat,
                'tambah'     => $tambah == null ? '0' : $tambah,
                'ubah'       => $ubah == null ? '0' : $ubah,
                'hapus'      => $hapus == null ? '0' : $hapus,
                'aprove'      => $aprove == null ? '0' : $aprove,
                'cetak'      => $cetak == null ? '0' : $cetak,
                'export'      => $export == null ? '0' : $export,
            );
            if (empty($this->m_menurole->cek_menu_role($idmenu, $idrole))) {
                $simpan = $this->m_menurole->simpan($data);
            } else {
                $simpan = false;
            }
        } else { // ini kondisi jika edit data

            $data = array(
                'idrole'     => $idrole,
                'idmenu'     => $idmenu,
                'lihat'      => $lihat == null ? '0' : $lihat,
                'tambah'     => $tambah == null ? '0' : $tambah,
                'ubah'       => $ubah == null ? '0' : $ubah,
                'hapus'      => $hapus == null ? '0' : $hapus,
                'aprove'      => $aprove == null ? '0' : $aprove,
                'cetak'      => $cetak == null ? '0' : $cetak,
                'export'      => $export == null ? '0' : $export,
            );

            $simpan = $this->m_menurole->updateWhere($data, $idmenurole);
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
        return redirect()->to('menu-role');
    }

    public function delete($encode)
    {
        $id = decode($encode);

        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => session()->get('nama')
        );

        $simpan = $this->m_menurole->updateWhere($data, $id);


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
        return redirect()->to('menu-role');
    }
}
