<?php

class M_lokasi extends CI_Model {

	function m_lokasi(){
		parent::__construct();
	}

	//Mengambil data nama lokasi berdasarkan id jurusan
	function getLokasiByIdJurusan($id){
		$query = $this->db->query("SELECT * from lokasi where ID_JURUSAN='$id'")->result_array();
		return $query;
	}

	//Mengambil data id lokasi berdasarkan nama lokasi
	function getIdLokasiByName($id,$name){
		$query = $this->db->query("SELECT ID_LOKASI from lokasi where ID_JURUSAN='$id' AND NAMA_LOKASI = '$name'")->row_array();
		return $query;	
	}

	//Mengambil semua lokasi
	function getAllLokasi(){
		$query = $this->db->query("SELECT * from lokasi")->result_array();
		return $query;
	}
}

?>
