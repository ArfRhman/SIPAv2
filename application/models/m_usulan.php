<?php

class M_usulan extends CI_Model {

	function m_usulan(){
		parent::__construct();
	}


	//Mengambil data usulan berdasarkan id jurusan
	function getUsulanByIdJurusan($id,$id_jenis){
		$query = $this->db->query("SELECT * from usulan,jurusan,user where user.id_user = usulan.id_user AND user.id_jenis_user = '$id_jenis' AND usulan.ID_JURUSAN = '$id' AND jurusan.ID_JURUSAN = usulan.ID_JURUSAN")->result_array();
		return $query;
	}

	//Menyimpan data usulan
	function saveUsulan($p){
		$query = $this->db->query("INSERT into usulan(
			ID_USER,
			ID_JURUSAN,
			NAMA_PAKET,
			TANGGAL_DIBUAT,
			TAHUN_ANGGARAN,
			TOTAL_ANGGARAN
			)values(
			'$p[id_user]',
			'$p[id_jurusan]',
			'$p[nama]',
			NOW(),
			'$p[tahun]',
			'$p[total]'
			)");
		return $this->db->insert_id();
	}

	//Update last update [ini asalnya update usulan by id]
	function updateUsulan($p){
		$query = $this->db->query("UPDATE usulan set 
			LAST_UPDATE = NOW(),
			NAMA_PAKET='$p[nama]',
			TOTAL_ANGGARAN='$p[total]'
			where ID_USULAN='$p[id_usulan]'");
		return $query;
	}

	//Mengambil data final usulan pengadaan berdasarkan jurusan
	function getUsulanFinal($id,$tahun){
		$query = $this->db->query("SELECT * from usulan,alat,lokasi,user,pegawai where alat.ID_USER = user.ID_USER AND pegawai.NIP=user.NIP AND usulan.ID_JURUSAN = '$id' AND usulan.TAHUN_ANGGARAN = '$tahun' AND usulan.ID_USULAN = alat.ID_USULAN AND alat.IS_FINAL='1' AND lokasi.ID_LOKASI = alat.ID_LOKASI")->result_array();
		return $query;
	}

	//Mengambil data usulan berdasarkan Id Usulan
	function getUsulanByIdUsulan($id){
		$query = $this->db->query("SELECT * from usulan,pagu,user where usulan.ID_USER=user.ID_USER AND ID_USULAN = '$id' AND usulan.TAHUN_ANGGARAN = pagu.TAHUN_ANGGARAN")->row_array();
		return $query;
	}

	//Mengambil data usulan yang telah diajukan oleh teknisi atau kepala lab
	function getUsulanFromBelow($id){
		$query = $this->db->query("SELECT *,progress_paket.STATUS as STAT from progress_paket,usulan,user where user.ID_JURUSAN = '$id' AND progress_paket.ID_USER = user.ID_USER AND usulan.ID_USULAN = progress_paket.ID_USULAN AND ID_PROGRESS_PAKET = (SELECT MAX(ID_PROGRESS_PAKET) from progress_paket where progress_paket.ID_USULAN = usulan.ID_USULAN) group by progress_paket.ID_USULAN order by ID_PROGRESS_PAKET DESC")->result_array();
		return $query;
	}

	//Mengambil progress usulan berdasarkan usulan dan id jurusan
	function getProgressUsulanByUserJurusan($id){
		$query = $this->db->query("SELECT pp.STATUS,pp.ID_USULAN,pp.REVISI_KE FROM usulan AS u, progress_paket AS pp WHERE u.ID_USER  = '$id' AND u.ID_USULAN = pp.ID_USULAN")->row_array();
		return $query;
	}

	//mengambil data usulan berdasarkan id jurusan dan fase pengadaan
	function getUsulanForFlow($id,$fase){
		$query = $this->db->query("SELECT *,progress_paket.STATUS as STAT from progress_paket,usulan,jurusan where jurusan.ID_JURUSAN = usulan.ID_JURUSAN AND progress_paket.STATUS = '$fase' AND usulan.ID_USULAN = progress_paket.ID_USULAN AND ID_PROGRESS_PAKET = (SELECT MAX(ID_PROGRESS_PAKET) from progress_paket where progress_paket.ID_USULAN = usulan.ID_USULAN) group by progress_paket.ID_USULAN order by ID_PROGRESS_PAKET DESC")->result_array();
		return $query;
	}
	
	function getUsulanFinalJurusan($fase){
		$query = $this->db->query("SELECT *,progress_paket.STATUS as STAT from progress_paket,usulan,jurusan where jurusan.ID_JURUSAN = usulan.ID_JURUSAN AND progress_paket.STATUS = '$fase' AND usulan.ID_USULAN = progress_paket.ID_USULAN AND ID_PROGRESS_PAKET = (SELECT MAX(ID_PROGRESS_PAKET) from progress_paket where progress_paket.ID_USULAN = usulan.ID_USULAN) group by progress_paket.ID_USULAN order by ID_PROGRESS_PAKET DESC")->result_array();
		return $query;
	}



/*
//==========================OLD=====================

	
	// // get data usulan final semua jurusan
	

	// //Mengambil data anggaran usulan berdasarkan Id jurusan
	// function getUsulanAnggaranByIdJurusan($id){
	// 	$th = date('Y');
	// 	$query = $this->db->query("SELECT * from usulan,pagu,jurusan where usulan.ID_JURUSAN = '$id'  AND jurusan.ID_JURUSAN = usulan.ID_JURUSAN AND pagu.ID_JURUSAN = '$id' AND pagu.TAHUN_ANGGARAN = '$th'")->result_array();
	// 	return $query;
	// }

	

	

	

*/
}