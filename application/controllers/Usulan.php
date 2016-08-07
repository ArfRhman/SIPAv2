<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usulan extends CI_Controller {

	public function usulan(){
		parent::__construct();
		$this->load->model("m_usulan");
		$this->load->model("m_pagu");
		$this->load->model("m_lokasi");
		$this->load->model("m_alat");
		$this->load->model("m_kategori");
		$this->load->model("m_progress");
		$this->load->model("m_pegawai");
	}

	// menampilkan halaman awal usulan alat
	public function index(){

		$id_jenis = $this->session->userdata('ID_JENIS_USER');
		$this->load->view('top');
		$id = $this->session->userdata("ID_JURUSAN");
		$tahun = date('Y');
		$data['usulan']=$this->m_usulan->getUsulanByIdJurusan($id,$id_jenis);
		
		//usulan final dipanggil disini sekalian
		$data['final']=$this->m_usulan->getUsulanFinal($id,$tahun);
		$data['usulan_below']=array();
		if($id_jenis==2){
			$usul=$this->m_usulan->getUsulanFromBelow($id);
			foreach($usul as $u){
				if($u['STAT']==11){
					$data['usulan_below'][]=$u;	
				}
			}
		}else if($id_jenis==3){
			$usul=$this->m_usulan->getUsulanFromBelow($id);
			foreach($usul as $u){
				if($u['STAT']==1 || $u['STAT']==22){
					$data['usulan_below'][]=$u;
				}
			}
		}
		$this->load->view('usulan/usulan_view',$data);

	}

	//Menampilkan form add usulan
	public function add(){
		$id = $this->session->userdata("ID_JURUSAN");
		$tahun = date("Y");
		$data['pagu']=$this->m_pagu->getCurrentPaguByIdJurusan($id,$tahun);
		$resKategori=$this->m_kategori->getAllKategori();
		$resLokasi=$this->m_lokasi->getLokasiByIdJurusan($id);
		$lokasi=array();
		$kategori=array();
		foreach($resLokasi as $re){	
			$lokasi[]=$re['NAMA_LOKASI'];
		}
		foreach($resKategori as $ka){
			$kategori[]=$ka['KATEGORI'];
		}
		$data['lokasi']=json_encode($lokasi);
		$data['kategori']=json_encode($kategori);
		$data['final']=$this->m_usulan->getUsulanFinal($id,$tahun);
		$this->load->view('top');
		$this->load->view('usulan/usulan_add',$data);
	}

	//Menyimpan usulan
	public function create(){
		$p=$this->input->post();
		$param=array(
			'id_jurusan'=>$this->session->userdata("ID_JURUSAN"),
			'id_user'=>$this->session->userdata("ID_USER"),
			'nama'=>$p['nama'],
			'total'=>$p['total'],
			'tahun'=>date("Y")
			);
		$res=$this->m_usulan->saveUsulan($param);
		print($res);
		//save alat dipisah ke method saveAlat
	}

	//Save Alat
	public function saveAlat(){
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
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
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
		if($this->session->userdata("ID_JENIS_USER")==3){
			$p['is_final']=1;
		}else{
			$p['is_final']=0;
		}
		
		$this->m_alat->saveAlat($p);
	}

	//Mengambil data revisi berdasarkan Id Usulan
	public function revisi($id){
		$data['revisi'] = $this->m_alat->getAllRevisiByIdUsulan($id);
		$this->load->view("usulan/revisi_view",$data);
	}

	//Menampilkan detail usulan
	public function detail($p,$curr=-1){
		$id_jenis = $this->session->userdata('ID_JENIS_USER');
		$tahun=date("Y");
		$id = $this->session->userdata("ID_JURUSAN");
		$max=$this->m_alat->getMaxRevisi($p);
		
		if($curr==-1){
			$rev=$max['m'];
		}else{
			$rev=$curr;
		}
		$data['pagu']=$this->m_pagu->getPaguByIdJurusan($id);
		$usulan = $this->m_usulan->getUsulanByIdUsulan($p);
		if($this->session->userdata("ID_JENIS_USER")==3){
			$alat = $this->m_alat->getAlatByIdUsulanAndFinal($usulan['ID_USULAN'],$rev,$id);
			$data['totalFinal']=count($alat);
		}else{
			$alat = $this->m_alat->getAlatByIdUsulan($usulan['ID_USULAN'],$rev);
			$data['totalFinal']=1;
		}
		$resKategori=$this->m_kategori->getAllKategori();
		$resLokasi=$this->m_lokasi->getLokasiByIdJurusan($id);
		$lokasi=array();
		foreach($resLokasi as $re){	
			$lokasi[$re['ID_LOKASI']]=$re['NAMA_LOKASI'];
		}
		foreach($resKategori as $ka){
			$kategori[$ka['ID_KATEGORI']]=$ka['KATEGORI'];
		}
		$data['kategori']=json_encode(array_values($kategori));
		$data['lokasi']=json_encode(array_values($lokasi));
		$data['final']=$this->m_usulan->getUsulanFinal($id,$tahun);
		$data['usulan']=$usulan;
		$data['max']=$max;
		if($curr==-1){
			$data['curr']=$max['m'];
		}else{
			$data['curr']=$curr;
		}


		$res[0] = array('NAMA ALAT', 'SPESIFIKASI', 'SETARA', 'SATUAN', 'JUMLAH ALAT', 'HARGA SATUAN', 'TOTAL (Rp)','LOKASI','JUMLAH DISTRIBUSI','REFERENSI TERKAIT','DATA AHLI','PRIORITAS','KATEGORI','KONFIRMASI','PIC','PAKET');
		
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
			if(empty($a['NAMA_PAKET'])){
				$a['NAMA_PAKET']="";
			}
			$res[]=array($a['NAMA_ALAT'], $a['SPESIFIKASI'], $a['SETARA'], $a['SATUAN'], $a['JUMLAH_ALAT'], $a['HARGA_SATUAN'], $a['JUMLAH_ALAT']*$a['HARGA_SATUAN'], $lokasi[$a['ID_LOKASI']],$a['JUMLAH_DISTRIBUSI'],$link." <input name='file[]' type='file'>",$ahli,$a['PRIORITY'],$kategori[$a['ID_KATEGORI']],$a['KONFIRMASI'],$a['NAMA_PEGAWAI'],$a['NAMA_PAKET']);
			
		}
		
		for($i=0;$i<9;$i++){
			$res[]=array('', '', '', '', '', '', '','','',"<input name='file[]' type='file'>",false,'','','','','');
		}
		

		$data['alat']=json_encode($res);
		if($id_jenis==6){
			$data['detailAlat'] = $alat;	
			$data['detailUsulan'] = $usulan;	
			$this->load->view('top');
			$this->load->view("usulan/usulan_detail",$data);
			$this->load->view('bottom');
		}else{
			$this->load->view('top');
			$this->load->view("usulan/usulan_detail",$data);
		}
	}

	//Menyimpan perubahan alat
	public function update(){
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
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		if($p['pic']==""){
			$p['id_user']=$this->session->userdata("ID_USER");	
		}else{
			$id_user=$this->m_pegawai->getUserIdByName($p['pic']);
			$p['id_user']=$id_user['ID_USER'];
		}

		if($p['paket']==""){
			$p['paket']="";
		}else{
			$vaket=$this->m_pengelompokan->getPengelompokanByName($p['paket']);
			$p['paket']=$vaket['ID_PAKET'];
		}

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
		if($this->session->userdata("ID_JENIS_USER")==3){
			$p['is_final']=1;
		}

		$this->m_usulan->updateUsulan($p);
		$this->m_alat->saveUpdateAlat($p);
	}

	//Mengajukan usulan
	function ajukan(){
		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		if($this->session->userdata("ID_JENIS_USER")==1){
			$p['id_fase']=1;	
			$p['status']=11;
			$cek = array('PROGRESS_USULAN'=>array('STATUS'=>11,'ID_USULAN'=> $p['id_usulan'],'REVISI_KE'=>$p['revisi_ke']));
			$this->session->set_userdata($cek); // set session dengan data user
		}else if($this->session->userdata("ID_JENIS_USER")==2){
			$p['id_fase']=1;
			$p['status']=22;
			$cek = array('PROGRESS_USULAN'=>array('STATUS'=>22,'ID_USULAN'=> $p['id_usulan'],'REVISI_KE'=>$p['revisi_ke']));
			$this->session->set_userdata($cek); // set session dengan data user
		}else if($this->session->userdata("ID_JENIS_USER")==3){
			$p['id_fase']=1;
			$p['status']=3;
			$cek = array('PROGRESS_USULAN'=>array('STATUS'=>3,'ID_USULAN'=> $p['id_usulan'],'REVISI_KE'=>$p['revisi_ke']));
			$this->session->set_userdata($cek); // set session dengan data user
		}
		$this->m_progress->saveProgressUsulan($p);

		// $k2 = array('NO_HP'=>$m['NO_HP'], 'KONTEN'=>'[NOTIFIKASI] Segera Masukkan Data Usulan');
		// array_push($konten,$k2);
		// SendSMS($konten,'Konfirmasi_Usulan');

		//$progress=$this->m_progress->getProgressByUserJurusan($p['id_jurusan'],$p['id_jenis_user']);

		redirect("Usulan");
	}

	//Mengkonfirmasi usulan
	function konfirmasi(){
		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['revisi_ke']=$p['revisi']-1;
		if($this->session->userdata("ID_JENIS_USER")==2){
			$p['id_fase']=1;	
			$p['status']=-1;
			$cek = array('PROGRESS_USULAN'=>array('STATUS'=>-1,'ID_USULAN'=> $p['id_usulan'],'REVISI_KE'=>$p['revisi_ke']));
			$this->session->set_userdata($cek); // set session dengan data user
		}if($this->session->userdata("ID_JENIS_USER")==3){
			$p['id_fase']=1;	
			$p['status']=-2;
			$cek = array('PROGRESS_USULAN'=>array('STATUS'=>-2,'ID_USULAN'=> $p['id_usulan'],'REVISI_KE'=>$p['revisi_ke']));
			$this->session->set_userdata($cek); // set session dengan data user
		}
		$this->m_progress->saveProgressUsulan($p);
		
		// $k2 = array('NO_HP'=>$m['NO_HP'], 'KONTEN'=>'[NOTIFIKASI] Segera Masukkan Data Usulan');
		// array_push($konten,$k2);	
		// SendSMS($konten,'Konfirmasi_Usulan');

		redirect("Usulan");
	}

	//Mengubah data alat yg diajukan menjadi data alat yang sudah final
	public function updateFinal(){
		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['revisi_ke']=$p['revisi']-1;

		$this->m_alat->updateFinal($p);
	}

	public function approve(){
		$p=$this->input->post();
		$p['id_user']=$this->session->userdata("ID_USER");
		$p['id_jurusan']=$this->session->userdata("ID_JURUSAN");
		$p['id_jenis_user']=$this->session->userdata("ID_JENIS_USER");
		$p['revisi_ke']=$p['revisi']-1;
		$p['id_fase']=1;	
		$p['status']=2;
		$this->m_progress->saveProgressUsulan($p);
		// $k2 = array('NO_HP'=>$m['NO_HP'], 'KONTEN'=>'[NOTIFIKASI] Segera Masukkan Data Usulan');
		// array_push($konten,$k2);
		// SendSMS($konten,'Konfirmasi_Usulan');
	}

	//===============Tambahan==============

	public function clearFinal(){
		if($this->session->userdata("ID_JENIS_USER")==3){
			$this->m_alat->clearFinal($this->session->userdata("ID_JURUSAN"));
		}
	}
	/*
	//======================Old==============
	

	public function indexPPK(){
		$this->load->view('top');
		$id = $this->session->userdata("ID_JURUSAN");
		$data['usulan']=$this->m_usulan->getUsulanByIdJurusan($id);
		$this->load->view('usulan/usulan_view_ppk',$data);
		$this->load->view('bottom');
	}

	

	

	

	

	//Menampilkan detail usulan verifikasi
	public function detailUsulanVerifikasi($p,$idUser){
		$curr=-1;
		$id_jenis = $this->session->userdata('ID_JENIS_USER');
		$id = $this->session->userdata("ID_JURUSAN");
		$max=$this->m_alat->getMaxRevisi($p);
		if($curr==-1){
			$rev=$max['m'];
		}else{
			$rev=$curr;
		}
		$usulan = $this->m_usulan->getUsulanByIdUsulan($p);
		$alat = $this->m_alat->getAlatByIdUsulan($usulan['ID_USULAN'],$rev);
		$resLokasi=$this->m_lokasi->getLokasiByIdJurusan($id);
		$lokasi=array();
		foreach($resLokasi as $re){	
			$lokasi[$re['ID_LOKASI']]=$re['NAMA_LOKASI'];
		}
		$data['lokasi']=json_encode(array_values($lokasi));
		$data['usulan']=$usulan;
		$data['max']=$max;
		if($curr==-1){
			$data['curr']=$max['m'];
		}else{
			$data['curr']=$curr;
		}

		$res[0] = array('NAMA ALAT', 'SPESIFIKASI', 'SETARA', 'SATUAN', 'JUMLAH ALAT', 'HARGA SATUAN', 'TOTAL (Rp)','LOKASI','JUMLAH DISTRIBUSI','REFERENSI TERKAIT','DATA AHLI','PRIORITAS','KONFIRMASI');
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
			$res[]=array($a['NAMA_ALAT'], $a['SPESIFIKASI'], $a['SETARA'], $a['SATUAN'], $a['JUMLAH_ALAT'], $a['HARGA_SATUAN'], $a['JUMLAH_ALAT']*$a['HARGA_SATUAN'], $lokasi[$a['ID_LOKASI']],$a['JUMLAH_DISTRIBUSI'],$link." <input name='file[]' type='file'>",$ahli,$a['PRIORITY'],'');		
		}
		for($i=0;$i<9;$i++){
			$res[]=array('', '', '', '', '', '', '','','',"<input name='file[]' type='file'>",false,'','');
		}
		//print_r($res);

		$data['alat']=json_encode($res);
		if($id_jenis==6){
			$data['detailAlat'] = $alat;	
			$data['detailUsulan'] = $usulan;	
			$this->load->view('top');
			$this->load->view("usulan/usulan_detail_tim_hps",$data);
			$this->load->view('bottom');
		}else{
			$this->load->view('top');
			$this->load->view("usulan/usulan_detail",$data);
		}
	}

	public function detailUsulanPPK($p){
		// $id = 1;//$this->session->userdata("id_jurusan");
		// $max=$this->m_alat->getMaxRevisi($p);
		// $usulan = $this->m_usulan->getUsulanByIdUsulan($p);
		// $alat = $this->m_alat->getAlatByIdUsulan($usulan['ID_USULAN']);
		// $resLokasi=$this->m_lokasi->getLokasiByIdJurusan($id);
		// $lokasi=array();
		// foreach($resLokasi as $re){	
		// 	$lokasi[$re['ID_LOKASI']]=$re['NAMA_LOKASI'];
		// }
		// $data['lokasi']=json_encode(array_values($lokasi));
		// $data['usulan']=$usulan;
		// $data['max']=$max;
		// $res[0] = array('NAMA ALAT', 'SPESIFIKASI', 'SETARA', 'SATUAN', 'JUMLAH ALAT', 'HARGA SATUAN', 'TOTAL (Rp)','LOKASI','JUMLAH DISTRIBUSI','REFERENSI TERKAIT','DATA AHLI','KONFIRMASI');
		// foreach($alat as $a){
		// 	if($a['DATA_AHLI']==1){
		// 		$ahli = true;
		// 	}else{
		// 		$ahli = false;
		// 	}
		// 	$res[]=array($a['NAMA_ALAT'], $a['SPESIFIKASI'], $a['SETARA'], $a['SATUAN'], $a['JUMLAH_ALAT'], $a['HARGA_SATUAN'], $a['JUMLAH_ALAT']*$a['HARGA_SATUAN'], $lokasi[$a['ID_LOKASI']],$a['JUMLAH_DISTRIBUSI'],"<a target='_blank' href='".base_url()."assets/referensi/".$a['REFERENSI_TERKAIT']."'>aa</a> <input name='file[]' type='file'>",$ahli,'');
		// }
		// for($i=0;$i<9;$i++){
		// 	$res[]=array('', '', '', '', '', '', '','','',"<input name='file[]' type='file'>",false,'');
		// }
		// //print_r($res);
		// $data['alat']=json_encode($res);
		$data['alat']='';
		$this->load->view('top');
		$this->load->view("usulan/usulan_detail_ppk",$data);
		$this->load->view('bottom');
		
	}

	
	

	
	*/

}

?>