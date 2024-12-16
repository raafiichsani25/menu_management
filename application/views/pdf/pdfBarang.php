<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
  <title><?= $title; ?></title>

</head><body>

 <table width="100%">
<tr>
 <td width="25" align="center"><img src="<?= base_url('assets/img/pdf/radika.jpg'); ?>" width="100%" height="13%" style="border-radius: 50%;"></td>
<td width="50" align="center"><h1>Laporan Data Barang <br> RETAIL RADIKA </h1><h4>Dusun Krajan Rt.014 Rw.004 Desa Sukasari Kecamatan Sukasari Kabupaten Subang - Jawa Barat</h4></td>

</tr>
</table>
<hr>


     <h4>Total Barang : <?= $total_rows; ?></h4>
     <table border="3" cellspacing="3" cellpadding="3">
                              <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Nama Barang</th>
                                  <th scope="col">Gambar</th>
                                  <th scope="col">Modal</th>
                                  <th scope="col">Harga Jual</th>
                                  <th scope="col">Stok</th>
                                  <th scope="col">QrCode Path</th>
                                  <th scope="col">QrCode Data</th>
                                  
                    
                                </tr>
                              </thead>
                              <tbody>
                                
                                <?php $i = 1; ?>
                                <?php foreach($barang as $br): ?>
                                <tr>
                                  <th scope="row"><?= $i; ?></th>
                                  <td><?= $br['nama_barang']; ?></td>

                                  <td align="center">

                                    <div class="form-group row">
                                     <div class="col-sm-4">
                                    <img src="<?= base_url('assets/img/barang/') . $br['gambar']; ?>" class="img-fluid rounded-start" class="img-thumbnail" width="30%" height="8%">
                                   </div>
                                   </div>
                                
                                  </td>
                                 
                                  <td><?= $br['modal']; ?></td>
                                  <td><?= $br['harga_jual']; ?></td>
                                  <td><?= $br['stok']; ?></td>

                                   <td align="center">

                                    <div class="form-group row">
                                     <div class="col-sm-5">
                                    <img src="<?= base_url('assets/img/qrcode-barang/') . $br['qrcode_path']; ?>" class="img-fluid rounded-start" class="img-thumbnail" width="50%" height="10%">
                                   </div>
                                   </div>
                                
                                  </td>


                                   <td><?= $br['qrcode_data']; ?></td>

                                                              
                      
                                </tr>
                                    <?php $i++; ?>                       
                                <?php endforeach; ?>   

                                </tbody>
                            </table>

                           
</body>
</html>