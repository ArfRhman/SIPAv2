<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {

	public function paket(){
		parent::__construct();
		$this->load->model("m_paket");
		$this->load->model("m_kategori");
		$this->load->model("m_alat");
		$this->load->model("m_timHps");
		$this->load->model("m_progress");

	}
	// menampilkan halaman awal pengelompokan paket usulan
	public function index(){
		 $this->load->view('top');
		 $tahun=date("Y");
		 $data['kategori']=$this->m_paket->getAllKategoriWithPaket($tahun);
		 $this->load->view('pengelompokan/pengelompokan_view',$data);
		 $this->load->view('bottom');
	}

	//Menyimpan data paket
	public function create(){
		// $p = $this->input->post();
		// $id = 1;//$this->session->userdata("id_jurusan");
		// $tahun = date("Y");
		// $this->m_pengelompokan->savePengelompokan($id,$tahun,$p);
		// redirect("Pengelompokan");

		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['tahun_anggaran']=date("Y");
		$dataid=$this->m_paket->getPaketByKategori($p['kategori']);
		
		if(empty($dataid)){
			$id = $this->m_paket->savePaket($p);
		}else{
			$id = $dataid['ID_PAKET'];
			$p['id_paket']=$id;
			$this->m_paket->updatePaket($p);
		}
		
		$this->m_alat->updateKategoriAlat($p['kategori'],$id);
		redirect("Paket");
	}

	public function ajukan($kat){
		$dataid=$this->m_paket->getPaketByKategori($kat);
		$p=$this->input->post();
		$p['id_paket']=$dataid['ID_PAKET'];
		$p['id_user']=$this->session->userdata("ID_USER");
		//$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['id_fase']=2;	
		$p['status']=5;	
		$this->m_progress->saveProgressGeneral($p);
		
		//$this->session->set_flashdata('data', 'Data Berhasil Diajukan ke Tim HPS');
		redirect("Paket");
	}


	//===============Tambahan================
	//Mengambil paket berdasarkan kategori
	public function getPaketByIdKategori($kat){
		$data['tim']=$this->m_timHps->getAllTimHps();
		$data['paket2'] = $this->m_alat->getAlatByIdKategori($kat);
		$data['paket']=$this->m_alat->getAlatNonPaketByIdKategori($kat);
		$kategori = $this->m_paket->getPaketByKategori($kat);
		$data['kategori']=array();
		if(!empty($kategori)){
			$data['kategori']=$kategori;
		}
		$data['paket']=array_merge($data['paket'],$data['paket2']);
		$this->load->view("pengelompokan/detail_pengelompokan_view",$data);
	}

	/*
	//===================Old==============

	//Menampilkan form add pengelompokan
	//[PopUp]
	public function addPengelompokan(){
		$this->load->view('pengelompokan/pengelompokan_add');
	}

	

	//Menampilkan form edit pengelompokan
	//[PopUp]
	public function editPengelompokan(){

	}

	//dipindahin jadi pas save
	public function updatePengelompokan(){
		$p = $this->input->post();
		$this->m_pengelompokan->updatePengelompokan($p);
		redirect("Pengelompokan");
	}

	
	*/
}


?>