<?php

namespace App\Controllers;

class Bayer extends BaseController
{
    // public function __construct()
    // {
    //     helper('m_helper');
    //     $uri = service('uri');
    //     if (!isset(roleAkses(session()->get('iduser'), $uri->getSegment(1))->lihat) == '1') {
    //         throw new \CodeIgniter\Router\Exceptions\RedirectException('/');
    //     }
    // }


    public function index()
    {
        return view('bayer/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_bayer->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->bayer;
                $datas['id'] = $rows->idbayer;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_bayer->count_all(),
            "recordsFiltered" => $this->m_bayer->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        return view('bayer/tambah');
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['bayer'] = $this->m_bayer->get_by_id($id)->getResult();
        return view('bayer/edit', $data);
    }
    public function simpan()
    {

        $idbayer         = $this->request->getPost('idbayer');
        $bayer         = $this->request->getPost('bayer');
        $ltambah        = $this->request->getPost('ltambah');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $data = array(
                'idbayer'     => $idbayer,
                'bayer'     => $bayer,
            );
            $simpan = $this->m_bayer->simpan($data);
        } else { // ini kondisi jika edit data


            $data = array(
                'bayer'     => $bayer,
            );

            $simpan = $this->m_bayer->updateWhere($data, $idbayer);
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
        return redirect()->to('bayer');
    }

    public function delete($id)
    {


        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => 'admin'
        );

        $simpan = $this->m_bayer->updateWhere($data, $id);


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
        return redirect()->to('bayer');
    }
}
