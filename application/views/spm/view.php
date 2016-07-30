<!-- Main Content -->
<?php
$this->load->view("info_header");
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
                  <span class="title">Approve Surat Perintah Membayar</span>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-stripped table-bordered table-hover">
                  <tr class="active">
                    <th>No. Dokumen Paket</th>
                    <th>Tahun</th>
                    <th>Nama Paket</th>
                    <th>Total Anggaran</th>
                    <th>Jumlah Alat</th>
                    <th>Sudah Diterima</th>
                    <th>Belum Diterima</th>
                    <th>Status Konfirmasi</th>
                    <th>Bukti Pengadaan</th>
                    <th>Aksi</th>
                  </tr>
                  <?
                  foreach ($paket as $p) {
                    $maxRev = $this->m_alat->getMaxRevisiPaket($p['ID_PAKET']);
                    $maxAlat = $this->m_alat->getAllJumlahAlatByIdPaket($p['ID_PAKET'],$maxRev);
                    $jmlTrmAlat = $this->m_alat->getAllJumlahPenerimaanAlatByIdPaket($p['ID_PAKET']);
                    $sisaAlat = $maxAlat['maxAlat'] - $jmlTrmAlat['maxTrmAlat'];
                    $statusKonfirmasi =  $this->m_alat->getStatusKonfirmasiByIdPaket($p['ID_PAKET']);
                    ?>
                    <tr>
                      <td><?=$p['ID_PROGRESS_PAKET']?>/PAKET-<?=$p['ID_PAKET']?>/<?=$p['TAHUN_ANGGARAN']?></td>
                      <td><?=$p['TAHUN_ANGGARAN']?></td>
                      <td> <?=$p['NAMA_PAKET']?> </td>
                      <td> Rp. <?=number_format($p['TOTAL_ANGGARAN'],'0',',','.')?> </td>
                      <td><span class="label label-primary" style="font-size: 14px;"><?=$maxAlat['maxAlat']?></span></td>
                      <td><span class="label label-success" style="font-size: 14px;"><?=$jmlTrmAlat['maxTrmAlat']?></span></td>
                      <td><span class="label label-danger" style="font-size: 14px;"><?=$sisaAlat?></span></td>
                      <td><?= ($statusKonfirmasi['c']==0)?'<span class="label label-success">Konfirmasi</span>':'<span class="label label-danger">Belum</span>'?></td>
                      <td><a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalLihatBukti" onclick="setLihatBukti('<?=$p['ID_PAKET']?>')"><i class="fa fa-search" ></i> Lihat Bukti Pengadaan </a></td>
                      <td>
                      <?if($p['STATUS_BAYAR']==0){?>
                      <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalKonfirmasi" onclick="setApproveBukti('<?=$p['ID_PAKET']?>')"><i class="fa fa-check"></i> Approve Pembayaran </a>
                      <?}else{?>
                        <span class="label label-success" style="font-size: 11px;"><i class="fa fa-check"></i> Pembayaran Diapprove</span>
                      <?}?>
                      </td>
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
  <!-- modal lihat bukti pengadaan -->
  <div class="modal fade modal-info" id="modalLihatBukti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel">Bukti Pengadaan</h4>
        </div>
        <div class="modal-body">
          <div class="card">
           <div class="card-body"  style="padding: 0px 20px !important;">
            <div class="sub-title">List Pengadaan</div>
            <div class="tbl-bukti">
              <table class="table table-bordered">
                <tr class="active">
                  <th> Tanggal </th>
                  <th> Bukti Pengadaan </th>
                  <th> Aksi </th>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>

<!-- end lihat bukti pengadan -->

<!-- Modal Konfirmasi -->
<div class="modal fade modal-success" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle"></i> Approve Pembayaran Dokumen Paket</h4>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="<?=base_url()?>SPM/approve" method="POST">
          <input id="idPaket" type="hidden" name="id_paket">
          <h5>Anda Yakin Menyetujui Pembayaran Dokumen Ini ?</h5>


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
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>

<script type="text/javascript">
  function setLihatBukti(a){
    console.log(a);
   $.ajax({
    url: '<?=base_url()?>SPM/getBukti',
    type: "POST",
    data: {id:a},
    success : function(res){
      console.log(res);
      $(".tbl-bukti").html(res);

    }
  })
 }
 function setApproveBukti(a){
   document.getElementById('idPaket').value = a;
 }

</script>
