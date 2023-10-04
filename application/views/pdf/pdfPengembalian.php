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
<td width="50" align="center"><h1>Laporan Data Peminjaman Buku <br> Perpustakaan Panatagama</h1><h4>Jln. Darmodiharjo No. 23 A, Sukamelang, Kec. Subang, Kab. Subang Prov. Jawa Barat</h4></td>

</tr>
</table>
<hr>
     <h4>Total Pengembalian Buku : <?= $total_rows; ?></h4>
     <table border="3" cellspacing="3" cellpadding="3">
                              <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Siswa</th>
                                  <th scope="col">Judul Buku</th>
                                  <th scope="col">Tanggal Pinjam</th>
                                  <th scope="col">Tanggal Pengembalian</th>
                                  <th scope="col">Keterangan</th>
                                  
                    
                                </tr>
                              </thead>
                              <tbody>
                                
                                <?php $i = 1; ?>
                                <?php foreach($pengembalian as $pn): ?>
                                <tr>
                                  <th scope="row"><?= $i; ?></th>

                                  <td align="center"><?= $pn['nama']; ?></td>

                                  <td align="center"><?= $pn['judul']; ?></td>

                                  <td align="center"><?= date('d F Y ',$pn['tanggal_pinjam']);?></td>

                                  <td align="center"><?= date('d F Y ',$pn['tanggal_pengembalian']);?></td>

                                  <td align="center"><?= $pn['keterangan']; ?></td>
                                                              
                      
                                </tr>
                                    <?php $i++; ?>                       
                                <?php endforeach; ?>   

                                </tbody>
                            </table>

                           
</body>
</html>