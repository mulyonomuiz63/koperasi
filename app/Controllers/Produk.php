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
                $row[] = $rows->pengepul;
                $row[] = $rows->produk;
                $row[] = $rows->komoditi;
                $row[] = $rows->qty;
                $row[] = number_format($rows->harga, 0, ',', '.');
                $row[] =  $status;
                $datas['id'] = $rows->idproduk;
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
        return view('produk/tambah', $data);
    }
    public function edit($encode)
    {
        $id = decode($encode);
        $data['pengepul'] = $this->m_produk->get_pengepul()->getRow();
        $data['komoditi'] = $this->m_produk->get_komoditi()->getResult();
        $data['produk'] = $this->m_produk->get_by_id($id)->getRow();
        $data['kualitas'] = $this->m_produk->get_kualitas()->getResult();
        $data['kualitasAll'] = $this->m_produk->get_kualitasAll()->getResult();
        return view('produk/edit', $data);
    }
    public function simpan()
    {
        $idproduk       = $this->request->getPost('idproduk');
        $idpengepul       = $this->request->getPost('idpengepul');
        $produk         = $this->request->getPost('produk');
        $idkomoditi     = $this->request->getPost('idkomoditi');
        $qty            = $this->request->getPost('qty');
        $harga          = str_replace(".", "", $this->request->getPost('harga'));
        $status         = 'N';


        $ltambah        = $this->request->getPost('ltambah');

        if ($ltambah == 'tambah') { // ini kondisi jika tambah data 


            $data = array(
                'idkomoditi'     => $idkomoditi,
                'idpengepul'     =>  $idpengepul,
                'produk'         => $produk,
                'status'         => $status,
                'qty'            => $qty,
                'harga'          => $harga,
            );

            $simpan = $this->m_produk->simpan($data, $this->request);
        } else { // ini kondisi jika edit data


            $data = array(
                'idkomoditi'     => $idkomoditi,
                'idpengepul'     =>  $idpengepul,
                'produk'         => $produk,
                'status'         => $status,
                'qty'            => $qty,
                'harga'          => $harga,
            );
            $simpan = $this->m_produk->updateWhere($data, $idproduk, $this->request);
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

    public function deleteKualitas()
    {
        $id =  $this->request->getPost('id');
        $builder = $this->db->table('kualitas');

        $builder->where('idkualitas', $id);

        if ($builder->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
