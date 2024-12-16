
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
 <table border="0" width="150" cellpadding="0" cellspacing="0">

 
 
   <?php for ($i=0; $i < 5; $i++): ?>      
        <tr bgcolor="#e7e7e7">
           <?php for ($j=0; $j < 5; $j++): ?> 
                <td>                
                <img src="<?= base_url('assets/img/qrcode-barang/') . $barang['qrcode_path']; ?>" width="150">
                    <p style="text-align:center"><?= $barang['qrcode_data']; ?></p>
                </td>
                <?php endfor; ?>
        </tr>
    <?php endfor; ?>
  

  
  <!-- <tr bgcolor="#e7e7e7">

    <td >
      <img src="<?= base_url('assets/img/qrcode-barang/') . $barang['qrcode_path']; ?>" width="150">
      <p style="text-align:center"><?= $barang['qrcode_data']; ?></p>
    </td>
    
  
  </tr> -->
  
  
  
  

 
 </table>

  <script type="text/javascript">
  window.print();
  </script>
</body>
</html>