<?php

namespace App\Controllers;

class Produk extends BaseController
{
    public function index(): string
    {
        return view('produk/index');
    }

    public function datatablesource()
    {
        $RsData = $this->m_produk->get_datatables();
        $no = $this->request->getPost('start');
        $data = array();

        if ($RsData->getNumRows() > 0) {
            foreach ($RsData->getResult() as $rows) {
                if ($rows->status == "N") {
                    $status = '<span class="badge bg-warning">Menunggu verifikasi produk</span>';
                } elseif ($rows->status == 'V') {
                    $status = '<span class="badge bg-warning">Menunggu verifikasi produk</span>';
                } elseif ($rows->status == 'T') {
                    $status = '<span class="badge bg-danger">Pengajuan produk ditolak</span>';
                } elseif ($rows->status == 'B') {
                    $status = '<span class="badge bg-success">Produk Aktif/span>';
                } else {
                    $status = '<span class="badge bg-danger">Produk Tidak Aktif/span>';
                }
                $no++;
                $row = array();
                $row[] = $rows->produk;
                $row[] = $rows->komoditi;
                $row[] = $rows->qty;
                $row[] = $rows->harga;
                $row[] =  $status;
                $row[] =
                    '<a href="' . site_url('produk/edit/' . ($rows->idproduk)) . '" class="btn btn-sm btn-warning btn-circle" data-toggle="tooltip" data-placement="left" title="Ubah data produk">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                            <a href="' . site_url('produk/delete/' . ($rows->idproduk)) . '" class="btn btn-sm btn-danger btn-circle" id="hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                            </a>';
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
        $data['komoditi'] = $this->m_produk->get_Komoditi()->getResult();
        return view('produk/tambah', $data);
    }
    public function edit($id)
    {
        $data['komoditi'] = $this->m_produk->get_Komoditi()->getResult();
        $data['produk'] = $this->m_produk->get_by_id($id)->getRow();
        return view('produk/edit', $data);
    }
    public function simpan()
    {
        $idproduk         = $this->request->getPost('idproduk');
        $produk         = $this->request->getPost('produk');
        $idkomoditi         = $this->request->getPost('idkomoditi');
        $qty         = $this->request->getPost('qty');
        $harga         = $this->request->getPost('harga');
        $status         = 'N';


        $ltambah        = $this->request->getPost('ltambah');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $data = array(
                'idkomoditi'     => $idkomoditi,
                'idpengepul'     => '1',
                'produk'         => $produk,
                'status'         => $status,
                'qty'            => $qty,
                'harga'          => $harga,
            );
            $simpan = $this->m_produk->simpan($data);
        } else { // ini kondisi jika edit data


            $data = array(
                'idkomoditi'     => $idkomoditi,
                'idpengepul'     => '1',
                'produk'         => $produk,
                'status'         => $status,
                'qty'            => $qty,
                'harga'          => $harga,
            );
            $simpan = $this->m_produk->updateWhere($data, $idproduk);
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
        return redirect()->to('produk');
    }

    public function delete($id)
    {


        $data = array(
            'deleted_at'     => date('Y-m-d H:i:s'),
            'deleted_by'     => 'admin'
        );

        $simpan = $this->m_produk->updateWhere($data, $id);


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

    function get_geotag($tmp)
    {
        $data = @exif_read_data($tmp, 0, true);

        if ((isset($data['GPS']) and is_array($data['GPS'])) and (isset($data['GPS']['GPSLatitudeRef']))) {
            $lat_ref = $data['GPS']['GPSLatitudeRef'];
            $lat = $data['GPS']['GPSLatitude'];
            list($num, $dec) = explode('/', $lat[0]);
            $lat_s = $num / $dec;
            list($num, $dec) = explode('/', $lat[1]);
            $lat_m = $num / $dec;
            list($num, $dec) = explode('/', $lat[2]);
            $lat_v = $num / $dec;

            $lng_ref = $data['GPS']['GPSLongitudeRef'];
            $lng = $data['GPS']['GPSLongitude'];
            list($num, $dec) = explode('/', $lng[0]);
            $lng_s = $num / $dec;
            list($num, $dec) = explode('/', $lng[1]);
            $lng_m = $num / $dec;
            list($num, $dec) = explode('/', $lng[2]);
            $lng_v = $num / $dec;

            $lat_int = ($lat_s + $lat_m / 60.0 + $lat_v / 3600.0);
            $lat_int = ($lat_ref == 'S') ? '-' . $lat_int : $lat_int;

            $lng_int = ($lng_s + $lng_m / 60.0 + $lng_v / 3600.0);
            $lng_int = ($lng_ref == 'W') ? '-' . $lng_int : $lng_int;

            return array('lat' => $lat_int, 'lng' => $lng_int);
        } else {
            return array('lat' => 0, 'lng' => 0);
        }
    }
}
