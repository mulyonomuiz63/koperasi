<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Libraries\Googlemaps;

class Petani extends BaseController
{

    public function props($idkeltani = null)
    {
        if ($idkeltani != null) {
            $data = array(
                'idkeltani' => $idkeltani,
            );
            $this->session->set($data);
            return redirect()->to('petani');
        }

        return redirect()->to('kelompok-tani');
    }
    public function index(): string
    {
        return view('admin/petani/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_petani->get_datatables();
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                $row = array();
                $row[] = $rows->nama;
                $row[] = $rows->nama_kelompok;
                $row[] = $rows->komoditi;
                $row[] = $rows->luas;
                $row[] = $rows->sertifikasi != '0' ?  '<span class="badge bg-success text-white">Ter-Sertifikasi</span>' : '<span class="badge bg-danger text-white">Tidak-Sertifikasi</span>';
                $datas['id'] = $rows->idtani;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_petani->count_all(),
            "recordsFiltered" => $this->m_petani->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        $data['provinsi'] = $this->m_petani->get_provinsi()->getResult();
        $data['komoditi'] = $this->m_petani->get_komoditi()->getResult();
        return view('admin/petani/tambah', $data);
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['petani'] = $this->m_petani->get_by_id($id)->getRow();
        $petani = $data['petani'];
        $googlemaps = new  Googlemaps();
        $config['center'] = "$petani->latitude, $petani->longitude";
        // -4.367409887099134, 104.35817017311595
        $config['zoom'] = 15;
        $googlemaps->initialize($config);
        // foreach ($petani as $rows) {
        $marker = array();
        $marker['position'] = "$petani->latitude, $petani->longitude";
        $marker['animation'] = "DROP";
        $marker['icon'] = base_url('assets/icon/icon.png');
        $marker['icon_scaledSize'] = '52,52';
        $marker['infowindow_content'] = '<div class="media" style="width:250px;">';
        $marker['infowindow_content'] .= '<div class="media-body">';
        $marker['infowindow_content'] .= '<h5>Nama Pemilik Lahan : ' . $petani->nama . '</h5>';
        $marker['infowindow_content'] .= '<p>No Telpon :' . $petani->nohp . '</p>';
        $marker['infowindow_content'] .= '<p>Luas Tanah : ' . $petani->luas . '</p>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';
        $googlemaps->add_marker($marker);
        // }
        $data['map'] = $googlemaps->create_map();
        $data['komoditi'] = $this->m_petani->get_komoditi()->getResult();
        $data['provinsi'] = $this->m_petani->get_provinsi()->getResult();
        return view('admin/petani/edit', $data);
    }
    public function simpan()
    {

        $ltambah            = $this->request->getPost('ltambah');
        $idtani             = $this->request->getPost('idtani');
        $idkelurahan        = $this->request->getPost('idkelurahan');
        $idkomoditi         = $this->request->getPost('idkomoditi');
        $nama               = $this->request->getPost('nama');
        $jk                 = $this->request->getPost('jk');
        $agama              = $this->request->getPost('agama');
        $nohp               = $this->request->getPost('nohp');
        $luas               = $this->request->getPost('luas');
        $lokasi_gambar      = $this->request->getFile('lokasi_gambar');
        $lokasi_gambar_lama = $this->request->getPost('lokasi_gambar_lama');
        $sertifikasi        = $this->request->getPost('sertifikasi');
        $sertifikasi_gambar = $this->request->getFile('sertifikasi_gambar');
        $sertifikasi_gambar_lama = $this->request->getPost('sertifikasi_gambar_lama');
        $lats = $this->request->getPost('lat');
        $longs = $this->request->getPost('long');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 
            if (get_geotag($lokasi_gambar)['lat'] != '0' || get_geotag($lokasi_gambar)['lng'] != '0') {
                $lat = get_geotag($lokasi_gambar)['lat'];
                $long = get_geotag($lokasi_gambar)['lng'];
                $lok_gambar = $lokasi_gambar->getRandomName();
                $thumbnail_path = FCPATH . 'uploads/lokasi/thumbnails';
                $path = FCPATH . 'uploads/lokasi';
                if ($lokasi_gambar->move($path, $lok_gambar)) {
                    // resizing image
                    $this->image->withFile($path . '/' . $lok_gambar)
                        ->resize(480, 480, true)
                        ->save($thumbnail_path . '/' . $lok_gambar);

                    if ($lok_gambar != '') {
                        if (file_exists('./uploads/lokasi/' . $lok_gambar)) {
                            unlink('./uploads/lokasi/' . $lok_gambar);
                        };
                    }
                }

                if ($sertifikasi == '1') {
                    if ($sertifikasi_gambar->isValid()) {
                        $sert_gambar = $sertifikasi_gambar->getRandomName();
                        $thumbnail_path = FCPATH . 'uploads/sertifikasi/thumbnails';
                        $path = FCPATH . 'uploads/sertifikasi';
                        if ($sertifikasi_gambar->move($path, $sert_gambar)) {
                            // resizing image
                            $this->image->withFile($path . '/' . $sert_gambar)
                                ->resize(480, 480, true)
                                ->save($thumbnail_path . '/' . $sert_gambar);

                            if ($sert_gambar != '') {
                                if (file_exists('./uploads/sertifikasi/' . $sert_gambar)) {
                                    unlink('./uploads/sertifikasi/' . $sert_gambar);
                                };
                            }
                        }
                    } else {
                        $sert_gambar = '';
                    }
                } else {
                    $sert_gambar = '';
                }
                $data = array(
                    'idkeltani'          => session()->get('idkeltani'),
                    'idkelurahan'        => $idkelurahan,
                    'idkomoditi'         => $idkomoditi,
                    'nama'               => $nama,
                    'jk'                 => $jk,
                    'agama'              => $agama,
                    'nohp'               => $nohp,
                    'luas'               => $luas,
                    'lokasi_gambar'      => $lok_gambar,
                    'latitude'           => $lat,
                    'longitude'          => $long,
                    'sertifikasi'        => $sertifikasi,
                    'sertifikasi_gambar' => $sert_gambar,

                );
                $simpan = $this->m_petani->simpan($data);
            } else {
                $pesan = '<div>
        				<div class="alert alert-danger alert-dismissable">
        	                <strong>Gagal!</strong> Data gagal disimpan karna foto lokasi tidak ada geotagging! <br>
        			    </div>
        			</div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('petani');
            }
        } else { // ini kondisi jika edit data


            if ($lokasi_gambar->isValid()) {
                if (get_geotag($lokasi_gambar)['lat'] != '0' || get_geotag($lokasi_gambar)['lng'] != '0') {
                    $lat = get_geotag($lokasi_gambar)['lat'];
                    $long = get_geotag($lokasi_gambar)['lng'];
                    $lok_gambar = $lokasi_gambar->getRandomName();
                    $thumbnail_path = FCPATH . 'uploads/lokasi/thumbnails';
                    $path = FCPATH . 'uploads/lokasi';
                    if ($lokasi_gambar->move($path, $lok_gambar)) {
                        // resizing image
                        $this->image->withFile($path . '/' . $lok_gambar)
                            ->resize(480, 480, true)
                            ->save($thumbnail_path . '/' . $lok_gambar);

                        if ($lok_gambar != '') {
                            if (file_exists('./uploads/lokasi/' . $lok_gambar)) {
                                unlink('./uploads/lokasi/' . $lok_gambar);
                            };
                        }
                        //untukmenghapus gambar di direktori gambar ketika gambar di update
                        if ($lokasi_gambar_lama != '') {
                            if (file_exists('./uploads/lokasi/thumbnails/' . $lokasi_gambar_lama)) {
                                unlink('./uploads/lokasi/thumbnails/' . $lokasi_gambar_lama);
                            };
                        }
                    }
                } else {
                    $lok_gambar = $lokasi_gambar_lama;
                    $lat = $lats;
                    $long = $longs;
                }
            } else {
                $lok_gambar = $lokasi_gambar_lama;
                $lat = $lats;
                $long = $longs;
            }
            if ($sertifikasi == '1') {
                if ($sertifikasi_gambar->isValid()) {
                    $sert_gambar = $sertifikasi_gambar->getRandomName();
                    $thumbnail_path = FCPATH . 'uploads/sertifikasi/thumbnails';
                    $path = FCPATH . 'uploads/sertifikasi';
                    if ($sertifikasi_gambar->move($path, $sert_gambar)) {
                        // resizing image
                        $this->image->withFile($path . '/' . $sert_gambar)
                            ->resize(480, 480, true)
                            ->save($thumbnail_path . '/' . $sert_gambar);

                        if ($sert_gambar != '') {
                            if (file_exists('./uploads/sertifikasi/' . $sert_gambar)) {
                                unlink('./uploads/sertifikasi/' . $sert_gambar);
                            };
                        }
                        //untukmenghapus gambar di direktori gambar ketika gambar di update
                        if ($sertifikasi_gambar_lama != '') {
                            if (file_exists('./uploads/sertifikasi/thumbnails/' . $sertifikasi_gambar_lama)) {
                                unlink('./uploads/sertifikasi/thumbnails/' . $sertifikasi_gambar_lama);
                            };
                        }
                    }
                } else {
                    $sert_gambar = $sertifikasi_gambar_lama;
                }
            } else {
                $sert_gambar = $sertifikasi_gambar_lama;
            }

            $data = array(
                'idkeltani'          => session()->get('idkeltani'),
                'idkelurahan'        => $idkelurahan,
                'idkomoditi'         => $idkomoditi,
                'nama'               => $nama,
                'jk'                 => $jk,
                'agama'              => $agama,
                'nohp'               => $nohp,
                'luas'               => $luas,
                'lokasi_gambar'      => $lok_gambar,
                'latitude'           => $lat,
                'longitude'          => $long,
                'sertifikasi'        => $sertifikasi,
                'sertifikasi_gambar' => $sert_gambar,

            );
            $simpan = $this->m_petani->updateWhere($data, $idtani);
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
        return redirect()->to('petani');
    }

    public function delete($encode)
    {
        $id = decode($encode);

        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => session()->get('nama')
        );

        $simpan = $this->m_petani->updateWhere($data, $id);


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
        return redirect()->to('petani');
    }

