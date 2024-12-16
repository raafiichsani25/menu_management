<div class="scrollbar">
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>




                    <?php 

                    
                    
                    $query = "SELECT COUNT(`stok`) AS `jumlah_total`
                     FROM `barang` 
                     "AND"(`stok` == '1'   ";

                      $count_id = $this->db->query($query)->result();

                      
                   
                      foreach($count_id as $brp_id) { ?>


                        <button class="btn btn-link btn-xs" style="color : black;" data-bs-toogle="dropdown">
                          <i class="fa fa-bell-o fa-lg"><input id="button_notif" style=" background-color: red; width: 20px; height:20px; border-radius: 100%; text-align: center; border-color:red; font: 8px;" value="<?= $brp_id->jumlah_total ?>" readonly></i>
                        </button>

                      <?php }?>

                        <div class="dropdown col-md-5">

                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fas fa-solid fa-bell"></i>
                        </button>
                        
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <table>
                          <p style="border-style: solid; border-width: 1px;"></p>
                          <td class="dropdown-item" id="button_isi"></td>
                        </table>
                          
                        </div>
                      </div>




                    <br>

                     <body onmousemove="tampil_button_notif(); tampil_isi_notif();"></body>
                    

                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newBarangModal">Tambah Barang</a>

                     <a href="<?= base_url('Barang/pdfBarang'); ?>" class="btn btn-warning mb-3" ><i class="fa fa-file" target="_BLANK"></i> Export PDF</a>


                   <!-- Searching -->

                    <div class="row">
                      <div class="col-md-5">
                        
                        <form action="<?= base_url('Barang/search');?>" method="post">
                          
                          <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Search atau Scan QrCode" name="keyword" autocomplete="off" autofocus >
                         <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                              </div>
                            </div>

                        </form>

                      </div>
                    </div>

                    


                    <!-- TABLE -->
                <div class="row">
                    <div class="col-lg">

                      <?php if(validation_errors()): ?>
                        <div class="alert alert-danger" role="alert">
                        <?= validation_errors() ?>
                        </div>
              
                      <?php endif; ?>
                      

                        <?= $this->session->flashdata('message'); ?>
                       

                         <h5>Data Barang : <?= $total_rows; ?></h5>

                         

                        <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Nama Barang</th>
                                  <th scope="col">Gambar</th>
                                  <th scope="col">Modal</th>
                                  <th scope="col">Harga Jual</th>
                                  <th scope="col">Stok</th>
                                  <th scope="col">QrCode Path</th>
                                  <th scope="col">QrCode Data</th>
                                  <th scope="col">Update</th>
                                  <th scope="col">Aksi</th>
                    
                                </tr>
                              </thead>
                              <tbody>
                              
                                <?php foreach($barang as $br): ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>
                                  <td><?= $br['nama_barang']; ?></td>
                                  <td>

                                    <div class="form-group row">
                                      <div class="col-sm-5">
                                    <img src="<?= base_url('assets/img/barang/') . $br['gambar']; ?>" class="img-fluid rounded-start" class="img-thumbnail">
                                  </div>
                                </div>
                                
                                  </td>

                                   <td><?php echo number_format($br['modal']); ?></td>

                                   <td><?php echo number_format($br['harga_jual']); ?></td>

                                   
                                   <td><?= $br['stok']; ?></td>

                                    

                                   <td>

                                    <div class="form-group row">
                                      <div class="col-sm-5">
                                    <img src="<?= base_url('assets/img/qrcode-barang/') . $br['qrcode_path']; ?>" class="img-fluid rounded-start" class="img-thumbnail">
                                  </div>
                                </div>
                                
                                  </td>

                                   <td><?= $br['qrcode_data']; ?></td>

                                   <td><?= $br['date']; ?></td>

                                                              
                                  <td>

                                      <a href="<?= base_url('Barang/printBarang/').$br['id']; ?>" class="badge badge-warning fa fa-print">Print</a>

                                      <a href="<?= base_url('Barang/editBarang/').$br['id'];?>" class="badge badge-success">edit</a>

                                      <a href="<?= base_url('Barang/deleteBarang/').$br['id'];?>" class="badge badge-danger" onclick= "return confirm('yakin data akan dihapus?');">delete</a>
                                  </td>
                                </tr>
                                                       
                                <?php endforeach; ?>   
                                </tbody>
                            </table>



                              <!-- pagination -->
                            <?= $this->pagination->create_links(); ?>


                    </div>
                </div>   


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



            <!-- Modal -->
            <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="newBarangModal" tabindex="-1" role="dialog" aria-labelledby="newBarangModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newBarangModalLabel">Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


<!-- body modal -->
     <form action="<?= base_url('Barang/index')?>" method="post">

       <?= $this->session->flashdata('message'); ?>
       
      <div class="modal-body">
        
         <div class="form-group">
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang">
        </div>

                         <!-- <div class="form-group row">
                            <div class="col-sm-10">
                                
                             <div class="row">

                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="foto" name="foto">
                                          <label class="custom-file-label" for="foto">Choose file</label>
                                     </div>

                             </div>
                                
                             </div>
                            </div>
                          </div> -->

             <div class="form-group">
               <input type="text" class="form-control" id="modal" name="modal" placeholder="Masukkan Modal Barang">
            </div>


            <div class="form-group">
               <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukkan Harga Jual">
            </div>


           <div class="form-group">
               <input type="text" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok Barang">
            </div>

             <div class="form-group">
               <input type="text" class="form-control" id="stok" name="qrcode_data" placeholder="Masukkan QrCode/Barcode Jika Ada">
            </div>

     </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>

         </form>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function tampil_button_notif(){
    $.ajax({
      url:"<?= base_url('Barang/untuk_buttonnya')?>",
      method: 'post',
      dataType: 'json',
      success: function(data)
      {
        $("#button_notif").val(data.jumlah_total);
        console.log(data.jumlah_total)
      }

    });

  }

  function tampil_isi_notif(){
    $.ajax({

      url:"<?= base_url('Barang/untuk_isinya') ?>",
      success: function(html)
      {
        $('#button_isi').html(html);
      }

    });
  }




</script>

          