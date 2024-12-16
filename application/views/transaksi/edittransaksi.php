
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="row">
                        <div class="col-lg-8">

                     <?php if(validation_errors()): ?>
                        <!-- <div class="alert alert-danger" role="alert"></div> -->
                        <?= validation_errors() ?>
                      <?php endif; ?>
                      

                    <?= $this->session->flashdata('message'); ?>



                            

         <form action="<?= base_url('Transaksi/editTransaksi/').basename(current_url());?>" method="post">
                    
                             
                        <div class="form-group row">
                            <label for="pembeli_id" class="col-sm-2 col-form-label" >Pembeli :</label>
                            <div class="col-sm-10">

                              <input type="text" class="form-control" id="pembeli_id" name="pembeli_id" value="<?= $transaksi['pembeli'];?>" readonly>


                                 <?= form_error('pembeli_id',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>   



                         <div class="form-group row">
                            <label for="barang_id" class="col-sm-2 col-form-label" >QrCode Barang </label>
                            <div class="col-sm-10">

                              <input type="text" class="form-control" id="barang_id" name="barang_id" placeholder="Scan QrCode Barang" value="<?= $transaksi['nama_barang']; ?>">
                             

                               <p id="tampil_barang" style="color:red;"></p>
                               <p id="tampil_modal" style="color:red;"></p>
                               <p id="tampil_harga_jual" style="color:red;"></p>
                               <p id="tampil_stok" style="color:red;"></p>

                                 <?= form_error('barang_id',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>   




                           <div class="form-group row">
                            <label for="qty" class="col-sm-2 col-form-label" >Qty</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="qty" name="qty" placeholder="Banyak nya Barang" value="<?= $transaksi['qty']; ?>">
                              

                                <?= form_error('qty',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>   




                         


                           
                          <!--   <div class="form-group row">
                            <div class="col-sm-2">Gambar</div>
                            <div class="col-sm-10">
                                
                             <div class="row">
                                    
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/barang/') . $barang['gambar'];?>" class="img-thumbnail">            
                                    </div>

                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                          <label class="custom-file-label" for="gambar">Choose file</label>
                                     </div>

                             </div>
                                
                            </div>
                            </div>
                            </div>   -->




                            <div class="form-group row justify-content-end">

                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Edit</button>

                                    <button type="submit" class="btn btn-success"><a href="<?= base_url('Transaksi/tambahTransaksi/').$transaksi['pembeli_id'];?>">Kembali</a></button>
                                </div>



                            </div>

                        </form>



                     </div>
                    </div>
                   


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



 <!-- enter on event -->
<script type="">
  var barang_id = document.getElementById("barang_id");
  


  barang_id.addEventListener("keypress", function(event){

    if(event.key === "Enter"){

       $.ajax({
        type: 'POST',
        url: '<?= base_url('Transaksi/namaBarang'); ?>',
         data : {"barang_id":barang_id.value},
        beforeSend:function(response) {
          $('#tampil_barang').html("Sedang memproses data, silahkan tunggu...");
        },
        
    
          success:function(response) {
            console.log(response)
            const data = JSON.parse(response);
        
        $('#tampil_barang').html("Nama Barang : "+data.barang);
        $('#tampil_modal').html("Modal : " + data.modal);
        $('#tampil_harga_jual').html("Harga Jual : " + data.harga_jual);
        $('#tampil_stok').html("Stok : "+data.stok);
        },
      
        error: function (response) {

        },

        });


      event.preventDefault();

       
      
    }
  });
  

</script>      

          