<div class="scrollbar">
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    

                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newBukuModal">Tambah Data Buku</a>

                      <a href="<?= base_url('Buku/pdfBuku'); ?>" class="btn btn-warning mb-3" ><i class="fa fa-file" target="_BLANK"></i> Export PDF</a>

                     <!-- Searching -->

                    <div class="row">
                      <div class="col-md-5">
                        
                        <form action="<?= base_url('Buku/search');?>" method="post">
                          
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
                        <!-- <div class="alert alert-danger" role="alert"></div> -->
                        <?= validation_errors() ?>
                      <?php endif; ?>
                      

                        <?= $this->session->flashdata('message'); ?>
                         <h5>Data Buku : <?= $total_rows; ?></h5>

                        <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Kode</th>
                                  <th scope="col">Judul</th>
                                  <th scope="col">Cover</th>
                                  <th scope="col">Penulis</th>
                                  <th scope="col">Penerbit</th>
                                  <th scope="col">Tahun</th>
                                  <th scope="col">QrPath</th>
                                  <th scope="col">QrData</th>
                                  <th scope="col">Aksi</th>
                    
                                </tr>
                              </thead>
                              <tbody>
                               
                                <?php foreach($buku as $bk): ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>

                                  <td><?= $bk['kode']; ?></td>
                                  <td><?= $bk['judul']; ?></td>

                                  <td>

                                       <div class="form-group row">
                                       <div class="col-sm-5">
                                       <img src="<?= base_url('assets/img/buku/') . $bk['gambar']; ?>" class="img-fluid rounded-start" class="img-thumbnail">
                                       </div>
                                       </div>
                                
                                  </td>

                                  


                                  <td><?= $bk['penulis']; ?></td>
                                  <td><?= $bk['penerbit']; ?></td>
                                  <td><?= $bk['tahun']; ?></td>

                                  <td>

                                  <div class="form-group row">
                                      <div class="col-sm-8">
                                    <img src="<?= base_url('assets/img/qrcodebuku/') . $bk['qrcode_path']; ?>" class="img-fluid rounded-start" class="img-thumbnail">
                                  </div>
                                </div>
                                
                                  </td>

                                   <td><?= $bk['qrcode_data']; ?></td> 
                            
                                  <td>

                                      <a href="<?= base_url('Buku/printBuku/').$bk['id']; ?>" class="badge badge-warning fa fa-print">Print</a>

                                      <a href="<?= base_url('Buku/editBuku/').$bk['id'];?>" class="badge badge-success">edit</a>

                                      <a href="<?= base_url('Buku/deleteBuku/').$bk['id'];?>" class="badge badge-danger" onclick= "return confirm('yakin data akan dihapus?');">delete</a>
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
<div class="modal fade" id="newBukuModal" tabindex="-1" role="dialog" aria-labelledby="newBukuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newBukuModalLabel">Tambah Data Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


<!-- body modal -->
     <form action="<?= base_url('Buku/index')?>" method="post">

      <div class="modal-body">
        
         <div class="form-group">
            <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan Kode Buku">
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
               <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Buku">
            </div>

            <div class="form-group">
               <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan Penulis">
            </div>

            <div class="form-group">
               <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Masukkan Penerbit">
            </div>

             <div class="form-group">
               <input type="year" class="form-control" id="tahun" name="tahun" placeholder="Masukkan Tahun">
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

          