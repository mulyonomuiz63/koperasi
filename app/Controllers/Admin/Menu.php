<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Menu extends BaseController
{
    public function index(): string
    {
        return view('admin/menu/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_menu->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->menu;
                $datas['id'] = $rows->idmenu;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_menu->count_all(),
            "recordsFiltered" => $this->m_menu->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        return view('admin/menu/tambah');
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['menu'] = $this->m_menu->get_by_id($id)->getResult();
        return view('admin/menu/edit', $data);
    }
    public function simpan()
    {

        $idmenu         = $this->request->getPost('idmenu');
        $menu         = $this->request->getPost('menu');
        $ltambah        = $this->request->getPost('ltambah');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $data = array(
                'idmenu'     => $idmenu,
                'menu'     => $menu,
            );
            $simpan = $this->m_menu->simpan($data);
        } else { // ini kondisi jika edit data


            $data = array(
                'menu'     => $menu,
            );

            $simpan = $this->m_menu->updateWhere($data, $idmenu);
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
        return redirect()->to('menu');
    }

    public function delete($encode)
    {
        $id = decode($encode);

        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => session()->get('nama')
        );

        $simpan = $this->m_menu->updateWhere($data, $id);


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
        return redirect()->to('menu');
    }
}
