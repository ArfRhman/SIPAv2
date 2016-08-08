<?php

class M_pemenang extends CI_Model {

	function m_pemenang(){
		parent::__construct();
	}
	//Mengambil data pemenang berdasarkan id paket
	function getDataPemenangByPaket($id){
		$query = $this->db->query("SELECT * FROM pemenang WHERE ID_PAKET = '$id'")->result_array();
		return $query;
	}

	//Mengupdate data pemenang apabila status lelangnya sukses
	function updateDataPemenang($data){
		$this->db->insert('pemenang',$data);
		return 1;
	}

	function getPenyediaByIdPaket($id){
		$query = $this->db->query("SELECT * FROM pemenang WHERE ID_PAKET = '$id' AND STATUS_PENYEDIA = 1");
		return $query;
	}

}

?>