
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="row">
                        <div class="col-lg-8">
                            
                         <form action="<?= base_url('Pembeli/editPembeli/').basename(current_url());?>" method="post">
                      
                             
                             <input type="hidden" class="form-control" id="id" name="id" value="<?= $pembeli['id'];?>">


                            <div class="form-group row">
                            <label for="pembeli" class="col-sm-2 col-form-label">Nama Pembeli</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="pembeli" name="pembeli" value="<?= $pembeli['pembeli'];?>">

                              <?= form_error('pembeli',' <small class ="text-danger pl-3">',' </small>');?>
                            </div>
                          </div>    



                            <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Tanggal Dibuat</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control datepicker" id="date" name="date" value="<?= $pembeli['date']; ?>">

                              <p><?= date('d F Y ',$pembeli['date']); ?></p>

                             <?= form_error('modal',' <small class ="text-danger pl-3">',' </small>');?>

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


                                     <button type="submit" class="btn btn-success"><a href="<?= base_url('Pembeli/index');?>">Kembali</a></button>

                                </div>

                            </div>

                        </form>


                     </div>
                    </div>
                   


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

          