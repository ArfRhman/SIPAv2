 <div class="app-container-slide">
  <div class="container-fluid">
    <div class="side-body padding-top"  style="padding-top:90px;">

      <div class="row  no-margin-bottom">
        <div class="row">
          <div class="col-xs-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title" style="width:100%">
                  <span class="title">Pencatatan</span>
                  <a href="<?=site_url()?>Pencatatan" class="btn btn-primary pull-right"><i class="fa fa-chevron-left"></i> Kembali </a>

                </div>
              </div>
              <div class="card-body">

               <div class="sub-title">Nomor Dokumen : PAKET-<?=$paket['ID_PAKET']?>/<?=$paket['TAHUN_ANGGARAN']?></div>
               <div>
                 <table class="table table-bordered table-stripped table-hovered">
                  <tr class="active">
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
                    <th> Nomor Inventaris </th>
                  </tr>
                  <?
                  // print_r($alat);
                  foreach ($alat as $p) {?>
                  <tr>
                    <td> <?=$p['NAMA_ALAT']?> </td>
                    <td> <?=$p['SPESIFIKASI']?> </td>
                    <td> <?=$p['SETARA']?> </td>
                    <td> <?=$p['SATUAN']?> </td>
                    <td> <?=$p['JUMLAH_ALAT']?> </td>
                    <td> <?=number_format($p['HARGA_SATUAN'],'0',',','.')?> </td>
                    <td> <?=number_format($p['HARGA_SATUAN']*$p['JUMLAH_ALAT'],'0',',','.')?> </td>
                    <td> <?=$this->m_data->getDataMultiWhere('LOKASI', array('ID_JURUSAN'=>$p['ID_JURUSAN'],'ID_LOKASI'=>$p['ID_LOKASI']))->row()->NAMA_LOKASI ?> </td>
                    <td> <?=$p['JUMLAH_DISTRIBUSI']?> </td>
                    <td> <a href="<?=site_url()?>assets/referensi/<?=$p['REFERENSI_TERKAIT']?>" target="_blank">  <?=$p['REFERENSI_TERKAIT']?> </a></td>
                    <td> <input type="checkbox" <?=($p['DATA_AHLI']==1)?'checked':'';?> disabled></td>
                    <td> <?=$p['TANGGAL_UPDATE']?></td>
                    <td class="td<?=$p['ID_ALAT']?>"> <?=($p['NO_INVENTARIS']=='')?'<input type="text" class="form-control no_inven'.$p['ID_ALAT'].'" style="width:100%">':'<span class="no_inven_span'.$p['ID_ALAT'].'">'.$p['NO_INVENTARIS'].'</span>'?></td>
                    <td class="td_b<?=$p['ID_ALAT']?>"> <?='<span style="display:none;">'.$p['ID_ALAT'].'</span>';?><?=($p['NO_INVENTARIS']=='')?'<button class="btn btn-success btn_inven" onclick=\'saveNoInvent("'.$p['ID_ALAT'].'");\'>Simpan</button>':'<button class="btn btn-warning btn_edit_inven" >Edit</button>'?></td>
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
</div> 
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>

<script type="text/javascript">
 function saveNoInvent(idalat){
   var data = $('.no_inven'+idalat).val();
    $.ajax({
      url: '<?=base_url()?>Pencatatan/addNoInvent',
      type: "POST",
      data: {id:idalat,data:data},
      success : function(res){
        window.location.reload();
      }
    })
 }

  $(document).ready(function(){
   $('.btn_edit_inven').click(function(){
    var idalat = $(this).prev().text();
    var data = $('.no_inven_span'+idalat).text();
    $('.td'+idalat).html('<input type="text" class="form-control no_inven'+idalat+'" style="width:100%" value="'+data+'">');
    $('.td_b'+idalat).html('<span style="display:none;">'+idalat+'</span><button class="btn btn-success btn_inven" onclick="saveNoInvent('+idalat+')">Simpan</button>');
  });
 });
</script>