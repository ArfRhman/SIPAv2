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
                  <span class="title">Mencatat Tim Penerimaan</span>
                </div>
              </div>
              <div class="card-body">
                <a href="#"  data-toggle="modal" data-target="#modalAddTimPenerimaan"  class="btn btn-info"><i class="fa fa-plus"></i> Tambah Tim Penerimaan </a>
                <table class="table table-stripped table-bordered table-hover">
                  <tr class="active">
                    <th>No</th>
                    <th>Nama Tim</th>
                    <th>Aksi</th>
                  </tr>
                  <?php 
                  $no=1;
                  foreach($tim as $t){
                    ?>
                    <tr>
                      <td><?=$no;$no++;?></td>
                      <td><a href="#"  data-toggle="modal" data-target="#modalLihatTimPenerimaan"><?=$t['NAMA_TIM']?></a></td>
                      <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalEditTimPenerimaan"><i class="fa fa-pencil"></i> Edit </a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalDelTimPenerimaan"><i class="fa fa-remove"></i> Hapus </a>
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
  <script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>
  <script>
  var allValsId = [];
    $(document).ready(function(){
     $(".user_password").focus(function(){
      this.type = "text";
    }).blur(function(){
      this.type = "password";
    }) 

    $('.setPegawai').click(function(){
      var allVals = [];
      var selVals = [];
      $('.dataPg:checked').each(function() {
        if($(this).val()!=''){
         selVals.push('<option value='+$(this).attr('da')+'>'+$(this).val()+'<option>');
       }
       allVals.push($(this).val()+'<br>'); 
       allValsId.push($(this).attr('da'));
     });
      $('.timData').html(allVals);
      $('#selKetua').html(selVals);
    }); 

    $('.setPegawaiE').click(function(){
      var allVals = [];
      var selVals = [];
      $('.dataPgE:checked').each(function() {
        if($(this).val()!=''){
         selVals.push('<option value='+$(this).attr('da')+'>'+$(this).val()+'<option>');
       }
       allVals.push($(this).val()+'<br>');
     });
      $('.timDataE').html(allVals);
      $('#selKetuaE').html(selVals);

    }); 

  });
  </script>
  <!-- Modal Lihat Tim Penerimaan-->
  <div class="modal fade modal-info" id="modalLihatTimPenerimaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel">Lihat Tim Penerimaan</h4>
        </div>
        <div class="modal-body">
          <div class="card">
           <div class="card-body"  style="padding: 0px 20px !important;">
            <div class="sub-title">
              <b>Nama Tim Penerimaan </b> : Tim Penerimaan Komputer dan Elektronika</div>
              <div class="sub-title">
                <b>Tahun Anggaran </b> : 2013</div>
                <div class="sub-title">
                  <b>Nama Tim Penerimaan </b> : </div>
                  <div style="font-size: 15px;margin-left:1%;">
                    <li> Agus (Ketua)</li>
                    <li> Bembi </li>
                    <li> Sumarna </li>
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
      <!-- End Modal Lihat Tim Penerimaan -->
      <!-- Modal Add Tim Penerimaan -->
      <div class="modal fade modal-info" id="modalAddTimPenerimaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel">Tambah Tim Penerimaan</h4>
            </div>
            <div class="modal-body">
              <div class="card">
               <div class="card-body"  style="padding: 0px 20px !important;">
                <form action="#n" method="POST">
                  <!-- kontent -->
                  <div class="card-body">

                    <div class="row" style="
                    width: 100%;
                    margin: auto;
                    ">
                    <div class="sub-title col-md-3">Nama Tim Penerimaan</div>
                    <div class="col-md-9">
                      <input type="text" name="nama" class="form-control">
                    </div>

                    <table width="100%" style="margin-top: 40px;margin-bottom:30px;">
                      <tr>
                        <td style="vertical-align: top;">
                          <fieldset class="col-md-11" style="border: 1px solid #ccc;padding-bottom: 1%;">
                            <legend> Data Pegawai </legend>
                            <?php 
                            foreach($pegawai as $pe){
                              ?>
                              <div class="checkbox3 checkbox-check addcheck">
                                <input type="checkbox" id="checkbox-<?=$pe['NIP']?>" class="dataPg" value="<?=$pe['NAMA_PEGAWAI']?>" da="<?=$pe['NIP']?>">
                                <label for="checkbox-<?=$pe['NIP']?>">
                                  <?=$pe['NAMA_PEGAWAI']?>
                                </label>
                              </div>
                              <?php
                            }
                            ?>
                          </fieldset>
                        </td>
                        <td>
                          <div>
                            <button type="button" class="btn btn-info setPegawai"><i class="fa fa-chevron-right"></i> <i class="fa fa-chevron-right"></i></button> 
                          </div>
                        </td>
                        <td style="vertical-align: top;">
                         <fieldset class="col-md-12" style="border: 1px solid #ccc;padding-bottom: 1%;">
                          <legend> Data Tim </legend>
                          <div class="checkbox3 timData">  </div>
                        </fieldset>
                      </td>
                      <tr>
                      </table>
                      <div class="sub-title col-md-3">Pilih Ketua</div>
                      <div class="col-md-9">
                        <select class="form-control" id='selKetua'>
                          <option>-</option>
                        </select>
                      </div>
                      <div class="sub-title col-md-3">Username</div>
                      <div class="col-md-9">
                       <input name="username" type="text" class="form-control">
                     </div>
                     <div class="sub-title col-md-3">Password</div>
                     <div class="col-md-9">
                      <input name="password" type="password" class="form-control user_password">
                    </div>
                  </div>
                </div>
                <!-- end konten -->
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button id="simpanAdd"  type="submit" class="btn btn-success">Simpan</button>
          </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Add Tim Penerimaan -->

  <!-- Modal Edit Tim Penerimaan -->
  <div class="modal fade modal-warning" id="modalEditTimPenerimaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Tim Penerimaan</h4>
        </div>
        <div class="modal-body">
          <div class="card">
           <div class="card-body"  style="padding: 0px 20px !important;">
            <form action="#n" method="POST">
              <!-- kontent -->
              <div class="card-body">

                <div class="row" style="
                width: 100%;
                margin: auto;
                ">
                <div class="sub-title col-md-3">Nama Tim Penerimaan</div>
                <div class="col-md-9">
                  <input type="text" name="nama" class="form-control">
                </div>

                <table width="100%" style="margin-top: 40px;margin-bottom:30px;">
                  <tr>
                    <td style="vertical-align: top;">
                      <fieldset class="col-md-11" style="border: 1px solid #ccc;padding-bottom: 1%;">
                        <legend> Data Pegawai </legend>
                        <div class="checkbox3 checkbox-check">
                          <input type="checkbox" id="checkbox-1E" class="dataPgE" value="Agus" da="1">
                          <label for="checkbox-1E">
                            Agus 
                          </label>
                        </div>
                        <div class="checkbox3 checkbox-check">
                          <input type="checkbox" id="checkbox-2E" class="dataPgE" value="Rahmat" da="2">
                          <label for="checkbox-2E">
                            Rahmat
                          </label>
                        </div>
                        <div class="checkbox3 checkbox-check">
                          <input type="checkbox" id="checkbox-3E" class="dataPgE" value="Jaka" da="3">
                          <label for="checkbox-3E">
                            Jaka 
                          </label>
                        </div>
                        <div class="checkbox3 checkbox-check">
                          <input type="checkbox" id="checkbox-4E" class="dataPgE" value="M. Darmin" da="4">
                          <label for="checkbox-4E">
                            M. Darmin 
                          </label>
                        </div>
                      </fieldset>
                    </td>
                    <td>
                      <div>
                        <button type="button" class="btn btn-info setPegawaiE"><i class="fa fa-chevron-right"></i> <i class="fa fa-chevron-right"></i></button> 
                      </div>
                    </td>
                    <td style="vertical-align: top;">
                     <fieldset class="col-md-12" style="border: 1px solid #ccc;padding-bottom: 1%;">
                      <legend> Data Tim </legend>
                      <div class="checkbox3 timDataE">  </div>
                    </fieldset>
                  </td>
                  <tr>
                  </table>
                  <div class="sub-title col-md-3">Pilih Ketua</div>
                  <div class="col-md-9">
                    <select class="form-control" id='selKetuaE'>
                      <option>-</option>
                    </select>
                  </div>
                  <div class="sub-title col-md-3">Username</div>
                  <div class="col-md-9">
                   <input type="text" class="form-control">
                 </div>
                 <div class="sub-title col-md-3">Password</div>
                 <div class="col-md-9">
                  <input type="password" class="form-control user_password">
                </div>
              </div>
            </div>
            <!-- end konten -->
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
<!-- End Modal Edit Tim Penerimaan -->
<!-- modal del Kontrak -->
<div class="modal fade modal-danger" id="modalDelTimPenerimaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle"></i> Hapus Data Tim Penerimaan</h4>
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
<script type="text/javascript">
  $(document).ready(function(e){
    $("#simpanAdd").click(function(e){
      e.preventDefault();
      var myFormData = new FormData();
      myFormData.append('namatim',$("input[name='nama']").val());
      myFormData.append('ketua',$("#selKetua").val());
      myFormData.append('username',$("input[name='username']").val());
      myFormData.append('password',$("input[name='password']").val());
      myFormData.append('anggota',allValsId);

      $.ajax({
        url: '<?=base_url()?>TimPenerimaan/saveTimPenerimaan',
        type: "POST",
        data:myFormData,
        processData: false,
        contentType: false,
        success : function(res){
         window.location.href ="<?=base_url()?>TimPenerimaan";
        },
        error: function (msg) {
          console.log("gagal"+msg);
          return false;
        }

      })
      console.log($('.timData').text());
    });
  });

</script>