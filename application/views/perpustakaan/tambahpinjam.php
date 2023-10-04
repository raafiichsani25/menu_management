
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> 

                                      

                    <div class="row">
                        <div class="col-lg-6">

                           <?= $this->session->flashdata('message'); ?>

                           <form action="" method="post">
                          <div class="form-group row">
                            <label for="siswa_id" class="col-sm-2 col-form-label">Siswa</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-input-siswa" id="siswa_id" name="siswa_id" placeholder="Scan Qr Siswa" autofocus>    


                               <p id="tampil_siswa"></p>
                               

                                 
                              
                                <?= form_error('siswa_id',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div> 


                             <div class="form-group row">
                            <label for="buku_id" class="col-sm-2 col-form-label">Judul Buku</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-input-buku" id="buku_id" name="buku_id" placeholder="Scan Qr Buku">

                              <p id="tampil_buku"></p>
                               

                             
                             
                                <?= form_error('buku_id',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>    
   

                           
                        <div class="form-group row justify-content-end">
                       

                         <div class="col-sm-10">

                            <a href="<?= base_url('peminjaman/index'); ?>" class="btn btn-warning">Batal</a>
                            <button type="submit" class="btn btn-primary" id="btn_simpan">Add</button>
                           
                           <form>
                          

                         </div>

                            </div>


                        </div>
                    </div>
                   


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



<!-- enter on event -->
<script type="">
  var input_siswa = document.getElementById("siswa_id");
  var input_buku = document.getElementById("buku_id");


  input_siswa.addEventListener("keypress", function(event){

    if(event.key === "Enter"){

       $.ajax({
        type: 'POST',
        url: '<?= base_url('peminjaman/namaSiswa'); ?>',
         data : {"siswa_id":input_siswa.value},
        beforeSend:function(response) {
          $('#tampil_siswa').html("Sedang memproses data, silahkan tunggu...");
        },
        
    
          success:function(response) {
            console.log(response)
            const data = JSON.parse(response);
        
        $('#tampil_siswa').html(data.siswa);
        },
      
        error: function (response) {

         
        },

        });


      event.preventDefault();

       input_buku.focus();
      
    }
  });
  



  input_buku.addEventListener("keypress", function(event){

    if(event.key === "Enter"){

      $.ajax({
        type: 'POST',
        url: '<?= base_url('peminjaman/judulBuku'); ?>',
         data : {"buku_id":input_buku.value},
        beforeSend:function(response) {
          $('#tampil_buku').html("Sedang memproses data, silahkan tunggu...");
        },
        
    
          success:function(response) {
            console.log(response)
            const data = JSON.parse(response);
        
        $('#tampil_buku').html(data.buku);
        },
      
        error: function (response) {

         
        },

        });


      event.preventDefault();
      
    }
  });


</script>


     
