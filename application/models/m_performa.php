<?php

class M_performa extends CI_Model {

	function m_performa(){
		parent::__construct();
	}
	//Mengambil data performa anggaran
	function getAllPerforma($periode){
		$query = $this->db->query("SELECT jurusan.*,SUM(JUMLAH_ALAT*HARGA_SATUAN) as total,(SELECT PAGU_ALAT from pagu where ID_JURUSAN = alat.ID_JURUSAN AND TAHUN_ANGGARAN='$periode') as pagu from alat,jurusan,usulan where usulan.ID_USULAN=alat.ID_USULAN AND usulan.TAHUN_ANGGARAN='$periode' AND jurusan.ID_JURUSAN = alat.ID_JURUSAN AND NO_INVENTARIS is not null GROUP BY ID_JURUSAN")->result_array();
		return $query;
	}

	//Mengambil detail data performa anggaran perjurusan
	function getDetailPerforma($id){
		$query = $this->db->query("SELECT * from alat where NO_INVENTARIS is not null AND ID_JURUSAN = '$id'")->result_array();
		return $query;
	}
}

?>