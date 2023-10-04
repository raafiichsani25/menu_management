
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                     <?php 

                    $tgl = date("Y-m-d");
                    
                    $query = "SELECT COUNT(`tanggal_pengembalian`) AS `jumlah_total`
                     FROM `peminjaman` 
                     "AND"(`tanggal_pengembalian` < '$tgl' OR `tanggal_pengembalian` = '$tgl' 

                       "OR" DATEDIFF(`tanggal_pengembalian`, '$tgl') == 3 
                      
                       "OR" DATEDIFF(`tanggal_pengembalian`,'$tgl') == 2 

                       "OR" DATEDIFF(`tanggal_pengembalian`,'$tgl') == 1) ";

                      $count_id = $this->db->query($query)->result();

                      
                   
                      foreach($count_id as $brp_id) { ?>


                        <button class="btn btn-link btn-xs" style="color : black;" data-bs-toogle="dropdown">
                          <i class="fa fa-bell-o fa-lg"><input id="button_notif" style=" background-color: red; width: 20px; height:20px; border-radius: 100%; text-align: center; border-color:red; font: 8px;" value="<?= $brp_id->jumlah_total ?>" readonly></i>
                        </button>

                      <?php }?>

                        <div class="dropdown col-md-5">

                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fas fa-solid fa-bell"></i>
                        </button>
                        
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <table>
                          <p style="border-style: solid; border-width: 1px;"></p>
                          <td class="dropdown-item" id="button_isi"></td>
                        </table>
                          
                        </div>
                      </div>

                   
                      <br>

                  
                    <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-primary mb-3">Tambah Peminjaman Buku</a>

                    <a href="<?= base_url('Peminjaman/pdfPinjam'); ?>" class="btn btn-warning mb-3" ><i class="fa fa-file" target="_BLANK"></i> Export PDF</a>

                    <!-- Searching -->

                    <div class="row">
                      <div class="col-md-5">
                        
                        <form action="<?= base_url('Peminjaman/index');?>" method="post">
                          
                          <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Search Atau Scan QrCode" name="keyword" autocomplete="off" autofocus>
                         <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                              </div>
                            </div>

                        </form>

                      </div>
                    </div>


                    <!-- TABLE -->
                <div class="row">
                    <div class="col-lg-6">


                        <?= $this->session->flashdata('message'); ?>
                      
                         <h5>Data Peminjam Buku : <?= $total_rows; ?></h5>

                         <body onmousemove="tampil_button_notif(); tampil_isi_notif();"></body>

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
                                
                                <?php foreach($peminjaman as $pm): ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>
                                  <td><?= $pm['nama']; ?></td>
                                  <td><?= $pm['judul']; ?></td>
                                  <td><?= date('d F Y ',$pm['tanggal_pinjam']);?></td>
                                  <td><?= date('d F Y ',$pm['tanggal_pengembalian']);?></td>
                                  <td><?= $pm['keterangan']; ?></td>
                                  <td>

                                   
                                      <a href="<?= base_url('Peminjaman/editPinjam/').$pm['id'];?>" class="badge badge-success">edit</a>

                                      
                                      <a href="<?= base_url('Peminjaman/kembali/').$pm['id']?>" class="badge badge-warning" onclick = "return confirm('yakin buku dikembalikan?');">Buku Kembali</a>

                                   
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
<div class="modal fade" id="newPinjamModal" tabindex="-1" role="dialog" aria-labelledby="newPinjamModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newPinjamModalLabel">Tambah Peminjaman Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


<!-- body modal -->
      <form action="<?= base_url('Peminjaman'); ?>" method="post">

      <div class="modal-body">

         <div class="form-group">
        
         <!--   <div class="form-group">
          <select name="siswa_id" id="siswa_id" class="form-control">
            <option value="">Select Siswa</option>
            <?php foreach($siswa as $sw) : ?>
              <option value="<?= $sw['id']; ?>"><?= $sw['nama']; ?></option>
            <?php endforeach; ?>
          </select> -->

            <input type="text" class="form-control" id="siswa_id" name="siswa_id" placeholder="Scan QrCode Siswa">

           <!-- form errors -->
           <?= form_error('siswa_id','<div class="alert alert-danger" role="alert">','</div>'); ?>
        
      </div>

         <!-- <div class="form-group">
          <select name="buku_id" id="buku_id" class="form-control">
            <option value="">Select Menu</option>
            <?php foreach($buku as $bk) : ?>
              <option value="<?= $bk['id']; ?>"><?= $bk['judul']; ?></option>
            <?php endforeach; ?>
          </select> -->

          <div class="form-group">
           <input type="text" class="form-control" id="buku_id" name="buku_id" placeholder="Scan QrCode Buku">


           <!-- form errors -->
           <?= form_error('buku_id','<div class="alert alert-danger" role="alert">','</div>'); ?>
        </div>


        <!--  <div class="form-group">
            <input type="text" class="form-control datepicker" id="tanggal_pengembalian" name="tanggal_pengembalian" placeholder="Masukkan Tanggal Pengembalian">

             <!-- form errors -->
             <?= form_error('tanggal_pengembalian','<div class="alert alert-danger" role="alert">','</div>'); ?>
        </div>
<!-- 
         <div class="form-group">
            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan">

             <!-- form errors -->
            <?= form_error('keterangan','<div class="alert alert-danger" role="alert">','</div>'); ?>
        


      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Add</button>
     
         </form>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function tampil_button_notif(){
    $.ajax({
      url:"<?= base_url('Peminjaman/untuk_buttonnya')?>",
      method: 'post',
      dataType: 'json',
      success: function(data)
      {
        $("#button_notif").val(data.jumlah_total);
        console.log(data.jumlah_total)
      }

    });

  }

  function tampil_isi_notif(){
    $.ajax({

      url:"<?= base_url('Peminjaman/untuk_isinya') ?>",
      success: function(html)
      {
        $('#button_isi').html(html);
      }

    });
  }




</script>









          