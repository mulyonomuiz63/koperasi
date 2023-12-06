<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Login extends BaseController
{


    public function index(): string
    {
        return view('admin/login/index');
    }



    public function cek_login()
    {
        $string = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));
        $result = "$string";
        $email = preg_replace("/[^a-zA-Z0-9_.@]/", "", $result);
        $row =  preg_match('/\A[a-z0-9__.@]+\z/i', $string);
        if ($row != '0') {
            if (empty($email) and empty($password)) {
                $pesan = '<div class="alert alert-danger">email atau password anda salah </div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('login');
            } else {
                $kirim = $this->m_login->cek_login($email, md5($password));
                $result = $kirim->getRow();
                if ($kirim->getNumRows() > 0) {
                    $data = array(
                        'iduser' => $result->iduser,
                        'nama' => $result->nama,
                        'email' => $result->email,
                        'idrole' => $result->idrole,
                        'isLoggedIn' => TRUE
                    );

                    $this->session->set($data);
                    return redirect()->to('dashboard');
                } else {
                    $pesan = '<div class="alert alert-danger">email atau password anda salah </div>';
                    $this->session->setFlashdata('pesan', $pesan);
                    return redirect()->to('login');
                }
            }
        } else {
            $pesan = '<div class="alert alert-danger">email atau password anda salah </div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('login');
        }
    }

    public function simpanregistrasi()
    {
        $namaperusahaan    = $this->request->getPost('namaperusahaan');
        $tglmulaiusaha    = date('Y-m-d', strtotime($this->request->getPost('tglmulaiusaha')));
        $email            = $this->request->getPost('email');
        $string           = $this->request->getPost('username');
        $password         = md5($this->request->getPost('password'));
        $password2         = md5($this->request->getPost('password2'));
        $tglregistrasi    = date('Y-m-d H:i:s');
        // $tglberakhir    = date('Y-m-d H:i:s', strtotime('+90 days', strtotime($tglregistrasi)));
        $tglberakhir    = null;
        $encrypted_id     = md5(trim($email));
        $kode_referal    = $this->request->getPost('kode_referal');


        $result = "$string";
        $username = preg_replace("/[^a-zA-Z0-9_.@]/", "", $result);

        if ($password != $password2) {
            $pesan = '<div class="alert alert-danger">Ulangi Password tidak sama</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('Login/registrasi');
            exit();
        }



        $cekid = $this->login_model->cek_email($email);
        if ($cekid->getNumRows() > 0) {
            if ($cekid->getRow()->statusverif == 1) {
                $pesan = '<div class="alert alert-danger">Email sudah terdaftar</div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('Login/registrasi');
                exit();
            } else {
                $pesan = '<div class="alert alert-danger">Email sudah terdaftar & belum diaktivasi</div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('Login/registrasi');
                exit();
            }
        } else {

            //kirim aktivasi
            $from_email = 'no-replay@akuntanmu.com';
            $from_nama = 'AKUNTANMU';
            $passwordemail = 'Akuntanmu123@#';

            $lkirimemail = $this->login_model->kirimemail($from_email, $from_nama, $passwordemail, $email, $namaperusahaan, $encrypted_id, $kode_referal);
            // echo($namaperusahaan);
            // exit();

            if ($lkirimemail) {
                $idperusahaan = $this->db->query("SELECT create_idperusahaan('" . $tglregistrasi . "') as idperusahaan")->getRow()->idperusahaan;

                $data = array(
                    'idperusahaan' => $idperusahaan,
                    'namaperusahaan' => $namaperusahaan,
                    'tglmulaiusaha' => $tglmulaiusaha,
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                    'tglregistrasi' => $tglregistrasi,
                    'tglberakhir' => $tglberakhir,
                    'statusaktif' => '1',
                    'encryptkey' => $encrypted_id,
                    'statusverif' => '0',
                    'kode_referal' => $kode_referal == '' ? null : $kode_referal,
                );

                $simpan = $this->login_model->simpanregistrasi($data);
                if ($simpan) {
                    $pesan = '<div class="alert alert-success">Buka email anda untuk aktivasi. <br>Atau Cek folder <b>SPAM</b></div>';
                    $this->session->setFlashdata('pesan', $pesan);
                    return redirect()->to('Login');
                    exit();
                } else {

                    $eror = $this->db->error();
                    $pesan = '<div class="alert alert-danger">Gagal registrasi<br>
					                Alasan : ' . $eror['code'] . ' ' . $eror['message'] . '
					          </div>';
                    $this->session->setFlashdata('pesan', $pesan);
                    return redirect()->to('Login/registrasi');
                    exit();
                }
            } else {
                $pesan = '<div class="alert alert-danger">Gagal kirim email aktivasi.</div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('Login/registrasi');
                exit();
            }
        }
    }


    public function verifikasi($hash = NULL, $kode_referal = null)
    {
        $data = array(
            'statusverif' => '1'
        );


        $cekverif = $this->db->query("select count(*) as jlh from perusahaan where encryptkey='" . $hash . "' and statusverif='1'")->getRow()->jlh;
        if ($cekverif > 0) {
            $pesan = '<div class="alert alert-danger">Email sudah di aktivasi.</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('Login');
            exit();
        }

        $update = $this->login_model->verifikasi_email($hash, $data, $kode_referal);
        if ($update > 0) {
            $pesan = '<div class="alert alert-success">Berhasil di aktivasi</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('Login');
        } else {
            $pesan = '<div class="alert alert-danger">Gagal di aktivasi</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('Login');
        }
    }

    public function kirimresetpassword()
    {

        $email = $this->request->getPost('email');
        $from_email = 'no-replay@akuntanmu.com';
        $from_nama = 'AKUNTANMU';
        $passwordemail = 'Akuntanmu123@#';
        $password_reset = $this->generateRandomString(10);
        $lkirimemail = $this->login_model->kirimresetpassword($from_email, $from_nama, $passwordemail, $email, $password_reset);

        if ($lkirimemail) {
            $data = array(
                'password' => md5($password_reset),
            );

            $simpan = $this->login_model->simpanresetpassword($data, $email);
            if ($simpan) {
                $pesan = '<div class="alert alert-success">Reset password dikirim ke email <br>Atau Cek folder <b>SPAM</b>
		       			</div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('Login');
                exit();
            } else {
                $pesan = 'error';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('Login/lupapassword');
                exit();
            }
        } else {
            $pesan = '<div class="alert alert-danger">Gagal reset password.</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('Login/lupapassword');
            exit();
        }
    }

    public function keluar()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
