<div class="scrollbar">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                            <!-- TABLE -->
                <div class="row">
                    <div class="col-lg">

                      <?php if(validation_errors()): ?>
                        <!-- <div class="alert alert-danger" role="alert"></div> -->
                        <?= validation_errors() ?>
                      <?php endif; ?>


                      <form action="<?= base_url('History/index');?>" method="post">
                          
                          <div class="col-sm-3">
                          <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal" name="keyword" autocomplete="off">
                         <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                              </div>
                          </div>

                        </form>

                      

                        <?= $this->session->flashdata('message'); ?>


                         <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                
                                  <th scope="col">Barang</th>
                                  <th scope="col">Modal</th>
                                  <th scope="col">Harga Jual</th>
                                  <th scope="col">qty</th>
                                  <th scope="col">Margin</th>
                                  <th scope="col">Jumlah</th>
                                  <th scope="col">Tanggal</th>
                    
                                </tr>
                              </thead>
                              <tbody>

                            

                              <?php $i = 1; ?>
                              
                              <?php $total = 0; 
                                    $total_margin = 0;
                              ?>

                                <?php foreach($transaksi as $tr): ?>

                                
                                <tr>
                                  <th scope="row"><?= $i; ?></th>

                                  
                                  
                                  <td><?= $tr['nama_barang']; ?></td>

                                  <td><?= number_format($tr['modal'],0,',','.'); ?></td>

                                  <td><?= number_format($tr['harga_jual'],0,',','.'); ?></td>

                                   <td><?= $tr['qty']; ?></td>

                                   <td>
                                     <?php $laba = $tr['harga_jual'] - $tr['modal'];

                                            $margin = $laba * $tr['qty'];

                                      ?>

                                      <?= number_format($margin,0,',','.'); ?>

                                   </td>

                                   <td><?php $jumlah = $tr['harga_jual'] * $tr['qty'];?>

                                   
                                    <?= number_format($jumlah,0,',','.'); ?>

                                  

                                   </td>

                                   <td><?= $tr['date']; ?></td>


                                  
                                </tr>
                                 <?php $total += $jumlah;
                                       $total_margin += $margin;
                                 ?>
                                  <?php $i++; ?>

                                 

                                <?php endforeach; ?>  

                               
                                </tbody>
                            </table>


                            <h1 class="text-success">Total Margin = Rp.<?= number_format($total_margin,0,',','.'); ?></h1>

                            <h1 class="text-primary">Pendapatan = Rp.<?= number_format($total,0,',','.'); ?></h1>



                   


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

</div>

          