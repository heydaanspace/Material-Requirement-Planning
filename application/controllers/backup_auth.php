<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Auth_model');
		$this->load->helper('captcha');
		$this->load->library('Crud_library');
	}

	public function index()
	{

		

		$site = $this->Konfigurasi_model->listing();
		$data = array(
			'title'     => 'Login | '.$site['website_name'],
			'favicon'   => $site['favicon'],
			'site'      => $site
		);
		
		$captcha['showcaptcha'] = $this->create_captcha();
		$greeting['salam'] = $this->greeting();
		$fuldata = $data + $greeting + $captcha;
		$this->template->load('authentication/layout/template', 'authentication/login', $fuldata);


	}


	public function greeting() 
	{
		$time = date("H");
		//date_default_timezone_set("Asia/Bangkok");
		//$timezone = date_default_timezone_get();
		if ($time >= "00" && $time <= "10") {
			return "Good morning";
		} elseif ($time > "10" && $time <= "18") {
			return "Good afternoon";
		} elseif ($time > "18" && $time < "24") {
			return "Good evening";
		} 
	}

	public function create_captcha()
	{
		$config = array(
			'word'          => 'heydaans',
			'img_path'      => 'assets/img/captcha/',
			'img_url'       => base_url().'assets/img/captcha/',
			'img_width'     => '200',
			'img_height'    => 40,
			'word_length'   => 3,
			'font_size'     => 18
		);
		$captcha = create_captcha($config);

        //Reset captcha
		$this->session->unset_userdata('captchaCode');
		$this->session->set_userdata('captchaCode', $captcha['word']);

        // Pass captcha image to view
		$datacap = $captcha['image'];
		return $datacap;
	}


	public function check_account()
	{
		//validasi login
		
		$email      = $this->input->post('email');
		$password   = $this->input->post('password');

		// echo var_dump($contain_captcha);

		//ambil data dari database untuk validasi login
		$query = $this->Auth_model->check_account($email, $password);
		$captcha_insert     = $this->input->post('icaptcha');
		$contain_captcha    = $this->create_captcha($this->session->userdata('captchaCode'));

		if ($query === 1){
			$this->session->set_flashdata('msg', show_err_msg('Email yang anda masukan tidak terdaftar.'));
		} elseif ($query === 3) {
			$this->session->set_flashdata('msg', show_err_msg('Password yang anda masukan salah.'));

		} else {
			//membuat session dengan nama userData yang artinya nanti data ini bisa di ambil sesuai dengan data yang login
			$userdata = array(
				'is_login'    => true,
				'user_id'     => $query->user_id,
				'password'    => $query->password,
				'id_role'     => $query->id_role,
				'username'    => $query->username,
				'fullname'    => $query->fullname,
				'email'       => $query->email,
				'no_telp'     => $query->no_telp,
				'foto'        => $query->foto,
				'created_date'=> $query->created_date,
				'last_login'  => $query->last_login
			);
			$this->session->set_userdata($userdata);
			return true;
		}
	}

	public function login()
	{
		//melakukan pengalihan halaman sesuai dengan levelnya

		
		if ($this->session->userdata('id_role') == "1") {
			redirect('production/home');
		}
		if ($this->session->userdata('id_role') == "2") {
			redirect('owner/home');
		}

		//proses login dan validasi nya
		if ($this->input->post('submit')) {
			$captcha_insert     = $this->input->post('icaptcha');
			$contain_captcha    = $this->create_captcha($this->session->userdata('captchaCode'));

			

			$error        = $this->check_account();
			$loginval     = $this->crud_library;
			$validation   = $this->form_validation;
			$validation->set_rules($loginval->loginvalidation());

			if ($validation->run()) {
				if ($error === true) {
					$data = $this->Auth_model->check_account($this->input->post('email'), $this->input->post('password'));
					if ($data->id_role == '1') {
						redirect('production/home');
					} elseif ($data->id_role == '2') {
						redirect('owner/home');
					}

				} else {
					redirect('auth');
				}

			} else {
				$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
				redirect('auth');
			}

		} else {
			
			redirect('auth');
		}

	}
	public function logout()
	{
		date_default_timezone_set('ASIA/JAKARTA');
		$date = array('last_login' => date('Y-m-d H:i:s'));
		$id = $this->session->userdata('user_id');
		$this->Auth_model->logout($date, $id);
		$user_data = $this->session->userdata();
		foreach ($user_data as $key => $value) {
			if ($key!='__ci_last_regenerate' && $key != '__ci_vars')
				$this->session->unset_userdata($key);
		}

		redirect('auth/login');
	}

}
