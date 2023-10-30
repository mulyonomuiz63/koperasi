<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        return view('login/index');
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
                if ($kirim->getNumRows() > 0) {

                    return redirect()->to('/');
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
}
