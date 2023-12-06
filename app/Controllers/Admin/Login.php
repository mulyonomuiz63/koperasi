<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Login extends BaseController
{


    public function index(): string
    {
        return view('admin/login/sigin');
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
    public function registrasi()
    {
        return view('admin/login/registrasi');
    }
    public function simpanRegistrasi()
    {
        $nama           = $this->request->getPost('nama');
        $email          = $this->request->getPost('email');
        $hp             = $this->request->getPost('hp');
        $password         = md5($this->request->getPost('password'));
        $cpassword         = md5($this->request->getPost('cpassword'));
        $privasi        = $this->request->getPost('privasi');


        if ($password != $cpassword) {
            $pesan = '<div class="alert alert-danger">Ulangi Password tidak sama</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('registrasi');
            exit();
        }

        $cekid = $this->m_login->cek_email($email);
        if ($cekid->getNumRows() > 0) {
            if ($cekid->getRow()->verifikasi_email == '1') {
                $pesan = '<div class="alert alert-danger">Email sudah terdaftar</div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('registrasi');
                exit();
            } else {
                $pesan = '<div class="alert alert-danger">Email sudah terdaftar & belum diaktivasi</div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('registrasi');
                exit();
            }
        } else {

            $lkirimemail = $this->m_login->kirimemail($email, $nama);
            var_dump($lkirimemail);
            // if ($lkirimemail) {

            //     $data = array(
            //         'nama' => $nama,
            //         'email' => $email,
            //         'hp' => $hp,
            //         'password' => $password,
            //         'privasi' => $privasi,
            //     );

            //     $simpan = $this->m_login->simpanregistrasi($data);
            //     if ($simpan) {
            //         $pesan = '<div class="alert alert-success">Buka email anda untuk aktivasi. <br>Atau Cek folder <b>SPAM</b></div>';
            //         $this->session->setFlashdata('pesan', $pesan);
            //         return redirect()->to('login');
            //         exit();
            //     } else {

            //         $eror = $this->db->error();
            //         $pesan = '<div class="alert alert-danger">Gagal registrasi<br>
            // 		                Alasan : ' . $eror['code'] . ' ' . $eror['message'] . '
            // 		          </div>';
            //         $this->session->setFlashdata('pesan', $pesan);
            //         return redirect()->to('registrasi');
            //         exit();
            //     }
            // } else {
            //     $pesan = '<div class="alert alert-danger">Gagal kirim email aktivasi.</div>';
            //     $this->session->setFlashdata('pesan', $pesan);
            //     return redirect()->to('registrasi');
            //     exit();
            // }
        }
    }




    public function verifikasi($email)
    {
        $data = array(
            'verifikasi_email' => '1'
        );


        $cekverif = $this->db->query("select count(*) as jlh from users where email='" . $email . "' and verifikasi_email='1'")->getRow()->jlh;
        if ($cekverif > 0) {
            $pesan = '<div class="alert alert-danger">Email sudah di aktivasi.</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('login');
            exit();
        }

        $update = $this->m_login->verifikasi_email($email, $data);
        if ($update) {
            $pesan = '<div class="alert alert-success">Berhasil di aktivasi</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('login');
        } else {
            $pesan = '<div class="alert alert-danger">Gagal di aktivasi</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('login');
        }
    }

    public function lupapassword()
    {
        return view('admin/login/lupapassword');
    }
    public function kirimresetpassword()
    {

        $email = $this->request->getPost('email');
        $from_email = 'no-replay@akuntanmu.com';
        $from_nama = 'AKUNTANMU';
        $passwordemail = 'Akuntanmu123@#';
        $password_reset = $this->generateRandomString(10);
        $lkirimemail = $this->m_login->kirimresetpassword($from_email, $from_nama, $passwordemail, $email, $password_reset);

        if ($lkirimemail) {
            $data = array(
                'password' => md5($password_reset),
            );

            $simpan = $this->m_login->simpanresetpassword($data, $email);
            if ($simpan) {
                $pesan = '<div class="alert alert-success">Reset password dikirim ke email <br>Atau Cek folder <b>SPAM</b>
		       			</div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('login');
                exit();
            } else {
                $pesan = 'error';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('login/lupapassword');
                exit();
            }
        } else {
            $pesan = '<div class="alert alert-danger">Gagal reset password.</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('login/lupapassword');
            exit();
        }
    }

    public function keluar()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
