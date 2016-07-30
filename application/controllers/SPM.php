<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SPM extends CI_Controller {

	public function SPM(){
		parent::__construct();
		$this->load->model("m_kontrak");
		$this->load->model("m_paket");
		$this->load->model("m_beritaacara");
	}
	// menampilkan halaman awal untuk approve SPM
	public function index(){
		$this->load->view('top');
		$data['paket'] = $this->m_paket->getPaketSPM();
		$this->load->view("spm/view",$data);
		$this->load->view('bottom');
	}
	// menampilkan data bukti pengadaan
	public function getBukti(){
		$id = $_POST['id'];
		$bukti = $this->m_beritaacara->getBuktiById($id);
		$display = '<table class="table table-bordered"><tr class="active"><th> Tanggal </th><th> Bukti Pengadaan </th><th> KETERANGAN </th></tr>';
		foreach ($bukti as $b) {
			$display .= '<tr><td>'.$b['TANGGAL'].'</td><td><a href="'.base_url().'assets/bukti/'.$b['FILE'].'">'.$b['FILE'].'</td><td>'.$b['KETERANGAN'].'</td></tr>';
		}
		$display .= '</table>';
		echo $display;
	}
	// mengubah status approve untuk SPM
	function approve(){
		$id = $this->input->post('id_paket');
		$data = array('STATUS_BAYAR'=>1);
		$this->m_spm->approveSPM($id,$data);

		// $cekProgress = $this->m_kontrak->cekProgressPenerimaan($id);
		// if($cekProgress==0){

		$dataProgress = array(
				'ID_PAKET'=>$id,
				'ID_USER'=> $this->session->userdata('ID_USER'),
				'ID_FASE'=> '5',
				'STATUS'=>'13',
				'REVISI_KE'=>'1'
				);

		$this->m_progress->saveProgressGeneral($dataProgress);
		// $this->m_beritaacara->saveProgressPenerimaan($dataProgress);
		// }
		redirect($_SERVER['HTTP_REFERER']);
		return 1;
	}

	function KonfirmasiAlat(){
		$id_jurusan = $this->session->userdata('ID_JURUSAN');
		$this->load->view('top');
		$data['pnb']=$this->m_alat->getPenerimaanAlat($id_jurusan);
		$this->load->view("spm/konfirmasi",$data);
		$this->load->view('bottom');
	}

	function approvePenerimaan(){
		$id = $this->input->post('id_penerimaan');
		$data = array('STATUS_KONFIRMASI'=>1);
		$this->m_alat->approvePenerimaan($id,$data);

		redirect($_SERVER['HTTP_REFERER']);
		return 1;
	}

}

?>