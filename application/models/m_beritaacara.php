<?php

class M_beritaacara extends CI_Model {

	function m_beritaacara(){
		parent::__construct();
	}
	function getAllDataPaket(){
		$query = $this->db->query("SELECT * 
			from paket p
			inner join (
				select *,pp.ID_USER AS idUSr,pp.`STATUS` AS sts from progress_paket pp 
				WHERE pp.`STATUS` IN (SELECT ppp.STATUS FROM progress_paket ppp WHERE ppp.`STATUS` BETWEEN '10' and '12' AND ppp.ID_PAKET = pp.ID_PAKET ORDER BY ppp.`STATUS` DESC)
				ORDER BY pp.TANGGAL desc 
				) r
		on r.ID_PAKET = p.ID_PAKET
		group by r.ID_PAKET")->result_array();
		return $query;
	}
	function getAllDataPaketById($id){
		$query = $this->db->query("SELECT * 
			from paket p
			inner join (
				select *,pp.ID_USER AS idUSr,pp.`STATUS` AS sts from progress_paket pp 
				WHERE pp.STATUS = 9
				ORDER BY pp.TANGGAL desc 
				) r
		on r.ID_PAKET = p.ID_PAKET AND p.ID_PAKET = '$id'
		group by r.ID_PAKET AND r.ID_FASE = '3'")->row_array();
		return $query;
	}

	function getAlatByIdPaket($id){
		$query = $this->db->query("SELECT * from alat where ID_PAKET= '$id'")->result_array();
		return $query;
	}

	function getKontrakByIdPaket($id){
		$query = $this->db->query("SELECT * from kontrak,user where ID_PAKET = '$id' AND user.ID_USER = kontrak.ID_USER")->result_array();
		return $query;
	}
	function getPaketById($id){
		$query = $this->db->query("SELECT * from paket where ID_PAKET = '$id'")->row_array();
		return $query;
	}

	function getBuktiById($id){
		$res = $this->db->query("SELECT * FROM bukti_penerimaan WHERE ID_PAKET = '$id'")->result_array();
		return $res;
	}
	function saveBAPP($data){
		$this->db->insert('penerimaan',$data);
		return 1;
	}
	function cekTglPenerimaan($id){
		$ret = $this->db->query("SELECT MAX(counted) AS c FROM
			(
				SELECT COUNT(*) AS counted
				FROM penerimaan
				WHERE ID_PAKET = $id
				GROUP BY ID_ALAT
				) AS counts")->row_array();
		return $ret;
	}
	function getTglPenerimaanByIdAlat($id){
		$query = $this->db->query("SELECT * FROM penerimaan WHERE ID_ALAT = $id")->result_array();
		return $query;
	}
	function saveProgressPenerimaan($data){
		$this->db->insert('progress_paket',$data);
		return 1;
	}
	function cekProgressPenerimaan($id){
		$ret = $this->db->query("SELECT * FROM progress_paket WHERE ID_PAKET = $id AND ID_FASE = 5")->num_rows();
		return $ret;
	}
	function saveKontrak($p){
		$query = $this->db->query("INSERT into kontrak(
			ID_PAKET,
			ID_USER,
			KETERANGAN,
			FILE
			)values(
			'$p[id_paket]',
			'$p[id_user]',
			'$p[keterangan]',
			'$p[file]'
			)");
		return $query;
	}

	function saveBukti($dataBukti){
		$this->db->insert('bukti_penerimaan',$dataBukti);
		return 1;
	}
	function deleteBukti($id){
		$this->db->where('ID_BUKTI',$id);
		$this->db->delete('bukti_penerimaan');
		return 1;
	}
	function deleteKontrak($id){
		$query = $this->db->query("DELETE from kontrak where ID_KONTRAK = '$id'");
		return $query;
	}

	function updateKontrak($p){
		if($p['file']!=""){
			$query = $this->db->query("UPDATE kontrak set 
				KETERANGAN='$p[keterangan]',
				FILE='$p[file]'
				where ID_KONTRAK='$p[id_kontrak]'");
		}
		else{
			$query = $this->db->query("UPDATE kontrak set 
				KETERANGAN='$p[keterangan]'
				where ID_KONTRAK='$p[id_kontrak]'");
		}
		return $query;
	}
}

?>