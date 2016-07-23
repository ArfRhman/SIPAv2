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
                  <span class="title">Tambah Tim HPS</span>
                  <a href="<?=site_url()?>BeritaAcara/TimHPS" class="btn btn-primary pull-right"><i class="fa fa-chevron-left"></i> Kembali </a>

                </div>
              </div>

              <div class="card-body">
                <div class="row" style="
                width: 35%;
                margin: auto;
                ">
                <div class="sub-title col-md-3">Nama Tim HPS</div>
                <div class="col-md-9">
                  <input type="text" name="nama" class="form-control">
                </div>

                <table width="100%" style="margin-top: 40px;">
                  <tr>
                    <td style="vertical-align: top;">
                      <fieldset class="col-md-11" style="border: 1px solid #ccc;padding-bottom: 1%;">
                        <legend> Data Pegawai </legend>
                        <div class="checkbox3 checkbox-check">
                          <input type="checkbox" id="checkbox-1" class="dataPg" value="Agus">
                          <label for="checkbox-1">
                            Agus 
                          </label>
                        </div>
                        <div class="checkbox3 checkbox-check">
                          <input type="checkbox" id="checkbox-2" class="dataPg" value="Rahmat">
                          <label for="checkbox-2">
                            Rahmat
                          </label>
                        </div>
                        <div class="checkbox3 checkbox-check">
                          <input type="checkbox" id="checkbox-3" class="dataPg" value="Jaka">
                          <label for="checkbox-3">
                            Jaka 
                          </label>
                        </div>
                        <div class="checkbox3 checkbox-check">
                          <input type="checkbox" id="checkbox-4" class="dataPg" value="M. Darmin">
                          <label for="checkbox-4">
                            M. Darmin 
                          </label>
                        </div>
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
                  <br>
                  <div style="text-align: center;margin-top: 5%;"> 
                    <button id="btnSimpanTim" type="button" class="btn btn-success"><i class="fa fa-chevron-right"></i> <i class="fa fa-disk"></i> Simpan </button> 
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

<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>
<script>
  $(document).ready(function(){ 
    $('.setPegawai').click(function(){
      var allVals = [];
      $('.dataPg:checked').each(function() {
       allVals.push($(this).val()+'<br>');
     });
      $('.timData').html(allVals);
    });
    $('#btnSimpanTim').click(function(){
      $.ajax({
        url: '<?=base_url()?>Usulan/revisi/'+id,
        type: "POST",
        data:[
        //'list':$('.timData').html()
        ]
        success : function(res){
         $("#revisiTabel").html(res);
       },
       error: function (msg) {
        console.log("gagal"+msg);
        return false;
      }
    })
    });
  });
</script>