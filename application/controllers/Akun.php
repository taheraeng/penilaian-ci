<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Akun extends CI_Controller{

	public function index(){
		redirect('akun/login');
	}
 
	public function login()
    {
    	$session = $this->session->userdata('isLogin'); //mengabil dari session apakah sudah login atau belum

        if($session == FALSE) {

	        $userid = $this->input->post("userid");
	        $password = md5($this->input->post("pass"));
	        $cek = $this->m_login->cek_user($userid,$password); //melakukan persamaan data dengan database
	        if(count($cek) == 1){ //cek data berdasarkan username & pass
                $this->load->model('user_model', 'um');

	            foreach ($cek as $cek) {
	                $level = $cek['level']; //mengambil data(level/hak akses) dari database
	            }

	            $userData = $this->um->getUserInfo($userid);

	            $this->session->set_userdata(array(
	                'isLogin'   => TRUE, //set data telah login
	                'userid'  => $userid, //set session userid
	                //'lvl'      => $level, //set session hak akses
                    'idscreen' => $userData->idscreen,
                    'email' => $userData->email,
                    'active' => $userData->active
					
	            ));

	         	$stat = $this->session->userdata('lvl');
	         	if($stat>2){
	            //redirect('depan','refresh');

                    if ($this->um->isUserActive($this->session->userdata('idscreen'))) {
                        redirect('depan','refresh');
                    } else {
                        $this->session->set_flashdata('flash_message', 'Ini adalah login pertama, untuk keamanan silahkan reset password Anda');
                        redirect('akun/reset');
                    }
	        	}else{
	        	//redirect('depan','refresh');

                    if ($this->um->isUserActive($this->session->userdata('idscreen'))) {
                        redirect('depan','refresh');
                    } else {
                        $this->session->set_flashdata('flash_message', 'Ini adalah login pertama, untuk keamanan silahkan reset password Anda');
                        redirect('akun/reset');
                    }
	        	}
	        }

	        else{ //jika data tidak ada yng sama dengan database
                $this->session->set_flashdata('flash_message', 'Gagal Login, periksa kembali userid atau password anda!');
	            redirect('depan','refresh');
	        }
	   	}else{
	       redirect('depan');
    	}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('depan','refresh');
		
	}

    public function reset()
    {
        if ($this->input->post()) {
            $newPassword = $this->input->post('new_password');
            $confirmPassword = $this->input->post('confirm_password');

            if ($newPassword == $confirmPassword) {
                /*$config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.mailgun.org',
                    'smtp_port' => '465',
                    'smtp_user' => 'postmaster@sandbox36724.mailgun.org',
                    'smtp_pass' => 'redbuzz12345',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'smtp_timeout' => '30'
                );*/

                //$this->load->library('email', $config);
                $this->load->model('user_model', 'um');

                $token = $this->um->insertToken($this->session->userdata('idscreen'), md5($newPassword));

                $qstring = $this->base64url_encode($token);
                $url = base_url() . 'akun/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '" target="_blank">' . $url . '</a>';

                $to = $this->session->userdata('email');
                $subject = "Reset Password BlackInnovation 2016";
                $from = "no-replay@blackxperience.com";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From:" . $from . "\r\n";
                $message = '';
                $message .= '<div style="padding: 10px;background-color: black;display: inline-block"><img src="https://blackinnovation.blackxperience.com/assets/image/biv-logo.png" style="width: 100px"></div><br><br>';
                $message .= '<p>A password reset has been requested for this email account</p><br>';
                $message .= '<p><strong>To confirmation, please click:</strong><br>' . $link . '</p>';
                $message .= '<br><br><p>Best Regards</p>';
                $message .= '<p>blackinnovation.blackxperience.com</p>';

                //mail($to, $subject, $message, $headers);

//var_dump(mail($to, $subject, $message, $headers));exit();

                                if(mail($to, $subject, $message, $headers)) {

                                $this->session->set_flashdata('flash_message', 'Silahkan cek email Anda untuk konfirmasi reset password');
                            } else {
                                $this->session->set_flashdata('flash_message', 'Terjadi kesalahan, silahkan ulangi beberapa saat lagi');
                            }

                // send email
                //$this->email->from($from);
                //$this->email->to($to);
                //$this->email->subject($subject);
                //$this->email->message($message);

                //$this->email->send();

                //$this->session->set_flashdata('flash_message', 'Silahkan cek email Anda untuk konfirmasi reset password');

                $data['flash'] = $this->session->flashdata('flash_message');
                $data=array(
                    'user'=> $this->m_login->ambil_user($this->session->userdata('userid')),
                    'jumlahiot'=> $this->m_login->jumlahiot(),
                    'jumlahiotgb'=> $this->m_login->jumlahiotgb(),
                    'jumlahpd'=> $this->m_login->jumlahpd(),
                    'jumlahiotpd'=> $this->m_login->jumlahiotpd(),
                    'jumlahall'=> $this->m_login->jumlahall()
                );

                $this->session->sess_destroy();
                $this->load->view('home/reset',$data);

                /*if(mail($to, $subject, $message, $headers)) {
                    $this->session->set_flashdata('flash_message', 'Silahkan cek email Anda untuk konfirmasi reset password');
                    redirect('/judging/login');
                } elseif ($this->email->send()) {
                    $this->session->set_flashdata('flash_message', 'Silahkan cek email Anda untuk konfirmasi reset password');
                    redirect('/judging/login');
                } else {
                    $data['flash'] = 'Terjadi kesalahan, sistem tidak bisa kirim email';
                    $this->twig->display('reset.html', $data);
                }*/
            } else {
                redirect('depan');
            }
        } else {
            $data['flash'] = $this->session->flashdata('flash_message');
            $data=array(
                'user'=> $this->m_login->ambil_user($this->session->userdata('userid')),
                'jumlahiot'=> $this->m_login->jumlahiot(),
                'jumlahiotgb'=> $this->m_login->jumlahiotgb(),
                'jumlahpd'=> $this->m_login->jumlahpd(),
                'jumlahiotpd'=> $this->m_login->jumlahiotpd(),
                'jumlahall'=> $this->m_login->jumlahall()
            );

            $this->load->view('home/reset',$data);
        }
    }

    public function reset_password($tkn)
    {
        $this->load->model('user_model', 'um');

        $token = $this->base64url_decode($tkn);
        $cleanToken = $this->security->xss_clean($token);

//var_dump($token);

        if (!$this->um->isTokenValid($cleanToken)) {
            $this->session->set_flashdata('flash_message', 'Token tidak valid');
        } else {
            $userInfo = $this->um->isTokenValid($token);
            $tokenOnly = rtrim($token, $userInfo->idscreen);
            $tempPassword = $this->um->getTemporaryPassword($userInfo->idscreen, $tokenOnly);

            $data = array(
                'user_id' => $userInfo->idscreen,
                'password' => $tempPassword->temporary_password
            );

            if ($this->um->updatePassword($data)) {
                $this->session->set_flashdata('flash_message', 'Password Anda sudah terupdate. Sekarang silahkan login');
            } else {
                $this->session->set_flashdata('flash_message', 'Terjadi kesalahan saat update password');
            }
        }

        redirect('depan');
    }

    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}