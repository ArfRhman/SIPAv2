<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class m_timPenerimaan extends CI_Model {

	public function m_timPenerimaan(){
		parent::__construct();
	}

	//mengambil semua data tim Penerima
	public function getAllTimPenerimaan(){
		$query = $this->db->query("SELECT * from tim_penerima")->result_array();
		return $query;
	}
	public function getAllTimPenerimaanByIdUser($id){
		$query = $this->db->query("SELECT * from tim_penerima WHERE ID_USER ='$id'")->row_array();
		return $query;
	}

	public function getTimPenerimaByPaket($id){
		$query = $this->db->query("SELECT * FROM anggota_tim_penerima AS atp,pegawai AS peg WHERE atp.ID_TIM_PENERIMA = (SELECT p.ID_TIM_PENERIMA FROM paket AS p WHERE p.ID_PAKET = '$id') AND atp.NIP = peg.NIP")->result_array();
		return $query;
	}

	public function getPenyediaByPaket($id){
		$query = $this->db->query("SELECT * FROM pemenang WHERE ID_PAKET = '$id' AND STATUS_PENYEDIA = 1")->row_array();
		return $query;
	}

	// menyimpan nama dan ketua tim Peneirma
	function saveTimPenerimaan($p){
		$query = $this->db->query("INSERT into tim_penerima(
			ID_USER,
			NAMA_TIM
			)values(
			'$p[id]',
			'$p[namatim]'
			)");
		return $this->db->insert_id();
	}

	// menyimpan data anggota tim penerima
	function saveAnggotaTimPenerima($nip,$id,$ket){
		$query = $this->db->query("INSERT into anggota_tim_penerima(
			ID_TIM_PENERIMA,
			NIP,
			STATUS_KETUA
			)values(
			'$id',
			'$nip',
			'$ket'
			)");
		return $query;
	}

}

?>