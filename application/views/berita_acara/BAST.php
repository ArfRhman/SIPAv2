<?php
$nama = '';
$nip = '';
$anggota = '';
foreach ($timPenerima as $tp ) {
    if($tp['STATUS_KETUA']==1){
        $nama = $tp['NAMA_PEGAWAI'];
        $nip = $tp['NIP'];
    }else{
    $anggota .= '<tr>
            <td width="243" valign="top">
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
                <p>
                    <strong>'.$tp['NAMA_PEGAWAI'].'</strong>
                </p>
            </td>
            <td width="124" valign="top">
            </td>
        </tr>
        <tr>
            <td width="243" valign="top">
                <p>
                   
                </p>
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
                <p>
                    NIP '.$tp['NIP'].'
                </p>
            </td>
            <td width="124" valign="top">
            </td>
        </tr>
        <tr>
            <td width="243" valign="top">
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
            </td>
            <td width="124" valign="top">
            </td>
        </tr>';
    }
}
$html='
<p align="center">
    <strong>
        <img width="633" height="123" src="'.base_url().'/assets/img/kopBAST.jpg">
    </strong>
</p>
<p align="center">
    <strong>BERITA ACARA PEMERIKSAAN </strong>
    <strong>HASIL </strong>
    <strong>PEKERJAAN</strong>
<Br>
    <strong>PENGADAAN ALAT PROGRAM KERJASAMA</strong>
    <strong></strong>
<br>
    <strong>POLITEKNIK NEGERI BANDUNG TAHUN ANGGARAN '.date('Y').'</strong>
</p>
<p align="center">
    Nomor : ....
</p>
<p>
    Pada hari ini, tanggal '.date('d-m-Y').', kami yang bertandatangan di bawah ini:
</p>
<p>
    Nama :'.$nama.'
</p>
<p>
    NIP : '.$nip.'
</p>
<p>
    Jabatan : Ketua Panitia Pemeriksa/Penerima Hasil Pekerjaan Barang/Jasa Politeknik Negeri Bandung
</p>
<p>
    Alamat : Jl. Gegerkalong Hilir, Ds. Ciwaruga Bandung 40012
</p>
<p>
    Telah mengadakan pemeriksaan hasil Pengadaan Alat Program Kerjasama Politeknik Negeri Bandung Tahun Anggaran '.date('Y').', yang dilaksanakan oleh:
</p>
<p>
    Nama Perusahaan : '.$penyedia['NAMA_PERUSAHAAN'].'
</p>
<p>
    NPWP : '.$penyedia['NPWP'].'
</p>
<p>
    Alamat : '.$penyedia['ALAMAT'].'
</p>
<p>
    Nomor Kontrak : ....
</p>
<p>
    dengan lampiran sebagai berikut :
</p>
<p>
    Kondisi pekerjaan ……………................................baik
</p>
<p>
    Volume pekerjaan ………...............................…….sesuai dengan SPK dengan capaian pekerjaan sebesar <strong>100%</strong><strong>.</strong>
</p>
<p>
    Demikian Berita Acara ini dibuat dengan sebenarnya, dan untuk dipergunakan seperlunya.
</p>
<table border="0" cellspacing="0" cellpadding="0" width="661">
    <tbody>
        <tr>
            <td width="243" valign="top">
                <p>
                    Yang menyerahkan pekerjaan,
                </p>
            </td>
            <td width="38" valign="top">
            </td>
            <td width="380" colspan="2" valign="top">
                <p>
                    Panitia Pemeriksa/Penerima Hasil Pekeraan Barang/Jasa
                </p>
            </td>
        </tr>
        <tr>
            <td width="243" valign="top">
                <p>
                   '.$penyedia['NAMA_PERUSAHAAN'].'
                </p>
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
                <p>
                    Ketua,
                </p>
            </td>
            <td width="124" valign="top">
            </td>
        </tr>
        <tr>
            <td width="243" valign="top">
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
                <p>
                    <strong></strong>
                </p>
            </td>
            <td width="124" valign="top">
            </td>
        </tr>
        <tr>
            <td width="243" valign="top">
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
                <p>
                    <strong>'.$nama.'</strong>
                </p>
            </td>
            <td width="124" valign="top">
            </td>
        </tr>
        <tr>
            <td width="243" valign="top">
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
                <p>
                    NIP '.$nip.'<strong></strong>
                </p>
            </td>
            <td width="124" valign="top">
            </td>
        </tr>
        <tr>
            <td width="243" valign="top">
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
                <p>
                    <strong></strong>
                </p>
            </td>
            <td width="124" valign="top">
            </td>
        </tr>
        <tr>
            <td width="243" valign="top">
                <p>
                    <strong>'.$penyedia['PIC_PERUSAHAAN'].'</strong>
                </p>
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
                <p>
                    Anggota,<strong></strong>
                </p>
            </td>
            <td width="124" valign="top">
                <p>
                    <strong></strong>
                </p>
            </td>
        </tr>
        <tr>
            <td width="243" valign="top">
                <p>
                    PIC PERUSAHAAN<strong></strong>
                </p>
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
                <p>
                    <strong></strong>
                </p>
            </td>
            <td width="124" valign="top">
            </td>
        </tr>
         
        '.$anggota.' 
       
        <tr>
            <td width="243" valign="top">
                <p>
                <strong></strong>
                </p>
            </td>
            <td width="38" valign="top">
            </td>
            <td width="255" valign="top">
            </td>
            <td width="124" valign="top">
            </td>
        </tr>
    </tbody>
</table>';

//==============================================================
//==============================================================
//==============================================================

include_once APPPATH.'/third_party/mpdf/mpdf.php';
$mpdf=new mPDF('c'); 

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>