    function add_ajax_kota($id)
    {
        $query = $this->m_petani->kota($id);
        $data = "<option value=''> Pilih </option>";
        foreach ($query->getResult() as $value) {
            $data .= "<option value='" . $value->idkota . "'>" . $value->kota . "</option>";
        }
        echo $data;
    }
    function add_ajax_kecamatan($id)
    {
        $query = $this->m_petani->kecamatan($id);
        $data = "<option value=''> Pilih </option>";
        foreach ($query->getResult() as $value) {
            $data .= "<option value='" . $value->idkecamatan . "'>" . $value->kecamatan . "</option>";
        }
        echo $data;
    }
    function add_ajax_kelurahan($id)
    {
        $query = $this->m_petani->kelurahan($id);
        $data = "<option value=''> Pilih </option>";
        foreach ($query->getResult() as $value) {
            $data .= "<option value='" . $value->idkelurahan . "'>" . $value->kelurahan . "</option>";
        }
        echo $data;
    }

    function cekLokasi()
    {
        $lokasi_gambar      = $this->request->getFile('lokasi_gambar');

        if (get_geotag($lokasi_gambar)['lat'] != '0' || get_geotag($lokasi_gambar)['lng'] != '0') {
            $data['success'] = 1;
        } else {
            $data['success'] = 0;
        }
        return $this->response->setJSON($data);
    }
}
