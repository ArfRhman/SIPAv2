<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('IndoTgl')){
	function IndoTgl($date){
       //get main CodeIgniter object
		$ci =& get_instance();

		$BulanIndo = array("Januari", "Februari", "Maret",
			"April", "Mei", "Juni",
			"Juli", "Agustus", "September",
			"Oktober", "November", "Desember");

		$tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
		$bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
		$tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
		
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
		return($result);
	}
}