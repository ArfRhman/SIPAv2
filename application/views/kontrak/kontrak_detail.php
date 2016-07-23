<!-- Main Content -->
<?php
//$this->load->view("info_header");
?>
<div class="app-container-slide">
    <div class="container-fluid">
        <div class="side-body padding-top"  style="padding-top:90px;">

            <div class="row  no-margin-bottom">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title" style="width:100%">
                                    <span class="title">Manage Penetapan Kontrak</span>
                                    <a href="<?=site_url()?>Kontrak" class="btn btn-primary pull-right"><i class="fa fa-chevron-left"></i> Kembali </a>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="row">
                                            <span class="col-md-3" style="margin-bottom:5px"><b>No. Dokumen : </b></span>
                                            <span class="col-md-3" style="margin-bottom:5px"> HPS-<?=$paket['ID_PAKET']?>/<?=$paket['TAHUN_ANGGARAN']?></span>

                                            <span class="col-md-3" style="margin-bottom:5px"><b> Total Anggaran :</b></span>
                                            <span class="col-md-3" style="margin-bottom:5px"> Rp. <?= number_format($paket['TOTAL_ANGGARAN'],'0',',','.') ?></span>
                                        </div>

                                        <div class="row">
                                            <span class="col-md-3" style="margin-bottom:5px"><b>Tahun : </b></span>
                                            <span class="col-md-3" style="margin-bottom:5px"> <?=$paket['TAHUN_ANGGARAN']?></span>
                                            <?  $tglHasilLelang = $this->m_lelang->getPaketLelangSuksesById($paket['ID_PAKET']);?>
                                            <span class="col-md-3" style="margin-bottom:5px"><b> Tanggal Hasil Lelang :</b></span>
                                            <span class="col-md-3" style="margin-bottom:5px"> <? $tgl = explode(" ", $tglHasilLelang['TANGGAL']); echo $tgl[0];?></span>
                                        </div>

                                        <div class="row">
                                            <span class="col-md-3" style="margin-bottom:5px"><b>Nama Paket  : </b></span>
                                            <span class="col-md-3" style="margin-bottom:5px"> <?=$paket['NAMA_PAKET']?></span>

                                            <span class="col-md-3" style="margin-bottom:5px"><b> Penyedia :</b></span>
                                            <span class="col-md-3" style="margin-bottom:5px"> <?=$paket['PENYEDIA'].' ('.$paket['WAKTU_PENGADAAN'].') ';?></span>
                                        </div>

                                    </div>

                                </div>
                                <button type="button" class="btn btn-primary btn-info" data-toggle="modal" data-target="#modalAddKontrak">
                                    <i class="fa fa-plus-square"></i>&nbsp; Tambah Dokumen Kontrak
                                </button>
                                <button type="button" class="btn btn-primary btn-primary" data-toggle="modal" data-target="#modalLihatPenyedia">
                                    <i class="fa fa-plus"></i> <i class="fa fa-user"></i>&nbsp; Pilih Penyedia
                                </button>
                                <table class="table table-stripped table-bordered table-hover">
                                    <tr class="active">
                                        <th>No</th>
                                        <th>Dokumen</th>
                                        <th>Keterangan</th>
                                        <th>Di Unggah Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <? $no=1;
                                    foreach ($kontrak as $k) {?>
                                    <tr>
                                        <td> <?=$no; $no++; ?></td>
                                        <td> <a href="<?= base_url()?>assets/kontrak/<?=$k['FILE'] ?>" target="_blank"> Lihat Dokumen </a> </td>
                                        <td><?= $k['KETERANGAN'] ?></td>
                                        <td><?=$this->m_data->getDataFromTblWhere('pegawai', 'NIP', $this->session->userdata('NIP'))->row()->NAMA_PEGAWAI?> (PPK)</td>
                                        <td> <a class="btn btn-warning" onclick="editKontrak('<?= $k['KETERANGAN'] ?>','<?= $k['ID_KONTRAK'] ?>')"
                                            data-toggle="modal" data-target="#modalEditKontrak"><i class="fa fa-pencil"></i> Edit</a> &nbsp; 
                                            <a href="#" class="btn btn-danger" onclick="deleteKontrak('<?= $k['ID_KONTRAK'] ?>');"><i class="fa fa-remove"> </i>Hapus</a> </td>
                                        </tr>
                                        <?}?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Pilih Penyedia -->
                    <div class="modal fade modal-primary" id="modalLihatPenyedia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Pilih Penyedia</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="card">
                                   <div class="card-body"  style="padding: 0px 20px !important;">
                                    <form enctype="multipart/form-data" action="<?=base_url()?>Kontrak/savePenyedia" method="POST">
                                        <input type="hidden" name="id_paket" value="<?=$paket['ID_PAKET']?>">
                                        <input type="hidden" name="statusPenyedia" value="<?=$penyedia['PENYEDIA']?>">
                                        <div class="sub-title">Penyedia</div>
                                        <div>
                                            <select name="penyedia" class="form-control" onChange="setPenyedia(this)">
                                            <option value="">- Pilih Penyedia -</option>
                                                <?if($penyedia['NAMA_A']!=''){?>
                                                <option value="<?=$penyedia['NAMA_A']?>/<?=$penyedia['NPWP_A']?>/<?=$penyedia['ALAMAT_A']?>/<?= $penyedia['TENDER_A']?>" <?=($penyedia['PENYEDIA']==$penyedia['TENDER_A'])?'selected':''?>> <?= $penyedia['TENDER_A']?></option>
                                                <?} if($penyedia['NAMA_B']!=''){?>
                                                <option value="<?=$penyedia['NAMA_B']?>/<?=$penyedia['NPWP_B']?>/<?=$penyedia['ALAMAT_B']?>/<?= $penyedia['TENDER_B']?>" <?=($penyedia['PENYEDIA']==$penyedia['TENDER_B'])?'selected':''?>> <?= $penyedia['TENDER_B']?></option>
                                                 <?} if($penyedia['NAMA_C']!=''){?>
                                                <option value="<?=$penyedia['NAMA_C']?>/<?=$penyedia['NPWP_C']?>/<?=$penyedia['ALAMAT_C']?>/<?= $penyedia['TENDER_C']?>" <?=($penyedia['PENYEDIA']==$penyedia['TENDER_C'])?'selected':''?>> <?= $penyedia['TENDER_C']?></option>
                                            <? }?>
                                            </select>
                                        </div>
                                        <div style="display:none"  id="dataPenyedia">
                                         <div class="sub-title">Nama Yang Menyerahkan : <span id="namaP"> </span></div>
                                         <div class="sub-title">NPWP : <span id="NMPWPP"> </span></div>
                                         <div class="sub-title">Alamat : <span id="AlamatP"> </span></div>
                                         <div class="sub-title">Waktu Pengerjaan</div>
                                         <div class="sub-title">
                                         
                                           <input type="text" class="form-control" style="width:20%" name="hariPengerjaan" placeholder="Hari">
                                           <select name="jenisHari" class="form-control" style="width:40%">
                                            <option value="Hari Kerja" >Hari Kerja </option>
                                            <option value="Hari Kalender"> Hari Kalender</option>
                                        </select>
                                    </div>
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
    <!-- End Modal Pilih Penyedia -->
    <!-- Modal Add kontrak -->
    <div class="modal fade modal-info" id="modalAddKontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Dokumen Kontrak</h4>
                </div>
                <div class="modal-body">
                  <div class="card">
                   <div class="card-body"  style="padding: 0px 20px !important;">
                    <form enctype="multipart/form-data" action="<?=base_url()?>Kontrak/saveKontrak" method="POST">
                        <input type="hidden" name="id_paket" value="<?=$paket['ID_PAKET']?>">
                        <div class="sub-title">Dokumen Kontrak</div>
                        <div>
                            <input type="file" name="fupload" class="form-control">
                        </div>
                        <div class="sub-title">Keterangan</div>
                        <div>
                            <textarea class="form-control" name="keterangan" placeholder="Masukan Keterangan Dokumen"></textarea>
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
<!-- End Modal Add kontrak -->
<!-- Modal Lihat kontrak -->

