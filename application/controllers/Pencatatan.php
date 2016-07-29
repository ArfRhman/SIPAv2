<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencatatan extends CI_Controller {

	public function pencatatan(){
		parent::__construct();
		$this->load->model("m_paket");
		
	}
	// menampilkan data paket pada halaman awal pencatatan
	public function index(){
		$this->load->view('top');
		$data['paket']=$this->m_paket->getPaketPencatatanById($this->session->userdata('ID_JURUSAN'));
		$this->load->view("pencatatan/pencatatan_view",$data);
		$this->load->view('bottom');
	}

	public function Detail($id){
		$this->load->view('top');
		$data['paket']=$this->m_paket->getPaketById($id);
		$maxRev = $this->m_alat->getMaxRevisi($id);
		$data['alat']=$this->m_alat->getAlatByIdUsulanAndFinal($id,$maxRev,$this->session->userdata('ID_JURUSAN'));
		$this->load->view('pencatatan/pencatatan_detail',$data);
		$this->load->view('bottom');
	}
	function add(){
		$id = $_POST['id'];
		$d = $_POST['data'];
		$data = array('NO_INVENTARIS'=>$d,'ID_FASE'=>'6');
		$this->m_alat->addNoInventaris($id,$data);
		return 1;
	}

	
}

?>