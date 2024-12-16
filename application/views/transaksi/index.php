<div class="scrollbar">
  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                   <!-- Transaksi -->

                    <div class="row">
                      <div class="col-md-7">

          
       <form action="<?= base_url('Transaksi/tambahTransaksi/').basename(current_url());?>" method="post">
                          
                          <div class="form-group row">
                            <label for="pembeli_id" class="col-sm-2 col-form-label" >Pembeli :</label>
                            <div class="col-sm-10">

                              <input type="text" class="form-control" id="pembeli_id" name="pembeli_id" value="<?= $pembeli['pembeli'];?>" readonly>


                                 <?= form_error('pembeli_id',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>   


                          <div class="form-group row">
                            <label for="barang_id" class="col-sm-2 col-form-label" >QrCode Barang </label>
                            <div class="col-sm-10">

                              <input type="text" class="form-control" id="barang_id" name="barang_id" placeholder="Scan QrCode">

                               <p id="tampil_barang" style="color:red;"></p>
                               <p id="tampil_modal" style="color:red;"></p>
                               <p id="tampil_harga_jual" style="color:red;"></p>
                               <p id="tampil_stok" style="color:red;"></p>
                               <p id="tampil_gambar" style="color:red;"></p>
                              
                              
                               </div>

                              
                
                           <div class="form-group row">
                            <label for="qty" class="col-sm-2 col-form-label" >Qty</label>
                            <div class="col-sm-10">
                            
                              <input type="text" class="form-control" id="qty" name="qty" placeholder="Banyak nya Barang">

                                <?= form_error('qty',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>
                          </div>
                           




                           
                            <div class="form-group row justify-content-end">
                       

                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary col-sm-10">Tambah</button>
                                </div>

                            

                            </form>


                            <div class="col-sm-10">
                            <a href="<?= base_url('Transaksi/pdfTransaksi/').$pembeli['id']; ?>" class="btn btn-warning mt-2 col-sm-10 " ><i class="fa fa-file" target="_BLANK"></i> Cetak Invoice</a>
                            </div>

                          </div>


                

                    <!-- TABLE -->
                <div class="row">
                    <div class="col-lg">

                      <?php if(validation_errors()): ?>
                        <!-- <div class="alert alert-danger" role="alert"></div> -->
                        <?= validation_errors() ?>
                      <?php endif; ?>
                      

                        <?= $this->session->flashdata('message'); ?>

                        <h5>Total Belanja : <?= $total_rows; ?></h5>

                         <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                
                                  <th scope="col">Barang</th>
                                  <th scope="col">Modal</th>
                                  <th scope="col">Harga Jual</th>
                                  <th scope="col">qty</th>
                                  <th scope="col">Jumlah</th>
                                  <th scope="col">Waktu</th>
                                  <th scope="col">Aksi</th>
                    
                                </tr>
                              </thead>
                              <tbody>
                                
                              <?php $i = 1; ?>
                              <?php $total = 0; ?>
                                <?php foreach($transaksi as $tr): ?>

                                <tr>
                                  <th scope="row"><?= $i; ?></th>

                            
                                  
                                  <td><?= $tr['nama_barang']; ?></td>

                                  <td><?= number_format($tr['modal'],0,',','.'); ?></td>

                                  <td><?= number_format($tr['harga_jual'],0,',','.'); ?></td>

                                   <td><?= $tr['qty']; ?></td>



                                   <td>

                                    <?php $jumlah = $tr['harga_jual'] * $tr['qty'];?>

                                   
                                    <?= number_format($jumlah,0,',','.'); ?>

                                   </td>


                                    <td><?= $tr['date']; ?></td>


                                  <td>

                                      <a href="<?= base_url('Transaksi/editTransaksi/').$tr['id'];?>" class="badge badge-success">edit</a>

                                      <a href="<?= base_url('Transaksi/deleteTransaksi/').$tr['id'];?>" class="badge badge-danger" onclick= "return confirm('yakin data akan dihapus?');">delete</a>
                                  </td>
                                </tr>
                                 <?php $total += $jumlah; ?>
                                  <?php $i++; ?>

                                 

                                <?php endforeach; ?>   
                                </tbody>
                            </table>

                            <h1 class="text-primary">Total = Rp.<?= number_format($total,0,',','.'); ?></h1>


                            <form action="" method="post">
                             <label for="kembalian" class="col-sm-2 col-form-label" ><h5 class="font-weight-bold">Masukkan Uang Cash</h5></label>
                            <input type="" name="kembalian" placeholder="Masukkan Uang Bayar">
                            <button type="submit">Cek Kembalian</button>
                            </form>


                            


                           <?php $kembalian = $this->input->post('kembalian'); ?>

                            <h1 class="text-danger">Uang Yang Dibayar = Rp.<?= number_format($kembalian,0,',','.'); ?></h1>
                              

                             <!-- mengkonversi rupiah ke bilangan bulat -->
                            <!-- <? preg_replace('/[Rp. ]/','',$total); ?> -->



                             <?php if($kembalian < $total) : ?>
                             
                              <?php $kembalian -= $total;  ?>
                              <div class="alert alert-danger" role="alert">
                             Uang Cash Kurang Dari Total Belanja
                             <h1>Si <?= $pembeli['pembeli']; ?> Uang nya Kurang <?= number_format($kembalian,0,',','.'); ?></h1>
                            </div>
                           
                            
                            
                             <?php else : ?>
                              <?php $kembalian -= $total;  ?>
                              <h1 class="text-success">Kembalian = Rp.<?= number_format($kembalian,0,',','.'); ?></h1>
                             <?php endif ; ?>
                            

                         </div>
                    </div>



                      


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
            
            
        
        $('#tampil_barang').html("Nama Barang : "+ data.barang);
        
        $('#tampil_modal').html("Modal : " + data.modal);
        $('#tampil_harga_jual').html("Harga Jual : " + data.harga_jual);
        $('#tampil_stok').html("Stok : "+ data.stok);

        // var gambarSrc = data.gambar;
        // var imgElement = $('<img>');
        // imgElement.attr( 'src' , gambarSrc);


        $('#tampil_gambar').html(data.gambar);


        

        },
      
        error: function (response) {

        },

        });


      event.preventDefault();

       
      
    }
  });
  

</script>      