<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	// untuk inisiasi object2 yang akan digunakan dalam class ini
	public function site(){
		parent::__construct();
		$this->load->model('m_site');
		$this->load->model('m_usulan');
	}

	// untuk menampilkan halaman paling awal aplikasi yaitu halaman login
	public function index(){
		$this->load->view('site/login');
	}

	// untuk melakukan pengecekan dan pembagian hak akses untuk user yang login
	public function login(){
		$username = $this->input->post('user-name');
		$password = md5($this->input->post('pass-word'));
		$cek = $this->m_site->Auth($username,$password); // mengecek username dan password ke databse. 
		if($cek){
			$cek['PROGRESS_USULAN']=$this->m_usulan->getProgressUsulanByUserJurusan($cek['ID_USER']);
			// $cek['PROGRESS_PAKET']=$this->m_progress->getProgressUsulanByUserJurusan($cek['ID_JURUSAN'],$cek['ID_JENIS_USER']);
			$this->session->set_userdata($cek); // set session dengan data user
			
			$id_jenis = $this->session->userdata('ID_JENIS_USER');
			if($id_jenis == 3){
				redirect(base_url().'Dashboard');
			}elseif($id_jenis==1 || $id_jenis==2){
				redirect(base_url().'Usulan');
			}elseif($id_jenis == 4){
				redirect(base_url().'Pagu');
			}elseif($id_jenis == 5){
				redirect(base_url().'Paket');
			}elseif($id_jenis == 6){
				redirect(base_url().'HPS');
			}elseif($id_jenis == 7){
				redirect(base_url().'Lelang');
			}elseif($id_jenis == 8){
				redirect(base_url().'BeritaAcara');
			}elseif($id_jenis == 9){
				redirect(base_url().'SPM');
			}elseif($id_jenis == 10){
				redirect(base_url().'Performa');
			}elseif($id_jenis == 11){
				redirect(base_url().'TimHPS');
			}
		}else{
			$this->session->set_flashdata('data', '1');
			redirect(site_url());
		}
			// echo $this->session->userdata('USERNAME');
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}
	
}
