<!-- Main Content -->
<?php
//$this->load->view("info_header");
?>
<style type="text/css">
  flat-blue .table .active td, .flat-blue .table .active th {
    vertical-align: middle;
  }
</style>
<div class="app-container-slide">
  <div class="container-fluid">
    <div class="side-body padding-top"  style="padding-top:90px;">
     <div class="row  no-margin-bottom">
      <div class="row">
        <div class="col-xs-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title" style="width:100%">
                <span class="title">Manage BAPP</span>
                <a href="<?=site_url()?>BeritaAcara" class="btn btn-primary pull-right"><i class="fa fa-chevron-left"></i> Kembali </a>

              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <?// print_r($p)?>
                <div class="col-md-7">
                  <div class="row">

                    <span class="col-md-3" style="margin-bottom:5px"><b>No. Dokumen : </b></span>
                    <span class="col-md-3" style="margin-bottom:5px"> PAKET-<?=$p['ID_PAKET']?>/<?=$p['TAHUN_ANGGARAN']?></span>

                    <span class="col-md-3" style="margin-bottom:5px"><b> Total Anggaran :</b></span>
                    <span class="col-md-3" style="margin-bottom:5px"> Rp. <?=number_format($p['TOTAL_ANGGARAN'],'0',',','.')?></span>
                  </div>

                  <div class="row">
                    <span class="col-md-3" style="margin-bottom:5px"><b>Tahun : </b></span>
                    <span class="col-md-3" style="margin-bottom:5px"> <?=$p['TAHUN_ANGGARAN']?></span>

                    <span class="col-md-3" style="margin-bottom:5px"><b> Tanggal Dibuat :</b></span>
                    <span class="col-md-3" style="margin-bottom:5px"> <? $tgl = explode(" ", $p['TANGGAL_DIBUAT']); echo $tgl[0];?></span>
                  </div>

                  <div class="row">
                    <span class="col-md-3" style="margin-bottom:5px"><b>Nama Paket  : </b></span>
                    <span class="col-md-3" style="margin-bottom:5px"> <?=$p['NAMA_PAKET']?></span>

                    <span class="col-md-3" style="margin-bottom:5px"><b> Last Update :</b></span>
                    <span class="col-md-3" style="margin-bottom:5px"> <? $tgl = explode(" ", $p['LAST_UPDATE']); echo $tgl[0];?></span>
                  </div>

                </div>

              </div>
              <?
              $maxTgl = $this->m_beritaacara->cekTglPenerimaan($p['ID_PAKET']);
              ?>
              <table class="table table-stripped table-bordered table-hover">
                <tr class="active">
                  <th rowspan="2">Nama Barang</th>
                  <th rowspan="2">Spesifikasi</th>
                  <th rowspan="2">Setara</th>
                  <th rowspan="2">Satuan</th>
                  <th rowspan="2">Jumlah</th>
                  <th colspan="<?= ($maxTgl['c']!=0)?$maxTgl['c']*2:'2'?>"  style="text-align:center"> Pemeriksaan</th>
                  <th rowspan="2">Jumlah Penerimaan</th>
                  <th rowspan="2">Aksi</th>
                </tr>
                <tr class="active">
                  <?for ($i=0; $i < $maxTgl['c']; $i++) { ?>
                  <th style="border-left: 2px solid #ccc;">Tanggal</th >
                    <th>Jumlah</th>
                    <? }  
                    if($maxTgl['c'] == 0) {?>
                    <th style="border-left: 2px solid #ccc;">Tanggal</th >
                      <th>Jumlah</th>
                      <? } ?>

                    </tr>
                    <?
                    foreach ($alat as $a) {
                      $tanggalPemeriksaan = $this->m_beritaacara->getTglPenerimaanByIdAlat($a['ID_ALAT']);
                      $jm = 0;
                      $c = 0;
                      ?>
                      <tr>
                        <td><?=$a['NAMA_ALAT']?></td>
                        <td><?=$a['SPESIFIKASI']?></td>
                        <td><?=$a['SETARA']?></td>
                        <td><?=$a['SATUAN']?></td>
                        <td><?=$a['JUMLAH_ALAT']?></td>
                        <? foreach ($tanggalPemeriksaan as $t) {?>
                        <td style="border-left: 2px solid #ccc;">
                          <a href="#" data-toggle="tooltip" data-placement="left" data-html="true" title="Ket : <?= $t['KETERANGAN']?>">
                            <? $tgl = explode(" ", $t['TANGGAL_PENERIMAAN']); echo $tgl[0];?>
                          </a>
                        </td>
                        <td ><?=$t['JUMLAH']?></td>
                        <? 
                        $jm += $t['JUMLAH']; 
                        $c++;
                      }


                      if($c < $maxTgl['c']){
                        $mx = $maxTgl['c'] - $c;
                        for ($i=0; $i < $mx; $i++) { ?>
                        <td style="border-left: 2px solid #ccc;"> - </td>
                        <td> - </td>
                        <? }}
                        if($maxTgl['c'] == 0) {?>
                        <td style="border-left: 2px solid #ccc;"> - </td>
                        <td> - </td>
                        <? } ?>
                        <td> <?= $jm ?> </td>
                        <td><a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalAddPenerimaan" onclick="setAddPenerimaan('<?=$a['ID_ALAT']?>','<?=$p['ID_TEAM_PENERIMA']?>','<?=$p['ID_PAKET']?>')"><i class="fa fa-plus"></i> Tambah </a></td>

                      </tr>
                      <?}?>
                    </table>


                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- modal add tanggal pemeriksaan -->
    <div class="modal fade modal-info" id="modalAddPenerimaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Data Penerimaan Alat</h4>
          </div>
          <div class="modal-body">
            <div class="card">
             <div class="card-body"  style="padding: 0px 20px !important;">
              <form enctype="multipart/form-data" action="<?=base_url()?>BeritaAcara/saveBAPP" method="POST">
                <input type="hidden" name="id_alat" id="id_alat">
                <input type="hidden" name="id_tim" id="id_tim">
                <input type="hidden" name="id_paket" id="id_paket">
                <div class="sub-title">Jumlah Barang</div>
                <div>
                  <input type="text" name="jml" class="form-control">
                </div>
                <div class="sub-title">Keterangan</div>
                <div>
                  <textarea name="ket" class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
          </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- end add tanggal pemeriksaan -->
  <script type="text/javascript">
    function setAddPenerimaan(a,b,c) {
      document.getElementById('id_alat').value = a;
      document.getElementById('id_tim').value = b;
      document.getElementById('id_paket').value = c;
    }

  </script>