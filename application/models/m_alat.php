<?php

class M_alat extends CI_Model {

	function m_alat(){
		parent::__construct();
	}

	function getAllRevisiByIdUsulan($id){
		$query = $this->db->query("SELECT *,(SELECT NAMA_PEGAWAI from user,pegawai where user.ID_USER=alat.ID_USER AND pegawai.NIP = user.NIP) as NAMA, (SELECT NAMA_JENIS_USER from jenis_user,user where user.ID_USER=alat.ID_USER AND user.ID_JENIS_USER = jenis_user.ID_JENIS_USER) as JENIS from alat where alat.ID_USULAN = '$id' group by REVISI order by REVISI ASC")->result_array();
		return $query;
	}

	function getAllRevisiByIdPaket($id){
		$query = $this->db->query("SELECT *,(SELECT NAMA_PEGAWAI from user,pegawai where user.ID_USER=alat.ID_USER AND pegawai.NIP = user.NIP) as NAMA, (SELECT NAMA_JENIS_USER from jenis_user,user where user.ID_USER=alat.ID_USER AND user.ID_JENIS_USER = jenis_user.ID_JENIS_USER) as JENIS from alat where alat.ID_PAKET = '$id' group by REVISI_PAKET order by REVISI_PAKET ASC")->result_array();
		return $query;
	}

	function getMaxRevisi($id){
		$query = $this->db->query("SELECT MAX(REVISI) as m from alat where ID_USULAN='$id'")->row_array();
		return $query;
	}

	function getMaxRevisiHps($id){
		$query = $this->db->query("SELECT MAX(REVISI_PAKET) as m from alat where ID_PAKET='$id'")->row_array();
		return $query;	
	}

	function getAlatByIdUsulan($id,$max){
		$query = $this->db->query("SELECT *,(SELECT NAMA_PAKET from paket where paket.ID_PAKET = alat.ID_PAKET) as NAMA_PAKET,(SELECT NAMA_PEGAWAI from pegawai,user where pegawai.NIP = user.NIP AND alat.ID_USER = user.ID_USER) as NAMA_PEGAWAI from alat where ID_USULAN ='$id' AND REVISI='$max[m]'")->result_array();
		return $query;
	}

	function getAlatByIdPengelompokan($id,$max){
		$query = $this->db->query("SELECT *,(SELECT NAMA_PEGAWAI from pegawai,user where pegawai.NIP = user.NIP AND alat.ID_USER = user.ID_USER) as NAMA_PEGAWAI from alat where ID_PAKET ='$id' AND REVISI_PAKET='$max[m]'")->result_array();
		return $query;	
	}

	function getAlatByIdUsulanAndFinal($id,$max,$jur){
		$query = $this->db->query("SELECT *,(SELECT NAMA_PAKET from paket where paket.ID_PAKET = alat.ID_PAKET) as NAMA_PAKET,(SELECT NAMA_PEGAWAI from pegawai,user where pegawai.NIP = user.NIP AND alat.ID_USER = user.ID_USER) as NAMA_PEGAWAI from alat where ID_USULAN ='$id' AND REVISI='$max[m]' OR IS_FINAL=1 AND ID_JURUSAN = '$jur'")->result_array();
		return $query;	
	}

	function getAlatByIdKategori($kat){
		$query = $this->db->query("SELECT *,alat.ID_PAKET as ID_PAKET from alat,lokasi,jurusan,progress_paket where progress_paket.STATUS = 3 AND (progress_paket.ID_USULAN = alat.ID_USULAN AND progress_paket.REVISI_KE = alat.REVISI) AND lokasi.ID_LOKASI = alat.ID_LOKASI AND jurusan.ID_JURUSAN = alat.ID_JURUSAN AND alat.ID_KATEGORI = '$kat' AND alat.IS_FINAL = 1 AND alat.ID_PAKET is not null")->result_array();
		return $query;
	}

	function getAlatNonPaketByIdKategori($kat){
		$query = $this->db->query("SELECT * from alat,lokasi,jurusan,progress_paket where progress_paket.STATUS = 3 AND (progress_paket.ID_USULAN = alat.ID_USULAN AND progress_paket.REVISI_KE = alat.REVISI) AND lokasi.ID_LOKASI = alat.ID_LOKASI AND jurusan.ID_JURUSAN = alat.ID_JURUSAN AND alat.ID_KATEGORI = '$kat' AND alat.IS_FINAL = 1 AND alat.ID_PAKET is null")->result_array();
		return $query;
	}

	//Mengubah is final jadi nol ketika manajemen save pengajuan
	function clearFinal($id){
		$query = $this->db->query("UPDATE alat set IS_FINAL = 0 where ID_JURUSAN = '$id'");
		return $query;
	}

