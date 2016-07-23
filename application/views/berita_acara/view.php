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
                                    <span class="title">Mencatat Berita Acara</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-stripped table-bordered table-hover">
                                    <tr class="active">
                                        <th>No. Dokumen</th>
                                        <th>Tahun</th>
                                        <th>Nama Paket</th>
                                        <th>Total Anggaran</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Last Update</th>
                                        <th>BAPP</th>
                                        <th>BAST</th>
                                        <th>Bukti Pengadaan</th>
                                    </tr>
                                    <?foreach ($paket as $p) {?>
                                    <tr>
                                        <td><?=$p['ID_PROGRESS_PAKET']?>//PAKET-<?=$p['ID_PAKET']?>/<?=$p['TAHUN_ANGGARAN']?></td>
                                        <td><?=$p['TAHUN_ANGGARAN']?></td>
                                        <td> <?=$p['NAMA_PAKET']?> </td>
                                        <td> Rp. <?=number_format($p['TOTAL_ANGGARAN'],'0',',','.')?> </td>
                                        <td> <? $tgl = explode(" ", $p['TANGGAL_DIBUAT']); echo $tgl[0];?></td>
                                        <td> <? $tgl = explode(" ", $p['LAST_UPDATE']); echo $tgl[0];?></td>
                                        <td><a href="<?=site_url()?>BeritaAcara/BAPP/<?=$p['ID_PAKET']?>" class="btn btn-info"><i class="fa fa-search"></i> Detail </a></td>
                                        <td>
                                         <!-- <a href="#" class="btn btn-success"><i class="fa fa-plus"></i> Tambah </a> -->
                                         <a href="<?=site_url()?>BeritaAcara/BAST" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i> Lihat </a></td>
                                         <!-- <td><a href="#"><i class="fa fa-search"></i> Detail </a></td> -->
                                         <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalAddBukti" onclick="setAddBukti('<?=$p['ID_PAKET']?>')"><i class="fa fa-plus"></i> Tambah </a></td>
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
 <!-- modal add bukti pengadaan -->
 <div class="modal fade modal-info" id="modalAddBukti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Bukti Pengadaan</h4>
    </div>
    <div class="modal-body">
        <div class="card">
         <div class="card-body"  style="padding: 0px 20px !important;">
          <form enctype="multipart/form-data" action="<?=base_url()?>BeritaAcara/saveBukti" method="POST">
            <input type="hidden" name="id_paket" id="idPkt">
            <div class="sub-title">File Bukti Pengadaan</div>
            <div>
              <input type="file" name="fupload" class="form-control">
          </div>
          <div class="sub-title">Keterangan</div>
          <div>
              <textarea name="ket" class="form-control"></textarea>
          </div>
          <div class="sub-title">List Pengadaan</div>
          <div class="tbl-penerimaan">
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
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>

<!-- end add bukti pengadan -->
<script type="text/javascript">
  function setAddBukti(a){
     document.getElementById('idPkt').value = a;
     $.ajax({
        url: '<?=base_url()?>BeritaAcara/getBukti',
        type: "POST",
        data: {id:a},
        success : function(res){
            console.log(res);
           $(".tbl-penerimaan").html(res);

      }
  })
 }

 function typeInputs(a){
    if(a==1){
        document.getElementById('fileForm').style.display = 'none';
        document.getElementById('manualForm').style.display = 'block';
    }else{
      document.getElementById('fileForm').style.display = 'block';
      document.getElementById('manualForm').style.display = 'none';
  }
}
function typeInputsE(a){
    if(a==1){
        document.getElementById('fileFormE').style.display = 'none';
        document.getElementById('manualFormE').style.display = 'block';
    }else{
      document.getElementById('fileFormE').style.display = 'block';
      document.getElementById('manualFormE').style.display = 'none';
  }


}
</script>
