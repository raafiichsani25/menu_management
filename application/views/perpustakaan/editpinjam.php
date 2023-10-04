
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>                   

                    <div class="row">
                        <div class="col-lg-8">

                     <?php $siswa_id = $this->db->get_where('siswa',['id' => $peminjaman['siswa_id']])->row_array(); 

                        $buku_id = $this->db->get_where('buku',['id' => $peminjaman['buku_id']])->row_array();

                     ?>
                            
                            <form action="" method="post">
                            
                           
                               <div class="form-group row">
                                 <label for="siswa_id" class="col-sm-2 col-form-label">Siswa</label>
                              <div class="col-sm-10">
                              <select name="siswa_id" id="siswa_id" class="form-control">
                            <option value="<?= $siswa_id['id'];?>"><?= $siswa_id['nama'];?></option>
                                <?php foreach($siswa as $sw) : ?>
                                  <option value="<?= $sw['id']; ?>"><?= $sw['nama']; ?></option>
                                <?php endforeach; ?>
                              </select>

                             </div>
                            </div>


                        <div class="form-group row">
                        <label for="buku_id" class="col-sm-2 col-form-label">Buku</label>
                        <div class="col-sm-10">
                         <select name="buku_id" id="buku_id" class="form-control">
                         <option value="<?= $buku_id['id']?>"><?= $buku_id['judul'];?></option>
                                <?php foreach($buku as $bk) : ?>
                                  <option value="<?= $bk['id']; ?>"><?= $bk['judul']; ?></option>
                                <?php endforeach; ?>
                              </select>

                          </div>
                          </div>



                            <div class="form-group row">
                            <label for="tanggal_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value=" <?= date('d F Y ',$peminjaman['tanggal_pinjam']); ?>" readonly>
                            

                                <?= form_error('tanggal_pinjam',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>    




                          <div class="form-group row">
                  <label for="tanggal_pengembalian" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control datepicker" id="tanggal_pengembalian" name="tanggal_pengembalian" value="<?= $peminjaman['tanggal_pengembalian'];?>">
                            
                                <?= form_error('tanggal_pengembalian',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>    



                          <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="keteragan" name="keterangan" value="<?= $peminjaman['keterangan'];?>">

                                <?= form_error('keterangan',' <small class ="text-danger pl-3">',' </small>');?>

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

          