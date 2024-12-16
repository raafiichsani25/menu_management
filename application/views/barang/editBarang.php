
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                     <?= $this->session->flashdata('message'); ?>    
                    
                    <div class="row">
                        <div class="col-lg-8">
                            
                         <form action="<?= base_url('Barang/editBarang/').basename(current_url());?>" method="post" enctype="multipart/form-data">
                      
                             
                             <input type="hidden" class="form-control" id="id" name="id" value="<?= $barang['id'];?>">


                            <div class="form-group row">
                            <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $barang['nama_barang'];?>">

                              <?= form_error('nama_barang',' <small class ="text-danger pl-3">',' </small>');?>
                            </div>
                          </div>    



                            <div class="form-group row">
                            <label for="modal" class="col-sm-2 col-form-label">Modal</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="modal" name="modal" value="<?= $barang['modal'];?>">

                             <?= form_error('modal',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>  



                          <div class="form-group row">
                            <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?= $barang['harga_jual'];?>">

                             <?= form_error('harga_jual',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>   



                             <div class="form-group row">
                            <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="stok" name="stok" value="<?= $barang['stok'];?>">

                             <?= form_error('stok',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>   


                            <div class="form-group row">
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
                            </div>  


                            <div class="form-group row justify-content-end">

                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Edit</button>

                                     <button type="submit" class="btn btn-success"><a href="<?= base_url('Barang/index');?>">Kembali</a></button>
                                </div>

                            </div>

                        </form>


                     </div>
                    </div>
                   


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

          