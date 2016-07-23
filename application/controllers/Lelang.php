<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lelang extends CI_Controller {

	public function lelang(){
		parent::__construct();
		$this->load->model("m_lelang");
	}

	public function index(){
		$this->load->view('top');
		// $data['lelang']=$this->m_lelang->getAllLelang();
		// $data['timpenerima']=$this->m_timPenerimaan->getAllTimPenerimaan();
		$this->load->view("lelang/lelang_view");
		$this->load->view('bottom');
	}

	//Menampilkan form add lelang
	//[PopUp]
	public function addLelang($id){

	}

	//Menampilkan form show Lelang
	//[PopUp]
	public function showLelang($id){

	}

	//Update 
	public function updateLelang(){
		$p = $this->input->post();
		if($p['status']==8){
			$this->m_lelang->updateLelangNormal($p);
		}else if($p['status']==9){
			$data = array(
				'ID_PAKET'=>$p['id_paket'],
				'ID_USER'=> $this->session->userdata('ID_USER'),
				'ID_FASE'=> '3',
				'STATUS'=>'9',
				'ID_JENIS_USER'=> $this->session->userdata('ID_JENIS_USER'),

				);
			$this->m_lelang->updateLelangSukses($p,$data);
		}else if($p['status']==-9){
			$data = array(
				'ID_PAKET'=>$p['id_paket'],
				'ID_USER'=> $this->session->userdata('ID_USER'),
				'ID_FASE'=> '3',
				'STATUS'=>'-9',
				'ID_JENIS_USER'=> $this->session->userdata('ID_JENIS_USER'),

				);

			$this->m_lelang->updateLelangGagal($p,$data);
		}
		$this->session->set_flashdata('data', 'Data Berhasil Dimasukkan');
		redirect("Lelang");
	}

}

?>