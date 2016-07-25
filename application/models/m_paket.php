<?php

class M_paket extends CI_Model {

	function m_paket(){
		parent::__construct();
	}

	//Mengambil data paket berdasarkan id paket
	function getPaketById($id){
		$query = $this->db->query("SELECT * from paket where ID_PAKET = '$id'")->row_array();
		return $query;
	}

	//Mengambil data paket berdasarkan id kategori
	function getPaketByKategori($kat){
		$query = $this->db->query("SELECT * from paket,team_hps where ID_KATEGORI = '$kat' AND paket.ID_TEAM_HPS = team_hps.ID_TEAM_HPS")->row_array();
		return $query;
	}

	//Mengambil data paket berdasarkan tim hps
	function getPengelompokanByTim($id){
		$query = $this->db->query("SELECT * from paket,team_hps where team_hps.ID_USER = '$id' AND paket.ID_TEAM_HPS = team_hps.ID_TEAM_HPS")->result_array();
		return $query;
	}

	//Mengubah data paket
	function updatePengelompokan($p){
		$query = $this->db->query("UPDATE paket set 
			NAMA_PAKET='$p[nama]',
			ID_TEAM_HPS='$p[tim]',
			LAST_UPDATE=NOW() 
			where ID_PAKET = '$p[id_paket]'
			");
		return $query;
	}

	//Mengambil data paket yang telah memasuki tahap kontrak
	function getAllPaketKontrak(){
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

	//Mengambil data kategori beserta paket dengan kategori tersebut
	function getAllKategoriWithPaket($tahun){
		$query = $this->db->query("SELECT *,(SELECT STATUS from progress_paket where progress_paket.ID_PAKET = paket.ID_PAKET order by TANGGAL DESC limit 0,1) as STATUS_PROGRESS,kategori.ID_KATEGORI as ID_KAT from kategori left join paket on paket.ID_KATEGORI = kategori.ID_KATEGORI")->result_array();
		return $query;
	}

	//Menyimpan data paket dengan mengembalikan nilai id paket
	function savePaket($p){
		$query = $this->db->query("INSERT into paket(
			ID_USER,
			ID_TEAM_HPS,
			NAMA_PAKET,
			TANGGAL_DIBUAT,
			TAHUN_ANGGARAN,
			TOTAL_ANGGARAN,
			ID_KATEGORI
			) values(
			'$p[id_user]',
			'$p[tim]',
			'$p[nama]',
			NOW(),
			'$p[tahun_anggaran]',
			'$p[total]',
			'$p[kategori]'
			)");
		return $this->db->insert_id();
	}

	//Mengambil data paket yang tela memasuki tahap SPM
	function getPaketSpm(){
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

	//Menngubah data paket [asalnya updatePengelompokanNoTim]
	function updatePaket($p){
		$query = $this->db->query("UPDATE paket set 
			NAMA_PAKET='$p[nama]',
			LAST_UPDATE=NOW() 
			where ID_PAKET = '$p[id_paket]'
			");
		return $query;
	}

	//Mengambil data kategori beserta paketnya
	function getAllKategoriWithPaket($tahun){
		$query = $this->db->query("SELECT *,(SELECT STATUS from progress_paket where progress_paket.ID_PAKET = paket.ID_PAKET order by TANGGAL DESC limit 0,1) as STATUS_PROGRESS,kategori.ID_KATEGORI as ID_KAT from kategori left join paket on paket.ID_KATEGORI = kategori.ID_KATEGORI")->result_array();
		return $query;
	}

/*
//===================Old===============	


	function getAllPengelompokan(){
		$query = $this->db->query("SELECT * from paket")->result_array();
		return $query;
	}

	function getPengelompokanByName($name){
		$query = $this->db->query("SELECT * from paket where NAMA_PAKET = '$name'")->row_array();
		return $query;
	}

	function getAllPengelompokanForKontrak(){
		$query = $this->db->query("SELECT * from paket where STATUS in (9)")->result_array();
		return $query;
	}

	
*/
}