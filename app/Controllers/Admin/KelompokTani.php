<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class KelompokTani extends BaseController
{
    public function index(): string
    {
        Session()->remove('idkeltani');
        return view('admin/kelompok_tani/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_kelompok_tani->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->nama;
                $row[] = $rows->nama_pengepul;
                $row[] = $rows->jml_tani;
                $row[] = $rows->luas;
                $row[] = '<a href="' . site_url('petani/props/' . ($rows->idkeltani)) . '" class="btn btn-sm btn-success  btn-circle" id="hapus">
                               <i class="flaticon-eye"></i>
                            </a>';
                $datas['id'] = $rows->idkeltani;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_kelompok_tani->count_all(),
            "recordsFiltered" => $this->m_kelompok_tani->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        $data['pengepul'] = $this->m_kelompok_tani->get_pengepul()->getRow();
        return view('admin/kelompok_tani/tambah', $data);
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['kelompok_tani'] = $this->m_kelompok_tani->get_by_id($id)->getRow();
        return view('admin/kelompok_tani/edit', $data);
    }
    public function simpan()
    {

        $idkeltani         = $this->request->getPost('idkeltani');
        $idpengepul        = $this->request->getPost('idpengepul');
        $nama              = $this->request->getPost('nama');
        $ltambah           = $this->request->getPost('ltambah');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $data = array(
                'idpengepul'    => $idpengepul,
                'nama'          => $nama,
            );
            $simpan = $this->m_kelompok_tani->simpan($data);
        } else { // ini kondisi jika edit data
            $data = array(
                'idpengepul'    => $idpengepul,
                'nama'          => $nama,
            );

            $simpan = $this->m_kelompok_tani->updateWhere($data, $idkeltani);
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
        return redirect()->to('kelompok-tani');
    }

    public function delete($encode)
    {
        $id = decode($encode);

        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => session()->get('nama')
        );

        $simpan = $this->m_kelompok_tani->updateWhere($data, $id);


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
        return redirect()->to('kelompok-tani');
    }
}
