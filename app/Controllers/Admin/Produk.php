<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Produk extends BaseController
{
    public function index(): string
    {
        return view('admin/produk/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_produk->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                if ($rows->status == "N1") {
                    $status = '<span class="badge bg-warning">Produk menunggu perhitungan kualitas</span>';
                } elseif ($rows->status == "N") {
                    $status = '<span class="badge bg-warning">Menunggu verifikasi produk</span>';
                } elseif ($rows->status == 'V') {
                    $status = '<span class="badge bg-primary">Produk telah diverifikasi</span>';
                } elseif ($rows->status == 'T') {
                    $status = '<span class="badge bg-danger">Pengajuan produk ditolak</span>';
                } elseif ($rows->status == 'B') {
                    $status = '<span class="badge bg-success">Produk Sudah Terjual</span>';
                } else {
                    $status = '<span class="badge bg-danger">Produk Tidak Aktif</span>';
                }
                $no++;
                $row = array();
                $row[] = $rows->pengepul;
                $row[] = $rows->produk;
                $row[] = $rows->komoditi;
                $row[] = $rows->qty;
                $row[] = number_format($rows->harga_final, 0, ',', '.');
                $row[] = number_format($rows->qty * $rows->harga_final, 0, ',', '.');
                $row[] =  $status;
                $datas['id'] = $rows->idproduk;
                $datas['status'] = $rows->status;
                $row[] = view('tools/tombolMulti', $datas);
                $data[] = $row;
            }
        }

        $output = array(
            // "draw" => $this->request->getPost('draw'),
            "recordsTotal" => $this->m_produk->count_all(),
            "recordsFiltered" => $this->m_produk->count_filtered(),
            "data" => $data,
        );

        //output to json format
        // echo json_encode($output);
        return $this->response->setJSON($output);
    }

    public function tambah()
    {
        $data['pengepul'] = $this->m_produk->get_pengepul()->getRow();
        $data['komoditi'] = $this->m_produk->get_komoditi()->getResult();
        $data['kualitas'] = $this->m_produk->get_kualitas()->getResult();
        return view('admin/produk/tambah', $data);
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['pengepul'] = $this->m_produk->get_pengepul()->getRow();
        $data['komoditi'] = $this->m_produk->get_komoditi()->getResult();
        $data['produk'] = $this->m_produk->get_by_id($id)->getRow();
        $data['kualitas'] = $this->m_produk->get_kualitas()->getResult();
        $data['kualitasAll'] = $this->m_produk->get_kualitasAll($id)->getResult();
        return view('admin/produk/edit', $data);
    }
    public function simpan()
    {
        $idproduk       = $this->request->getPost('idproduk');
        $idpengepul       = $this->request->getPost('idpengepul');
        $produk         = $this->request->getPost('produk');
        $idkomoditi     = $this->request->getPost('idkomoditi');
        $qty            = $this->request->getPost('qty');
        $harga          = str_replace(".", "", $this->request->getPost('harga'));
        $harga_final    =  $this->request->getPost('harga_final');
        $status         = 'N1';
        $ltambah        = $this->request->getPost('ltambah');

        $gambar_produk = $this->request->getFile('gambar_produk');
        $gambar_produk_lama = $this->request->getPost('gambar_produk_lama');




        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 

            $nama_gambar = $gambar_produk->getRandomName();
            $thumbnail_path = FCPATH . 'uploads/produk/thumbnails';
            $path = FCPATH . 'uploads/produk';
            if ($gambar_produk->move($path, $nama_gambar)) {
                // resizing image
                $this->image->withFile($path . '/' . $nama_gambar)
                    ->resize(
                        480,
                        480,
                        true
                    )
                    ->save($thumbnail_path . '/' . $nama_gambar);

                if (file_exists('./uploads/produk/' . $nama_gambar)) {
                    unlink('./uploads/produk/' . $nama_gambar);
                };
            }

            $data = array(
                'idkomoditi'     => $idkomoditi,
                'idpengepul'     =>  $idpengepul,
                'produk'         => $produk,
                'status'         => $status,
                'qty'            => $qty,
                'harga'          => $harga,
                'gambar_produk'  => $nama_gambar,
            );

            $simpan = $this->m_produk->simpan($data, $this->request);
            if (!$simpan) {
                $eror = $this->db->error();
                $pesan = '<div>
                            <div class="alert alert-danger alert-dismissable">
                                <strong>Gagal!</strong> Data gagal disimpan! <br>
                                Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '
                            </div>
                        </div>';
            } else {
                $pesan = '<div>
						<div class="alert alert-success alert-dismissable">
			                <strong>Berhasil.</strong> Data telah disimpan
					    </div>
					</div>';
            }

            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('produk/edit/' . encode($simpan));
        } else { // ini kondisi jika edit data
            if ($gambar_produk->isValid()) {
                $nama_gambar = $gambar_produk->getRandomName();
                $thumbnail_path = FCPATH . 'uploads/produk/thumbnails';
                $path = FCPATH . 'uploads/produk';
                if ($gambar_produk->move($path, $nama_gambar)) {
                    // resizing image
                    $this->image->withFile($path . '/' . $nama_gambar)
                        ->resize(480, 480, true)
                        ->save($thumbnail_path . '/' . $nama_gambar);

                    if (file_exists('./uploads/produk/' . $nama_gambar)) {
                        unlink('./uploads/produk/' . $nama_gambar);
                    };
                    //untukmenghapus gambar di direktori gambar ketika gambar di update
                    if ($gambar_produk_lama != '') {
                        if (file_exists('./uploads/produk/thumbnails/' . $gambar_produk_lama)) {
                            unlink('./uploads/produk/thumbnails/' . $gambar_produk_lama);
                        };
                    }
                }
            } else {
                $nama_gambar = $gambar_produk_lama;
            }

            $data = array(
                'idkomoditi'     => $idkomoditi,
                'idpengepul'     =>  $idpengepul,
                'produk'         => $produk,
                'status'         => 'N',
                'qty'            => $qty,
                'harga'          => $harga,
                'harga_final'    => $harga_final,
                'gambar_produk'  => $nama_gambar,
            );
            $simpan = $this->m_produk->updateWhere($data, $idproduk);
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
            return redirect()->to('produk/edit/' . encode($idproduk));
        }
    }

    public function simpanKualitas()
    {
        $idproduk       = $this->request->getPost('idproduk');
        $idqreport      = $this->request->getPost('idqreport');
        $kualitas       = $this->request->getPost('kualitas');
        $total          = $this->request->getPost('total');
        $pembulat1      = $this->request->getPost('pembulat1');
        $pembulat2      = $this->request->getPost('pembulat2');
        $penjumlah1     = $this->request->getPost('penjumlah1');
        $penjumlah2     = $this->request->getPost('penjumlah2');



        $data = array(
            'idproduk'          => $idproduk,
            'idqreport'         =>  $idqreport,
            'persen'            => $kualitas,
            'nilai_pembulat'    => "($kualitas $penjumlah1 $pembulat1) $penjumlah2 $pembulat2",
            'total'             => $total,
        );

        $simpan = $this->m_produk->simpanKualitas($data);
        if (!$simpan) {
            $eror = $this->db->error();
            $pesan = '<div>
                            <div class="alert alert-danger alert-dismissable">
                                <strong>Gagal!</strong> Data gagal disimpan! <br>
                                Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '
                            </div>
                        </div>';
        } else {
            $pesan = '<div>
						<div class="alert alert-success alert-dismissable">
			                <strong>Berhasil.</strong> Data telah disimpan
					    </div>
					</div>';
        }

        $this->session->setFlashdata('pesan', $pesan);
        return redirect()->to('produk/edit/' . encode($idproduk));
    }

    public function delete($encode)
    {

        $id = decode($encode);
        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => 'admin'
        );

        $simpan = $this->m_produk->hapus($data, $id);


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
        return redirect()->to('produk');
    }

    public function deleteKualitas()
    {
        $encode =  $this->request->getPost('id');

        $id = ($encode);
        $builder = $this->db->table('kualitas');

        $builder->where('idkualitas', $id);

        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function aprove()
    {

        $id     =  $this->request->getPost('idproduk');
        $total  =  $this->request->getPost('randemen');

        $harga  = str_replace(".", "", $this->request->getPost('harga'));
        $harga_final = ($harga * (100 - $total)) / 100;
        $data = array(
            'status'        => $this->request->getPost('aprove'),
            'harga'         => $harga,
            'harga_final'   => $harga_final,
        );

        $simpan = $this->m_produk->aprove($data, $id);


        if ($simpan) {
            $pesan = '<div>
						<div class="alert alert-success alert-dismissable">
			                <strong>Berhasil.</strong> Data telah diapproved
					    </div>
					</div>';
        } else {
            $eror = $this->db->error();
            $pesan = '<div>
						<div class="alert alert-danger alert-dismissable">
			                <strong>Gagal!</strong> Data gagal diaprove! <br>
			                Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '
					    </div>
					</div>';
        }

        $this->session->setFlashdata('pesan', $pesan);
        return redirect()->to('produk');
    }

    public function aproveBuktiTransfer()
    {

        $bukti_transfer = $this->request->getFile('bukti_transfer');
        $id = ($this->request->getPost('idproduk'));
        $bukti_gambar = $bukti_transfer->getRandomName();
        $thumbnail_path = FCPATH . 'uploads/buktiTransfer/thumbnails';
        $path = FCPATH . 'uploads/buktiTransfer';
        if ($bukti_transfer->move($path, $bukti_gambar)) {
            // resizing image
            $this->image->withFile($path . '/' . $bukti_gambar)
                ->resize(480, 480, true)
                ->save($thumbnail_path . '/' . $bukti_gambar);

            if (file_exists('./uploads/buktiTransfer/' . $bukti_gambar)) {
                unlink('./uploads/buktiTransfer/' . $bukti_gambar);
            };
        }
        $data = array(
            'status'     => 'B',
            'bukti_transfer'     => $bukti_gambar,
        );
        $simpan = $this->m_produk->aprove($data, $id);


        if ($simpan) {
            $pesan = '<div>
						<div class="alert alert-success alert-dismissable">
			                <strong>Berhasil.</strong> Upload bukti transfer berhasil
					    </div>
					</div>';
        } else {
            $eror = $this->db->error();
            $pesan = '<div>
						<div class="alert alert-danger alert-dismissable">
			                <strong>Gagal!</strong>Upload bukti transfer gagal <br>
			                Pesan Error : ' . $eror['code'] . ' ' . $eror['message'] . '
					    </div>
					</div>';
        }

        $this->session->setFlashdata('pesan', $pesan);
        return redirect()->to('produk');
    }
}
