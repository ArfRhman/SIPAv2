<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaAcara extends CI_Controller {

	public function BeritaAcara(){
		parent::__construct();
		$this->load->model("m_paket");

	}
	// menampilkan data paket di halaman awal berita acara
	public function index(){
		$this->load->view('top');
		$getDataTim = $this->m_timPenerimaan->getAllTimPenerimaanByIdUser($this->session->userdata('ID_USER'));
		$data['paket']=$this->m_paket->getAllDataPaket($getDataTim['ID_TIM_PENERIMA']);
		// $data['maxProgress']=$this->m_progress->getMaksProgressAlatByPaket($id);
		$this->load->view("berita_acara/view",$data);
		$this->load->view('bottom');
	}
	// menampilkan data BAPP berdasarkan id paket yang dipilih
	public function BAPP($id){
		$this->load->view('top');
		$data['p']=$this->m_paket->getPaketById($id);
		$rev=$this->m_alat->getMaxRevisiPaket($id);
		$data['alat']=$this->m_alat->getAlatByIdPaket($id,$rev['m']);
		$this->load->view("berita_acara/bapp",$data);
		$this->load->view('bottom');
	}
	// menyimpan data BAPP
	function saveBAPP(){
		$data = array(
			'ID_ALAT'=>$this->input->post('id_alat'),
			'ID_TIM_PENERIMA'=>$this->input->post('id_tim'),
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
		// $this->m_beritaacara->saveProgressPenerimaan($dataProgress);
		// }
		redirect($_SERVER['HTTP_REFERER']);

	}
	// menghapus data BAPP berdasarkan data BAPP yang dipilih
	function deleteBAPP($id){
		$this->m_beritaacara->deleteBAPP($id);
		redirect($_SERVER['HTTP_REFERER']);
	}
	// mengambil data bukti pengadaan
	public function getBukti(){
		$id = $_POST['id'];
		$bukti = $this->m_beritaacara->getBuktiById($id);
		$display = '<table class="table table-bordered"><tr class="active"><th> Tanggal </th><th> Bukti Pengadaan </th><th> Aksi </th></tr>';
		foreach ($bukti as $b) {
			$tgl = explode(" ", $p['TANGGAL']); echo IndoTgl($tgl[0]);
			$display .= '<tr><td>'.$b['TANGGAL'].'</td><td><a href="'.base_url().'assets/bukti/'.$b['FILE'].'">'.$b['FILE'].'</td><td><a href="'.base_url().'BeritaAcara/deleteBukti/'.$b['ID_BUKTI'].'">Hapus</a></td></tr>';
		}
		$display .= '</table>';
		echo $display;
	}
	// menyimpan data bukti pengadaan
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
			'KETERANGAN'=>$this->input->post('ket'),
			'TANGGAL'=>date('Y-m-d')
			);
		$this->m_beritaacara->saveBukti($dataBukti);
		redirect($_SERVER['HTTP_REFERER']);
	}
	function deleteBukti($id){
		$this->m_beritaacara->deleteBukti($id);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function BAST($id){

		$data['timPenerima']=$this->m_timPenerimaan->getTimPenerimaByPaket($id);
		$data['penyedia']=$this->m_timPenerimaan->getPenyediaByPaket($id);
		$html=$this->load->view('berita_acara/BAST',$data); 
	}	
	
	// update progress untuk setujui data berita acara
	public function approve(){
		$id = $this->input->post('id_paket');
		$data = array(
			'ID_PAKET'=>$id,
			'ID_USER'=> $this->session->userdata('ID_USER'),
			'ID_FASE'=> '5',
			'STATUS'=>'12',
			'REVISI_KE'=>'1'
			);
		$this->m_progress->saveProgressGeneral($data);

		redirect($_SERVER['HTTP_REFERER']);	
	}
}

?>