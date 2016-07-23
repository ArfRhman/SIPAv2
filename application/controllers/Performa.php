<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performa extends CI_Controller {

	public function performa(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('top');
		$data['paket']='';
		$this->load->view("performa/performa_view",$data);
		// $this->load->view('bottom');
	}
	public function detailPaket(){
		$this->load->view('top');
		$data['paket']='';
		$this->load->view("performa/paket_detail",$data);
		$this->load->view('bottom');
	}


}

?>