<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimHPS extends CI_Controller {

	public function timHps(){
		parent::__construct();
		$this->load->model("m_timHps");
		$this->load->model("m_pegawai");
		$this->load->model("m_user");
	}

	public function index(){
		$this->load->view('top');	
		// $data['tim']=$this->m_timHps->getAllTimHps();
		// $data['pegawai']=$this->m_pegawai->getAllPegawai();
		$this->load->view("timHPS/timHps_view");
		$this->load->view('bottom');
	}

	public function Add(){
		$this->load->view('top');
		$this->load->view("timHPS/timHps_add",$data);
		$this->load->view('bottom');
	}

	public function saveTimHps(){
		$p=$this->input->post();
		$id=$this->m_user->saveUserFromTim($p);
		$p['id']=$id;
		$this->m_timHps->saveTimHps($p);
	}

}

?>