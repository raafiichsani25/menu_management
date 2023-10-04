
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


                    <div class="row">
                        <div class="col-lg-8">
                            
                        <form action="" method="post" enctype="multipart/form-data">
                      
                             
                             <input type="hidden" class="form-control" id="id" name="id" value="<?= $buku['id'];?>">


                            <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="kode" name="kode" value="<?= $buku['kode'];?>" readonly>
                            </div>
                          </div>    


                             <div class="form-group row">
                            <label for="nis" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="judul" name="judul" value="<?= $buku['judul'];?>" >

                              <?= form_error('judul',' <small class ="text-danger pl-3">',' </small>');?>
                            </div>
                          </div>   


                            <div class="form-group row">
                            <div class="col-sm-2">Gambar</div>
                            <div class="col-sm-10">
                                
                             <div class="row">
                                    
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/buku/') . $buku['gambar'];?>" class="img-thumbnail">            
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



                              <div class="form-group row">
                            <label for="nis" class="col-sm-2 col-form-label">Penulis</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $buku['penulis'];?>" >

                              <?= form_error('penulis',' <small class ="text-danger pl-3">',' </small>');?>
                            </div>
                          </div>   



                           <div class="form-group row">
                            <label for="nis" class="col-sm-2 col-form-label">Penerbit</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $buku['penerbit'];?>" >

                              <?= form_error('penerbit',' <small class ="text-danger pl-3">',' </small>');?>
                            </div>
                          </div>  


                           <div class="form-group row">
                            <label for="nis" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-10">
                              <input type="year" class="form-control" id="tahun" name="tahun" value="<?= $buku['tahun'];?>" >

                              <?= form_error('tahun',' <small class ="text-danger pl-3">',' </small>');?>
                            </div>
                          </div>    





                            
                           


                            <div class="form-group row justify-content-end">

                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>

                            </div>

                            </form>


                        </div>
                    </div>
                   


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

          