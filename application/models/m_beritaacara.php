<?php

class M_beritaacara extends CI_Model {

	function m_beritaacara(){
		parent::__construct();
	}
	
	// menyimpan data penerimaan alat
	function saveBAPP($data){

		$query = $this->db->query("SELECT * from penerimaan where ID_PAKET='$data[ID_PAKET]' AND ID_ALAT ='$data[ID_ALAT]' AND TANGGAL_PENERIMAAN = '$data[TANGGAL_PENERIMAAN]'")->row_array();
		if(empty($query)){
			$this->db->insert('penerimaan',$data);
		}else{
			$tot = $query['JUMLAH'] + $data['JUMLAH'];
			$this->db->query("UPDATE penerimaan set JUMLAH='$tot' where ID_PENERIMAAN='$query[ID_PENERIMAAN]'");
		}
		return 1;
	}
	// menghapus data BAPP
	function deleteBAPP($id){
		$this->db->where('ID_PENERIMAAN',$id);
		$this->db->delete('penerimaan');
		return 1;
	}
	// menyimpan data bukti Pengadaan
	function saveBukti($dataBukti){
		$this->db->insert('bukti_pengadaan',$dataBukti);
		return 1;
	}
	// get Bukti Pengadaan berdasarkan id paket
	function getBuktiById($id){
		$res = $this->db->query("SELECT * FROM bukti_pengadaan WHERE ID_PAKET = '$id'")->result_array();
		return $res;
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
		$query = $this->db->query("SELECT * FROM penerimaan WHERE ID_ALAT = $id ORDER BY TANGGAL_PENERIMAAN")->result_array();
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