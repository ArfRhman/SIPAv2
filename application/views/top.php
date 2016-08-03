<!DOCTYPE html>
<html>
<? if(!$this->session->userdata('USERNAME')){
    redirect(site_url());
}else{
    $id_jurusan = $this->session->userdata('ID_JURUSAN');
    $id_jenis = $this->session->userdata('ID_JENIS_USER');
    $nip = $this->session->userdata('NIP');
}?>
<head>
    <title>SIPA POLBAN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/css/select2.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/themes/flat-blue.css">

    <style type="text/css">
       .navbar {
        padding-left: 0px;
    }
    .navbar .navbar-breadcrumb > li {
        font-size: 1.9em;
    }
    .app-containers .content-container .side-menu .navbar-nav li a .title {
        font-size: 15px;
    }
    .app-containers .content-container .side-menu .navbar-nav li.dropdown ul li a {
        font-size: 15px;
    }
    .flat-blue .side-menu.sidebar-inverse .navbar li {
        margin-bottom: 15px;
    }
    .flat-blue .navbar, .flat-blue .navbar.navbar-default {
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
    }
    .btn-shadow{
        box-shadow: 4px 4px 2px -3px rgba(0, 0, 0, 0.61);
        margin-right: 1.5%;
    }
    .table tbody tr td a.btn {
        padding: 3px 10px;
        margin: 0;
    }
    .table tbody tr td{
        vertical-align: middle;
    }
    .card .card-body button.btn{
        margin-top: -1%;
        margin-bottom: 1%;
    }
    .card .card-body a.btn{
        margin-top: -1%;
        margin-bottom: 1%;
    }
    .card .card-body .sub-title {
        font-size: 1.2em;
        padding: 0.5em 0em 0.4em 0em;
        margin-bottom: 10px;
    }
    .card .card-title a.btn{
        padding: 3px 10px;
        margin: 0;
    }
    .flat-blue a {
        color: #2196F3;
    }
    .card .card-body a#addRow{
        margin-top: -1%;
        margin-bottom: 2%;
    }
</style>
<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/grafik_dashboard.css"> -->

