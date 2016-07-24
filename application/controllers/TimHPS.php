<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimHPS extends CI_Controller {

	public function timHps(){
		parent::__construct();
		$this->load->model("m_timHps");
		$this->load->model("m_pegawai");
		$this->load->model("m_user");
	}

	// menampilkan halaman awal tim HPS
	public function index(){
		$this->load->view('top');	
		$data['tim']=$this->m_timHps->getAllTimHps();
		$data['pegawai']=$this->m_pegawai->getAllPegawai();
		$this->load->view("timHPS/timHps_view",$data);
		$this->load->view('bottom');
	}

	// menampilkan form untuk tambah data tim HPS
	public function add(){
		$this->load->view('top');
		$this->load->view("timHPS/timHps_add",$data);
		$this->load->view('bottom');
	}

	// menyimpan data tim HPS yang dimasukkan
	public function create(){
		$p=$this->input->post();
		$id=$this->m_user->saveUserFromTim($p);
		$p['id']=$id;
		$idt = $this->m_timHps->saveTimHps($p);
		$exp = explode(',', $p['anggota']);
		$jml = count($exp);
		for($i=0; $i < $jml; $i++) { 
			$this->m_timHps->saveAnggotaTimHps($exp[$i],$idt);
		}
		
	}

}

?>