<?php

class M_kategori extends CI_Model {

	function m_kategori(){
		parent::__construct();
	}

	//Mengambil seluruh kategori
	function getAllKategori(){
		$query = $this->db->query("SELECT * FROM kategori")->result_array();
		return $query;
	}

	//=======Tambahan========
	//Mengambil kategori berdasrkan nama kategori
	function getKategoriByName($name){
		$query = $this->db->query("SELECT * from kategori where KATEGORI = '$name'")->row_array();
		return $query;
	}

	/*
	//==================Old
	

	function getMaxRevisi($id){
		$query = $this->db->query("SELECT MAX(REVISI) as m from alat where ID_USULAN='$id'")->row_array();
		return $query;
	}

	
	*/

}


?>