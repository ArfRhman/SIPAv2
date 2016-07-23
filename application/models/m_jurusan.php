<?php

class M_jurusan extends CI_Model {

	function m_jurusan(){
		parent::__construct();
	}

	function getAllJurusan(){
		$query = $this->db->query("SELECT * from jurusan")->result_array();
		return $query;
	}

	function getJurusanByNamaLokasi($nama){
		$query = $this->db->query("SELECT * from jurusan,lokasi where lokasi.ID_JURUSAN=jurusan.ID_JURUSAN AND lokasi.NAMA_LOKASI = '$nama'")->row_array();
		return $query;	
	}
}

?>