	//Menyimpan data alat
	function saveAlat($p){
		$query = $this->db->query("INSERT INTO alat(
			TANGGAL_UPDATE,
			ID_JURUSAN,
			ID_USER,
			ID_LOKASI,
			ID_FASE,
			ID_USULAN,
			NAMA_ALAT,
			SPESIFIKASI,
			SETARA,
			SATUAN,
			JUMLAH_ALAT,
			HARGA_SATUAN,
			JUMLAH_DISTRIBUSI,
			REFERENSI_TERKAIT,
			DATA_AHLI,
			PRIORITY,
			ID_KATEGORI,
			IS_FINAL
			)values(
			NOW(),
			'$p[id_jurusan]',
			'$p[id_user]',
			'$p[id_lokasi]',
			'1',
			'$p[id_usulan]',
			'$p[nama_alat]',
			'$p[spesifikasi]',
			'$p[setara]',
			'$p[satuan]',
			'$p[jumlah_alat]',
			'$p[harga_satuan]',
			'$p[jumlah_distribusi]',
			'$p[ref]',
			'$p[data_ahli]',
			'$p[prioritas]',
			'$p[kategori]',
			'$p[is_final]'
			)");
		return $query;
	}

	function saveUpdateAlat($p){
		if($p['ref']==""){
			if($p['paket']==""){
				$query = $this->db->query("INSERT INTO alat(
					TANGGAL_UPDATE,
					ID_JURUSAN,
					ID_USER,
					ID_LOKASI,
					ID_FASE,
					ID_USULAN,
					NAMA_ALAT,
					SPESIFIKASI,
					SETARA,
					SATUAN,
					JUMLAH_ALAT,
					HARGA_SATUAN,
					JUMLAH_DISTRIBUSI,
					REVISI,
					DATA_AHLI,
					PRIORITY,
					ID_KATEGORI,
					KONFIRMASI,
					IS_FINAL
					)values(
					NOW(),
					'$p[id_jurusan]',
					'$p[id_user]',
					'$p[id_lokasi]',
					'1',
					'$p[id_usulan]',
					'$p[nama_alat]',
					'$p[spesifikasi]',
					'$p[setara]',
					'$p[satuan]',
					'$p[jumlah_alat]',
					'$p[harga_satuan]',
					'$p[jumlah_distribusi]',
					'$p[revisi]',
					'$p[data_ahli]',
					'$p[prioritas]',
					'$p[kategori]',
					'$p[konfirmasi]',
					'$p[is_final]'
					)");
			}else{
				$query = $this->db->query("INSERT INTO alat(
					TANGGAL_UPDATE,
					ID_JURUSAN,
					ID_USER,
					ID_LOKASI,
					ID_FASE,
					ID_USULAN,
					NAMA_ALAT,
					SPESIFIKASI,
					SETARA,
					SATUAN,
					JUMLAH_ALAT,
					HARGA_SATUAN,
					JUMLAH_DISTRIBUSI,
					REVISI,
					DATA_AHLI,
					PRIORITY,
					ID_KATEGORI,
					KONFIRMASI,
					IS_FINAL,
					ID_PAKET
					)values(
					NOW(),
					'$p[id_jurusan]',
					'$p[id_user]',
					'$p[id_lokasi]',
					'1',
					'$p[id_usulan]',
					'$p[nama_alat]',
					'$p[spesifikasi]',
					'$p[setara]',
					'$p[satuan]',
					'$p[jumlah_alat]',
					'$p[harga_satuan]',
					'$p[jumlah_distribusi]',
					'$p[revisi]',
					'$p[data_ahli]',
					'$p[prioritas]',
					'$p[kategori]',
					'$p[konfirmasi]',
					'$p[is_final]',
					'$p[paket]'
					)");
			}
		}else{
			if($p['paket']==""){
				$query = $this->db->query("INSERT INTO alat(
				TANGGAL_UPDATE,
				ID_JURUSAN,
				ID_USER,
				ID_LOKASI,
				ID_FASE,
				ID_USULAN,
				NAMA_ALAT,
				SPESIFIKASI,
				SETARA,
				SATUAN,
				JUMLAH_ALAT,
				HARGA_SATUAN,
				JUMLAH_DISTRIBUSI,
				REFERENSI_TERKAIT,
				REVISI,
				DATA_AHLI,
				PRIORITY,
				ID_KATEGORI,
				KONFIRMASI,
				IS_FINAL
				)values(
				NOW(),
				'$p[id_jurusan]',
				'$p[id_user]',
				'$p[id_lokasi]',
				'1',
				'$p[id_usulan]',
				'$p[nama_alat]',
				'$p[spesifikasi]',
				'$p[setara]',
				'$p[satuan]',
				'$p[jumlah_alat]',
				'$p[harga_satuan]',
				'$p[jumlah_distribusi]',
				'$p[ref]',
				'$p[revisi]',
				'$p[data_ahli]',
				'$p[prioritas]',
				'$p[kategori]',
				'$p[konfirmasi]',
				'$p[is_final]'
				)");
			}else{
				$query = $this->db->query("INSERT INTO alat(
				TANGGAL_UPDATE,
				ID_JURUSAN,
				ID_USER,
				ID_LOKASI,
				ID_FASE,
				ID_USULAN,
				NAMA_ALAT,
				SPESIFIKASI,
				SETARA,
				SATUAN,
				JUMLAH_ALAT,
				HARGA_SATUAN,
				JUMLAH_DISTRIBUSI,
				REFERENSI_TERKAIT,
				REVISI,
				DATA_AHLI,
				PRIORITY,
				ID_KATEGORI,
				KONFIRMASI,
				IS_FINAL,
				ID_PAKET
				)values(
				NOW(),
				'$p[id_jurusan]',
				'$p[id_user]',
				'$p[id_lokasi]',
				'1',
				'$p[id_usulan]',
				'$p[nama_alat]',
				'$p[spesifikasi]',
				'$p[setara]',
				'$p[satuan]',
				'$p[jumlah_alat]',
				'$p[harga_satuan]',
				'$p[jumlah_distribusi]',
				'$p[ref]',
				'$p[revisi]',
				'$p[data_ahli]',
				'$p[prioritas]',
				'$p[kategori]',
				'$p[konfirmasi]',
				'$p[is_final]',
				'$p[paket]'
				)");
			}
			
		}
		return $query;
	}

