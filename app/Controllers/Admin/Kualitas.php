<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kualitas extends BaseController
{
    public function index(): string
    {
        return view('admin/kualitas/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_kualitas->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->kualitas;
                $datas['id'] = $rows->idqreport;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_kualitas->count_all(),
            "recordsFiltered" => $this->m_kualitas->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        return view('admin/kualitas/tambah');
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['kualitas'] = $this->m_kualitas->get_by_id($id)->getResult();
        return view('admin/kualitas/edit', $data);
    }
    public function simpan()
    {

        $idqreport     = $this->request->getPost('idqreport');
        $kualitas       = $this->request->getPost('kualitas');
        $ltambah        = $this->request->getPost('ltambah');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $data = array(
                'idqreport'     => $idqreport,
                'kualitas'     => $kualitas,
            );
            $simpan = $this->m_kualitas->simpan($data);
        } else { // ini kondisi jika edit data


            $data = array(
                'kualitas'     => $kualitas,
            );

            $simpan = $this->m_kualitas->updateWhere($data, $idqreport);
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
        return redirect()->to('kualitas');
    }

    public function delete($encode)
    {
        $id = decode($encode);

        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => session()->get('nama')
        );

        $simpan = $this->m_kualitas->updateWhere($data, $id);


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
        return redirect()->to('kualitas');
    }
}
