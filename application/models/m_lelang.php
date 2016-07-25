<?php

class M_lelang extends CI_Model {

	function m_lelang(){
		parent::__construct();
	}

	//Mengambil data paket yang berada dalam fase lelang
	function getAllLelang(){
		$query = $this->db->query("SELECT *,p.STATUS AS status_paket 
			from paket p
			inner join (
				select *,pp.ID_USER AS idUSr,pp.STATUS AS status_progress from progress_paket pp 
				WHERE pp.ID_FASE ='3' AND pp.STATUS IN(8,-9,9)
				ORDER BY pp.TANGGAL desc 
				) r
		on r.ID_PAKET = p.ID_PAKET
		group by r.ID_PAKET")->result_array();
		return $query;
	}

	//Mengupdate data paket apabila status lelangnya gagal
	function updateLelangGagal($p){
		$this->db->query("UPDATE paket set 
			KETERANGAN_GAGAL_LELANG='$p[keterangan]'
			where ID_PAKET='$p[id_paket]'
			");
		return 1;
	}

	//Mengupdate data paket apabila status lelangnya sukses
	function updateLelangSukses($p){

		$this->db->query("UPDATE paket set 
			ID_TIM_PENERIMA='$p[timPenerima]',
			KETERANGAN_GAGAL_LELANG=''
			where ID_PAKET='$p[id_paket]'
			");		
		return 1;
	}
/*
//=============Old==============
	//Mengambil data paket lelang berdasarkan id paket
	function getPaketLelangSuksesById($id){
		$query = $this->db->query("SELECT * 
			from paket p
			inner join (
				select *,pp.ID_USER AS idUSr,pp.`STATUS` AS sts from progress_paket pp 
				WHERE pp.ID_FASE ='3' AND pp.`STATUS` = 9 AND pp.ID_PAKET = $id
				ORDER BY pp.TANGGAL desc 
				) r
		on r.ID_PAKET = p.ID_PAKET
		group by r.ID_PAKET")->row_array();
		return $query;
	}



	//Mengupdate data paket kembali ke normal
	function updateLelangNormal($p){
		$query = $this->db->query("UPDATE paket set 
			STATUS='8',
			TENDER_A='',
			TENDER_B='',
			TENDER_C='',
			TENDER_D='',
			TENDER_E='',
			KETERANGAN_GAGAL_KONTRAK='' 
			where ID_PAKET='$p[id_paket]'
			");
		return $query;
	}
	*/
}

?>