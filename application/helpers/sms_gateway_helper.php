<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
if ( ! function_exists('SendSMS')){
	function SendSMS($konten,$kontak,$type){
       //get main CodeIgniter object
		$ci =& get_instance();

		$fc .= "gammu sendsms text $kontak -text \"$konten\"\n";
		$myfile = fopen("c:/sms \kirim_".$type."-".date("d-m-y").".bat", "w") or die("Unable to open file!");
		fwrite($myfile, "c: \n cd c:/gammu/bin \n".$fc);
		fclose($myfile);

		exec("c:/sms/kirim_".$type."-".date("d-m-y").".bat");
	}
}