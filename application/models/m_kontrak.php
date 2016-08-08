<?php

class M_kontrak extends CI_Model {

	function m_kontrak(){
		parent::__construct();
	}

	//Mengambil data kontrak berdasarkan id paket
	function getKontrakByIdPaket($id){
		$query = $this->db->query("SELECT * from kontrak,user where ID_PAKET = '$id' AND user.ID_USER = kontrak.ID_USER")->result_array();
		return $query;
	}

	//Menyimpan data kontrak
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

	//Mengubah data kontrak
	function updateKontrak($p){
		if($p['file']!=""){
			$query = $this->db->query("UPDATE kontrak set 
				KETERANGAN='$p[keterangan]',
				FILE='$p[file]'
				where ID_KONTRAK='$p[id_kontrak]'");
		}else{
			$query = $this->db->query("UPDATE kontrak set 
				KETERANGAN='$p[keterangan]'
				where ID_KONTRAK='$p[id_kontrak]'");
		}
		return $query;
	}

	//Menghapus data kontrak
	function deleteKontrak($id){
		$query = $this->db->query("DELETE from kontrak where ID_KONTRAK = '$id'");
		return $query;
	}


	//Mengupdate data penyedia pada paket
	function updatePenyedia($id,$data,$idp){
		$this->db->where('ID_PAKET',$id);
		$this->db->update('paket',$data);

		$this->db->where('ID_PEMENANG',$idp);
		$this->db->update('pemenang',array('STATUS_PENYEDIA'=>1));
		return 1;
	}

	/*
	//==============Old==============
	function getAllDataPaket(){
		$query = $this->db->query("SELECT * 
			from paket p
			inner join (
				select *,pp.ID_USER AS idUSr,pp.`STATUS` AS sts from progress_paket pp 
				WHERE pp.`STATUS` IN (SELECT ppp.STATUS FROM progress_paket ppp WHERE ppp.`STATUS` BETWEEN '9' and '10' AND ppp.ID_PAKET = pp.ID_PAKET ORDER BY ppp.STATUS DESC)
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
				WHERE pp.`STATUS` IN (SELECT ppp.STATUS FROM progress_paket ppp WHERE ppp.`STATUS` BETWEEN '9' and '10' AND ppp.ID_PAKET = pp.ID_PAKET ORDER BY ppp.STATUS DESC) AND pp.ID_PAKET = $id
				ORDER BY pp.TANGGAL desc 
				) r
		on r.ID_PAKET = p.ID_PAKET
		group by r.ID_PAKET")->row_array();
		return $query;
	}

	function saveProgressKontrak($data){
		$this->db->insert('progress_paket',$data);
		return 1;
	}
	function cekProgressKontrak($id){
		$ret = $this->db->query("SELECT * FROM progress_paket WHERE ID_PAKET = $id AND ID_FASE = 4")->num_rows();
		return $ret;
	}
	function getKontrakById($id){
		$query = $this->db->query("SELECT * from kontrak where ID_PAKET= '$id'")->result_array();
		return $query;
	}

	
	

	


	*/
}

?>