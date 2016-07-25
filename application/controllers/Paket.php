<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {

	public function paket(){
		parent::__construct();
		$this->load->model("m_paket");
		//$this->load->model("m_kategori");
		//$this->load->model("m_alat");
		//$this->load->model("m_timHps");

	}
	// menampilkan halaman awal pengelompokan paket usulan
	public function index(){
		print_r("adad");die();
		// $this->load->view('top');
		// $tahun=date("Y");
		// $data['kategori']=$this->m_paket->getAllKategoriWithPaket($tahun);
		// $this->load->view('pengelompokan/pengelompokan_view',$data);
		// $this->load->view('bottom');
	}

	//Menampilkan form add pengelompokan
	//[PopUp]
	public function addPengelompokan(){
		$this->load->view('pengelompokan/pengelompokan_add');
	}

	//Menyimpan data pengelompokan
	public function savePengelompokan(){
		// $p = $this->input->post();
		// $id = 1;//$this->session->userdata("id_jurusan");
		// $tahun = date("Y");
		// $this->m_pengelompokan->savePengelompokan($id,$tahun,$p);
		// redirect("Pengelompokan");

		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['tahun_anggaran']=date("Y");
		$dataid=$this->m_pengelompokan->getPengelompokanByKategori($p['kategori']);
		
		if(empty($dataid)){
			$id = $this->m_pengelompokan->savePengelompokan($p);
		}else{
			$id = $dataid['ID_PAKET'];
			$p['id_paket']=$id;
			$this->m_pengelompokan->updatePengelompokan($p);
		}
		
		$this->m_alat->updateKategoriAlat($p['kategori'],$id);
		redirect("Pengelompokan");
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

	public function getPaketByIdKategori($kat){
		$data['tim']=$this->m_timHps->getAllTimHps();
		$data['paket2'] = $this->m_alat->getAlatByIdKategori($kat);
		$data['paket']=$this->m_alat->getAlatNonPaketByIdKategori($kat);
		$kategori = $this->m_pengelompokan->getPengelompokanByKategori($kat);
		$data['kategori']=array();
		if(!empty($kategori)){
			$data['kategori']=$kategori;
		}
		$data['paket']=array_merge($data['paket'],$data['paket2']);
		$this->load->view("pengelompokan/detail_pengelompokan_view",$data);
	}

}


?>