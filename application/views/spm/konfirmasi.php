<!-- Main Content -->
<?php
$this->load->view("info_header");
$id_jurusan = $this->session->userdata('ID_JURUSAN');

?>
<div class="app-container-slide">
  <div class="container-fluid">
    <div class="side-body padding-top"  style="padding-top:25px;">

      <div class="row  no-margin-bottom">
        <div class="row">
          <div class="col-xs-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                  <span class="title">Konfrimasi Alat</span>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-stripped table-bordered table-hover">
                  <tr class="active">
                    <th>Nama Alat </th>
                    <th>Spesifikasi</th>
                    <th>Satuan</th>
                    <th>Jumlah</th>
                    <th>Sudah Diterima</th>
                    <th>Waktu Diterima</th>
                    <th>Belum Diterima</th>
                    <th>Aksi</th>
                  </tr>
                  <? 
                  $pnb = $this->db->query('SELECT * FROM penerimaan pn WHERE pn.ID_PAKET = (SELECT MAX(a.ID_PAKET) FROM alat AS a WHERE a.ID_JURUSAN = '.$id_jurusan.')')->result_array(); 
                  foreach ($pnb as $p) {
                    $cekJur = $this->db->query('SELECT *  FROM alat WHERE ID_JURUSAN = '.$id_jurusan.' AND ID_ALAT = '.$p['ID_ALAT'].'')->result_array();
                    if(!empty($cekJur[0]['ID_ALAT'])){ 

                    ?>
                    <td> <?=$cekJur[0]['NAMA_ALAT'] ?></td>
                    <td> <?=$cekJur[0]['SPESIFIKASI'] ?></td> 
                    <td> <?=$cekJur[0]['SATUAN'] ?></td> 
                    <td> <span class="label label-primary" style="font-size: 14px;"><?=$cekJur[0]['JUMLAH_ALAT'] ?></span></td> 
                    <td> <span class="label label-success" style="font-size: 14px;"><?=$p['JUMLAH'] ?></span></td> 
                    <td> <?=$p['TANGGAL_PENERIMAAN'] ?></td> 
                    <td> <span class="label label-danger" style="font-size: 14px;"><?=$cekJur[0]['JUMLAH_ALAT'] - $p['JUMLAH'] ?></span></td> 
                   <td>
                    <? if($p['STATUS_KONFIRMASI']==0){?>
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalKonfirmasi" onclick="setApprovePenerimaan('<?=$p['ID_PENERIMAAN']?>')"><i class="fa fa-check"></i> Approve Penerimaan </a>
                    <?}else{?>
                    <span class="label label-success" style="font-size: 11px;"><i class="fa fa-check"></i> Peenerimaan Diapprove</span>
                    <?}?>
                  </td>
                </tr>
                <?} }?>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>


<!-- Modal Konfirmasi -->
<div class="modal fade modal-success" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle"></i> Approve Penerimaan Alat</h4>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="<?=base_url()?>SPM/confirmPenerimaan" method="POST">
          <input id="idAlat" type="hidden" name="id_penerimaan">
          <h5>Anda Yakin Menyetujui Penerimaan Alat Ini ?</h5>


        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Ya</button>
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Konfirmasi -->

<script type="text/javascript">
  function setApprovePenerimaan(a){
   document.getElementById('idAlat').value = a;
 }

</script>
