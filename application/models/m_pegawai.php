<?php

class M_pegawai extends CI_Model {

	function m_pegawai(){
		parent::__construct();
	}

	function getAllPegawai(){
		$query = $this->db->query("SELECT * from pegawai")->result_array();
		return $query;
	}

	function getAllTeknisi(){
		$query = $this->db->query("SELECT * from pegawai where IS_TEKNISI = '1'")->result_array();
		return $query;
	}

	function getUserIdByName($nama){
		$query = $this->db->query("SELECT * from pegawai,user where pegawai.NAMA_PEGAWAI = '$nama' AND pegawai.NIP = user.NIP")->row_array();
		return $query;
	}
}

?>