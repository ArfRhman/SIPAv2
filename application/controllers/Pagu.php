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
		$data['periode']=$this->m_pagu->getPeriodePagu();
		$data['pagu']=$this->m_pagu->getPaguByPeriode();
		$data['jurusan']=$this->m_jurusan->getAllJurusan();
		$this->load->view('pagu/pagu_view');
		$this->load->view('bottom');
	}

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

	//Menyimpan data pagu
	public function savePagu(){
		$p = $this->input->post();
		foreach($p['pagu'] as $key=>$a){
			$data=array(
				'id_jurusan'=>$key,
				'pagu'=>$a,
				'tahun_anggaran'=>date("Y"),
				'tanggal_mulai'=>date('Y-m-d'),
				);
			$this->m_pagu->savePagu($data);
		}
		$konten = '[REMINDER] Data Pagu Telah Dimasukkan Pada '.IndoTgl(date('Y-m-d'));
		// SendSMS($konten,'08997150058','Pagu');
		redirect("Pagu");
	}

	//Mengupdate data pagu
	public function updatePagu(){
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


	
}