	function saveUpdateAlatHps($p){
		if($p['ref']==""){
			$query = $this->db->query("INSERT INTO alat(
				TANGGAL_UPDATE,
				ID_JURUSAN,
				ID_USER,
				ID_LOKASI,
				ID_FASE,
				ID_PAKET,
				NAMA_ALAT,
				SPESIFIKASI,
				SETARA,
				SATUAN,
				JUMLAH_ALAT,
				HARGA_SATUAN,
				JUMLAH_DISTRIBUSI,
				REVISI_PAKET,
				DATA_AHLI,
				PRIORITY,
				ID_KATEGORI,
				KONFIRMASI,
				IS_FINAL
				)values(
				NOW(),
				'$p[id_jurusan]',
				'$p[id_user]',
				'$p[id_lokasi]',
				'1',
				'$p[id_paket]',
				'$p[nama_alat]',
				'$p[spesifikasi]',
				'$p[setara]',
				'$p[satuan]',
				'$p[jumlah_alat]',
				'$p[harga_satuan]',
				'$p[jumlah_distribusi]',
				'$p[revisi]',
				'$p[data_ahli]',
				'$p[prioritas]',
				'$p[kategori]',
				'$p[konfirmasi]',
				'$p[is_final]'
				)");
		}else{
			$query = $this->db->query("INSERT INTO alat(
				TANGGAL_UPDATE,
				ID_JURUSAN,
				ID_USER,
				ID_LOKASI,
				ID_FASE,
				ID_PAKET,
				NAMA_ALAT,
				SPESIFIKASI,
				SETARA,
				SATUAN,
				JUMLAH_ALAT,
				HARGA_SATUAN,
				JUMLAH_DISTRIBUSI,
				REFERENSI_TERKAIT,
				REVISI_PAKET,
				DATA_AHLI,
				PRIORITY,
				ID_KATEGORI,
				KONFIRMASI,
				IS_FINAL
				)values(
				NOW(),
				'$p[id_jurusan]',
				'$p[id_user]',
				'$p[id_lokasi]',
				'2',
				'$p[id_paket]',
				'$p[nama_alat]',
				'$p[spesifikasi]',
				'$p[setara]',
				'$p[satuan]',
				'$p[jumlah_alat]',
				'$p[harga_satuan]',
				'$p[jumlah_distribusi]',
				'$p[ref]',
				'$p[revisi]',
				'$p[data_ahli]',
				'$p[prioritas]',
				'$p[kategori]',
				'$p[konfirmasi]',
				'$p[is_final]'
				)");
		}
		return $query;
	}

	function updateFinal($p){
		$query = $this->db->query("UPDATE alat set IS_FINAL = 1 where ID_USULAN = '$p[id_usulan]' AND REVISI = '$p[revisi_ke]'");
		return $query;
	}
	function updateKategoriAlat($kat,$id){
		$query = $this->db->query("UPDATE alat set ID_PAKET = '$id', REVISI_PAKET = '0' where IS_FINAL = '1' AND ID_KATEGORI = '$kat'");
		return $query;
	}

}


?>