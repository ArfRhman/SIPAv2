<?php
//$this->load->view("info_header");
?>
<div class="app-container-slide">
  <div class="container-fluid">
    <div class="side-body padding-top"  style="padding-top:85px;">
     <div class="row no-margin-bottom">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <span class="title">Form Tambah Usulan Pengadaan</span>
            </div>
          </div>
          <div class="card-body">
           <div class="text-center">
            <h5>
              USULAN PENGADAAN ALAT
            </h5>
            <h5>
              TAHUN ANGGARAN 2016
            </h5>
            <br>
          </div>
          <form class="form-horizontal row-fluid form-usulan-noborder">
            <div class="col-md-4">
              <div class="control-group ">
                <label class="control-label " >Nama Paket</label>
                <div class="controls">
                  <input type="text" name="NM_PAKET" id="NM_PAKET"  value="<?=$usulan['NAMA_PAKET']?>" class="form-control">
                </div>
              </div>
              <? if($this->session->userdata('ID_JENIS_USER') == 3){?>
              <div class="control-group ">
                <label class="control-label " >Sisa Pagu</label>
                <div class="controls">
                  <span class="pagu_alat"><?=$pagu['PAGU_ALAT']?></span>
                </div>
              </div>
              <? } ?>
              <? if($this->session->userdata('ID_JENIS_USER') == 2 || $this->session->userdata('ID_JENIS_USER') == 1){?>
              <div class="control-group ">
                <label class="control-label " ></label>
                <div class="controls">
                 <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalLihatUsulanFinal"> <i class="fa fa-search"></i>&nbsp; Lihat Usulan Final</a>
               </div>
             </div>
             <? } ?>
             <div class="control-group ">
              <label class="control-label " >Revisi Ke : </label>
              <div class="controls">
                <select name="revisi" class="revisi">
                  <?php 
                  for($i=0;$i<=$max['m'];$i++){
                    ?>
                    <option <?=$i==$curr ? 'selected' : ''?>><?=$i?></option>
                    <?php 
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4" style="margin-bottom: 2%;">
            <div class="control-group ">
              <label class="label-jumlah" >Jumlah </label>
              <div class="controls">
                <input type="text" id="totalAnggaran" readonly value="" class="form-control">
              </div>
            </div>
            <div class="control-group ">
              <label class="label-jumlah" >Jumlah + Biaya Keuntungan </label>
              <div class="controls">
                <input type="text" id="totalAnggaranKeuntungan" readonly value="" class="form-control">
              </div>
            </div>
            <div class="control-group ">
              <label class="label-jumlah" >Jumlah + Biaya Keuntungan + Pajak </label>
              <div class="controls">
                <input type="text" id="totalAnggaranKeuntunganPajak" readonly value="" class="form-control">
              </div>
            </div>
          </div>
        </form>
        <br>
        <div class="row-fluid " style="height:auto;background:#fff">
          <div id="dataTable" style="width:100%; height:300px; overflow: hidden;">  </div>
          <br><br>
          <div class="col-md-4">
          </div>
          <div class="col-md-4" style="
          margin-bottom: 2%;
          ">
          <center>
            <div class="control-group">
              <div class="controls">
                <a id="addRow" class="btn btn-info">Add New Row</a>

              </div>


            </div>
            <div class="control-group">
              <div class="controls">
                <a id="Save" class="btn btn-success">Save</a>
                <a href="<?=base_url()?>Usulan" class="btn btn-warning">Cancel</a>
              </div>

            </div>
          </center>
        </div>
        <div class="col-md-4" style="text-align: right;
        ">
        <? if($this->session->userdata('ID_JENIS_USER') == 2 || $this->session->userdata('ID_JENIS_USER') == 3){
          if($this->session->userdata('ID_USER') != $usulan['ID_USER'] ){
            ?>
            <button id="btnKonfirm" class="btn btn-danger"><i class="fa fa-warning"></i> &nbsp;Konfirmasi</button>
            <? } } ?>
            <?php 
            $jenis = $this->session->userdata('ID_JENIS_USER');
            if($jenis==3){
              if($jenis==$usulan['ID_JENIS_USER']){
                ?>
                <form method="POST" action="<?=base_url()?>Progress/saveProgressUsulan"/>
                  <input type="hidden" name="id_usulan" value="<?=$usulan['ID_USULAN']?>">
                  <input type="hidden" name="revisi_ke" value="<?=$curr?>">
                  <button id="btnKirimAjuan" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp;Kirim Ajuan</button>
                </form>
                <?php }else{
                  ?>
                  <button id="btnAccept" type="button" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp;Setujui</button>
                  <?php 
                }
              }else{
                ?>
                <form method="POST" action="<?=base_url()?>Progress/saveProgressUsulan"/>
                  <input type="hidden" name="id_usulan" value="<?=$usulan['ID_USULAN']?>">
                  <input type="hidden" name="revisi_ke" value="<?=$curr?>">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp;Kirim Ajuan</button>
                </form>
                <?php } ?>

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
<!--/.module-->
<footer class="app-footer">
  <div class="wrapper">
    <span class="pull-right">2.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © 2015 Copyright.
  </div>
</footer>
<!-- Javascript Libs -->
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/Chart.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/ace/ace.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/ace/mode-html.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/ace/theme-github.js"></script>
<!-- Javascript -->
<script type="text/javascript" src="<?=base_url()?>assets/js/app.js"></script>


<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/handsontable/dist/handsontable.full.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/handsontable/plugins/editRow/editRow.css">
<script type="text/javascript" src="<?=base_url()?>assets/handsontable/dist/handsontable.full.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/handsontable/plugins/jqueryHandsontable.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/handsontable/plugins/editRow/editRow.js"></script>

<script>
  function cekPagu(){
    var pagu = parseInt($(".pagu_alat").text());

    if(pagu<0){
      $("#btnKirimAjuan").attr("disabled","disabled");
    }else{
      $("#btnKirimAjuan").removeAttr("disabled");
    }
  }

  $(document).ready(function () {
    cekPagu();

    $(".revisi").change(function(){
      window.location.href = "<?=base_url()?>Usulan/DetailUsulan/<?=$usulan['ID_USULAN']?>/"+$(".revisi").val();
    });

    $("#addRow").click(function(){
     var ht = $("#dataTable").handsontable("getInstance");
     ht.alter('insert_row');
   });
    
    $("#Save").click(function(e){
      var rowUsulan = $("#dataTable").handsontable("getData");
      var jsUsulan=JSON.stringify(rowUsulan);
      var counter=0;
      var counter2=0;

      var myFormData = new FormData();
      myFormData.append('file','');
      myFormData.append('nama_alat','');
      myFormData.append('id_usulan','');
      myFormData.append('spesifikasi','');
      myFormData.append('setara','');
      myFormData.append('satuan','');
      myFormData.append('jumlah_alat','');
      myFormData.append('harga_satuan','');
      myFormData.append('jumlah_distribusi','');
      myFormData.append('referensi_terkait','');
      myFormData.append('lokasi','');
      myFormData.append('data_ahli','');
      myFormData.append('prioritas','');
      myFormData.append('kategori','');
      myFormData.append('nama',$("#NM_PAKET").val());
      myFormData.append('total',$("#totalAnggaranKeuntunganPajak").val());
      myFormData.append('revisi',<?=$max['m']+1?>);
      myFormData.set('id_usulan',<?=$usulan['ID_USULAN']?>);
      myFormData.append('konfirmasi','');
      myFormData.append('pic','');
      myFormData.append('paket','');

      $.ajax({
        url: '<?=base_url()?>Usulan/clearFinal',
        type: "POST",
        data:myFormData,
        contentType: false,
        processData: false,
        success : function(res){
          console.log("Clear Done");
        },
        error: function (msg) {
          console.log("gagal"+msg);
          return false;
        }

      })
      for(var i=1;i<rowUsulan.length;i++){
        if(rowUsulan[i][0]!=""){
          counter++;
        }
      }
      for(var i=1;i<rowUsulan.length;i++){
        if(rowUsulan[i][0]!=""){
          counter2++;
          myFormData.set('file',$("input:file:eq("+(i-1)+")").prop("files")[0]);
          myFormData.set('nama_alat',rowUsulan[i][0]);
          myFormData.set('spesifikasi',rowUsulan[i][1]);
          myFormData.set('setara',rowUsulan[i][2]);
          myFormData.set('satuan',rowUsulan[i][3]);
          myFormData.set('jumlah_alat',rowUsulan[i][4]);
          myFormData.set('harga_satuan',rowUsulan[i][5]);
          myFormData.set('lokasi',rowUsulan[i][7]);
          myFormData.set('jumlah_distribusi',rowUsulan[i][8]);
          var ahli = 0;
          if(rowUsulan[i][10]==true){
            var ahli = 1;  
          }

          myFormData.set('data_ahli',rowUsulan[i][10]);
          myFormData.set('prioritas',rowUsulan[i][11]);
          myFormData.set('kategori',rowUsulan[i][12]);
          myFormData.set('konfirmasi',rowUsulan[i][13]);
          myFormData.set('pic',rowUsulan[i][14]);
          myFormData.set('paket',rowUsulan[i][15]);

          $.ajax({
            url: '<?=base_url()?>Usulan/updateAlat',
            type: "POST",
            data:myFormData,
            contentType: false,
            processData: false,
            success : function(res){
              if(counter=counter2){
                window.location.href='<?=base_url()?>Usulan';
              }
              console.log("Save Alat Done");
              console.log(res);
            },
            error: function (msg) {
              console.log("gagal"+msg);
              return false;
            }

          })
        }
      }
    }); 
$("#btnKonfirm").click(function(e){
  var rowUsulan = $("#dataTable").handsontable("getData");
  var jsUsulan=JSON.stringify(rowUsulan);
  var counter=0;
  var counter2=0;

  var myFormData = new FormData();
  myFormData.append('file','');
  myFormData.append('nama_alat','');
  myFormData.append('id_usulan','');
  myFormData.append('spesifikasi','');
  myFormData.append('setara','');
  myFormData.append('satuan','');
  myFormData.append('jumlah_alat','');
  myFormData.append('harga_satuan','');
  myFormData.append('jumlah_distribusi','');
  myFormData.append('referensi_terkait','');
  myFormData.append('lokasi','');
  myFormData.append('data_ahli','');
  myFormData.append('prioritas','');
  myFormData.append('kategori','');
  myFormData.append('nama',$("#NM_PAKET").val());
  myFormData.append('total',$("#totalAnggaranKeuntunganPajak").val());
  myFormData.append('revisi',<?=$max['m']+1?>);
  myFormData.set('id_usulan',<?=$usulan['ID_USULAN']?>);
  myFormData.append('konfirmasi','');
  myFormData.append('pic','');
  myFormData.append('paket','');

  $.ajax({
    url: '<?=base_url()?>Progress/saveProgressKonfirmasi',
    type: "POST",
    data:myFormData,
    contentType: false,
    processData: false,
    success : function(res){
      console.log("Save Konfirmasi Done");
      console.log(res);
    },
    error: function (msg) {
      console.log("gagal"+msg);
      return false;
    }

  })

  for(var i=1;i<rowUsulan.length;i++){
    if(rowUsulan[i][0]!=""){
      counter++;
    }
  }
  for(var i=1;i<rowUsulan.length;i++){
    if(rowUsulan[i][0]!=""){
      counter2++;
      myFormData.set('file',$("input:file:eq("+(i-1)+")").prop("files")[0]);
      myFormData.set('nama_alat',rowUsulan[i][0]);
      myFormData.set('spesifikasi',rowUsulan[i][1]);
      myFormData.set('setara',rowUsulan[i][2]);
      myFormData.set('satuan',rowUsulan[i][3]);
      myFormData.set('jumlah_alat',rowUsulan[i][4]);
      myFormData.set('harga_satuan',rowUsulan[i][5]);
      myFormData.set('lokasi',rowUsulan[i][7]);
      myFormData.set('jumlah_distribusi',rowUsulan[i][8]);
      var ahli = 0;
      if(rowUsulan[i][10]==true){
        var ahli = 1;  
      }

      myFormData.set('data_ahli',rowUsulan[i][10]);
      myFormData.set('prioritas',rowUsulan[i][11]);
      myFormData.set('kategori',rowUsulan[i][12]);
      myFormData.set('konfirmasi',rowUsulan[i][13]);
      myFormData.set('pic',rowUsulan[i][14]);
      myFormData.set('paket',rowUsulan[i][15]);

      $.ajax({
        url: '<?=base_url()?>Usulan/updateAlat',
        type: "POST",
        data:myFormData,
        contentType: false,
        processData: false,
        success : function(res){
          if(counter=counter2){
            window.location.href='<?=base_url()?>Usulan';
          }
          console.log("Save Alat Done");
          console.log(res);
        },
        error: function (msg) {
          console.log("gagal"+msg);
          return false;
        }

      })
    }
  }
});


$("#btnAccept").click(function(e){
  var rowUsulan = $("#dataTable").handsontable("getData");
  var jsUsulan=JSON.stringify(rowUsulan);
  var counter=0;
  var counter2=0;

  var myFormData = new FormData();
  myFormData.append('file','');
  myFormData.append('nama_alat','');
  myFormData.append('id_usulan','');
  myFormData.append('spesifikasi','');
  myFormData.append('setara','');
  myFormData.append('satuan','');
  myFormData.append('jumlah_alat','');
  myFormData.append('harga_satuan','');
  myFormData.append('jumlah_distribusi','');
  myFormData.append('referensi_terkait','');
  myFormData.append('lokasi','');
  myFormData.append('data_ahli','');
  myFormData.append('prioritas','');
  myFormData.append('kategori','');
  myFormData.append('nama',$("#NM_PAKET").val());
  myFormData.append('total',$("#totalAnggaranKeuntunganPajak").val());
  myFormData.append('revisi',<?=$max['m']+1?>);
  myFormData.set('id_usulan',<?=$usulan['ID_USULAN']?>);
  myFormData.append('konfirmasi','');
  myFormData.append('pic','');
  myFormData.append('paket','');

  $.ajax({
    url: '<?=base_url()?>Progress/approveUsulan',
    type: "POST",
    data:myFormData,
    contentType: false,
    processData: false,
    success : function(res){
      console.log("Accept Done");
      console.log(res);
    },
    error: function (msg) {
      console.log("gagal"+msg);
      return false;
    }

  })

  for(var i=1;i<rowUsulan.length;i++){
    if(rowUsulan[i][0]!=""){
      counter++;
    }
  }

  for(var i=1;i<rowUsulan.length;i++){
    if(rowUsulan[i][0]!=""){
      counter2++;
      myFormData.set('file',$("input:file:eq("+(i-1)+")").prop("files")[0]);
      myFormData.set('nama_alat',rowUsulan[i][0]);
      myFormData.set('spesifikasi',rowUsulan[i][1]);
      myFormData.set('setara',rowUsulan[i][2]);
      myFormData.set('satuan',rowUsulan[i][3]);
      myFormData.set('jumlah_alat',rowUsulan[i][4]);
      myFormData.set('harga_satuan',rowUsulan[i][5]);
      myFormData.set('lokasi',rowUsulan[i][7]);
      myFormData.set('jumlah_distribusi',rowUsulan[i][8]);
      var ahli = 0;
      if(rowUsulan[i][10]==true){
        var ahli = 1;  
      }

      myFormData.set('data_ahli',rowUsulan[i][10]);
      myFormData.set('prioritas',rowUsulan[i][11]);
      myFormData.set('kategori',rowUsulan[i][12]);
      myFormData.set('konfirmasi',rowUsulan[i][13]);
      myFormData.set('pic',rowUsulan[i][14]);
      myFormData.set('paket',rowUsulan[i][15]);
      $.ajax({
        url: '<?=base_url()?>Usulan/updateFinal',
        type: "POST",
        data:myFormData,
        contentType: false,
        processData: false,
        success : function(res){
         if(counter=counter2){
          window.location.href='<?=base_url()?>Usulan';
        }
        console.log("Save Alat Done");
        console.log(res);
      },
      error: function (msg) {
        console.log("gagal"+msg);
        return false;
      }

    })
    }
  }
}); 
}); 


</script>
<script data-jsfiddle="excel1">
  var
  data1 = <?=$alat?>,
  //container1 = document.getElementById('dataTable'),
  hot1;

  function firstRowRenderer(instance, td, row, col, prop, value, cellProperties) {
    Handsontable.renderers.TextRenderer.apply(this, arguments);
    td.style.fontWeight = 'bold';
    td.style.color = 'white';
    td.style.background = '#5B9BD5';
  }

  function TotalRowRenderer(instance, td, row, col, prop, value, cellProperties) {
    Handsontable.renderers.NumericRenderer.apply(this, arguments);
    td.style.fontWeight = 'bold';
    td.style.color = 'white';
    td.style.background = '#3cbc8d';
    td.style.textAlign = 'right'; 
  }

  function KeyRowRenderer(instance, td, row, col, prop, value, cellProperties) {
    Handsontable.renderers.TextRenderer.apply(this, arguments);
    td.style.display = 'none';
  }

  $("#dataTable").handsontable( {
    data: data1,
    minSpareRows: 1,
    rowHeaders: true,
    colHeaders: false,
    contextMenu: false,
    fixedColumnsLeft: 2,
    fixedRowsTop:1,
    outsideClickDeselects: false,
    mergeCells: [
    {row: 0, col: 0, rowspan: 1, colspan: 1},
    {row: 0, col: 1, rowspan: 1, colspan: 1},
    {row: 0, col: 2, rowspan: 1, colspan: 1},
    {row: 0, col: 3, rowspan: 1, colspan: 1},
    {row: 0, col: 4, rowspan: 1, colspan: 1},
    {row: 0, col: 5, rowspan: 1, colspan: 1},
    {row: 0, col: 6, rowspan: 1, colspan: 1},
    {row: 0, col: 7, rowspan: 1, colspan: 1},
    {row: 0, col: 8, rowspan: 1, colspan: 1},
    {row: 0, col: 9, rowspan: 1, colspan: 1},
    {row: 0, col: 10, rowspan: 1, colspan: 1},
    {row: 0, col: 11, rowspan: 1, colspan: 1},
    {row: 0, col: 12, rowspan: 1, colspan: 1},
    {row: 0, col: 13, rowspan: 1, colspan: 1},
    {row: 0, col: 14, rowspan: 1, colspan: 1},
    {row: 0, col: 15, rowspan: 1, colspan: 1}
    ],
    cell: [
    {row: 0, col: 0, className: "htCenter htMiddle"},
    {row: 0, col: 1, className: "htCenter htMiddle"},
    {row: 0, col: 2, className: "htCenter htMiddle"},
    {row: 0, col: 3, className: "htCenter htMiddle"},
    {row: 0, col: 4, className: "htCenter htMiddle"},
    {row: 0, col: 5, className: "htCenter htMiddle"},
    {row: 0, col: 6, className: "htCenter htMiddle"},
    {row: 0, col: 7, className: "htCenter htMiddle"},
    {row: 0, col: 8, className: "htCenter htMiddle"},
    {row: 0, col: 9, className: "htCenter htMiddle"},
    {row: 0, col: 10, className: "htCenter htMiddle"},
    {row: 0, col: 11, className: "htCenter htMiddle"},
    {row: 0, col: 12, className: "htCenter htMiddle"},
    {row: 0, col: 13, className: "htCenter htMiddle"},
    {row: 0, col: 14, className: "htCenter htMiddle"},
    {row: 0, col: 15, className: "htCenter htMiddle"}
    ],
    columns: [
    {
      width:200,
      renderer:"html",
      isActive:false
    },
    {
      width:200,
      renderer:"html"
    },
    {
      width:150,
      renderer:"html"
    },
    {
      type: 'autocomplete',
      source: ['Unit','Set'],
      strict: false
    },
    {
      type: 'numeric',
      format: '0,0',
      language: 'en',
      width:80
    },
    {
      type: 'numeric',
      format: '0,0.00',
      language: 'en',
      alignment: 'right',
      validator: 'numericValidator', 
      allowInvalid: false
    },
    {
      type: 'numeric',
      format: '0,0.00',
      language: 'en',
      readOnly: true
    },
    {
      type: 'autocomplete',
      source: <?=$lokasi?>,
      strict: false,
      width:150
    },
    {
      type: 'numeric',
      renderer:"html"
    },
    {
      width:200,
      renderer:"html"
    },
    {
      type:'checkbox',
      width:100
    },
    {
      width:100,
      renderer:"html"
    },
    {
      type: 'autocomplete',
      source: <?=$kategori?>,
      strict: false,
      width:150
    },{
      width:200,
      renderer:"html"
    },
    {
      width:100,
      renderer:"html"
    },
    {
      width:200,
      renderer:"html"
    }
    ],
    cells: function (row, col, prop) {
      var cellProperties = {};

      if (row === 0 || this.instance.getData()[row][col] === 'readOnly') {
            cellProperties.readOnly = true; // make cell read-only if it is first row or the text reads 'readOnly'
          }
          if (row === 0) {
            cellProperties.renderer = firstRowRenderer; // uses function directly
          }
          if(col === 6){
            cellProperties.renderer = TotalRowRenderer;  
          }

          return cellProperties;
        },
        afterChange : function(changes, source){

          if(changes != null){
            var row = changes[0][0];
            var col = changes[0][1];
            var oldVal = changes[0][2];
            var newVal = changes[0][3];
          }
          var ht = $('#dataTable').handsontable('getInstance');

          if(col===4 || col===5){
            var qty = ht.getData()[row][4];
            var harga = ht.getData()[row][5];

            if(qty != 0 || harga != 0){
              ht.setDataAtCell(row, 6, qty*harga); 

            }  
          }

              // if(col===4){
              //   ht.setDataAtCell(row, 8, newVal);   
              // }

            //COunt Total Anggaran
            var totRow = ht.countRows();
            var  totAnggaran = 0;
            for(var i=1; i<totRow; i++){
              if(ht.getData()[i][6] != null){
                totAnggaran = Number(totAnggaran) + ht.getData()[i][6];
                //console.log(totAnggaran);
              }
            }


            
            $("#totalAnggaran").val(totAnggaran);
            
            var keuntungan = (10/100)*Number(totAnggaran);
            var jumlahKeuntungan = Number(totAnggaran) + Number(keuntungan);
            $("#totalAnggaranKeuntungan").val(jumlahKeuntungan);
            //$("#totalAnggaranKeuntungan").val(accounting.formatMoney(jumlahKeuntungan, "Rp", 2, ",", "."));
            
            var pajak = (10/100)*Number(jumlahKeuntungan);
            var jumlahKeuntunganPajak = Number(jumlahKeuntungan) + Number(pajak);
            $("#totalAnggaranKeuntunganPajak").val(jumlahKeuntunganPajak);
            
            var pagu = <?=$pagu['PAGU_ALAT']?>;
            $(".pagu_alat").text(Number(pagu)-jumlahKeuntunganPajak);

          }                            

        });




</script>


</body>

</html>
