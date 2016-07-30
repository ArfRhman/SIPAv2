<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hps extends CI_Controller {

	public function hps(){
		parent::__construct();
		$this->load->model("m_paket");
		$this->load->model("m_alat");
		$this->load->model("m_kategori");
		$this->load->model("m_lokasi");
		$this->load->model("m_jurusan");
		$this->load->model("m_pegawai");
	}

	function index(){
		$this->load->view('top');
		$id=$this->session->userdata("ID_USER");
		$data['paket']=$this->m_paket->getPengelompokanByTim($id);
		$this->load->view("hps/hps_view",$data);
	}

	//Menampilkan detail hps
	public function detail($p,$curr=-1){
		$id_jenis = $this->session->userdata('ID_JENIS_USER');
		$tahun=date("Y");
		$max=$this->m_alat->getMaxRevisiPaket($p);
		if($curr==-1){
			$rev=$max['m'];
		}else{
			$rev=$curr;
		}
		$paket = $this->m_paket->getPaketById($p);
		$alat = $this->m_alat->getAlatByIdPaket($paket['ID_PAKET'],$rev);
		$resKategori=$this->m_kategori->getAllKategori();
		$resLokasi=$this->m_lokasi->getAllLokasi();
		$lokasi=array();
		foreach($resLokasi as $re){	
			$lokasi[$re['ID_LOKASI']]=$re['NAMA_LOKASI'];
		}
		foreach($resKategori as $ka){
			$kategori[$ka['ID_KATEGORI']]=$ka['KATEGORI'];
		}
		$data['kategori']=json_encode(array_values($kategori));
		$data['lokasi']=json_encode(array_values($lokasi));
		$data['paket']=$paket;
		$data['max']=$max;
		if($curr==-1){
			$data['curr']=$max['m'];
		}else{
			$data['curr']=$curr;
		}

		
		$res[0] = array('NAMA ALAT', 'SPESIFIKASI', 'SETARA', 'SATUAN', 'JUMLAH ALAT', 'HARGA SATUAN', 'TOTAL (Rp)','LOKASI','JUMLAH DISTRIBUSI','REFERENSI TERKAIT','DATA AHLI','PRIORITAS','KATEGORI','KONFIRMASI');
		
		foreach($alat as $a){
			if($a['DATA_AHLI']==1){
				$ahli = true;
			}else{
				$ahli = false;
			}
			if($a['REFERENSI_TERKAIT']!=""){
				$link = "<a target='_blank' href='".base_url()."assets/referensi/".$a['REFERENSI_TERKAIT']."'>Referensi</a>";
			}else{
				$link = "";
			}
			
			$res[]=array($a['NAMA_ALAT'], $a['SPESIFIKASI'], $a['SETARA'], $a['SATUAN'], $a['JUMLAH_ALAT'], $a['HARGA_SATUAN'], $a['JUMLAH_ALAT']*$a['HARGA_SATUAN'], $lokasi[$a['ID_LOKASI']],$a['JUMLAH_DISTRIBUSI'],$link." <input name='file[]' type='file'>",$ahli,$a['PRIORITY'],$kategori[$a['ID_KATEGORI']],$a['KONFIRMASI']);
			
		}

		$data['alat']=json_encode($res);
		$this->load->view('top');

		$this->load->view("hps/hps_detail",$data);
	}


	public function updateAlat(){
		//$data="[[\"NAMA BARANG\",\"SPESIFIKASI\",\"SETARA\",\"SATUAN\",\"JUMLAH ALAT\",\"HARGA SATUAN\",\"TOTAL (Rp)\",\"LOKASI\",\"JUMLAH DISTRIBUSI\",\"REFERENSI TERKAIT\",\"DATA AHLI\"],[\"barang\",\"spek\",\"setara\",\"Set\",18,50000,900000,\"RSG\",10,\"<input type='file'>\",\"<input type='checkbox'>\"],[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"<input type='file'>\",\"<input type='checkbox'>\"],[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"<input type='file'>\",\"<input type='checkbox'>\"],[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"<input type='file'>\",\"<input type='checkbox'>\"],[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"<input type='file'>\",\"<input type='checkbox'>\"],[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"<input type='file'>\",\"<input type='checkbox'>\"],[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"<input type='file'>\",\"<input type='checkbox'>\"],[\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\"]]";
		$config['upload_path']   =   "assets/referensi";
		$config['allowed_types'] =   "*"; 
		$config['max_size']      =   "50000";
		$this->load->library('upload',$config);

		if(!$this->upload->do_upload('file')){
			//echo $this->upload->display_errors();
			$finfo['file_name']="";
		}else{
			$finfo=$this->upload->data();
		}
		$p=$this->input->post();
		$lokasi=$this->m_jurusan->getJurusanByNamaLokasi($p['lokasi']);
		$p['id_jurusan']=$lokasi['ID_JURUSAN'];
		$p['id_user']=$this->session->userdata("ID_USER");	
		
		$p['ref']=$finfo['file_name'];
		$lokasi = $this->m_lokasi->getIdLokasiByName($p['id_jurusan'],$p['lokasi']);
		$kategori = $this->m_kategori->getKategoriByName($p['kategori']);
		if(empty($lokasi)){
			$p['id_lokasi']='';
		}else{
			$p['id_lokasi']=$lokasi['ID_LOKASI'];	
		}
		if(empty($kategori)){
			$p['kategori']='';
		}else{
			$p['kategori']=$kategori['ID_KATEGORI'];
		}

		if($p['data_ahli']=='true'){
			$p['data_ahli']=1;
		}else{
			$p['data_ahli']=0;
		}
		$p['is_final']=0;

		$this->m_pengelompokan->updatePengelompokanNoTim($p);
		$this->m_alat->saveUpdateAlatHps($p);
	}

	/*
	public function approve(){

	}
	*/

	public function revisi($id){
		$data['revisi'] = $this->m_alat->getAllRevisiByIdPaket($id);
		$this->load->view("hps/hps_revisi_view",$data);
	}
}

?>