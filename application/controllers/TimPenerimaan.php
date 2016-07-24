<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimPenerimaan extends CI_Controller {

	public function timPenerimaan(){
		parent::__construct();
		$this->load->model("m_timPenerimaan");
		$this->load->model("m_pegawai");
		$this->load->model("m_user");
	}

	// menampilkan halaman awal tim penerima
	public function index(){
		$this->load->view('top');
		$data['tim']=$this->m_timPenerimaan->getAllTimPenerimaan();
		$data['pegawai']=$this->m_pegawai->getAllTeknisi();
		$this->load->view("timPenerimaan/timPenerimaan_view",$data);
		$this->load->view('bottom');
	}

	// menampilkan form untuk tambah data tim penerima
	public function Add(){
		$this->load->view('top');
		$data['paket']='';
		$this->load->view("timPenerimaan/add",$data);
		$this->load->view('bottom');
	}

	// menyimpan data tim penerimaan yang dimasukkan
	public function create(){
		$p=$this->input->post();
		$id=$this->m_user->saveUserFromTimPenerima($p);
		$p['id']=$id;
		$idt = $this->m_timPenerimaan->saveTimPenerimaan($p);
		$exp = explode(',', $p['anggota']);
		$jml = count($exp);
		for($i=0; $i < $jml; $i++) { 
			$this->m_timPenerimaan->saveAnggotaTimPenerima($exp[$i],$idt);
		}
	}

}

?>