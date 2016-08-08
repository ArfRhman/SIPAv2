<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lelang extends CI_Controller {

	public function lelang(){
		parent::__construct();
		$this->load->model("m_lelang");
		$this->load->model("m_timPenerimaan");
		$this->load->model("m_pemenang");
		$this->load->model("m_progress");
	}

	public function index(){
		$this->load->view('top');
		$data['lelang']=$this->m_lelang->getAllLelang();
		$data['timpenerima']=$this->m_timPenerimaan->getAllTimPenerimaan();
		$this->load->view("lelang/lelang_view",$data);
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

	//Update hasil lelang
	public function updateLelang(){
		$p = $this->input->post();

		if($p['status']==8){ // bila masih dalam tahap lelang
			$this->m_lelang->updateLelangNormal($p);

		}else if($p['status']==9){ // bila lelang sukses
			$data = array(
				'ID_PAKET'=>$p['id_paket'],
				'ID_USER'=> $this->session->userdata('ID_USER'),
				'ID_FASE'=> '3',
				'STATUS'=>'9',
				'REVISI_KE'=>'1'
				);

			if($p['tender_a']!=''){
				$data_pemenang = array(
					'ID_PAKET'=>$p['id_paket'],
					'NAMA_PERUSAHAAN'=>$p['tender_a'],
					'NPWP'=>$p['npwp_a'],
					'ALAMAT'=>$p['alamat_a'],
					'PIC_PERUSAHAAN'=>$p['nama_a']
					);
				$this->m_lelang->updateLelangSukses($p);
				$this->m_pemenang->updateDataPemenang($data_pemenang);
				$this->m_progress->saveProgressGeneral($data);

				// $konten = '[NOTIFIKASI] Data Hasil Lelang Sukses Telah Dimasukkan Pada '.IndoTgl(date('Y-m-d'));
				// SendSMS($konten,'08997150058','Lelang');

				if($p['tender_b']!=''){
					$data_pemenang = array(
						'ID_PAKET'=>$p['id_paket'],
						'NAMA_PERUSAHAAN'=>$p['tender_b'],
						'NPWP'=>$p['npwp_b'],
						'ALAMAT'=>$p['alamat_b'],
						'PIC_PERUSAHAAN'=>$p['nama_b']
						);
					$this->m_pemenang->updateDataPemenang($data_pemenang);
				}
				if($p['tender_c']!=''){
					$data_pemenang = array(
						'ID_PAKET'=>$p['id_paket'],
						'NAMA_PERUSAHAAN'=>$p['tender_c'],
						'NPWP'=>$p['npwp_c'],
						'ALAMAT'=>$p['alamat_c'],
						'PIC_PERUSAHAAN'=>$p['nama_c']
						);
					$this->m_pemenang->updateDataPemenang($data_pemenang);
				}
			}
		}else if($p['status']==-9){ // bila lelang gagal
			$data = array(
				'ID_PAKET'=>$p['id_paket'],
				'ID_USER'=> $this->session->userdata('ID_USER'),
				'ID_FASE'=> '3',
				'STATUS'=>'-9',
				'REVISI_KE'=>'1'
				);
			$this->m_lelang->updateLelangGagal($p);
			$this->m_progress->saveProgressGeneral($data);

			// $k2 = array('NO_HP'=>$m['NO_HP'], 'KONTEN'=>'[NOTIFIKASI] Segera Masukkan Data Usulan');
		// array_push($konten,$k2);
		// SendSMS($konten,'Konfirmasi_Usulan');
		}
		$this->session->set_flashdata('data', 'Data Berhasil Dimasukkan');
		redirect("Lelang");
	}

}

?>