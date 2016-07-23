<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrak extends CI_Controller {

	public function kontrak(){
		parent::__construct();
		$this->load->model("m_kontrak");
		$this->load->model("m_pengelompokan");
	}

	public function index(){
		$this->load->view('top');
		$data['paket']=$this->m_kontrak->getAllDataPaket();
		$this->load->view("kontrak/kontrak_view",$data);
		$this->load->view('bottom');
	}

	//Menampilkan detail dari dokumen pengelompokan berdasarkan id paket (pengelompokan)
	public function detail($id){
		$this->load->view('top');
		$data['paket']=$this->m_kontrak->getAllDataPaketById($id);
		$data['kontrak']=$this->m_kontrak->getKontrakById($id);
		$data['penyedia']=$this->m_kontrak->getPenyediaById($id);
		$this->load->view("kontrak/kontrak_detail",$data);
		$this->load->view('bottom');
	}

	//[PopUp]
	public function addKontrak(){

	}

	//[PopUp]
	public function editKontrak($id){

	}
	//Save Kontrak
	public function savePenyedia(){
		$penyedia = explode("/", $this->input->post('penyedia'));
		$data = array(
			'PENYEDIA' => $penyedia[3],
			'WAKTU_PENGADAAN' => $this->input->post('hariPengerjaan').'/'.$this->input->post('jenisHari'),
			);

		$id = $this->input->post('id_paket');
		$this->m_kontrak->savePenyedia($id,$data);
		redirect($_SERVER['HTTP_REFERER']);

	}
	//Save Kontrak
	public function saveKontrak(){
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
			$dataProgress = array(
				'ID_PAKET'=>$id,
				'ID_USER'=> $this->session->userdata('ID_USER'),
				'ID_FASe'=> '4',
				'STATUS'=>'10',
				'ID_JENIS_USER'=> $this->session->userdata('ID_JENIS_USER'),
				);
			$this->m_kontrak->saveProgressKontrak($dataProgress);
		// }
		redirect($_SERVER['HTTP_REFERER']);
	}

	//Update Kontrak
	public function updateKontrak(){
		$config['upload_path']   =   "assets/kontrak";
		$config['allowed_types'] =   "*"; 
		$config['max_size']      =   "50000";
		$this->load->library('upload',$config);
		$p = $this->input->post();

		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
			$finfo['file_name']="";
		}else{
			$kontrak = $this->m_kontrak->getKontrakById($p['id_kontrak']);
			unlink("assets/kontrak/".$kontrak['FILE']);
			$finfo=$this->upload->data();
		}
		
		$p['file'] = $finfo['file_name'];
		$this->m_kontrak->updateKontrak($p);
		redirect($_SERVER['HTTP_REFERER']);
	}

	//Delete Kontrak
	public function deleteKontrak(){
		$id = $this->input->post('id_kontrak');
		$kontrak = $this->m_kontrak->getKontrakById($id);
		$res=$this->m_kontrak->deleteKontrak($id);
		if($res){
			unlink("assets/kontrak/".$kontrak['FILE']);
		}
		redirect($_SERVER['HTTP_REFERER']);	
	}

}

?>