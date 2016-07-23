<!-- Main Content -->
<?php
$this->load->view("info_header");
?>
<!-- Main layout -->
<div class="app-container-slide">
    <div class="container-fluid">
        <div class="side-body padding-top"  style="padding-top:25px;">
            <!-- Main Content -->
            <div class="row no-margin-bottom">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="title">Pengelolaan Pagu  
                                    <select class="periode">
                                        <?php foreach($periode as $p){ ?>
                                        <option <?=$p['TAHUN_ANGGARAN']==$currentDate ? 'selected' : '' ?>><?=$p['TAHUN_ANGGARAN']?></option>
                                        <?php } ?>
                                    </select>
                                </span>
                                <br><br>
                                <?php 
                                $total_anggaran=0;
                                foreach ($pagu as $pag){
                                    $total_anggaran+=$pag['PAGU_ALAT'];
                                }
                                ?>
                                <span class="title">Total Pagu : Rp <?= number_format($total_anggaran,0,',','.')?>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php 
                            if($currentDate == date('Y')){
                                if(empty($pagu)){
                                    ?>
                                    <button type="button" class="btn btn-primary btn-info" data-toggle="modal" data-target="#modalAddPagu">
                                      <i class="fa fa-plus-square"></i>&nbsp; Tambah Data Pagu
                                  </button>
                                  <?php }else{ ?>
                                  <a class="btn btn-warning" onclick="editPagu()"
                                  data-toggle="modal" data-target="#modalEditPagu"><i class="fa fa-pencil"></i> Edit Data Pagu
                                  <?php 
                              } 
                          } ?>
                      </a>

                      <table class="table table-stripped table-bordered table-hover">
                          <tr class="active">
                            <th>Jurusan</th>
                            <th>Tahun Anggaran</th>
                            <th>Pagu Alat</th>
                        </tr>
                        <?php 
                        $no=1;
                        foreach($pagu as $p){ ?>
                        <tr>
                            <td> <?=$p['NAMA_JURUSAN']?> </td>
                            <td><?=$p['TAHUN_ANGGARAN']?> </td>
                            <td nilai="<?=$p['PAGU_ALAT']?>">Rp <?= number_format($p['PAGU_ALAT'],0,',','.')?> </td>
                        </tr>
                        <?php 
                        $no++;
                    } 
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content -->
<!-- Modal Add Pagu -->
<div class="modal fade modal-info" id="modalAddPagu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Pagu (Tahun Anggaran <?= date('Y')?>)</h4>
            </div>
            <div class="modal-body">
              <div class="card">
               <div class="card-body"  style="padding: 0px 20px !important;">
                <form action="<?=base_url()?>Pagu/savePagu" method="POST">

                    <div class="sub-title">Pagu Alat Jurusan <b style="float: right;"> TOTAL PAGU : <span id="totPagujur">0</span></b></div>
                    <?$totJur = 0;
                    foreach ($jurusan as $j) {
                        if($j['ID_JURUSAN']!=0){?>
                        <div class="sub-title"><b><?= $j['NAMA_JURUSAN'] ?></b>
                            <input type="text" name="pagu[<?= $j['ID_JURUSAN'] ?>]" class="form-control formattedNumberField dataJur<?= $j['ID_JURUSAN']?>" placeholder="Masukan Nominal Pagu <?= $j['NAMA_JURUSAN'] ?>">
                        </div>

                        <? $totJur++; }} ?>

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
<!-- Modal Edit Pagu -->
<div class="modal fade modal-warning" id="modalEditPagu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Data Pagu (Tahun Anggaran <?= date('Y')?>)</h4>
            </div>
            <div class="modal-body">
              <div class="card">
               <div class="card-body"  style="padding: 0px 20px !important;">
                <form action="<?=base_url()?>Pagu/updatePagu" method="POST">
                    <div class="sub-title">Pagu Alat Jurusan <b style="float: right;"> TOTAL PAGU : <span id="totPagujurE">0</span></b></div>
                    <?$totJur = 0;$no=1;
                    foreach ($jurusan as $j) {
                        if($j['ID_JURUSAN']!=0){?>
                        <div class="sub-title"><b><?= $j['NAMA_JURUSAN'] ?></b>
                            <input type="text" name="pagu[<?= $j['ID_JURUSAN'] ?>]" class="isian<?=$no?> form-control formattedNumberFieldE dataJurE<?= $j['ID_JURUSAN']?>" placeholder="Masukan Nominal Pagu <?= $j['NAMA_JURUSAN'] ?>">
                        </div>

                        <? $totJur++;$no++; }} ?>

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
</div>
</div>
</div>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>
<script type="text/javascript">
    $(".periode").change(function(){
      window.location.href = "<?=base_url()?>Pagu/index/"+$(".periode").val();
  });

    function editPagu () {
        var total= 0;
        $('tr').each(function(index){
            if(index!=0){
                total = total+Number($(this).find('td').eq(2).attr('nilai'));
                $('.isian'+index).val($(this).find('td').eq(2).attr('nilai'));
            }
        });
        var n = parseInt(total.toString().replace(/\D/g,''),10);
        $('#totPagujurE').text(n.toLocaleString());
    }
//   function myParse(num) {
//       var n2 = num.split(".")
//       out = 0
//       for(var i = 0; i < n2.length; i++) {
//         out *= 1000;
//         out += parseFloat(n2[i])
//     }
//     return out;
// }
$(".formattedNumberField").on('keyup',function(event) {
// var n = parseInt($(this).val().replace(/\D/g,''),10);
// $(this).val(n.toLocaleString());
if(event.which < 46
    || event.which > 59) {
    event.preventDefault();
    } // prevent if not number/dot
    var jml = <?=$totJur?> ;
    var tot = 0;
// tot = 2;
for(var i=1;i<=jml;i++){
    if($('.dataJur'+i).val()!=''){
        tot += parseInt($('.dataJur'+i).val());
    }
}
var n = parseInt(tot.toString().replace(/\D/g,''),10);
$('#totPagujur').text(n.toLocaleString());
// $('#totPagujur').text(tot);
});

$(".formattedNumberFieldE").on('keyup',function(event) {
// var n = parseInt($(this).val().replace(/\D/g,''),10);
// $(this).val(n.toLocaleString());
if(event.which < 46
    || event.which > 59) {
    event.preventDefault();
    } // prevent if not number/dot
    var jml = <?=$totJur?> ;
    var tot = 0;
// tot = 2;
for(var i=1;i<=jml;i++){
    if($('.dataJurE'+i).val()!=''){
        tot += parseInt($('.dataJurE'+i).val());
    }
}
var n = parseInt(tot.toString().replace(/\D/g,''),10);
$('#totPagujurE').text(n.toLocaleString());
// $('#totPagujurE').text(tot);
});

</script>

