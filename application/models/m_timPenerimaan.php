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
	function saveAnggotaTimPenerima($nip,$id){
		$query = $this->db->query("INSERT into anggota_tim_penerima(
			ID_TIM_PENERIMA,
			NIP
			)values(
			'$id',
			'$nip'
			)");
		return $query;
	}

}

?>