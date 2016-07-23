<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimPenerimaan extends CI_Controller {

	public function timPenerimaan(){
		parent::__construct();
		$this->load->model("m_timPenerimaan");
		$this->load->model("m_pegawai");
		$this->load->model("m_user");
	}

	public function index(){
		$this->load->view('top');
		// $data['tim']=$this->m_timPenerimaan->getAllTimPenerimaan();
		// $data['pegawai']=$this->m_pegawai->getAllTeknisi();
		$this->load->view("timPenerimaan/timPenerimaan_view");
		$this->load->view('bottom');
	}

	public function Add(){
		$this->load->view('top');
		$data['paket']='';
		$this->load->view("timPenerimaan/add",$data);
		$this->load->view('bottom');
	}

	public function saveTimPenerimaan(){
		$p=$this->input->post();
		$id=$this->m_user->saveUserFromTimPenerima($p);
		$p['id']=$id;
		$this->m_timPenerimaan->saveTimPenerimaan($p);
	}

}

?>