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
            <div class="card-title" style="width:100%">
              <span class="title">Detail Usulan Pengadaan</span>
              <a href="<?=site_url()?>Usulan/indexPPK" class="btn btn-primary pull-right"><i class="fa fa-chevron-left"></i> Kembali </a>

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

                <div class="controls">
                 <label class="control-label " >Nama Paket</label> : 
                 Paket Teknik Komputer
               </div>
             </div>
             <div class="control-group ">
              <div class="controls">
                <label class="control-label " >Sisa Pagu</label> :
                <span class="pagu_alat">0</span>
              </div>
            </div>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4" style="margin-bottom: 2%;">
            <div class="control-group ">
              <div class="controls">
                <label class="label-jumlah" >Jumlah </label> : 
                9000000
              </div>
            </div>
            <div class="control-group ">
              <div class="controls">
               <label class="label-jumlah" >Jumlah + Biaya Keuntungan </label> : 
               9900000
             </div>
           </div>
           <div class="control-group ">
            <div class="controls">
              <label class="label-jumlah" >Jumlah + Biaya Keuntungan + Pajak </label> :
              10890000
            </div>
          </div>
        </div>
      </form>
      <br>
      <div class="row-fluid " style="height:auto;background:#fff">
      <?print_r($detailAlat)?>
       <table class="table table-bordered table-stripped table-hovered">
        <tr class="active">
          <th> Nama Dokumen Usulan </th>
          <th> Nama Alat </th>
          <th> Spesifikasi </th>
          <th> Setara </th>
          <th> Satuan </th>
          <th> Jumlah Alat </th>
          <th> Harga Satuan </th>
          <th> Total </th>
          <th> Lokasi </th>
          <th> Jumlah Distribusi </th>
          <th> Referensi Terkait </th>
          <th> Data Ahli </th>
          <th> Tanggal Update </th>
          <th> Konfirmasi </th>
        </tr>
        <tr>
          <td> Usulan Teknik Komputer </td>
          <td> Hardisk External </td>
          <td> 2TB Toshiba </td>
          <td> Seagate </td>
          <td> Buah </td>
          <td> 5 </td>
          <td> <?=number_format(1000000,'0',',','.')?> </td>
          <td> <?=number_format(5000000,'0',',','.')?> </td>
          <td> Ruang Dosen </td>
          <td> 5</td>
          <td> <a href="#" target="_blank"> file.png </a></td>
          <td> <input type="checkbox" checked disabled=""></td>
          <td> 20 May 2013</td>
          <td> <input type="text" class="form-control"></td>
        </tr>
      </table>
      <br>

    </div>

  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){  
    $('#addKelData').click(function(){
       $('#modalAddPengelompokanData').modal('show');
    });
   });

</script>
  <!-- Modal Add Pagu -->
                <div class="modal fade modal-info" id="modalAddPengelompokanData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">Tambah Data Pengelompokan</h4>
                            </div>
                            <div class="modal-body">
                              <div class="card">
                               <div class="card-body"  style="padding: 0px 20px !important;">
                                <form action="<?=base_url()?>Pengelompokan/savePengelompokan" method="POST">
                                    <div class="sub-title">Nama Paket Pengelompokan</div>
                                    <div>
                                       <select class="form-control">
                                         <option> Paket 1</option>
                                         <option> Paket 2</option>
                                       </select>
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