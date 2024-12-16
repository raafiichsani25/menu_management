<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <style type="text/css">
    body{
    margin: 0;
    padding: 0;
    font: 400 .875rem 'Open Sans', sans-serif;
    color: #bcd0f7;
    background: #1A233A;
    position: relative;
    height: 100%;
}
.invoice-container {
    padding: 1rem;
}
.invoice-container .invoice-header .invoice-logo {
    margin: 0.8rem 0 0 0;
    display: inline-block;
    font-size: 1.6rem;
    font-weight: 700;
    color: #bcd0f7;
}
.invoice-container .invoice-header .invoice-logo img {
    max-width: 130px;
}
.invoice-container .invoice-header address {
    font-size: 0.8rem;
    color: #8a99b5;
    margin: 0;
}
.invoice-container .invoice-details {
    margin: 1rem 0 0 0;
    padding: 1rem;
    line-height: 180%;
    background: #1a233a;
}
.invoice-container .invoice-details .invoice-num {
    text-align: right;
    font-size: 0.8rem;
}
.invoice-container .invoice-body {
    padding: 1rem 0 0 0;
}
.invoice-container .invoice-footer {
    text-align: center;
    font-size: 0.7rem;
    margin: 5px 0 0 0;
}

.invoice-status {
    text-align: center;
    padding: 1rem;
    background: #272e48;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    margin-bottom: 1rem;
}
.invoice-status h2.status {
    margin: 0 0 0.8rem 0;
}
.invoice-status h5.status-title {
    margin: 0 0 0.8rem 0;
    color: #8a99b5;
}
.invoice-status p.status-type {
    margin: 0.5rem 0 0 0;
    padding: 0;
    line-height: 150%;
}
.invoice-status i {
    font-size: 1.5rem;
    margin: 0 0 1rem 0;
    display: inline-block;
    padding: 1rem;
    background: #1a233a;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}
.invoice-status .badge {
    text-transform: uppercase;
}

@media (max-width: 767px) {
    .invoice-container {
        padding: 1rem;
    }
}

.card {
    background: #272E48;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}

.custom-table {
    border: 1px solid #2b3958;
}
.custom-table thead {
    background: #2f71c1;
}
.custom-table thead th {
    border: 0;
    color: #ffffff;
}
.custom-table > tbody tr:hover {
    background: #172033;
}
.custom-table > tbody tr:nth-of-type(even) {
    background-color: #1a243a;
}
.custom-table > tbody td {
    border: 1px solid #2e3d5f;
}

.table {
    background: #1a243a;
    color: #bcd0f7;
    font-size: .75rem;
}
.text-success {
    color: #c0d64a !important;
}
.custom-actions-btns {
    margin: auto;
    display: flex;
    justify-content: flex-end;
}
.custom-actions-btns .btn {
    margin: .3rem 0 .3rem .3rem;
}
  </style>
  
  <title><?= $title; ?></title>

</head><body>




<!-- Fisrt -->
<div class="container">
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-body p-0">
            <div class="invoice-container">
              <div class="invoice-header">
    
                <!-- Row start -->
                <div class="row gutters">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="custom-actions-btns mb-5">
                     <!--  <a href="#" class="btn btn-primary">
                        <i class="icon-download"></i> Download
                      </a> -->
                     <!--  <a href="#" class="btn btn-secondary">
                        <i class="icon-printer"></i> Print
                      </a> -->
                    </div>
                  </div>
                </div>
                <!-- Row end -->
    
                <!-- Row start -->
                <div class="row gutters">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <a href="index.html" class="invoice-logo">
                      Radika Retail
                    </a>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <address class="text-right">
                      Dusun Krajan Rt.014 Rw.004<br>
                      Desa Sukasari Kecamatan Sukasari Kabupaten Subang<br>
                      41254
                    </address>
                  </div>
                </div>
                <!-- Row end -->
    
                <!-- Row start -->
                <div class="row gutters">
                  <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="invoice-details">
                      <address>
                        <?= $pembeli['pembeli']; ?><br>
                        Customer
                      </address>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="invoice-details">
                      <div class="invoice-num">
                        <div>Invoice</div>
                        <div><?= date('d F Y ',$pembeli['date']);?></div>
                      </div>
                    </div>                          
                  </div>
                </div>
                <!-- Row end -->
    
              </div>
    
              <div class="invoice-body">
    
                <!-- Row start -->
                <div class="row gutters">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                      <table class="table custom-table m-0">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Harga Jual</th>
                            <th>Quantity</th>
                            <th>Jumlah</th>
                            <th>Waktu</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php $i = 1; ?>
                          <?php $total = 0; ?>
                          <?php foreach($transaksi as $tr): ?>


                          <tr>
                            <td><?= $i; ?></td>
                            <td>
                             <?= $tr['nama_barang']; ?>
                            </td>
                            <td><?= $tr['harga_jual']; ?></td>
                            <td><?= $tr['qty']; ?></td>
                            
                            <td>
                              <?php $jumlah = $tr['harga_jual'] * $tr['qty'];?>
                               <?= number_format($jumlah,0,',','.'); ?>

                            </td>

                            <td><?= $tr['date']; ?></td>
                          </tr>
                          

                         

                          <?php $total += $jumlah; ?>
                          <?php $i++; ?>                       
                          <?php endforeach; ?>
                        </tbody>
                      </table>

<!-- GRAND TOTAL -->
                      <table>
                       <tr>
                            <td>
                              <h5 class="text-success"><strong>Grand Total</strong></h5>
                              <h5 class="text-success"><strong>Rp.<?= number_format($total,0,',','.'); ?></strong></h5>
                            </td>
                        </tr>
                      </table>
<!-- END GRAND TOTAL -->


                    </div>
                  </div>
                </div>
                <!-- Row end -->
    
              </div>
    
              <div class="invoice-footer">
                Terima Kasih Telah Belanja Ke Radika Retail
              </div>
    
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

























<!-- END -->


 <!-- <table width="100%">
<tr>
 <td width="25" align="center"><img src="<?= base_url('assets/img/pdf/radika.jpg'); ?>" width="100%" height="13%" style="border-radius: 50%;"></td>
<td width="50" align="center"><h1>Rekapitulasi Data Transaksi <br>RETAIL RADIKA</h1><h4>Dusun Krajan Rt.014 Rw.004 Desa Sukasari Kecamatan Sukasari Kabupaten Subang - Jawa Barat</h4></td>

</tr>
</table>
<hr>
      <h4>Nama Pembeli : <?= $pembeli['pembeli']; ?></h4>
     <h4>Total Transaksi : <?= $total_rows; ?></h4>
     <table border="3" cellspacing="3" cellpadding="3">
                              <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Barang</th>
                                  <th scope="col">Harga Jual</th>
                                  <th scope="col">Qty</th>
                                  <th scope="col">Jumlah</th>
                                  <th scope="col">Waktu</th>

                                 
                    
                                </tr>
                              </thead>
                              <tbody>
                                
                                <?php $i = 1; ?>
                                <?php $total = 0; ?>
                                <?php foreach($transaksi as $tr): ?>
                                <tr>
                                  <th scope="row"><?= $i; ?></th>
                                  <td align="center"><?= $tr['nama_barang']; ?></td>

                                   <td align="center"><?= $tr['harga_jual']; ?></td>


                                  <td align="center"><?= $tr['qty']; ?></td>

                                 <td>

                                    <?php $jumlah = $tr['harga_jual'] * $tr['qty'];?>

                                   
                                    <?= number_format($jumlah,0,',','.'); ?>

                                   </td> 

                                   <td align="center"><?= $tr['date']; ?></td>                          
                      
                                </tr>
                                 <?php $total += $jumlah; ?>
                                    <?php $i++; ?>                       
                                <?php endforeach; ?>   

                                </tbody>
                            </table>

                              <h1 class="text-primary">Total = Rp.<?= number_format($total,0,',','.'); ?></h1> -->

                           
</body>
</html>