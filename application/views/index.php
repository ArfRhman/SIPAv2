<?php
$this->load->view("info_header");
?>

<!-- Main Content -->
<div class="app-container-slide">
    <div class="container-fluid">
        <div class="side-body" style="padding-top:45px ;margin-left: 90px;margin-right: 30px">
            <?
            $id_jurusan = $this->session->userdata('ID_JURUSAN');
            $id_jenis = $this->session->userdata('ID_JENIS_USER');
            $this->session->set_userdata('fase', 0);
            $sess=$this->session->userdata();
            
            ?>
            <div class="row  no-margin-bottom">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="title">Progress Pengadaan</span>
                                    <span class="description"></span>
                                </div>
                            </div>
                            <style type="text/css">
                                .flat-blue .pricing-table .pt-header .plan-pricing .pricing {
                                    text-shadow: 0 0px 0px #FFF;
                                }
                            </style>
                            <div class="row no-margin no-gap">
                                <div class="col-sm-2">
                                    <div class="pricing-table red">
                                        <div class="pt-header">
                                            <div class="plan-pricing">
                                                <div class="pricing "><span class="icon fa fa-files-o"></span></div>
                                                <div class="pricing-type">PENGAJUAN USULAN</div>
                                            </div>
                                        </div>
                                        <div class="pt-body">
                                            <h4> <? 
                                                // if($id_jenis== 1 || $id_jenis==2 || $id_jenis==3){
                                                // $usul = $this->m_usulan->getUsulanForFlow($id_jurusan,3);
                                                // foreach ($usul as $u) { ?>
                                                <button type="button" class="btn btn-default btn-shadow" data-toggle="modal" data-target="#modalLihatUsulanFinal"><i class="fa fa-file-text-o"></i> <?=$u['NAMA_PAKET']?></button>
                                                <? //}          } ?>
                                        </h4>
                                        <ul class="plan-detail">
                                            <li>20 Juni 2016 <b>(5 Hari)</b></li>
                                        </ul>
                                    </div>
                                    <div class="pt-footer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="pricing-table blue">
                                    <div class="pt-header">
                                        <div class="plan-pricing">
                                            <div class="pricing"><span class="icon fa fa-money"></span></div>
                                            <div class="pricing-type">VERIFIKASI HPS</div>
                                        </div>
                                    </div>
                                    <div class="pt-body">
                                        <h4>
                                             <? //if($id_jenis== 1 || $id_jenis==2 || $id_jenis==3){
                                            //     $alat = $this->m_progress->getAlatByIdJurusan($id_jurusan);
                                            //     foreach ($alat as $a) {
                                            //         $cekHPS = $this->m_progress->getProgressAlatByPaket($a['ID_PAKET']); 
                                            //         if($cekHPS['ST']==6 || $cekHPS['ST']==7){ ?>
                                                    <button type="button" class="btn btn-default btn-shadow"><i class="fa fa-check-circle"></i> <?=$a['NAMA_ALAT']?></button>
                                                    <? //}  }       }?>
                                        </h4>
                                        <ul class="plan-detail">
                                            <li>-</li>
                                        </ul>
                                    </div>
                                    <div class="pt-footer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="pricing-table yellow">
                                    <div class="pt-header">
                                        <div class="plan-pricing">
                                            <div class="pricing"><span class="icon fa fa-shopping-cart"></span></div>
                                            <div class="pricing-type">PENGADAAN</div>
                                        </div>
                                    </div>
                                    <div class="pt-body">
                                        <h4>
                                           <? //if($id_jenis== 1 || $id_jenis==2 || $id_jenis==3){
                                            // $alat = $this->m_progress->getAlatByIdJurusan($id_jurusan);
                                            // foreach ($alat as $a) {
                                            //     $cekHPS = $this->m_progress->getProgressAlatByPaket($a['ID_PAKET']); 
                                            //     if($cekHPS['ST']==8 || $cekHPS['ST']==9 || $cekHPS['ST']==-9){ ?>
                                                <button type="button" class="btn btn-default btn-shadow"><i class="fa fa-check-circle"></i> <?=$a['NAMA_ALAT']?></button>
                                                <? //}  } } ?>
                                    </h4>
                                    <ul class="plan-detail">
                                        <li>-</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="pricing-table blue">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing"><span class="icon fa fa-check-square"></span></div>
                                        <div class="pricing-type">PENETAPAN KONTRAK</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>
                                        <? //if($id_jenis== 1 || $id_jenis==2 || $id_jenis==3){
                                            // $alat = $this->m_progress->getAlatByIdJurusan($id_jurusan);
                                            // foreach ($alat as $a) {
                                            //     $cekHPS = $this->m_progress->getProgressAlatByPaket($a['ID_PAKET']); 
                                            //     if($cekHPS['ST']==10){ ?>
                                                <button type="button" class="btn btn-default btn-shadow"><i class="fa fa-check-circle"></i> <?=$a['NAMA_ALAT']?></button>
                                                <? //}}  } ?>
                                    </h4>
                                    <ul class="plan-detail">
                                        <li>-</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="pricing-table green">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing"><span class="icon fa fa-compress"></span></div>
                                        <div class="pricing-type">PENERIMAAN</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4> <? //if($id_jenis== 1 || $id_jenis==2 || $id_jenis==3){
                                        // $alat = $this->m_progress->getAlatByIdJurusan($id_jurusan);
                                        // foreach ($alat as $a) {
                                        //     $cekHPS = $this->m_progress->getProgressAlatByPaket($a['ID_PAKET']); 
                                        //     if($cekHPS['ST']==12 ){ ?>
                                            <button type="button" class="btn btn-default btn-shadow"><i class="fa fa-check-circle"></i> <?=$a['NAMA_ALAT']?></button>
                                            <?// } }} ?></h4>
                                    <ul class="plan-detail">
                                        <li>-</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="pricing-table yellow">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing"><span class="icon fa fa-pencil"></span></div>
                                        <div class="pricing-type">PENCATATAN</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>
                                        <? //if($id_jenis== 1 || $id_jenis==2 || $id_jenis==3){
                                            // $alat = $this->m_progress->getAlatByIdJurusan($id_jurusan);
                                            // foreach ($alat as $a) {
                                            //     $cekHPS = $this->m_progress->getProgressAlatByPaket($a['ID_PAKET']); 
                                            //     if($cekHPS['ST']==13){ ?>
                                                <button type="button" class="btn btn-default btn-shadow"><i class="fa fa-check-circle"></i> <?=$a['NAMA_ALAT']?></button>
                                                <?// }} } ?>
                                    </h4>
                                    <ul class="plan-detail">
                                    <li>31 Juni 2016</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-body no-padding">
                        <!--<div class="step card-no-padding">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li role="step" class="plan-pricing <?=($sess['fase']==1)?'active':''?> <?=($sess['fase']>=1)?'step-success':''?>">
                                    <a href="#step1-2" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                        <div class="icon fa fa-files-o"></div>
                                        <div class="step-title">
                                            <div class="title">Pengajuan Usulan</div>
                                        </div>
                                    </a>
                                </li>
                                <li role="step" class="<?=($sess['fase']==2)?'active':''?> <?=($sess['fase']>=2)?'step-success':''?>">
                                    <a href="#step2-2" role="tab" id="step2-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-money"></div>
                                        <div class="step-title">
                                            <div class="title">Verifikasi HPS</div>
                                        </div>
                                    </a>
                                </li>
                                <li role="step">
                                    <a href="#step3-2" role="tab" id="step3-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-shopping-cart"></div>
                                        <div class="step-title">
                                            <div class="title">Pengadaan</div>
                                        </div>
                                    </a>
                                </li>
                                <li role="step">
                                    <a href="#step4-2" role="tab" id="step4-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-check-square"></div>
                                        <div class="step-title">
                                            <div class="title">Penetapan Kontrak</div>
                                        </div>
                                    </a>
                                </li>
                                <li role="step">
                                    <a href="#step5-2" role="tab" id="step5-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-compress"></div>
                                        <div class="step-title">
                                            <div class="title">Penerimaan</div>
                                        </div>
                                    </a>
                                </li>
                                <li role="step">
                                    <a href="#step6-2" role="tab" id="step6-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-pencil"></div>
                                        <div class="step-title">
                                            <div class="title">Pencatatan</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="step1-2" aria-labelledby="home-tab">

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="step2-2" aria-labelledby="profile-tab">
                                <p>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="step3-2" aria-labelledby="dropdown1-tab">
                            <p> 
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="step4-2" aria-labelledby="home-tab">
                        <p>
                    </p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="step5-2" aria-labelledby="home-tab">
                    <p>
                </p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="step6-2" aria-labelledby="home-tab">
                <p>
            </p>
        </div>
    </div>
</div> -->
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

<!-- Modal Show Usulan Final -->
<div class="modal fade modal-info" id="modalLihatUsulanFinal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Dokumen Usulan Final</h4>
    </div>
    <div class="modal-body">
        <div class="card">
           <div class="card-body"  style="padding: 0px 20px !important;">
             <? include 'usulan/usulan_final_view.php'; ?>
         </div>
     </div>
 </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
</div>
</div>
</div>
</div>
<!-- End Modal Usulan Final -->

