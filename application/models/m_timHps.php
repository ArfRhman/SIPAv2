<?php

class M_timHps extends CI_Model {

	function m_timHps(){
		parent::__construct();
	}

	//mengambil semua data tim HPS
	function getAllTimHps(){
		$query = $this->db->query("SELECT * from tim_hps")->result_array();
		return $query;
	}

	// menyimpan nama dan ketua tim HPS
	function saveTimHps($p){
		$query = $this->db->query("INSERT into tim_hps(
			ID_USER,
			NAMA_TIM
			)values(
			'$p[id]',
			'$p[namatim]'
			)");
		return $this->db->insert_id();
	}

	// menyimpan data anggota tim hps
	function saveAnggotaTimHps($nip,$id){
		$query = $this->db->query("INSERT into anggota_tim_hps(
			ID_TIM_HPS,
			NIP
			)values(
			'$id',
			'$nip'
			)");
		return $query;
	}
}

?>