</head>
<body class="flat-blue" onload="startTime()">
    <div class="app-containers">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header" style="padding: 5px 0px;">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <ol class="breadcrumb navbar-breadcrumb" style="background: url(<?php echo base_url()?>/assets/img/opl.png) no-repeat;background-size: contain;padding-left: 70px;">
                            <li class="active">Sistem Informasi Pengadaan Alat</li>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                        <li class="dropdown danger">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-exclamation-circle icon" style=" font-size: 25px;"></i> 
                                <span style="font-size: 15px;font-weight: bold;"></span></a>
                                <ul class="dropdown-menu danger  animated fadeInDown" style="margin-top:10px">
                                    <li class="title">
                                        Notifikasi <span class="badge pull-right"></span>
                                    </li>
                                    <? 
                                    $startDate = $this->m_site->getStartDate(date('Y'));


                                    $notifPagu = 0;
                                    if($startDate!=""){
                                        $notifPagu = 1;
                                    }
                                    ?>
                                    <li>
                                        <ul class="list-group notifications">

                                          <?
                                          // notif pagu telah dibuat oleh pd2
                                          if($notifPagu){?>
                                          <a href="<?=site_url()?>">
                                            <li class="list-group-item">
                                                <span class="badge"></span> <i class="fa fa-money"></i> Pagu Telah Dibuat
                                            </li>
                                        </a>
                                        <?}?>
                                        <?
                                        // notif untuk teknisi ,konfirmasi dari kalab berdasarkan usulan yang dibuat oleh teknisi
                                        if($id_jenis==1){
                                            $usul=$this->m_usulan->getUsulanFromBelow($id_jurusan);
                                            if(isset($usul[0])){
                                                if($usul[0]['STAT']==-1){?>
                                                <a href="<?=site_url()?>">
                                                    <li class="list-group-item">
                                                        <span class="badge"></span> <i class="fa fa-file-text-o"></i> Konfirmasi Usulan
                                                    </li>
                                                </a>
                                                <? } }
                                            }?>
                                            <?
                                             // notif untuk kalab , verifikasi usulan berdasarkan usulan yang dibuat oleh teknisi
                                            if($id_jenis==2){
                                                $usul=$this->m_usulan->getUsulanFromBelow($id_jurusan);
                                                if(isset($usul[0])){
                                                    if($usul[0]['STAT']==11){?>
                                                    <a href="<?=site_url()?>">
                                                        <li class="list-group-item">
                                                            <span class="badge"></span> <i class="fa fa-file-text-o"></i> Verifikasi Usulan
                                                        </li>
                                                    </a>
                                                    <? } }
                                                }?>
                                                <?
                                                 // notif untuk manajemen , verifikasi usulan berdasarkan usulan yang diajukan oleh kalab
                                                if($id_jenis==3){
                                                    $usul=$this->m_usulan->getUsulanFromBelow($id_jurusan);
                                                    if(isset($usul[0])){
                                                        if($usul[0]['STAT']==1 || $usul[0]['STAT']==22){?>
                                                        <a href="<?=site_url()?>">
                                                            <li class="list-group-item">
                                                                <span class="badge"></span> <i class="fa fa-file-text-o"></i> Verifikasi Usulan
                                                            </li>
                                                        </a>
                                                        <? } }
                                                    }?>
                                                    <? 
                                                    // notif unuk pihak jurusan, usulan final telah dibuat
                                                    if($id_jenis== 1 || $id_jenis==2 || $id_jenis==3 ){
                                                        $usul=$this->m_usulan->getUsulanFromBelow($id_jurusan);
                                                        if(isset($usul[0])){
                                                            if($usul[0]['STAT']==3){?>
                                                            <a href="<?=site_url()?>">
                                                                <li class="list-group-item">
                                                                    <span class="badge"></span> <i class="fa fa-file-text-o"></i> Usulan Final Telah Dibuat
                                                                </li>
                                                            </a>
                                                            <? }
                                                        }
                                                    }?>
                                                    <? if($id_jenis== 5){
                                                        $usul=$this->m_usulan->getUsulanFinalJurusan(3);
                                                        $jmlUsul = count($usul);
                                                        if($jmlUsul!=0){?>
                                                        <a href="<?=site_url()?>Pengelompokan">
                                                            <li class="list-group-item">
                                                                <span class="badge"><?= $jmlUsul ?></span> <i class="fa fa-file-text-o"></i> Usulan Final Telah Dibuat
                                                            </li>
                                                        </a>
                                                        <?}
                                                    }?>
                                                    <? if($id_jenis== 3 || $id_jenis== 5 || $id_jenis== 6){
                                                        $usul=$this->m_progress->getProgressPaketByFase(5);
                                                        $jmlUsul = count($usul);
                                                        if($jmlUsul!=0){?>
                                                        <a href="<?=site_url()?>">
                                                            <li class="list-group-item">
                                                                <span class="badge"><?= $jmlUsul ?></span> <i class="fa fa-files-o"></i> Dokumen Telah Dikelompokan
                                                            </li>
                                                        </a>
                                                        <? } } ?>
                                                        <? if($id_jenis== 3 || $id_jenis== 5){
                                                            $usul=$this->m_progress->getProgressPaketByFase(6);
                                                            $jmlUsul = count($usul);
                                                            if($jmlUsul!=0){?>
                                                            <a href="<?=site_url()?>">
                                                                <li class="list-group-item">
                                                                    <span class="badge"><?= $jmlUsul ?></span> <i class="fa fa-check"></i> HPS Telah Dibuat
                                                                </li>
                                                            </a>
                                                            <? } } ?>
                                                            <a href="#">
                                                                <li class="list-group-item message">
                                                                   Lihat Semua
                                                               </li>
                                                           </a>
                                                       </ul>
                                                   </li>
                                               </ul>
                                           </li>
                                           <li class="dropdown profile">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="
                                            line-height: 25px;
                                            padding-top: 10px;
                                            text-align: center;
                                            font-size: 15px;
                                            "><span >
                                            <?= $this->m_data->getDataFromTblWhere('jenis_user', 'ID_JENIS_USER', $id_jenis)->row()->NAMA_JENIS_USER ?>
                                            <br> 
                                            <? $nama_jur = $this->m_data->getDataFromTblWhere('jurusan', 'ID_JURUSAN', $id_jurusan)->row()->NAMA_JURUSAN;
                                            if($nama_jur!=''){?>
                                            <b>( <?= $nama_jur ?> )</b> </span> 
                                            <?}?>
                                            <span class="caret"></span></a>
                                            <ul class="dropdown-menu animated fadeInDown" style="margin-top:10px">
                                <!-- <li class="profile-img" style="width: 100px;margin: auto;">
                                    <img src="<?php echo base_url()?>/assets/img/profile/1.jpg" class="profile-img">
                                </li> -->
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username">
                                            <?php if($this->session->userdata("ID_JENIS_USER")!=6){ ?>
                                            <?=$this->m_data->getDataFromTblWhere('pegawai', 'NIP', $nip)->row()->NAMA_PEGAWAI?>
                                            <?php } ?>
                                        </h4>
                                        <p><?=$this->session->userdata('EMAIL')?></p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                            <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button>
                                            <a href="<?=site_url()?>Site/logout" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="side-menu sidebar-inverse" style="margin-top: 70px;">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <div class="icon "><i class="fa fa-long-arrow-right"></i></div>
                                <div class="title"> Menu </div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>

                        <ul class="nav navbar-nav" style="font-size: 20px;">
                           <? if($id_jenis==1 || $id_jenis==2 || $id_jenis==3){ ?>
                           <li class="list <?= ($this->uri->segment(1)=='Dashboard')?'active':''; ?>">
                            <a href="<?=base_url()?>Dashboard">
                                <span class="icon fa fa-tasks"></span><span class="title">Progress Paket 
                            </span>
                        </a>
                    </li>
                    <?}?>
                    <? if($id_jenis==4){ ?>
                    <li class="list <?= ($this->uri->segment(1)=='Pagu')?'active':''; ?>">
                        <a href="<?=base_url()?>Pagu">
                            <span class="icon fa fa-money"></span><span class="title">Pagu</span>
                        </a>
                    </li>
                    <? } ?>
                    <? if($id_jenis==5){ ?>
                    <li class="list <?= ($this->uri->segment(1)=='Pengelompokan')?'active':''; ?>">
                        <a href="<?=base_url()?>Paket">
                            <span class="icon fa fa-list-alt"></span><span class="title">Pengelompokan</span>
                        </a>
                    </li>
                    <? } ?>
                    <? if($id_jenis==1 || $id_jenis==2 || $id_jenis==3){ ?>
                    <li class="list <?= ($this->uri->segment(1)=='Usulan')?'active':''; ?>">
                        <a href="<?=base_url()?>Usulan">
                            <? if($id_jenis==6 || $id_jenis==5){ ?>
                            <span class="icon fa fa-file-text-o"></span><span class="title">Dokumen Paket</span>
                            <?}else{?>
                            <span class="icon fa fa-file-text-o"></span><span class="title">Usulan</span>
                            <?}?>
                        </a>
                    </li>
                    <? } ?>
                    <? if($id_jenis==1){ ?>
                    <li class="list <?= ($this->uri->segment(1)=='Pencatatan')?'active':''; ?>">
                        <a href="<?=base_url()?>Pencatatan">
                            <span class="icon fa fa-pencil"></span><span class="title">Pencatatan</span>
                        </a>
                    </li>
                    <? } ?>

                    <? if($id_jenis==7){ ?>
                    <li class="list <?= ($this->uri->segment(1)=='Lelang')?'active':''; ?>">
                        <a href="<?=base_url()?>Lelang">
                            <span class="icon fa fa-shopping-cart"></span><span class="title">Lelang</span>
                        </a>
                    </li>
                    <? } ?>
                    <? if($id_jenis==5){ ?>
                    <li class="list <?= ($this->uri->segment(1)=='Kontrak')?'active':''; ?>">
                        <a href="<?=base_url()?>Kontrak">
                            <span class="icon fa fa-check-square"></span><span class="title">Kontrak</span>
                        </a>
                    </li>    
                    <? } ?>
                    <? if($id_jenis==8){ ?>
                    <li class="list <?= ($this->uri->segment(1)=='BeritaAcara')?'active':''; ?>">
                        <a href="<?=base_url()?>BeritaAcara">
                            <span class="icon fa fa-file-text"></span><span class="title">Berita Acara</span>
                        </a>
                    </li> 
                    <? } ?>
                    
                    <? if($id_jenis==6){ ?>    
                    <li class="list <?= ($this->uri->segment(1)=='HPS')?'active':''; ?>">
                        <a href="<?=base_url()?>HPS">
                            <span class="icon fa fa-file-text-o"></span><span class="title">HPS</span>
                        </a>
                    </li>   
                    <? } ?>
                    <? if($id_jenis==9){ ?>    
                    <li class="list <?= ($this->uri->segment(1)=='SPM')?'active':''; ?>">
                        <a href="<?=base_url()?>SPM">
                            <span class="icon fa fa-list-alt"></span><span class="title">SPM</span>
                        </a>
                    </li>   
                    <? } ?>
                    <? if($id_jenis==10){ ?>  
                    <li class="list <?= ($this->uri->segment(1)=='Performa')?'active':''; ?>">
                        <a href="<?=base_url()?>Performa">
                            <span class="icon fa fa-bar-chart"></span><span class="title">Performa Serapan</span>
                        </a>
                    </li>  
                    <? } ?>  
                    <? if($id_jenis==11){ ?>  
                    <li class="list <?= ($this->uri->segment(1)=='TimHPS')?'active':''; ?>">
                        <a href="<?=base_url()?>TimHPS">
                            <span class="icon fa fa-user-plus"></span><span class="title">Tim HPS</span>
                        </a>
                    </li>   
                    <li class="list <?= ($this->uri->segment(1)=='TimPenerimaan')?'active':''; ?>">
                        <a href="<?=base_url()?>TimPenerimaan">
                            <span class="icon fa fa-user-plus"></span><span class="title">Tim Penerimaan</span>
                        </a>
                    </li>  
                    <? } ?>  
                    <? if($id_jenis==99){ ?>  
                    <li class="list <?= ($this->uri->segment(1)=='Jurusan')?'active':''; ?>">
                        <a href="<?=base_url()?>Jurusan">
                            <span class="icon fa fa-file-o"></span><span class="title">Data Jurusan</span>
                        </a>
                    </li>  
                    <li class="list <?= ($this->uri->segment(1)=='Lokasi')?'active':''; ?>">
                        <a href="<?=base_url()?>Lokasi">
                            <span class="icon fa fa-file-o"></span><span class="title">Data Lokasi</span>
                        </a>
                    </li>  
                    <li class="list <?= ($this->uri->segment(1)=='Pegawai')?'active':''; ?>">
                        <a href="<?=base_url()?>Pegawai">
                            <span class="icon fa fa-file-o"></span><span class="title">Data Pegawai</span>
                        </a>
                    </li>  
                    <? } ?>  
                    <? 
                    // sss
                    $pnb = $this->db->query('SELECT * FROM penerimaan pn WHERE pn.ID_PAKET = (SELECT MAX(a.ID_PAKET) FROM alat AS a WHERE a.ID_JURUSAN = 1)')->row(); 
                    if($id_jenis==3 /*AND (!empty($pnb->ID_ALAT))*/){ ?>  
                    <li class="list <?= ($this->uri->segment(2)=='KonfirmasiAlat')?'active':''; ?>">
                        <a href="<?=base_url()?>SPM/KonfirmasiAlat">
                            <span class="icon fa fa-check"></span><span class="title">Konfirmasi Alat</span>
                        </a>
                    </li>  
                    <? } ?>
                    <!-- Dropdown-->
                           <!--  <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#component-example">
                                    <span class="icon fa fa-cubes"></span><span class="title">Components</span>
                                </a>
                                 Dropdown level 1
                                <div id="component-example" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="components/pricing-table.html">Pricing Table</a>
                                            </li>
                                            <li><a href="components/chartjs.html">Chart.JS</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li> -->
                            
                            
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
            <?php //include 'second-top.php';

