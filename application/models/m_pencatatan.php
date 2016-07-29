<?php

class M_pencatatan extends CI_Model {

	function m_pencatatan(){
		parent::__construct();
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