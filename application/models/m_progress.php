<?php

class M_progress extends CI_Model {

	function m_progress(){
		parent::__construct();
	}

	//Menyimpan progress usulan
	function saveProgressUsulan($p){
		$query=$this->db->query("INSERT into progress_paket(
			ID_USER,
			ID_FASE,
			ID_USULAN,
			STATUS,
			REVISI_KE,
			TANGGAL
			)values(
			'$p[id_user]',
			'$p[id_fase]',
			'$p[id_usulan]',
			'$p[status]',
			'$p[revisi_ke]',
			CURDATE()
			)");
		return $query;
	}

	// menyimpan data progress paket
	function saveProgressGeneral($data){
		$this->db->insert('progress_paket',$data);
		return 1;
	}

	// mengambil status akhir progress berdasarkan id paket
	function getMaksProgressAlatByPaket($id){
		$query = $this->db->query("SELECT MAX(pp.STATUS) AS ST FROM progress_paket pp WHERE pp.ID_PAKET = '$id'")->row_array();
		return $query;
	}


	// get data progress paket 
	function getProgressPaketByFase($fase){
		$query = $this->db->query("SELECT *,progress_paket.STATUS as STAT from progress_paket,paket WHERE progress_paket.STATUS = '$fase' AND paket.ID_PAKET = progress_paket.ID_PAKET AND ID_PROGRESS_PAKET = (SELECT MAX(ID_PROGRESS_PAKET) from progress_paket where paket.ID_PAKET = progress_paket.ID_PAKET) group by progress_paket.ID_PAKET order by ID_PROGRESS_PAKET DESC")->result_array();
		return $query;
	}
	
		function getProgressAlatByPaket($id){
			$query = $this->db->query("SELECT MAX(pp.STATUS) AS ST, MAX(pp.TANGGAL) AS TGL FROM progress_paket pp WHERE pp.ID_PAKET = '$id'")->row_array();
			return $query;
		}
	/*
	//============Old===========
	function getProgressByUserJurusan($id,$id_jenis){
		$query=$this->db->query("SELECT * from progress_paket where ID_JURUSAN = '$id' AND ID_JENIS_USER='$id_jenis' order by ID_PROGRESS_PAKET DESC")->row_array();
		return $query;
	}




	function getAlatByIdJurusan($id){
		$query = $this->db->query("SELECT * FROM alat a WHERE a.ID_PAKET != '' AND a.ID_JURUSAN = '$id'")->result_array();
		return $query;
	}

	

	function saveProgressGeneral($data){
		$this->db->insert('progress_paket',$data);
		return 1;
	}
	*/
}

?>