<?php

namespace App\Models;

use CodeIgniter\Model;

class M_login extends Model
{

    public function cek_login($username, $password)
    {
        $query = "select * from user where (email='" . $username . "' and password='" . $password . "') or (email='" . $username . "' and password='" . $password . "')";
        return $this->db->query($query);
    }

    public function cek_email($email)
    {
        $builder = $this->db->table('users');
        return $builder->getWhere(array('email' => $email));
    }


    public function simpanregistrasi($data)
    {
        $builder = $this->db->table('re_user');
        return $builder->insert($data);
    }

    public function kirimemail($email, $nama)
    {
        $conEmail = \Config\Services::email();
        $textemail = '				
					<div style="font-weight: bold; font-size: 16px;">' . $nama . '</div><br>
					<span>Terima kasih sudah mendaftar pada layanan kami
					<br>Silahkan aktivasi akun anda dibawah ini.</span><br><br>
					
					<div style="width: 100%;">
						<button style="background-color: #24ca4b; width: 300px; height: 50px; color: white"><a href="' . site_url("login/verifikasi/" . $email) . '" style="color: white; text-decoration: none">AKTIVASI AKUN</a></button>			
					</div><br><br>

					<div style="width: 100%; font-size: 14px;">
						<b>Best Regards,</b> <div style="width: 100%; font-size: 14px;">
						TEAM kmpsmart.co.id
						<br>JL. PURNAWIRAWAN GG SWADAYA 9 GUNUNGTERANG, LANGKAPURA KOTA BANDAR LAMPUNG LAMPUNG
						<br>Telepon: +62 878-9948-4098</div>
					</div>			
			  		';




        //memanggil library email dan set konfigurasi untuk pengiriman email

        //konfigurasi pengiriman
        $conEmail->setFrom('no-replay@kmpsmart.co.id', 'KMP Smart');
        $conEmail->setTo($email);
        $conEmail->setSubject("Verifikasi Email");
        $conEmail->setMessage($textemail);

        return $conEmail->send();
    }

    public function verifikasi_email($email, $data)
    {
        $this->db->transBegin();

        $builder = $this->db->table('re_user');
        $builder->where('email', $email);
        $builder->update($data);

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }


    public function kirimresetpassword($from_email, $from_nama, $passwordemail, $email, $password_reset)
    {
        /**
				Untuk mengaktifkan email google
				https://myaccount.google.com/lesssecureapps?pli=1
				Allow less secure apps: ON
         **/

        $textemail = '				
					<span>Anda baru saja mereset password? <br>
					Silahkan login dengan password baru anda: </span><br><br>
					
					<div style="width: 100%;">
						<div style="background-color: #24ca4b; width: 300px; height: 50px; font-size: 35px; text-align:center; color: white">' . $password_reset . '</div>			
					</div><br><br>

					<div style="width: 100%; font-size: 14px;">
						<b>Best Regards,</b> 
						<div style="width: 100%; font-size: 14px;"> 
						TEAM AKUNTANMU.COM
						<br>Menara Samawa No 1106 - Jakarta Timur
						<br>Telepon: 021-86941220 / 081380935185</div>
						</div>
					</div>			
			  		';

        $config = array();
        $config['protocol'] = "smtp";
        $config['mailType'] = "html";
        $config['SMTPHost'] = "mail.akuntanmu.com";
        $config['SMTPPort'] = "465";
        $config['SMTPTimeout'] = "5";
        $config['SMTPUser'] = $from_email;
        $config['SMTPPass'] = $passwordemail;
        $config['SMTPCrypto'] = 'ssl';
        $config['CRLF'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['wordWrap'] = TRUE;

        //memanggil library email dan set konfigurasi untuk pengiriman email
        $this->email->initialize($config);

        //$datatemplate['namaperusahaan'] = $namaperusahaan;
        //$templateemail = $this->load->view('isiemailverifikasi', $datatemplate);

        //konfigurasi pengiriman
        $this->email->setFrom($from_email, $from_nama);
        $this->email->setTo($email);
        $this->email->setSubject("Reset Password Akun");
        $this->email->setMessage($textemail);

        return $this->email->send();
    }

    public function simpanresetpassword($data, $email)
    {
        $builder = $this->db->table('user');
        $builder->where('email', $email);
        return $builder->update($data);
    }
}


/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */