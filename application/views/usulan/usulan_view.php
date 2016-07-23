<!-- Main Content -->
<?php
$this->load->view("info_header");
?>
<div class="app-container-slide">

  <div class="container-fluid">
    <div class="side-body padding-top"  style="padding-top:25px;">
  <?
   $id_jurusan = $this->session->userdata('ID_JURUSAN');
    $id_jenis = $this->session->userdata('ID_JENIS_USER');
  if($id_jenis== 1 || $id_jenis==2 || $id_jenis==3 || $id_jenis== 5){
    // $usul = $this->m_usulan->getUsulanFromBelow($id_jurusan);
    // echo $usul[0]['STAT'];
  }
  ?>
      <div class="row  no-margin-bottom">
        <div class="row">
          <div class="col-xs-12">
           <div class="card">
            <div role="tabpanel">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active">
                 <a href="#usulan" aria-controls="rd" role="tab" data-toggle="tab">Usulan Pengadaan</a></li>
                 <? if($this->session->userdata('ID_JENIS_USER') == 2 || $this->session->userdata('ID_JENIS_USER') == 3){?>
                 <li role="presentation" ><a href="#verusulan" aria-controls="verusulan" role="tab" data-toggle="tab">Verifikasi Usulan 
                 <?php //if(!empty($usulan_below)){?><span class="badge danger">!</span><?php //} ?> </a></li>
                 <? }?>


               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="usulan">

                  <div class="card-body">
                    <a href="<?=base_url()?>Usulan/addUsulan" class="btn btn-info"> <i class="fa fa-plus-square"></i>&nbsp; Tambah Usulan</a>
                    &nbsp;
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalLihatUsulanFinal"> <i class="fa fa-search"></i>&nbsp; Lihat Usulan Final</a>
                    <table class="table table-stripped table-bordered table-hover">
                      <tr class="active">
                        <th>No. Dokumen</th>
                        <th>Tahun</th>
                        <th>Nama Paket</th>
                        <th>Total Anggaran</th>
                        <th>Tanggal Dibuat</th>
                        <th>Last Update</th>
                        <th>Aksi</th>
                      </tr>
                      <?php 
                      // foreach($usulan as $p){
                      //   $noDok = "Usulan-".$p['ID_USULAN']."/".$p['INISIAL']."/".$p['TAHUN_ANGGARAN'];
                        ?>
                        <tr>
                          <td><?//$noDok?></td>
                          <td><?//=$p['TAHUN_ANGGARAN']?></td>
                          <td>
                            <a href="<?=base_url()?>Usulan/DetailUsulan/<?=$p['ID_USULAN']?>">
                              <?//=$p['NAMA_PAKET']?>
                            </a>
                          </td>
                          <td><?//=number_format($p['TOTAL_ANGGARAN'],'0',',','.')?></td>
                          <td><?//=//$p['TANGGAL_DIBUAT']?></td>
                          <td><?//=//$p['LAST_UPDATE']?></td>
                          <td><a href="#" download class="btn btn-success"><i class="fa fa-download"></i> </a> | <a href="#" download class="btn btn-primary" onclick="getRevisi(<?=$p['ID_USULAN']?>,'<?=$noDok?>')" data-toggle="modal" data-target="#modalLihatRevisi"><i class="fa fa-files-o"></i> Revisi </a></td>
                        </tr>
                        <?php 
                     // }
                      ?>
                    </table>

                  </div>
                </div>
                <div role="tabpanel" class="tab-pane " id="verusulan">

                  <table class="table table-stripped table-bordered table-hover">
                    <tr class="active">
                      <th>No. Dokumen</th>
                      <th>Tahun</th>
                      <th>Nama Paket</th>
                      <th>Total Anggaran</th>
                      <th>Tanggal Dibuat</th>
                      <th>Last Update</th>
                      <th>Aksi</th>
                    </tr>
                    <?php 
                    // foreach($usulan_below as $p){
                    //   $noDok = "Usulan-".$p['ID_USULAN']."/".$p['INISIAL']."/".$p['TAHUN_ANGGARAN'];
                      ?>
                      <tr>
                        <td><?//=$noDok?></td>
                        <td><?//=$p['TAHUN_ANGGARAN']?></td>
                        <td>
                          <!-- <a href="<?//=base_url()?>Usulan/detailUsulan/<?//=$p['ID_USULAN']?>/<?//=$p['REVISI_KE']?>"> -->
                            <?//=$p['NAMA_PAKET']?>
                          </a>
                        </td>
                        <td><?//=number_format($p['TOTAL_ANGGARAN'],'0',',','.')?></td>
                        <td><?//=$p['TANGGAL_DIBUAT']?></td>
                        <td><?//=$p['LAST_UPDATE']?></td>
                        <td><a href="#" download class="btn btn-success"><i class="fa fa-download"></i> </a></td>
                      </tr>
                      <?php 
                //    }
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
</div>
</div>
<!-- Modal Show Usulan Final -->
<div class="modal fade modal-primary" id="modalLihatUsulanFinal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Dokumen Usulan Final</h4>
      </div>
      <div class="modal-body">
        <div class="card">
         <div class="card-body"  style="padding: 0px 20px !important;">
           <? include 'usulan_final_view.php'; ?>
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
            <b>Nomor Dokumen </b>  : <span id="noDok"></span> 
            <div id="revisiTabel">                           
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
<!-- End Modal Add Pagu -->
<?php
$this->load->view('bottom');
?>

<script type="text/javascript">
  function getRevisi(id,no){
    $("#noDok").text(no);
    $.ajax({
      url: '<?=base_url()?>Usulan/revisi/'+id,
      type: "GET",
      success : function(res){
       $("#revisiTabel").html(res);
     },
     error: function (msg) {
      console.log("gagal"+msg);
      return false;
    }

  })
  }
</script>