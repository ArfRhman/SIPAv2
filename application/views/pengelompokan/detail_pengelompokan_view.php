<div class="card">
 <div class="card-body"  style="padding: 0px 20px !important;">
  <div class="sub-title">Nama Paket Pengelompokan  
  <input type="text" style="width: 30%; margin-left: 1%;" name="nama" class="form-control" placeholder="Masukan Nama Paket Pengelompokan" value="<?php if(!empty($kategori)){?><?=$kategori['NAMA_PAKET']?><?php } ?>"> </div>
    <div>
    </div>
    <div class="sub-title">Tim HPS 
    <select name="tim" class="form-control" style="width: 20%;margin-left:1%;">
      <?php foreach($tim as $t){?>
      <option value="<?=$t['ID_TEAM_HPS']?>" <?php if(!empty($kategori)){?><?=$kategori['ID_TEAM_HPS']==$t['ID_TEAM_HPS'] ? 'selected' : ''?><?php } ?>><?=$t['NAMA_TIM']?></option>
      <?php } ?> 
    </select></div>
    <div>
    <h4>Data Alat Dalam Paket Sekarang  : </h4>
    </div>
    <Br>
     <table class="table table-bordered table-stripped table-hovered">
      <tr class="active">
        <th> Jurusan </th>
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
      </tr>
      <?php 
      $total=0;
      $id_kat=0;
      foreach($paket as $k){
        $total=$total+($k['HARGA_SATUAN']*$k['JUMLAH_ALAT']);
        $id_kat=$k['ID_KATEGORI'];
       ?>
       <tr <?=empty($k['ID_PAKET']) ? 'style="border:2px solid red"' : ''?>>
        <td> <?=$k['NAMA_JURUSAN']?></td>
        <td> <?=$k['NAMA_ALAT']?> </td>
        <td> <?=$k['SPESIFIKASI']?> </td>
        <td> <?=$k['SETARA']?></td>
        <td> <?=$k['SATUAN']?> </td>
        <td> <?=$k['JUMLAH_ALAT']?></td>
        <td> <?=number_format($k['HARGA_SATUAN'],'0',',','.')?> </td>
        <td> <?=number_format($k['HARGA_SATUAN']*$k['JUMLAH_ALAT'],'0',',','.')?> </td>
        <td> <?=$k['NAMA_LOKASI']?></td>
        <td> <?=$k['JUMLAH_DISTRIBUSI']?></td>
        <td> <a href="<?=base_url()?>assets/referensi/<?=$k['REFERENSI_TERKAIT']?>" target="_blank"> <?=$k['REFERENSI_TERKAIT']?> </a></td>
        <td> <input type="checkbox" <?=$k['DATA_AHLI']==1 ? 'selected' : ''?> disabled=""></td>
        <td> <?=$k['TANGGAL_UPDATE']?></td>
      </tr>
      <?php 
    }
    ?>
    <input type="hidden" name="total" value="<?=$total?>">
    <input type="hidden" name="kategori" value="<?=$id_kat?>">
  </table>
  <hr>
</div>