<?php

class M_buktipengadaan extends CI_Model {

	function M_buktipengadaan(){
		parent::__construct();
	}

	//Mengambil data bukti pengadaan berdasarkan id paket
	function getBuktiByIdPaket($id){
		$query = $this->db->query("SELECT * from bukti_pengadaan where ID_PAKET = '$id'")->result_array();
		return $query;
	}

	//Menyimpan data bukti pengadaan
	function saveBuktiPengadaan($dataBukti){
		$this->db->insert('bukti_penerimaan',$dataBukti);
		return 1;
	}

	//Menghapus data bukti pengadaan
	function deleteBuktiPengadaan($id){
		$this->m_beritaacara->deleteBukti($id);
		redirect($_SERVER['HTTP_REFERER']);
	}

}

?>