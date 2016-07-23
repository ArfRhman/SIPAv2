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
                                    <span class="title">Manage Penetapan Kontrak</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-stripped table-bordered table-hover">
                                <tr class="active">
                                    <th>No. Dokumen</th>
                                    <th>Nama Paket</th>
                                    <th>Tahun</th>
                                    <th>Total Anggaran</th>
                                    <th>Tanggal Hasil Lelang</th>
                                    <th>Penyedia</th>
                                    <th>Dokumen Kontrak</th>
                                    </tr>
                                    <?php 
                                    foreach($paket as $p){
                                        $tglHasilLelang = $this->m_lelang->getPaketLelangSuksesById($p['ID_PAKET']);
                                        ?>
                                        <tr>
                                            <td><?=$p['ID_PROGRESS_PAKET']?>// PAKET-<?=$p['ID_PAKET']?>/<?=$p['TAHUN_ANGGARAN']?></td>
                                            <td> <?=$p['NAMA_PAKET']?> </td>
                                            <td> <?=$p['TAHUN_ANGGARAN']?> </td>
                                            <td> Rp. <?=number_format($p['TOTAL_ANGGARAN'],'0',',','.')?> </td>
                                            <td> <? $tgl = explode(" ", $tglHasilLelang['TANGGAL']); echo $tgl[0];?></td>
                                            <td> <?=$this->m_data->getDataFromTblWhere('team_penerima', 'ID_TEAM_PENERIMA', $p['ID_TEAM_PENERIMA'])->row()->NAMA_TIM?></td>
                                            <td><a href="<?=base_url()?>Kontrak/detail/<?=$p['ID_PAKET']?>" class="btn btn-primary"><i class="fa fa-file-text"></i> &nbsp; Lihat Kontrak</a></td>
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
