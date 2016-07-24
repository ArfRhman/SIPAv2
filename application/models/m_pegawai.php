<?php

class M_pegawai extends CI_Model {

	function m_pegawai(){
		parent::__construct();
	}

	//Mengambil seluruh data pegawai
	function getAllPegawai(){
		$query = $this->db->query("SELECT * from pegawai")->result_array();
		return $query;
	}

	//Mengambil data pegawai yang berstatus teknisi
	function getAllTeknisi(){
		$query = $this->db->query("SELECT * from pegawai where IS_TEKNISI = '1'")->result_array();
		return $query;
	}


/*
//===============OLd================
	function getUserIdByName($nama){
		$query = $this->db->query("SELECT * from pegawai,user where pegawai.NAMA_PEGAWAI = '$nama' AND pegawai.NIP = user.NIP")->row_array();
		return $query;
	}
	*/
	
}

?>