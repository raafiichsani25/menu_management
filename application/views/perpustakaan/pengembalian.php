
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <!-- TABLE -->
                <div class="row">
                    <div class="col-lg-6">
                      
                        <?= $this->session->flashdata('message'); ?>


                        <a href="<?= base_url('Pengembalian/pdfPengembalian'); ?>" class="btn btn-warning mb-3" ><i class="fa fa-file" target="_BLANK"></i> Export PDF</a>

                          <!-- Searching -->

                    <div class="row">
                      <div class="col-md-6">
                        
                        <form action="<?= base_url('Pengembalian/index');?>" method="post">
                          
                          <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Search Atau Scan QrCode" name="keyword" autocomplete="off" autofocus >
                         <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                              </div>
                            </div>

                        </form>

                      </div>
                    </div>

                         <h5>Data Pengembalian Buku : <?= $total_rows; ?></h5>

                        <table class="table table-hover">
                              <thead>
                                <tr>

                                  <th scope="col">#</th>
                                  <th scope="col">Siswa</th>
                                  <th scope="col">Buku</th>
                                  <th scope="col">Tanggal Pinjam</th>
                                  <th scope="col">Tanggal Pengembalian</th>
                                  <th scope="col">Keterangan</th>
                                  <th scope="col">Aksi</th>
                    
                                </tr>
                              </thead>
                              <tbody>
                                
                                <?php foreach($pengembalian as $pn): ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>
                                  <td><?= $pn['nama']; ?></td>
                                  <td><?= $pn['judul']; ?></td>
                                  <td><?= date('d F Y ',$pn['tanggal_pinjam']);?></td>
                                  <td><?= date('d F Y ',$pn['tanggal_pengembalian']);?></td>
                                  <td><?= $pn['keterangan']; ?></td>
                                  <td>

                                   
                                      <a href="<?= base_url('Pengembalian/editPengembalian/').$pn['id'];?>" class="badge badge-success">edit</a>
                                      <a href="<?= base_url('Pengembalian/deletePengembalian/').$pn['id'];?>" class="badge badge-danger" onclick= "return confirm('yakin data akan dihapus?');">hapus</a>

                                   
                                  </td>
                                </tr>
                                                       
                                <?php endforeach; ?>   
                                </tbody>
                            </table>

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
<div class="modal fade" id="newPengembalianModal" tabindex="-1" role="dialog" aria-labelledby="newPengembalianModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newPengembalianModalLabel">Tambah Pengembalian Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


<!-- body modal -->
      <form action="<?= base_url('Perpustakaan/pengembalian'); ?>" method="post">

      <div class="modal-body">
        
           <div class="form-group">
          <select name="siswa_id" id="siswa_id" class="form-control">
            <option value="">Select Siswa</option>
            <?php foreach($siswa as $sw) : ?>
              <option value="<?= $sw['id']; ?>"><?= $sw['nama']; ?></option>
            <?php endforeach; ?>
          </select>

           <!-- form errors -->
           <?= form_error('siswa_id','<div class="alert alert-danger" role="alert">','</div>'); ?>
        </div>


         <div class="form-group">
          <select name="buku_id" id="buku_id" class="form-control">
            <option value="">Select Menu</option>
            <?php foreach($buku as $bk) : ?>
              <option value="<?= $bk['id']; ?>"><?= $bk['judul']; ?></option>
            <?php endforeach; ?>
          </select>


           <!-- form errors -->
           <?= form_error('buku_id','<div class="alert alert-danger" role="alert">','</div>'); ?>
        </div>


         <div class="form-group">
            <input type="text" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" placeholder="Masukkan Tanggal Pengembalian">

             <!-- form errors -->
             <?= form_error('tanggal_pengembalian','<div class="alert alert-danger" role="alert">','</div>'); ?>
        </div>

         <div class="form-group">
            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan">

             <!-- form errors -->
            <?= form_error('keterangan','<div class="alert alert-danger" role="alert">','</div>'); ?>
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

          