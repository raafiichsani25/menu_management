
<!DOCTYPE html>
<html>
<head>
 <title><?= $title; ?></title>
 <style type="text/css">
  body {
   font-family: Arial;
  }
  td {
   padding: 10px;
  }
  table {
   margin: auto;
   margin-top: 90px;
  }
 </style>
</head>
<body bgcolor="#181a1c">

 <table border="0" width="500" cellpadding="0" cellspacing="0">
  <tr>
<!--    <th colspan ="3"><img src="" width="120%" height="60%"></th> -->

  </tr>

  <tr bgcolor="#e7e7e7">
    <td></td>
    <td width="150"><h3>Kartu Anggota</h3></td>

  </tr>

  <tr bgcolor="#e7e7e7">
   <td width="150">Nama Lengkap</td>
   <td width="250">: <?= $siswa['nama']; ?></td>
  </tr>

  <tr bgcolor="#e7e7e7">
   <td width="150">NISN :</td>
   <td>: <?= $siswa['nis']; ?></td>
  </tr>
 
  <tr bgcolor="#e7e7e7">
   <td>QrCode_Data :</td>
   <td>: <?= $siswa['qrcode_data']; ?></td>
  </tr>

 <tr bgcolor="#e7e7e7">

  <td ><img src="<?= base_url('assets/img/siswa/') . $siswa['foto']; ?>" width="95"></td>
   <td><img src="<?= base_url('assets/img/qrcode/') . $siswa['qrcode_path']; ?>" width="95"></td>
 </tr>

  <tr bgcolor="#ff0000">
   <td colspan="4" align="center">Created By : 173040152</a></td>
  </tr>
 </table>

  <script type="text/javascript">
  window.print();
  </script>
</body>
</html>