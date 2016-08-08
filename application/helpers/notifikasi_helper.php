<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
if ( ! function_exists('SendSMS')){
	function SendSMS($data,$type){
       //get main CodeIgniter object
		$ci =& get_instance();
		
		$fc = '';
		foreach ($data as $k=> $value) {
			foreach ($value as $v) {
				$fc .= "gammu sendsms text ".$v['NO_HP']." -text \"".$v['KONTEN']."\" \n";
			}
		}
		$myfile = fopen("c:/sms \kirim_".$type."-".date("d-m-y").".bat", "w") or die("Unable to open file!");
		fwrite($myfile, "c: \n cd c:/gammu/bin \n".$fc);
		fclose($myfile);

		// exec("c:/sms/kirim_".$type."-".date("d-m-y").".bat");
	}
}
if ( ! function_exists('NotifWeb')){
	function NotifWeb($data,$type){
       //get main CodeIgniter object
		
	}
}