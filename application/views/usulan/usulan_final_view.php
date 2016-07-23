<?php 
if(!empty($final)){
  ?>
  <div>
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
      <th> PIC </th>
    </tr>
    <?php foreach($final as $f){ ?>
    <tr>
      <td> <?=$f['NAMA_PAKET']?> </td>
      <td> <?=$f['NAMA_ALAT']?> </td>
      <td> <?=$f['SPESIFIKASI']?> </td>
      <td> <?=$f['SETARA']?> </td>
      <td> <?=$f['SATUAN']?></td>
      <td> <?=$f['JUMLAH_ALAT']?> </td>
      <td> <?=number_format($f['HARGA_SATUAN'],'0',',','.')?> </td>
      <td> <?=number_format($f['HARGA_SATUAN']*$f['JUMLAH_ALAT'],'0',',','.')?> </td>
      <td> <?=$f['NAMA_LOKASI']?></td>
      <td> <?=$f['JUMLAH_DISTRIBUSI']?></td>
      <td> <a href="<?=base_url()?>assets/referensi/<?=$f['REFERENSI_TERKAIT']?>" target="_blank"> <?=$f['REFERENSI_TERKAIT']?> </a></td>
      <td> <input type="checkbox" <?=$f['DATA_AHLI']==1 ? 'checked' : ''?> disabled=""></td>
      <td> <?=$f['TANGGAL_UPDATE']?></td>
      <td> <?=$f['NAMA_PEGAWAI']?></td>
    </tr>
    <?php } ?>
  </table>
</div>
<?php 
}else{
  echo "-- Usulan Final Belum Ada --";
}
?>