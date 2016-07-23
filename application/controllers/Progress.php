<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress extends CI_Controller {

	public function progress(){
		parent::__construct();
		$this->load->model("m_progress");
		$this->load->model("m_pengelompokan");
	}

	public function saveProgressUsulan(){
		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		if($this->session->userdata("ID_JENIS_USER")==1){
			$p['id_fase']=1;	
			$p['status']=11;
		}else if($this->session->userdata("ID_JENIS_USER")==2){
			$p['id_fase']=1;
			$p['status']=22;
		}else if($this->session->userdata("ID_JENIS_USER")==3){
			$p['id_fase']=1;
			$p['status']=3;
		}
		$this->m_progress->saveProgressUsulan($p);
		$progress=$this->m_progress->getProgressByUserJurusan($p['id_jurusan'],$p['id_jenis_user']);
		
		$this->session->set_userdata('PROGRESS',$progress);

		redirect("Usulan");
	}

	public function saveProgressKonfirmasi(){
		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['revisi_ke']=$p['revisi']-1;
		if($this->session->userdata("ID_JENIS_USER")==2){
			$p['id_fase']=1;	
			$p['status']=-1;
		}if($this->session->userdata("ID_JENIS_USER")==3){
			$p['id_fase']=1;	
			$p['status']=-2;
		}
		$this->m_progress->saveProgressUsulan($p);
		redirect("Usulan");
	}

	public function approveUsulan(){
		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['revisi_ke']=$p['revisi']-1;
		$p['id_fase']=1;	
		$p['status']=2;
		$this->m_progress->saveProgressUsulan($p);
	}

	public function saveProgressPengelompokan($kat){
		$dataid=$this->m_pengelompokan->getPengelompokanByKategori($kat);
		$p=$this->input->post();
		$p['id_paket']=$dataid['ID_PAKET'];
		$p['id_user']=$this->session->userdata("ID_USER");
		//$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['id_fase']=2;	
		$p['status']=5;	
		$this->m_progress->saveProgressGeneral($p);
		$this->session->set_flashdata('data', 'Data Berhasil Diajukan ke Tim HPS');
		redirect("Pengelompokan");
	}

	public function saveProgressHps(){
		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['revisi_ke']=$p['revisi_ke']-1;
		$p['id_fase']=2;
		$p['status']=6;
		$this->m_progress->saveProgressGeneral($p);
		if($this->session->userdata("ID_JENIS_USER")==6){
			redirect("HPS");	
		}else{
			redirect("Pengelompokan");
		}
		
	}

	public function saveProgressLelang($kat){
		$dataid=$this->m_pengelompokan->getPengelompokanByKategori($kat);
		$p=$this->input->post();
		$p['id_paket']=$dataid['ID_PAKET'];
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['id_fase']=3;
		$p['status']=8;
		$this->m_progress->saveProgressGeneral($p);
		$this->session->set_flashdata('data', 'Dokumen Memasuki Tahap Lelang');	
		redirect("Pengelompokan");	
	}	


	public function approveHps(){
		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['revisi_ke']=$p['revisi_ke']-1;
		$p['id_fase']=2;
		$p['status']=7;
		$this->m_progress->saveProgressGeneral($p);
		if($this->session->userdata("ID_JENIS_USER")==6){
			redirect("HPS");	
		}else{
			redirect("Pengelompokan");
		}
		
	}

}

?>