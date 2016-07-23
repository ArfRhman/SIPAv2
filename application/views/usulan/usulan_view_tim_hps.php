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
                                    <span class="title">Pengelolaan Dokumen Paket</span>
                                </div>
                            </div>
                            <div class="card-body">
                               <table class="table table-stripped table-bordered table-hover">
                                    <tr class="active">
                                        <th>No. Dokumen</th>
                                        <!-- <th>Tahun</th> -->
                                        <th>Nama Paket</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Update Terakhir</th>
                                        <th>Total Anggaran</th>
                                        <th>Status</th>
                                        <th style="width: 23%;">Aksi</th>
                                    </tr>
                                    <?php 
                                    foreach($anggaran_usulan as $p){
                                        $noDok = "Paket-".$p['ID_USULAN']."/".$p['TAHUN_ANGGARAN'];
                                        ?>
                                        <tr>
                                            <td><?=$noDok?></td>
                                            <!-- <td><?=$p['TAHUN_ANGGARAN']?></td> -->
                                            <td><?=$p['NAMA_PAKET']?></td>
                                            <td><?=$p['TANGGAL_DIBUAT']?></td>
                                            <td><?=$p['LAST_UPDATE']?></td>
                                            <td><?=number_format($p['TOTAL_ANGGARAN'],'0',',','.')?></td>
                                            <td> - /
                                                <span class="label label-success" style="font-size: 12px;"><i class="fa fa-check"></i> Disetujui</span>
                                                /
                                                <span class="label label-danger" style="font-size: 12px;"><i class="fa fa-warning"></i> Konfirmasi</span>
                                            </td>
                                            <td><a href="#" download class="btn btn-success"><i class="fa fa-download"></i> </a> &nbsp; <a href="<?=base_url()?>Usulan/DetailUsulan/<?=$p['ID_USULAN']?>" class="btn btn-primary"><i class="fa fa-search"></i> Detail </a>
                                          </td>
                                        </tr>
                                        <?php 
                                    }
                                    ?>
                                </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
  <!-- Modal Add Konfirmasi -->
                <div class="modal fade modal-warning" id="modalAddKonfirmasiUsulan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">Konfirmasi Usulan</h4>
                            </div>
                            <div class="modal-body">
                              <div class="card">
                               <div class="card-body"  style="padding: 0px 20px !important;">
                                <form action="<?=base_url()?>Pengelompokan/savePengelompokan" method="POST">
                                    <div class="sub-title">Keterangan</div>
                                    <div>
                                        <textarea class="form-control" placeholder="Masukan Keterangan"></textarea>
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
        <!-- End Modal Add Konfirmasi -->
<!-- Modal Show Revisi -->
<div class="modal fade modal-primary" id="modalLihatRevisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Lihat Revisi Dokumen Usulan</h4>
            </div>
            <div class="modal-body">
              <div class="card">
                 <div class="card-body"  style="padding: 0px 20px !important;">

                    <div class="sub-title">Daftar Data Dokumen Usulan </div>
                    <div>
                        <b>Nomor Dokumen </b>  : - 
                        <table class="table table-bordered table-hovered table-stripped">
                            <tr class="active">
                                <th> Revisi Ke </th>
                                <th> Tanggal </th>
                                <th> PIC </th>
                                <th> Aksi </th>
                            </tr>
                            <tr>
                                <td> 1 </td>
                                <td> 20 May 2016 </td>
                                <td> Manajemen </td>
                                <td> <a href="#" target="_blank"><i class="fa fa-search"></i> Lihat</a> </td>
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
<!-- End Modal Add Pagu -->
<?php
$this->load->view('bottom');
?>
