<?php

class M_timHps extends CI_Model {

	function m_timHps(){
		parent::__construct();
	}

	function getAllTimHps(){
		$query = $this->db->query("SELECT * from team_hps")->result_array();
		return $query;
	}

	function saveTimHps($p){
		$query = $this->db->query("INSERT into team_hps(
			ID_USER,
			NAMA_TIM,
			LIST_USER_HPS
			)values(
			'$p[id]',
			'$p[namatim]',
			'$p[anggota]'
			)");
		return $query;
	}
}

?>