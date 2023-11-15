<?php

namespace App\Controllers;

class Pengepul extends BaseController
{
    public function index(): string
    {
        return view('pengepul/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_pengepul->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->nama;
                $row[] = $rows->email;
                $row[] = $rows->hp;
                $datas['id'] = $rows->idpengepul;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_pengepul->count_all(),
            "recordsFiltered" => $this->m_pengepul->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        $data['provinsi'] = $this->m_pengepul->get_provinsi()->getResult();
        return view('pengepul/tambah', $data);
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['pengepul'] = $this->m_pengepul->get_by_id($id)->getRow();
        $data['provinsi'] = $this->m_pengepul->get_provinsi()->getResult();
        return view('pengepul/edit', $data);
    }
    public function simpan()
    {

        $ltambah        = $this->request->getPost('ltambah');
        $idpengepul         = $this->request->getPost('idpengepul');
        $iduser    = $this->request->getPost('iduser');
        $idkelurahan    = $this->request->getPost('idkelurahan');
        $nama         = $this->request->getPost('nama');
        $tempat_lahir         = $this->request->getPost('tempat_lahir');
        $tgl_lahir         = $this->request->getPost();
        $jk         = $this->request->getPost('jk');
        $agama         = $this->request->getPost('agama');
        $norek         = $this->request->getPost('norek');
        $nama_bank         = $this->request->getPost('nama_bank');
        $nik         = $this->request->getPost('nik');
        $fotoktp         = $this->request->getFile('foto_ktp');
        $fotoktplama         = $this->request->getPost('foto_ktp_lama');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $image = $fotoktp->getRandomName();
            // thumnail foto_ktp path
            // $tmp = $fotoktp->getTempName();
            // $get = get_geotag($tmp);
            // $data = exif_read_data($tmp, 0, false);
            // $lat = $get['lat'];
            // $lng = $get['lng'];
            // var_dump($data);

            $thumbnail_path = FCPATH . 'uploads/pengepul/thumbnails';
            $path = FCPATH . 'uploads/pengepul';

            if ($fotoktp->move($path, $image)) {
                // resizing image
                $this->image->withFile($path . '/' . $image)
                    ->resize(480, 480, true)
                    ->save($thumbnail_path . '/' . $image);

                if (file_exists('./uploads/pengepul/' . $image)) {
                    unlink('./uploads/pengepul/' . $image);
                };
            }
            $data = array(
                'iduser'            => session()->get('iduser'),
                'idkelurahan'       => $idkelurahan,
                'nama'              => $nama,
                'tempat_lahir'      => $tempat_lahir,
                'tgl_lahir'         => date('Y-m-d', strtotime($tgl_lahir['tgl_lahir'])),
                'jk'                => $jk,
                'agama'             => $agama,
                'norek'             => $norek,
                'nama_bank'         => $nama_bank,
                'nik'               => $nik,
                'foto'              => '',
                'foto_ktp'          => $image,
            );
            $simpan = $this->m_pengepul->simpan($data);
        } else { // ini kondisi jika edit data

            // // thumnail foto_ktp path
            $image = $fotoktp->getRandomName();
            $thumbnail_path = FCPATH . 'uploads/pengepul/thumbnails';
            $path = FCPATH . 'uploads/pengepul';

            if ($fotoktp->isValid()) {
                if ($fotoktp->move($path, $image)) {
                    // resizing image
                    $this->image->withFile($path . '/' . $image)
                        ->resize(480, 480, true)
                        ->save($thumbnail_path . '/' . $image);

                    if (file_exists('./uploads/pengepul/' . $image)) {
                        unlink('./uploads/pengepul/' . $image);
                    };
                    //untukmenghapus gambar di direktori gambar ketika gambar di update
                    if (file_exists('./uploads/pengepul/thumbnails/' . $fotoktplama)) {
                        unlink('./uploads/pengepul/thumbnails/' . $fotoktplama);
                    };
                }
                $linkfile = $image;
            } else {
                $linkfile = $fotoktplama;
            }
            $data = array(
                'iduser'            => session()->get('iduser'),
                'idkelurahan'       => $idkelurahan,
                'nama'              => $nama,
                'tempat_lahir'      => $tempat_lahir,
                'tgl_lahir'         => date('Y-m-d', strtotime($tgl_lahir['tgl_lahir'])),
                'jk'                => $jk,
                'agama'             => $agama,
                'norek'             => $norek,
                'nama_bank'         => $nama_bank,
                'nik'               => $nik,
                'foto'              => '',
                'foto_ktp'          => $linkfile,
            );
            $simpan = $this->m_pengepul->updateWhere($data, $idpengepul);
        }

        if ($simpan) {
            $pesan = '<div>
						<div class="alert alert-success alert-dismissable">
			                <strong>Berhasil.</strong> Ubah data telah disimpan
					    </div>
					</div>';
        } else {
            $eror = $this->db->error();
            $pesan = '<div>
						<div class="alert alert-danger alert-dismissable">
			                <strong>Gagal!</strong> Data gagal diubah! <br>
			                Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '
					    </div>
					</div>';
        }

        $this->session->setFlashdata('pesan', $pesan);
        return redirect()->to('pengepul');
    }

    public function delete($id)
    {


        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => 'admin'
        );

        $simpan = $this->m_pengepul->updateWhere($data, $id);


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
        return redirect()->to('pengepul');
    }

    function add_ajax_kota($id)
    {
        $query = $this->m_pengepul->kota($id);
        $data = "<option value=''> Pilih </option>";
        foreach ($query->getResult() as $value) {
            $data .= "<option value='" . $value->idkota . "'>" . $value->kota . "</option>";
        }
        echo $data;
    }
    function add_ajax_kecamatan($id)
    {
        $query = $this->m_pengepul->kecamatan($id);
        $data = "<option value=''> Pilih </option>";
        foreach ($query->getResult() as $value) {
            $data .= "<option value='" . $value->idkecamatan . "'>" . $value->kecamatan . "</option>";
        }
        echo $data;
    }
    function add_ajax_kelurahan($id)
    {
        $query = $this->m_pengepul->kelurahan($id);
        $data = "<option value=''> Pilih </option>";
        foreach ($query->getResult() as $value) {
            $data .= "<option value='" . $value->idkelurahan . "'>" . $value->kelurahan . "</option>";
        }
        echo $data;
    }
}
