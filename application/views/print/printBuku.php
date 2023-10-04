
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
 <table border="0" width="400" cellpadding="0" cellspacing="0">
  <tr>
<!--    <th colspan ="3"><img src="" width="120%" height="60%"></th> -->
  </tr>
  <tr bgcolor="#e7e7e7">
   <td width="150">ISBN :</td>
   <td ><?= $buku['kode']; ?></td>
  </tr>
  <tr bgcolor="#e7e7e7">
   <td width="150">Judul :</td>
   <td width="250"><?= $buku['judul']; ?></td>
  </tr>

  <tr bgcolor="#e7e7e7">
   <td width="150">Penulis :</td>
   <td ><?= $buku['penulis']; ?></td>
  </tr>

  <tr bgcolor="#e7e7e7">
   <td width="150">Penerbit :</td>
   <td ><?= $buku['penerbit']; ?></td>
  </tr>
 
  <tr bgcolor="#e7e7e7">
   <td width="150">Tahun :</td>
   <td ><?= $buku['tahun']; ?></td>
 
  <tr bgcolor="#e7e7e7">
   <td>QrCode_Data :</td>
   <td><?= $buku['qrcode_data']; ?></td>
  </tr>

  <tr bgcolor="#e7e7e7">
  <td></td>
  <td ><img src="<?= base_url('assets/img/qrcodebuku/') . $buku['qrcode_path']; ?>" width="100"></td>
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