<div class="modal fade modal-warning" id="modalEditKontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Dokumen Kontrak</h4>
            </div>
            <div class="modal-body">
              <div class="card">
               <div class="card-body"  style="padding: 0px 20px !important;">
                <form enctype="multipart/form-data" action="<?=base_url()?>Kontrak/updateKontrak" method="POST">
                    <input id="frmId" type="hidden" name="id_kontrak" value="">
                    <div class="sub-title">Dokumen Kontrak</div>
                    <div>
                        <input type="file" name="fupload" class="form-control">
                    </div>
                    <div class="sub-title">Keterangan</div>
                    <div>
                        <textarea class="form-control" id="frmKeterangan" name="keterangan" placeholder="Masukan Keterangan Dokumen"></textarea>
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
<!-- End Modal Lihat Pagu -->
<!-- modal del Kontrak -->
<div class="modal fade modal-danger" id="modalDelKontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle"></i> Hapus Data Kontrak</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="<?=base_url()?>Kontrak/deleteKontrak" method="POST">
                    <input id="frmIddel" type="hidden" name="id_kontrak" value="">
                    <h5>Anda Yakin Menghapus Data Ini ?</h5>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ya</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Del Pagu -->
</div>
</div>
</div>

<script type="text/javascript">
    function editKontrak(a,b) {
      document.getElementById('frmKeterangan').value=a;
      document.getElementById('frmId').value=b;
  }
  function deleteKontrak(a){
      document.getElementById('frmIddel').value=a;
      jQuery('#modalDelKontrak').modal('show', {backdrop: 'static'});

  }
  function setPenyedia(a){
    if(a.value!=""){
        document.getElementById('dataPenyedia').style.display='block';
        var data = a.value.split('/');

        document.getElementById('namaP').innerHTML=data[0];
        document.getElementById('NMPWPP').innerHTML=data[1];
        document.getElementById('AlamatP').innerHTML=data[2];
    }else{
        document.getElementById('dataPenyedia').style.display='none';

    }
}

</script>
