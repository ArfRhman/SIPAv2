<?php

class M_kategori extends CI_Model {

	function m_kategori(){
		parent::__construct();
	}

	function getAllKategori(){
		$query = $this->db->query("SELECT * FROM kategori")->result_array();
		return $query;
	}

	//Mengambil data kategori beserta paketnya
	function getAllKategoriWithPaket($tahun){
		$query = $this->db->query("SELECT *,(SELECT STATUS from progress_paket where progress_paket.ID_PAKET = paket.ID_PAKET order by TANGGAL DESC limit 0,1) as STATUS_PROGRESS,kategori.ID_KATEGORI as ID_KAT from kategori left join paket on paket.ID_KATEGORI = kategori.ID_KATEGORI")->result_array();
		return $query;
	}

	function getMaxRevisi($id){
		$query = $this->db->query("SELECT MAX(REVISI) as m from alat where ID_USULAN='$id'")->row_array();
		return $query;
	}

	function getKategoriByName($name){
		$query = $this->db->query("SELECT * from kategori where KATEGORI = '$name'")->row_array();
		return $query;
	}


}


?>