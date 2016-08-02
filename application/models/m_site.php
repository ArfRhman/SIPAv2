<?php

class M_site extends CI_Model {

	function m_site(){
		parent::__construct();
	}

	function Auth($u,$p){
		$query = $this->db->query("SELECT * FROM user where username='$u' AND password='$p'")->row_array();
		return $query;
	}

	//Mengambil data id lokasi berdasarkan nama lokasi
	function getIdLokasiByName($id,$name){
		$query = $this->db->query("SELECT ID_LOKASI from lokasi where ID_JURUSAN='$id' AND NAMA_LOKASI = '$name'")->row_array();
		return $query;	
	}

	function getStartDate($thn){
		$date = $this->db->query("SELECT TANGGAL_MULAI AS tgl FROM tahun_anggaran WHERE TAHUN_ANGGARAN = $thn")->row();
		return $date;
	}

	function getDeadline(){
		$date = $this->db->query("SELECT *  FROM fase")->result_array();
		return $date;
	}

	function getFase($thn){
		return 1;
	}

	function setReminder($id,$fase){
		$cek = $this->db->query("SELECT COUNT(id_reminder) AS ID_R FROM reminder WHERE id_user = $id AND id_fase=$fase")->row()->ID_R;
		if($cek==0){
			$data= array('id_user'=>$id,'id_fase'=>$fase,'status_reminder'=>1);
			$this->db->insert('reminder',$data);

		$konten = '[REMINDER] Segera Masukkan Data Usulan';
		// SendSMS($konten,'08997150058','Usulan');
		}
	}

	function getDataKontakManajemenByIdJurusan($idj){
		$query = $this->db->query("SELECT p.NO_HP FROM user AS u, pegawai AS p WHERE u.NIP = p.NIP AND u.ID_JURUSAN = $idj AND u.ID_JENIS_USER = 3");
		return $query;
	}
	
}

?>
