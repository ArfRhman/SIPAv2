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
		$konten = array();
		foreach($p['pagu'] as $key=>$a){
			$pagu = str_replace(',','',$a);
			$data=array(
				'id_jurusan'=>$key,
				'pagu'=>$pagu,
				'tahun_anggaran'=>date("Y"),
				'tanggal'=>date('Y-m-d'),
				);
			$this->m_pagu->savePagu($data);
			$DataPegawai = $this->m_site->getDataKontakManajemenByIdJurusan($key)->result_array();
			if(!empty($DataPegawai[0]['NO_HP'])){
				for ($i=0; $i < count($DataPegawai); $i++) { 
					$DataPegawai[$i]['KONTEN'] = '[NOTIFIKASI] Data Pagu Telah Dimasukkan Pada '.IndoTgl(date('Y-m-d'));
				}
				array_push($konten, $DataPegawai);
			}
		}
		SendSMS($konten,'Pagu');
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
