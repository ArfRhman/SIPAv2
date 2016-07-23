<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class m_timPenerimaan extends CI_Model {

	public function m_timPenerimaan(){
		parent::__construct();
	}

	public function getAllTimPenerimaan(){
		$query = $this->db->query("SELECT * from team_penerima")->result_array();
		return $query;
	}

	function saveTimPenerimaan($p){
		$query = $this->db->query("INSERT into team_penerima(
			ID_USER,
			NAMA_TIM,
			LIST_USER_PENERIMA
			)values(
			'$p[id]',
			'$p[namatim]',
			'$p[anggota]'
			)");
		return $query;
	}

}

?>