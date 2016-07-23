<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencatatan extends CI_Controller {

	public function usulan(){
		parent::__construct();
		
	}

	public function index(){
		$this->load->view('top');
		$data['paket']=$this->m_pencatatan->getAllDataPaket($this->session->userdata('ID_JURUSAN'));
		$this->load->view("pencatatan/pencatatan_view",$data);
		$this->load->view('bottom');
	}
	public function Detail($id){
		$this->load->view('top');
		$data['paket']=$this->m_pencatatan->GetPaketById($id);
		$data['alat']=$this->m_pencatatan->getDataAlatById($id,$this->session->userdata('ID_JURUSAN'));
		$this->load->view('pencatatan/pencatatan_detail',$data);
		$this->load->view('bottom');
	}
	function addNoInvent(){
		$id = $_POST['id'];
		$d = $_POST['data'];
		$data = array('NO_INVENTARIS'=>$d,'ID_FASE'=>'6');
		$this->m_pencatatan->saveNoInvent($id,$data);
		return 1;
	}

	
}

?>