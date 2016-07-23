<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SPM extends CI_Controller {

	public function kontrak(){
		parent::__construct();
		$this->load->model("m_kontrak");
		$this->load->model("m_pengelompokan");
	}

	public function index(){
		$this->load->view('top');
		$data['paket']=$this->m_spm->getAllDataPaket();
		$this->load->view("spm/view",$data);
		$this->load->view('bottom');
	}

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
	function confirmSPM(){
		$id = $this->input->post('id_paket');
		$data = array('STATUS_BAYAR'=>1);
		$this->m_spm->confirmSPM($id,$data);

		// $cekProgress = $this->m_kontrak->cekProgressPenerimaan($id);
		// if($cekProgress==0){
			$dataProgress = array(
				'ID_PAKET'=>$id,
				'ID_USER'=> $this->session->userdata('ID_USER'),
				'ID_FASe'=> '5',
				'STATUS'=>'13',
				'ID_JENIS_USER'=> $this->session->userdata('ID_JENIS_USER'),
				);
			$this->m_beritaacara->saveProgressPenerimaan($dataProgress);
		// }
			redirect($_SERVER['HTTP_REFERER']);
		return 1;
	}

	function KonfirmasiAlat(){
		$this->load->view('top');
		// $data['paket']=$this->m_spm->getAllDataPaket();
		$this->load->view("spm/konfirmasi");
		$this->load->view('bottom');
	}

	function confirmPenerimaan(){
		$id = $this->input->post('id_penerimaan');
		$data = array('STATUS_KONFIRMASI'=>1);
		$this->m_spm->confirmPenerimaan($id,$data);

			redirect($_SERVER['HTTP_REFERER']);
		return 1;
	}

}

?>