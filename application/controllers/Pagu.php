<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagu extends CI_Controller {

	public function pagu(){
		parent::__construct();
		$this->load->model("m_pagu");
		$this->load->model("m_jurusan");
	}

	//menampilkan halaman awal data pagu
	public function index($tahun=0){
		$this->load->view('top');
		$data['currentDate']=date("Y");
		if($tahun!=0){
			$data['currentDate']=$tahun;
		}
		$data['pagu']=$this->m_pagu->getPaguByPeriode($data['currentDate']);
		$data['jurusan']=$this->m_jurusan->getAllJurusan();
		//====tambahan==
		$data['periode']=$this->m_pagu->getPeriodePagu();
		//
		$this->load->view('pagu/pagu_view',$data);
		$this->load->view('bottom');
	}

	//Menyimpan data pagu
	public function create(){
		$p = $this->input->post();
		$this->m_pagu->saveTahunAnggaran(date('Y'),date('Y-m-d'));
		foreach($p['pagu'] as $key=>$a){
			$data=array(
				'id_jurusan'=>$key,
				'pagu'=>$a,
				'tahun_anggaran'=>date("Y"),
				'tanggal'=>date('Y-m-d'),
				);
			$this->m_pagu->savePagu($data);
		}
		$konten = '[REMINDER] Data Pagu Telah Dimasukkan Pada '.IndoTgl(date('Y-m-d'));
		// SendSMS($konten,'08997150058','Pagu');
		redirect("Pagu");
	}

	//Mengupdate data pagu
	public function update(){
		$p = $this->input->post();
		foreach($p['pagu'] as $key=>$a){
			$data=array(
				'id_jurusan'=>$key,
				'pagu'=>$a,
				'tahun_anggaran'=>date("Y"),
				);
			$this->m_pagu->updatePagu($data);
		}
		redirect("Pagu");
	}

/*
//====================Old=====================
	

	//Menampilkan form add pagu
	//[PopUp]
	public function addPagu(){
		$this->load->view('pagu/pagu_add');
	}

	//Menampilkan form edit pagu
	//[PopUp]
	public function editPagu($id){
		$data['pagu']=$this->m_pagu->getPaguByIdPagu($id);
		$this->load->view('pagu/pagu_edit',$data);
	}

	

	

*/
	
}
