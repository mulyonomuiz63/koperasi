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
                    if ($result->verifikasi_email == '1') {
                        if ($result->status == '1') {
                            $data = array(
                                'iduser' => $result->iduser,
                                'nama' => $result->nama,
                                'email' => $result->email,
                                'idrole' => $result->idrole,
                                'isLoggedIn' => TRUE,
                                'status' => $result->status
                            );

                            $this->session->set($data);
                            return redirect()->to('dashboard');
                        } else {
                            $data = array(
                                'iduser' => $result->iduser,
                                'nama' => $result->nama,
                                'email' => $result->email,
                                'idrole' => $result->idrole,
                                'isLoggedIn' => TRUE,
                                'status' => $result->status
                            );

                            $this->session->set($data);
                            return redirect()->to('pengepul/edit/' . encode(session()->get('iduser')));
                        }
                    } else {
                        $pesan = '<div class="alert alert-danger">Lakukan verifikasi email anda! </div>';
                        $this->session->setFlashdata('pesan', $pesan);
                        return redirect()->to('login');
                    }
                } else {
                    $pesan = '<div class="alert alert-danger">Akun belum terdaftar atau salah memasukan email atau password </div>';
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



            $data = array(
                'idrole' => 3,
                'nama' => $nama,
                'email' => $email,
                'hp' => $hp,
                'verifikasi_email' => '0',
                'password' => $password,
                'privasi' => $privasi,
            );

            $simpan = $this->m_login->simpanregistrasi($data, $nama, $email);

            if ($simpan) {
                $pesan = '<div class="alert alert-success">Buka email anda untuk aktivasi. <br>Atau Cek folder <b>SPAM</b></div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('login');
                exit();
            } else {

                $eror = $this->db->error();
                $pesan = '<div class="alert alert-danger">Gagal registrasi<br>
            		                Alasan : ' . $eror['code'] . ' ' . $eror['message'] . '
            		          </div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('registrasi');
                exit();
            }
        }
    }




    public function verifikasi($id)
    {
        $iduser = decode($id);
        $data = array(
            'verifikasi_email' => '1'
        );


        $cekverif = $this->db->query("select count(*) as jlh from users where iduser='" . $iduser . "' and verifikasi_email='1'")->getRow()->jlh;
        if ($cekverif > 0) {
            $pesan = '<div class="alert alert-success">Email sudah di aktivasi.</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('login');
            exit();
        }

        $update = $this->m_login->verifikasi_email($iduser, $data);
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
    public function resetPassword()
    {

        $email = $this->request->getPost('email');
        $password_new = '#KmpSMART18';

        $data = array(
            'password' => md5($password_new),
        );
        $user = $this->db->table('users')->getWhere(array('email' => $email))->getRow();
        if (isset($user)) {

            $textemail = '				
        			<span>Anda baru saja mereset password? <br>
        			Silahkan login dengan password baru anda: </span><br><br>

        			<div style="width: 100%;">
        				<div style="background-color: #24ca4b; width: 300px; height: 50px; font-size: 35px; text-align:center; color: white">' . $password_new . '</div>			
        			</div><br><br>

        			<div style="width: 100%; font-size: 14px;">
        				<b>Best Regards,</b> 
        				<div style="width: 100%; font-size: 14px;"> 
        				TEAM KMPSMART.CO.ID
        				<br>JL. PURNAWIRAWAN GG SWADAYA 9 GUNUNGTERANG, LANGKAPURA KOTA BANDAR LAMPUNG LAMPUNG</div>
        				</div>
        			</div>			
        	  		';

            $this->email->setTo($email);
            $this->email->setSubject("Reset sandi user");
            $this->email->setMessage($textemail);


            if ($this->email->send()) {
                $simpan = $this->m_login->simpanresetpassword($data, $email, $password_new);
                if ($simpan) {
                    $pesan = '<div class="alert alert-success">Reset sandi berhasil dikirim ke email <br>Atau Cek folder <b>SPAM</b>
                   			</div>';
                    $this->session->setFlashdata('pesan', $pesan);
                    return redirect()->to('login');
                    exit();
                } else {
                    $pesan = '<div class="alert alert-danger">Reset sandi gagalcoba lagi
                   			</div>';
                    $this->session->setFlashdata('pesan', $pesan);
                    return redirect()->to('lupapassword');
                    exit();
                }
            } else {
                $pesan = '<div class="alert alert-danger">Reset sandi gagalcoba lagi
                   			</div>';
                $this->session->setFlashdata('pesan', $pesan);
                return redirect()->to('lupapassword');
                exit();
            }
        } else {
            $pesan = '<div class="alert alert-danger">email yang dimasukan tidak ditemukan
                   			</div>';
            $this->session->setFlashdata('pesan', $pesan);
            return redirect()->to('lupapassword');
            exit();
        }
    }

    public function keluar()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
