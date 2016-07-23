<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaAcara extends CI_Controller {

	public function BeritaAcara(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('top');
		$data['paket']=$this->m_beritaacara->getAllDataPaket();
		$this->load->view("berita_acara/view",$data);
		$this->load->view('bottom');
	}

	public function BAPP($id){
		$this->load->view('top');
		$data['p']=$this->m_beritaacara->getPaketById($id);
		$data['alat']=$this->m_beritaacara->getAlatByIdPaket($id);
		$this->load->view("berita_acara/bapp",$data);
		$this->load->view('bottom');
	}
	public function getBukti(){
		$id = $_POST['id'];
		$bukti = $this->m_beritaacara->getBuktiById($id);
		$display = '<table class="table table-bordered"><tr class="active"><th> Tanggal </th><th> Bukti Pengadaan </th><th> Aksi </th></tr>';
		foreach ($bukti as $b) {
			$display .= '<tr><td>'.$b['TANGGAL'].'</td><td><a href="'.base_url().'assets/bukti/'.$b['FILE'].'">'.$b['FILE'].'</td><td><a href="'.base_url().'BeritaAcara/deleteBukti/'.$b['ID_BUKTI'].'">Hapus</a></td></tr>';
		}
		$display .= '</table>';
		echo $display;
	}
	function saveBAPP(){
		$data = array(
			'ID_ALAT'=>$this->input->post('id_alat'),
			'ID_TEAM_PENERIMA'=>$this->input->post('id_tim'),
			'ID_TEAM_PENERIMA'=>$this->input->post('id_tim'),
			'TANGGAL_PENERIMAAN'=>date('Y-m-d'),
			'JUMLAH'=>$this->input->post('jml'),
			'ID_PAKET'=>$this->input->post('id_paket'),
			'KETERANGAN'=>$this->input->post('ket'),
			);
		$this->m_beritaacara->saveBAPP($data);

		$id = $this->input->post('id_paket');
		// $cekProgress = $this->m_kontrak->cekProgressPenerimaan($id);
		// if($cekProgress==0){
		$dataProgress = array(
			'ID_PAKET'=>$id,
			'ID_USER'=> $this->session->userdata('ID_USER'),
			'ID_FASe'=> '5',
			'STATUS'=>'12',
			'ID_JENIS_USER'=> $this->session->userdata('ID_JENIS_USER'),
			);
		$this->m_beritaacara->saveProgressPenerimaan($dataProgress);
		// }
		redirect($_SERVER['HTTP_REFERER']);

	}
	function saveBukti(){
		$config['upload_path']   =   "assets/bukti";
		$config['allowed_types'] =   "*"; 
		$config['max_size']      =   "50000";
		$this->load->library('upload',$config);

		if(!$this->upload->do_upload('fupload')){
			echo $this->upload->display_errors();
			$finfo['file_name']="";
		}else{
			$finfo=$this->upload->data();
		}
		$dataBukti = array(
			'ID_PAKET'=>$this->input->post('id_paket'),
			'FILE'=>$finfo['file_name'],
			'KETERANGAN'=>$this->input->post('ket')
			);
		$this->m_beritaacara->saveBukti($dataBukti);
		redirect($_SERVER['HTTP_REFERER']);
	}
	function deleteBukti($id){
		$this->m_beritaacara->deleteBukti($id);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function BAST()
	{

		$html=$this->load->view('berita_acara/BAST'); 

	}	
}

?>