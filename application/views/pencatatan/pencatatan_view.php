 <div class="app-container-slide">
  <div class="container-fluid">
    <div class="side-body padding-top"  style="padding-top:90px;">

      <div class="row  no-margin-bottom">
        <div class="row">
          <div class="col-xs-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                  <span class="title">Pencatatan</span>
                </div>
              </div>
              <div class="card-body">

                <div>
                  <table class="table table-bordered table-stripped table-hovered">
                    <tr class="active">
                      <th> Nomor Dokumen </th>
                      <th> Tahun Anggaran </th>
                      <th> Nama Paket </th>
                      <th> Aksi </th>
                    </tr>
                    <? foreach ($paket as $p) {?>
                    <tr>
                    <td> <?=$p['ID_PROGRESS_PAKET']?>//PAKET-<?=$p['ID_PAKET']?>/<?=$p['TAHUN_ANGGARAN']?> </td>
                    <td><?=$p['TAHUN_ANGGARAN']?></td>
                    <td> <?=$p['NAMA_PAKET']?> </td>
                      <td> <a class="btn btn-primary" href="<?=site_url()?>Pencatatan/Detail/<?=$p['ID_PAKET']?>"> <i class="fa fa-search"></i> Detail</a></td>
                   </tr>
                    <? } ?>
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