<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Komoditi extends BaseController
{
    public function index(): string
    {
        return view('admin/komoditi/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_komoditi->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->komoditi;
                $datas['id'] = $rows->idkomoditi;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_komoditi->count_all(),
            "recordsFiltered" => $this->m_komoditi->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        return view('admin/komoditi/tambah');
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['komoditi'] = $this->m_komoditi->get_by_id($id)->getResult();
        return view('admin/komoditi/edit', $data);
    }
    public function simpan()
    {

        $idkomoditi         = $this->request->getPost('idkomoditi');
        $komoditi         = $this->request->getPost('komoditi');
        $ltambah        = $this->request->getPost('ltambah');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $data = array(
                'idkomoditi'     => $idkomoditi,
                'komoditi'     => $komoditi,
            );
            $simpan = $this->m_komoditi->simpan($data);
        } else { // ini kondisi jika edit data


            $data = array(
                'komoditi'     => $komoditi,
            );

            $simpan = $this->m_komoditi->updateWhere($data, $idkomoditi);
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
        return redirect()->to('komoditi');
    }

    public function delete($encode)
    {
        $id = decode($encode);

        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => session()->get('nama')
        );

        $simpan = $this->m_komoditi->hapus($data, $id);


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
        return redirect()->to('komoditi');
    }
}
