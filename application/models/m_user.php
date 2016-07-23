<?php

class M_user extends CI_Model {

	function m_user(){
		parent::__construct();
	}

	function saveUserFromTim($p){
		$query = $this->db->query("INSERT into user(
			ID_JENIS_USER,
			ID_JURUSAN,
			USERNAME,
			PASSWORD
			)values(
			'6',
			'0',
			'$p[username]',
			MD5('$p[password]')
			)");
		return $this->db->insert_id();
	}

	function saveUserFromTimPenerima($p){
		$query = $this->db->query("INSERT into user(
			ID_JENIS_USER,
			ID_JURUSAN,
			USERNAME,
			PASSWORD
			)values(
			'8',
			'0',
			'$p[username]',
			MD5('$p[password]')
			)");
		return $this->db->insert_id();
	}
}

?>