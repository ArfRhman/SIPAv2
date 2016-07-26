<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrak extends CI_Controller {

	public function kontrak(){
		parent::__construct();
		$this->load->model("m_kontrak");
		$this->load->model("m_paket");
		$this->load->model("m_pemenang");
		$this->load->model("m_progress");
	}

	// menampilkan smua data dokumen paket yang telah sukses lelang
	public function index(){
		$this->load->view('top');
		$data['paket']=$this->m_paket->getAllPaketKontrak();
		$this->load->view("kontrak/kontrak_view",$data);
		$this->load->view('bottom');
	}

	//Menampilkan detail dari dokumen pengelompokan berdasarkan id paket (pengelompokan)
	public function detail($id){
		$this->load->view('top');
		$data['paket']=$this->m_paket->getAllDataPaketById($id);
		$data['kontrak']=$this->m_kontrak->getKontrakByIdPaket($id);
		$data['penyedia']=$this->m_pemenang->getDataPemenangByPaket($id);
		$data['maxProgress']=$this->m_progress->getMaksProgressAlatByPaket($id);
		$this->load->view("kontrak/kontrak_detail",$data);
		$this->load->view('bottom');
	}

	//[PopUp]
	public function addKontrak(){

	}

	//[PopUp]
	public function editKontrak($id){

	}
	//mengupdate data penyedia
	public function updatePenyedia(){
		$penyedia = explode("/", $this->input->post('penyedia'));
		$data = array(
			'PENYEDIA' => $penyedia[3],
			'WAKTU_PENGADAAN' => $this->input->post('hariPengerjaan'),
			'TYPE_WAKTU'=>$this->input->post('jenisHari')
			);

		$id = $this->input->post('id_paket');
		$this->m_kontrak->updatePenyedia($id,$data);
		redirect($_SERVER['HTTP_REFERER']);

	}
	//menyimpan data dokumen kontrak
	public function create(){
		$config['upload_path']   =   "assets/kontrak";
		$config['allowed_types'] =   "*"; 
		$config['max_size']      =   "50000";
		$this->load->library('upload',$config);

		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
			$finfo['file_name']="";
		}else{
			$finfo=$this->upload->data();
		}

		$p = $this->input->post();
		$p['file'] = $finfo['file_name'];
		$p['id_user']=$this->session->userdata("ID_USER");
		$this->m_kontrak->saveKontrak($p);

		$id = $this->input->post('id_paket');
		// $cekProgress = $this->m_kontrak->cekProgressKontrak($id);
		// if($cekProgress==0){

			// $dataProgress = array(
			// 	'ID_PAKET'=>$id,
			// 	'ID_USER'=> $this->session->userdata('ID_USER'),
			// 	'ID_FASe'=> '4',
			// 	'STATUS'=>'10',
			// 	'ID_JENIS_USER'=> $this->session->userdata('ID_JENIS_USER'),
			// 	);
			// $this->m_kontrak->saveProgressKontrak($dataProgress);

		// }
		redirect($_SERVER['HTTP_REFERER']);
	}

	//Update dokumen Kontrak
	public function update(){
		$config['upload_path']   =   "assets/kontrak";
		$config['allowed_types'] =   "*"; 
		$config['max_size']      =   "50000";
		$this->load->library('upload',$config);
		$p = $this->input->post();

		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
			$finfo['file_name']="";
		}else{
			$kontrak = $this->m_kontrak->getKontrakByIdPaket($p['id_kontrak']);
			unlink("assets/kontrak/".$kontrak['FILE']);
			$finfo=$this->upload->data();
		}
		
		$p['file'] = $finfo['file_name'];
		$this->m_kontrak->updateKontrak($p);
		redirect($_SERVER['HTTP_REFERER']);
	}

	//Menghapus dokumen kontrak
	public function delete(){
		$id = $this->input->post('id_kontrak');
		$kontrak = $this->m_kontrak->getKontrakByIdPaket($id);
		$res=$this->m_kontrak->deleteKontrak($id);
		if($res){
			unlink("assets/kontrak/".$kontrak['FILE']);
		}
		redirect($_SERVER['HTTP_REFERER']);	
	}

	public function setujui(){
		$id = $this->input->post('id_paket');
		$data = array(
			'ID_PAKET'=>$id,
			'ID_USER'=> $this->session->userdata('ID_USER'),
			'ID_FASE'=> '4',
			'STATUS'=>'10',
			'REVISI_KE'=>'1'
			);
		$this->m_progress->saveProgressGeneral($data);

		redirect($_SERVER['HTTP_REFERER']);	
	}

}

?>