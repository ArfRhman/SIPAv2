<?php

class M_pencatatan extends CI_Model {

	function m_pencatatan(){
		parent::__construct();
	}
	function getDataAlatById($id,$idj){
		$query = $this->db->query("SELECT * FROM alat a WHERE a.ID_PAKET = $id AND ID_JURUSAN = $idj")->result_array();	
		return $query;
	}
	function getAllDataPaket($id){
		$query = $this->db->query("SELECT * FROM progress_paket pp,paket p WHERE  pp.`STATUS` BETWEEN '13' and '14' AND p.ID_PAKET = pp.ID_PAKET AND pp.ID_PAKET IN ((SELECT ID_PAKET FROM alat WHERE ID_JURUSAN = $id AND ID_PAKET != ''))")->result_array();
		return $query;
	}
	function GetPaketById($id){
		$ret = $this->db->query("SELECT * FROM paket WHERE ID_PAKET = $id")->row_array();
		return $ret;
	}
	function saveNoInvent($id,$data){
		$this->db->where('ID_ALAT',$id);
		$this->db->update('alat',$data);

	}
	function getPaketByIdAlat($id){
		$query = $this->db->query("SELECT a.ID_ALAT FROM alat a WHERE a.ID_ALAT = $id")->row_array();	
		return $query;
	}
	function getNoInventAlatByJurusan($id){
		$query = $this->db->query("SELECT * FROM alat WHERE NO_INVENTARIS!='' AND ID_JURUSAN = '$id' AND ID_PAKET = (SELECT pp.ID_PAKET FROM progress_paket pp WHERE pp.STATUS = '13')")->result_array();	
		return $query;
	}
	// function getAllJumlahAlatByIdPaket($id){
	// 	$res = $this->db->query('SELECT SUM(JUMLAH_ALAT) AS maxAlat FROM alat WHERE ID_PAKET = '.$id.'')->row_array();
	// 	return $res;
	// }
	// function getAllJumlahPenerimaanAlatByIdPaket($id){
	// 	$res = $this->db->query('SELECT SUM(JUMLAH) AS maxTrmAlat FROM penerimaan WHERE ID_PAKET = '.$id.'')->row_array();
	// 	return $res;
	// }
	// function getStatusKonfirmasiByIdPaket($id){
	// 	$res = $this->db->query('SELECT COUNT(STATUS_KONFIRMASI) AS c FROM penerimaan WHERE STATUS_KONFIRMASI IN (0) AND ID_PAKET = '.$id.'')->row_array();
	// 	return $res;
	// }
	// function confirmSPM($id,$data){
	// 	$this->db->where('ID_PAKET',$id);
	// 	$this->db->update('paket',$data);
	// 	return 1;
	// }

}

?>