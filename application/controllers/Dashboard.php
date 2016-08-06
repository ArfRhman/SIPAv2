<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function main(){
		parent::__construct();

	}

	// menampilkan halaman awal untuk progress paket 
	public function index(){
		$id = $this->session->userdata("ID_JURUSAN");
		$tahun = date('Y');
		$data['final']=$this->m_usulan->getUsulanFinal($id,$tahun);
		$this->load->view('top');
		$this->load->view("index",$data);
		$this->load->view('bottom');

	}
	
}
