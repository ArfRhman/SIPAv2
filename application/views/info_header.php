<?php 
$sess=$this->session->userdata();
$id_jurusan = $this->session->userdata('ID_JURUSAN');
$startDate ='';// $this->m_site->getStartDate(date('Y'));

$fase = '-';
$deadline = '-';
$days = '';
// if($startDate!=''){
//     $startDate = $startDate->tgl;

// // get Fase from date now
//     $dateNow = date('Y-m-d');
//     $setDiff=date_diff(date_create($startDate),date_create($dateNow));
// $dif = $setDiff->format("%a"); // difference date
// $getDeadline = $this->m_site->getDeadline();

// $tot = 0;
// foreach ($getDeadline AS $g) {
//    $tot += $g['WAKTU_PELAKSANAAN'];
//    if($dif <= $tot){
//     $fases = $g['ID_FASE'];
//     break;
// }}
// $this->session->set_userdata('fase', $fases);
// $deadlines = strtotime('+'.$tot.' day',strtotime($startDate));
// $deadline = IndoTgl(date('Y-m-d', $deadlines));
// $secs = $deadlines - strtotime($dateNow);
// $days = ($secs / 86400).' Hari Lagi';
// $fase = $this->m_data->getDataFromTblWhere('fase','ID_FASE',$fases)->row()->NAMA_FASE;
// }

$status="";
// if($sess['ID_JENIS_USER']==1){
//     if($sess['PROGRESS']){
//         if($sess['PROGRESS']['STATUS']==11){
//             $status = "Sudah Mengajukan Usulan <a href='".base_url()."Usulan/DetailUsulan/".$sess['PROGRESS']['ID_USULAN']."/".$sess['PROGRESS']['REVISI_KE']."'>(Lihat)</a>";
//         }else{
//             $status = "<strong  style='color:red'><span><i class='fa fa-exclamation-triangle icon'></i></span></strong> Belum Mengajukan Usulan";
//             if($days <= 3 AND $fases == 1){
//                 $this->m_site->setReminder($sess['ID_USER'],1);
//             }    
//         }
//     }else{
//         $status = "<strong  style='color:red'><span><i class='fa fa-exclamation-triangle icon'></i></span></strong> Belum Mengajukan Usulan";
//         if($days <= 3 AND $fases == 1){
//             $this->m_site->setReminder($sess['ID_USER'],1);
//         }    
//     }
// }else if($sess['ID_JENIS_USER']==2){
//     if($sess['PROGRESS']){
//         if($sess['PROGRESS']['STATUS']==22){
//             $status = "Sudah Mengajukan Usulan <a href='".base_url()."Usulan/DetailUsulan/".$sess['PROGRESS']['ID_USULAN']."/".$sess['PROGRESS']['REVISI_KE']."'>(Lihat)</a>";
//         }else{
//             $status = "<strong  style='color:red'><span><i class='fa fa-exclamation-triangle icon'></i></span></strong> Belum Mengajukan Usulan";
//             if($days <= 3 AND $fases == 1){
//                 $this->m_site->setReminder($sess['ID_USER'],1);
//             }    
//         }
//     }else{
//         $status = "<strong  style='color:red'><span><i class='fa fa-exclamation-triangle icon'></i></span></strong> Belum Mengajukan Usulan";
//          if($days <= 3 AND $fases == 1){
//                 $this->m_site->setReminder($sess['ID_USER'],1);
//             }    
//     }
// }else if($sess['ID_JENIS_USER']==3){
//     if($sess['PROGRESS']){
//         if($sess['PROGRESS']['STATUS']==3){
//             $status = "Sudah Mengajukan Usulan <a href='".base_url()."Usulan/DetailUsulan/".$sess['PROGRESS']['ID_USULAN']."/".$sess['PROGRESS']['REVISI_KE']."'>(Lihat)</a>";
//         }else{
//             $status = "<strong  style='color:red'><span><i class='fa fa-exclamation-triangle icon'></i></span></strong> Belum Mengajukan Usulan";
//              if($days <= 3 AND $fases == 1){
//                $this->m_site->setReminder($sess['ID_USER'],1);
//             }    
//         }
//     }else{
//         $status = "<strong  style='color:red'><span><i class='fa fa-exclamation-triangle icon'></i></span></strong> Belum Mengajukan Usulan";
//          if($days <= 3 AND $fases == 1){
//                 $this->m_site->setReminder($sess['ID_USER'],1);
//             }    
//     }
// }else if($sess['ID_JENIS_USER']==4){
//     $pagu=$this->m_pagu->getPaguByPeriode(date('Y'));
//     // print_r($pagu); die();
//     if(!empty($pagu)){
//         if($pagu[0]['TAHUN_ANGGARAN']){
//          $status = "<strong style='color:green'><span><i class='fa fa-check icon'></i></span></strong> Sudah Membuat Pagu";
//      }else{
//         $status = "<strong style='color:red'><span><i class='fa fa-exclamation-triangle icon'></i></span></strong> Belum Memasukkan Pagu";
//     }
// }else{
//     $status = "<strong style='color:red'><span><i class='fa fa-exclamation-triangle icon'></i></span></strong> Belum Memasukkan Pagu";

// }
// }

?>
<!-- Main Content -->
<div class="app-container-slide" style="
background: white;
border-bottom: 0px;
box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
">
<div class="container-fluid" >
    <div class="side-body padding-top" style="padding-top: 75px;">

        <div class="row  no-margin-bottom">
            <div class="col-xs-6 col-md-5">
               <div class="alert alert-danger" role="alert" style="margin-bottom: 0px;padding: 5px;font-size: 15px;">
                <strong>Deadline : </strong> <?=$deadline?> <b> (<?=$days?>)</b>

            </div>
        </div>
        <div class="col-xs-6 col-md-4 text-right">
        </div>
        <div class="col-xs-6 col-md-3 text-center">
            <div class="alert alert-info" role="alert" style="margin-bottom: 0px;padding: 5px;font-size: 14px;">
                <span><i class="fa fa-clock-o icon"></i></span></span>
                <strong><span id="txtTime"></span> , <?=date('d M Y')?></strong> 
            </div>
        </div>
    </div>
    <div class="row no-margin-bottom">
        <div class="col-xs-6 col-md-4">

            <div class="alert" role="alert" style="margin-bottom: 0px;padding: 5px;font-size: 16px;">
                <strong>Status : </strong><?=$status?> 

            </div>
        </div>
        <div class="col-xs-12 col-md-7 text-right">
            <div class="alert" role="alert" style="margin-bottom: 0px;padding: 5px;font-size: 16px;">
                <strong>Fase : </strong> <?= $fase?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
  function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('txtTime').innerHTML = h + ":" + m + ":" + s;
      var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>