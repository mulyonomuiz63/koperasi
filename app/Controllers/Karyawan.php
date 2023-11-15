<?php

namespace App\Controllers;

class Karyawan extends BaseController
{
    public function index(): string
    {
        return view('karyawan/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_karyawan->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $no++;
                $row = array();
                $row[] = $rows->nama;
                $row[] = $rows->email;
                $row[] = $rows->hp;
                $row[] = $rows->jabatan;
                $datas['id'] = $rows->idkaryawan;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_karyawan->count_all(),
            "recordsFiltered" => $this->m_karyawan->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        $data['provinsi'] = $this->m_karyawan->get_provinsi()->getResult();
        return view('karyawan/tambah', $data);
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['karyawan'] = $this->m_karyawan->get_by_id($id)->getRow();
        $data['provinsi'] = $this->m_karyawan->get_provinsi()->getResult();
        return view('karyawan/edit', $data);
    }
    public function simpan()
    {

        $ltambah        = $this->request->getPost('ltambah');
        $idkaryawan     = $this->request->getPost('idkaryawan');
        $idkelurahan    = $this->request->getPost('idkelurahan');
        $nama           = $this->request->getPost('nama');
        $tempat_lahir   = $this->request->getPost('tempat_lahir');
        $tgl_lahir      = $this->request->getPost();
        $jk             = $this->request->getPost('jk');
        $agama          = $this->request->getPost('agama');
        $norek          = $this->request->getPost('norek');
        $nama_bank      = $this->request->getPost('nama_bank');
        $nik            = $this->request->getPost('nik');
        $foto           = $this->request->getFile('foto');
        $fotolama       = $this->request->getPost('fotolama');
        $jabatan        = $this->request->getPost('jabatan');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $image = $foto->getRandomName();
            $thumbnail_path = FCPATH . 'uploads/karyawan/thumbnails';
            $path = FCPATH . 'uploads/karyawan';
            if ($foto->move($path, $image)) {
                // resizing image
                $this->image->withFile($path . '/' . $image)
                    ->resize(480, 480, true)
                    ->save($thumbnail_path . '/' . $image);

                if (file_exists('./uploads/karyawan/' . $image)) {
                    unlink('./uploads/karyawan/' . $image);
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
                'foto'              => $image,
                'jabatan'           => $jabatan,
            );
            $simpan = $this->m_karyawan->simpan($data);
        } else { // ini kondisi jika edit data

            // // thumnail foto_ktp path
            $image = $foto->getRandomName();
            $thumbnail_path = FCPATH . 'uploads/karyawan/thumbnails';
            $path = FCPATH . 'uploads/karyawan';

            if ($foto->isValid()) {
                if ($foto->move($path, $image)) {
                    // resizing image
                    $this->image->withFile($path . '/' . $image)
                        ->resize(480, 480, true)
                        ->save($thumbnail_path . '/' . $image);

                    if (file_exists('./uploads/karyawan/' . $image)) {
                        unlink('./uploads/karyawan/' . $image);
                    };
                    //untukmenghapus gambar di direktori gambar ketika gambar di update
                    if (file_exists('./uploads/karyawan/thumbnails/' . $fotolama)) {
                        unlink('./uploads/karyawan/thumbnails/' . $fotolama);
                    };
                }
                $linkfile = $image;
            } else {
                $linkfile = $fotolama;
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
                'foto'              => $linkfile,
                'jabatan'          => $jabatan,
            );
            $simpan = $this->m_karyawan->updateWhere($data, $idkaryawan);
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
			                <strong>Gagal!</strong> Data gagal diubah! <br>
			                Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '
					    </div>
					</div>';
        }

        $this->session->setFlashdata('pesan', $pesan);
        return redirect()->to('karyawan');
    }

    public function delete($id)
    {


        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => 'admin'
        );

        $simpan = $this->m_karyawan->updateWhere($data, $id);


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
        return redirect()->to('karyawan');
    }

    function add_ajax_kota($id)
    {
        $query = $this->m_karyawan->kota($id);
        $data = "<option value=''> Pilih </option>";
        foreach ($query->getResult() as $value) {
            $data .= "<option value='" . $value->idkota . "'>" . $value->kota . "</option>";
        }
        echo $data;
    }
    function add_ajax_kecamatan($id)
    {
        $query = $this->m_karyawan->kecamatan($id);
        $data = "<option value=''> Pilih </option>";
        foreach ($query->getResult() as $value) {
            $data .= "<option value='" . $value->idkecamatan . "'>" . $value->kecamatan . "</option>";
        }
        echo $data;
    }
    function add_ajax_kelurahan($id)
    {
        $query = $this->m_karyawan->kelurahan($id);
        $data = "<option value=''> Pilih </option>";
        foreach ($query->getResult() as $value) {
            $data .= "<option value='" . $value->idkelurahan . "'>" . $value->kelurahan . "</option>";
        }
        echo $data;
    }
}
