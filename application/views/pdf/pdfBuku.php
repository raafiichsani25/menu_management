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
 <td width="25" align="center"><img src="<?= base_url('assets/img/pdf/logo.png'); ?>" width="120%" height="25%"></td>
<td width="50" align="center"><h1>Laporan Data Buku <br> Perpustakaan Panatagama</h1><h4>Jln. Darmodiharjo No. 23 A, Sukamelang, Kec. Subang, Kab. Subang Prov. Jawa Barat</h4></td>

</tr>
</table>
<hr>
     <h4>Total Buku : <?= $total_rows; ?></h4>
     <table border="3" cellspacing="3" cellpadding="3">
                              <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Kode</th>
                                  <th scope="col">Judul</th>
                                  <th scope="col">Cover</th>
                                  <th scope="col">Penulis</th>
                                  <th scope="col">Penerbit</th>
                                  <th scope="col">Tahun</th>
                                  <th scope="col">QrCode Path</th>
                                  <th scope="col">QrCode Data</th>
                                  
                    
                                </tr>
                              </thead>
                              <tbody>
                                
                                <?php $i = 1; ?>
                                <?php foreach($buku as $bk): ?>
                                <tr>
                                  <th scope="row"><?= $i; ?></th>
                                  <td align="center"><?= $bk['kode']; ?></td>

                                   <td align="center"><?= $bk['judul']; ?></td>

                                  <td align="center">

                                    <div class="form-group row">
                                     <div class="col-sm-4">
                                    <img src="<?= base_url('assets/img/buku/') . $bk['gambar']; ?>" class="img-fluid rounded-start" class="img-thumbnail" width="30%" height="8%">
                                   </div>
                                   </div>
                                
                                  </td>
                                 

                                  <td align="center"><?= $bk['penulis']; ?></td>

                                  <td align="center"><?= $bk['penerbit']; ?></td>

                                  <td align="center"><?= $bk['tahun']; ?></td>

                                   <td align="center">

                                    <div class="form-group row">
                                     <div class="col-sm-5">
                                    <img src="<?= base_url('assets/img/qrcodebuku/') . $bk['qrcode_path']; ?>" class="img-fluid rounded-start" class="img-thumbnail" width="60%" height="8%">
                                   </div>
                                   </div>
                                
                                  </td>


                                   <td align="center"><?= $bk['qrcode_data']; ?></td>

                                                              
                      
                                </tr>
                                    <?php $i++; ?>                       
                                <?php endforeach; ?>   

                                </tbody>
                            </table>

                           
</body>
</html>