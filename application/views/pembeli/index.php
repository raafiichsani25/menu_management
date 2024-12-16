  <!-- Begin Page Content -->
  <div class="scrollbar">
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                   <!-- Transaksi -->

                    <div class="row">
                      <div class="col-md-7">

                        
                        <form action="<?= base_url('Pembeli/index');?>" method="post">
                          
                          <div class="form-group row">
                            <label for="pembeli" class="col-sm-2 col-form-label" >Nama Pembeli</label>
                            <div class="col-sm-10" >

                            
                            
                             <input type="text" class="form-control" id="pembeli" name="pembeli" placeholder="Masukkan Nama" value="Pembeli Ke <?= $idnext; ?>">

                                 <?= form_error('pembeli',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>   

                          

                            <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label" >Tanggal</label>
                            <div class="col-sm-10">
                           <input type="text" class="form-control" id="date" name="date" value="<?= date("Y-m-d");?>" readonly>

                                <?= form_error('date',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>   


 
                            <div class="form-group row justify-content-end">
                       

                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>

                            </div>

                            </form>


                            <!-- Kolom Pencarian tanggal datepicker -->

                            <form action="<?= base_url('Pembeli/search');?>" method="post">
                          
                          <div class="col-sm-4">
                          <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal" name="keyword" autocomplete="off">
                         <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                              </div>
                          </div>

                        </form>


                  <h3>Jumlah Pembeli : <?= $total_rows; ?></h3>

                    <!-- TABLE -->
                <div class="row">
                    <div class="col-lg">

                      <?php if(validation_errors()): ?>
                        <!-- <div class="alert alert-danger" role="alert"></div> -->
                        <?= validation_errors() ?>
                      <?php endif; ?>
                      

                        <?= $this->session->flashdata('message'); ?>


                         <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Pembeli</th>
                                  <th scope="col">Date</th>
                                  <th scope="col">Aksi</th>
                    
                                </tr>
                              </thead>
                              <tbody>
                              <?php $i = 1; ?>
                                <?php foreach($pembeli as $pm): ?>

                                <tr>
                                  <th scope="row"><?= $i; ?></th>

                                  <td><?= $pm['pembeli']; ?></td>
                                  
                                  <td><?= date('Y-m-d', $pm['date']);?></td>

                          

                                  <td>
                                    <a href="<?= base_url('transaksi/tambahTransaksi/').$pm['id']; ?>" 
                                     class="badge badge-primary"  
                                     >Transaksi
                                    </a>
                                  
                                    

                                      <a href="<?= base_url('Pembeli/editPembeli/').$pm['id'];?>" class="badge badge-success">edit</a>

                                      <a href="<?= base_url('Pembeli/deletePembeli/').$pm['id'];?>" class="badge badge-danger" onclick= "return confirm('yakin data akan dihapus?');">delete</a>
                                  </td>



                                </tr>
                                  <?php $i++; ?>                
                                <?php endforeach; ?>   
                                </tbody>
                            </table>



                              <!-- pagination -->
                            <?= $this->pagination->create_links(); ?>

                            

                         </div>
                    </div>

    
                      

<script>

        // $('.custom-file-input').on('change', function() {

        //     let fileName = $(this).val().split('\\').pop();
        //     $(this).next('.custom-file-label').addClass("selected").html(fileName);


        // });

function pembeliId($id){

            var pembeliId = $(this).data($id);
             

             $.ajax({

                url: "<?= base_url("transaksi/tambahTransaksi"); ?>",
                type: "post",
                 data : {"pembeli":pembeliId.value},
                // data: {

                //     pembeliId: pembeliId,
                    
                // },

                success: function(){

                    document.location.href = "<?= base_url('transaksi/tambahTransaksi/');?>" + pembeliId;
              

            }

        //      });

        // });

    </script>


