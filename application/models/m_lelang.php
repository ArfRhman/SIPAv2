<?php

class M_lelang extends CI_Model {

	function m_lelang(){
		parent::__construct();
	}

	//Mengambil semua paket yang telah terferifikasi oleh PPK
	function getAllLelang(){
		$query = $this->db->query("SELECT *,p.STATUS AS stss 
			from paket p
			inner join (
				select *,pp.ID_USER AS idUSr,pp.STATUS AS sts from progress_paket pp 
				WHERE pp.ID_FASE ='3' AND pp.STATUS IN(8,-9,9)
				ORDER BY pp.TANGGAL desc 
				) r
		on r.ID_PAKET = p.ID_PAKET
		group by r.ID_PAKET")->result_array();
		return $query;
	}

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

	//Mengupdate data paket apabila status lelangnya sukses
	function updateLelangSukses($p,$data){

		$this->db->query("UPDATE paket set 
			TENDER_A='$p[tender_a]',
			NAMA_A='$p[nama_a]',
			NPWP_A='$p[npwp_a]',
			ALAMAT_A='$p[alamat_a]',
			TENDER_B='$p[tender_b]',
			NAMA_B='$p[nama_b]',
			NPWP_B='$p[npwp_b]',
			ALAMAT_B='$p[alamat_b]',
			TENDER_C='$p[tender_c]',
			NAMA_C='$p[nama_c]',
			NPWP_C='$p[npwp_c]',
			ALAMAT_C='$p[alamat_c]',
			STATUS = 9,
			ID_TEAM_PENERIMA='$p[timPenerima]',
			KETERANGAN_GAGAL_KONTRAK='' 
			where ID_PAKET='$p[id_paket]'
			");
		$this->db->insert('progress_paket',$data);
		
		return 1;
	}

	//Mengupdate data paket apabila status lelangnya gagal
	function updateLelangGagal($p,$data){
		$this->db->query("UPDATE paket set 
			TENDER_A='$p[tender_a]',
			NAMA_A='$p[nama_a]',
			NPWP_A='$p[npwp_a]',
			ALAMAT_A='$p[alamat_a]',
			TENDER_B='$p[tender_b]',
			NAMA_B='$p[nama_b]',
			NPWP_B='$p[npwp_b]',
			ALAMAT_B='$p[alamat_b]',
			TENDER_C='$p[tender_c]',
			NAMA_C='$p[nama_c]',
			NPWP_C='$p[npwp_c]',
			ALAMAT_C='$p[alamat_c]',
			STATUS = -9,
			ID_TEAM_PENERIMA='$p[timPenerima]',
			KETERANGAN_GAGAL_KONTRAK='$p[keterangan]' 
			where ID_PAKET='$p[id_paket]'
			");

		$this->db->insert('progress_paket',$data);
		return 1;
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
}

?>