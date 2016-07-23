<?php

class M_pengelompokan extends CI_Model {

	function m_pengelompokan(){
		parent::__construct();
	}

	function getPengelompokanById($id){
		$query = $this->db->query("SELECT * from paket where ID_PAKET = '$id'")->row_array();
		return $query;
	}

	function getPengelompokanByKategori($kat){
		$query = $this->db->query("SELECT * from paket,team_hps where ID_KATEGORI = '$kat' AND paket.ID_TEAM_HPS = team_hps.ID_TEAM_HPS")->row_array();
		return $query;
	}

	function getAllPengelompokan(){
		$query = $this->db->query("SELECT * from paket")->result_array();
		return $query;
	}

	function getPengelompokanByName($name){
		$query = $this->db->query("SELECT * from paket where NAMA_PAKET = '$name'")->row_array();
		return $query;
	}

	//Mengambil data paket berdasarkan TimHPS
	function getPengelompokanByTim($id){
		$query = $this->db->query("SELECT * from paket,team_hps where team_hps.ID_USER = '$id' AND paket.ID_TEAM_HPS = team_hps.ID_TEAM_HPS")->result_array();
		return $query;
	}

	function getAllPengelompokanForKontrak(){
		$query = $this->db->query("SELECT * from paket where STATUS in (9)")->result_array();
		return $query;
	}

	function savePengelompokan($p){
		$query = $this->db->query("INSERT into paket(
			ID_USER,
			ID_TEAM_HPS,
			NAMA_PAKET,
			TANGGAL_DIBUAT,
			TAHUN_ANGGARAN,
			TOTAL_ANGGARAN,
			ID_KATEGORI
			) values(
			'$p[id_user]',
			'$p[tim]',
			'$p[nama]',
			NOW(),
			'$p[tahun_anggaran]',
			'$p[total]',
			'$p[kategori]'
			)");
		return $this->db->insert_id();
	}

	function updatePengelompokan($p){
		$query = $this->db->query("UPDATE paket set 
			NAMA_PAKET='$p[nama]',
			ID_TEAM_HPS='$p[tim]',
			LAST_UPDATE=NOW() 
			where ID_PAKET = '$p[id_paket]'
			");
		return $query;
	}
	function updatePengelompokanNoTim($p){
		$query = $this->db->query("UPDATE paket set 
			NAMA_PAKET='$p[nama]',
			LAST_UPDATE=NOW() 
			where ID_PAKET = '$p[id_paket]'
			");
		return $query;
	}

}