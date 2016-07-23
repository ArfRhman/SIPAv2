<?php

class M_spm extends CI_Model {

	function m_spm(){
		parent::__construct();
	}
	function getAllDataPaket(){
		$query = $this->db->query("SELECT * 
			from paket p
			inner join (
				select *,pp.ID_USER AS idUSr,pp.`STATUS` AS sts from progress_paket pp 
				WHERE pp.`STATUS` IN (SELECT ppp.STATUS FROM progress_paket ppp WHERE ppp.`STATUS` BETWEEN '12' and '13' AND ppp.ID_PAKET = pp.ID_PAKET ORDER BY ppp.`STATUS` DESC)
				ORDER BY pp.TANGGAL desc 
				) r
		on r.ID_PAKET = p.ID_PAKET
		group by r.ID_PAKET")->result_array();
		return $query;
	}
	function getAllJumlahAlatByIdPaket($id){
		$res = $this->db->query('SELECT SUM(JUMLAH_ALAT) AS maxAlat FROM alat WHERE ID_PAKET = '.$id.'')->row_array();
		return $res;
	}
	function getAllJumlahPenerimaanAlatByIdPaket($id){
		$res = $this->db->query('SELECT SUM(JUMLAH) AS maxTrmAlat FROM penerimaan WHERE ID_PAKET = '.$id.'')->row_array();
		return $res;
	}
	function getStatusKonfirmasiByIdPaket($id){
		$res = $this->db->query('SELECT COUNT(STATUS_KONFIRMASI) AS c FROM penerimaan WHERE STATUS_KONFIRMASI IN (0) AND ID_PAKET = '.$id.'')->row_array();
		return $res;
	}
	function confirmSPM($id,$data){
		$this->db->where('ID_PAKET',$id);
		$this->db->update('paket',$data);
		return 1;
	}
	function confirmPenerimaan($id,$data){
		$this->db->where('ID_PENERIMAAN',$id);
		$this->db->update('penerimaan',$data);
		return 1;
	}

}

?>