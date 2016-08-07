<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performa extends CI_Controller {

	public function performa(){
		parent::__construct();
		$this->load->model('m_performa');
	}

	public function index(){
		$this->load->view('top');
		$performa = $this->m_performa->getAllPerforma(date('Y'));
		$lastPerforma = $this->m_performa->getAllPerforma(date('Y')-1);
		$target=array();
		$aktual=array();
		foreach ($performa as $key=>$d) {
			$a = $d['total']+($d['total']*10/100);
			$target[]=array(
				'name' => $d['NAMA_JURUSAN'],
				'y' => intval($d['pagu']),
				'drilldown' => '1t'
				);
			$aktual[]=array(
				'name' => $d['NAMA_JURUSAN'],
				'y' => intval($a+($a*10/100)),
				'drilldown' => '1t'
				);
			if(empty($lastPerforma[$key]['total'])){
				$performa[$key]['lastTotal']= 0;	
			}else{
				$performa[$key]['lastTotal']= $lastPerforma[$key]['total'];
			}

			if(empty($lastPerforma[$key]['pagu'])){
				$performa[$key]['lastPagu']= 0;
			}else{
				$performa[$key]['lastPagu']= $lastPerforma[$key]['pagu'];
			}
			
			
		}
		$data['target']=json_encode($target);
		$data['realisasi']=json_encode($aktual);
		$data['performa']=$performa;
		//print_r($data['target']);die();
		$this->load->view("performa/performa_view",$data);
		// $this->load->view('bottom');
	}
	public function detailPerforma($id){
		$this->load->view('top');
		$data['alat']=$this->m_performa->getDetailPerforma($id);
		$this->load->view("performa/paket_detail",$data);
		$this->load->view('bottom');
	}


}

?>