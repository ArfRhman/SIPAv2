<?php

class M_spm extends CI_Model {

	function m_spm(){
		parent::__construct();
	}


	//Men-approve data paket di fase SPM
	function approveSPM($id){
		$query = $this->db->query("UPDATE paket set STATUS_BAYAR = 1 where ID_PAKET = '$id'");
		return $query;
	}
	
	/*
	//===========Old===========
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

	*/

}

?>