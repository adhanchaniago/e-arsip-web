<!DOCTYPE html>
<html>
<body onload=" window.print();" onafterprint="window.close();">
     <div>
        <center>PEMERINTAH KABUPATEN JEMBER</center>
        <center>KECAMATAN BALUNG</center>
        <center>KANTOR DESA BALUNG KIDUL</center>
        <center>Jl.Pemuda no 23 Desa Balung Kidul kode Pos 68161</center>
        <center></center>
        <br>
        <hr>
        <br>
    </div>
    <table cellpadding="10" border="1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>No.</th>
                <th>No Surat</th>
                <th>Asal Surat</th>
                <th>Perihal</th>
                <th>Tanggal Arsip</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; foreach ($data_surat_masuk as $surat_masuk): ?>
            <tr>
                <td><?php echo ++$no; ?></td>
                <td><?php echo $surat_masuk->no_surat ?></td>   
                <td><?php echo $surat_masuk->asal_surat ?></td>
                <td><?php echo $surat_masuk->perihal ?></td>
                <td><?php echo date("d F Y", strtotime($surat_masuk->tgl_arsip)) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>