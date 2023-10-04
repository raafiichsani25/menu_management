
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <h3 class="h3 mb-4 text-gray-800">Judul : <?= $menuId['menu']; ?></h3>


                    <div class="row">
                        <div class="col-lg-8">
                            
                            <form action="" method="post">
                            
                            <input type="hidden" name="id" value="<?= $menuId['id']; ?>">
                            <div class="form-group row">
                            <label for="menu" class="col-sm-2 col-form-label">Judul :</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="menu" name="menu" value="<?= $menuId['menu'];?>">

                                <?= form_error('menu',' <small class ="text-danger pl-3">',' </small>');?>

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

          