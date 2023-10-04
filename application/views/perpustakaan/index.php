
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    

                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSiswaModal">Tambah Siswa/i</a>

                     <a href="<?= base_url('Perpustakaan/pdfSiswa'); ?>" class="btn btn-warning mb-3" ><i class="fa fa-file" target="_BLANK"></i> Export PDF</a>


                   <!-- Searching -->

                    <div class="row">
                      <div class="col-md-5">
                        
                        <form action="<?= base_url('Perpustakaan/search');?>" method="post">
                          
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
                        
                         <h5>Data Siswa : <?= $total_rows; ?></h5>

                        <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Nama</th>
                                  <th scope="col">Foto</th>
                                  <th scope="col">NIS</th>
                                  <th scope="col">QrCode Path</th>
                                  <th scope="col">QrCode Data</th>
                                  <th scope="col">Aksi</th>
                    
                                </tr>
                              </thead>
                              <tbody>
                              
                                <?php foreach($siswa as $sw): ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>
                                  <td><?= $sw['nama']; ?></td>
                                  <td>

                                    <div class="form-group row">
                                      <div class="col-sm-5">
                                    <img src="<?= base_url('assets/img/siswa/') . $sw['foto']; ?>" class="img-fluid rounded-start" class="img-thumbnail">
                                  </div>
                                </div>
                                
                                  </td>

                                  <td><?= $sw['nis']; ?></td>


                                   <td>

                                    <div class="form-group row">
                                      <div class="col-sm-5">
                                    <img src="<?= base_url('assets/img/qrcode/') . $sw['qrcode_path']; ?>" class="img-fluid rounded-start" class="img-thumbnail">
                                  </div>
                                </div>
                                
                                  </td>

                                   <td><?= $sw['qrcode_data']; ?></td>

                                                              
                                  <td>

                                      <a href="<?= base_url('Perpustakaan/printSiswa/').$sw['id']; ?>" class="badge badge-warning fa fa-print">Print</a>

                                      <a href="<?= base_url('Perpustakaan/editSiswa/').$sw['id'];?>" class="badge badge-success">edit</a>

                                      <a href="<?= base_url('Perpustakaan/deleteSiswa/').$sw['id'];?>" class="badge badge-danger" onclick= "return confirm('yakin data akan dihapus?');">delete</a>
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
<div class="modal fade" id="newSiswaModal" tabindex="-1" role="dialog" aria-labelledby="newSiswaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSiswaModalLabel">Tambah Siswa/i</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


<!-- body modal -->
     <form action="<?= base_url('Perpustakaan/index')?>" method="post">

      <div class="modal-body">
        
         <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Siswa">
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
               <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan Nomer Induk Siswa">
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

          