
        
        
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <h3 class="h3 mb-4 text-gray-800">Title : <?= $smId['title']; ?></h3>


                    <div class="row">
                        <div class="col-lg-8">
                            
                            <form action="" method="post">
                            
                            <input type="hidden" name="id" value="<?= $smId['id']; ?>">


                            <div class="form-group row">
                            <label for="menu" class="col-sm-2 col-form-label">Title :</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="title" name="title" value="<?= $smId['title'];?>">

                                <?= form_error('title',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>   




                      <div class="form-group row">
                              <label for="menu" class="col-sm-2 col-form-label">Menu Id :</label>
                               <div class="col-sm-10">
                            <select name="menu_id" id="menu_id" class="form-control">
                            <option value="<?= $menu_id['id'];?>"><?= $menu_id['menu'];?></option>

                             <?php foreach($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                             <?php endforeach; ?>
                         </select>
                        </div>
                        </div>



                           <div class="form-group row">
                            <label for="menu" class="col-sm-2 col-form-label">Url :</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="url" name="url" value="<?= $smId['url'];?>">

                                <?= form_error('url',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>    



                           <div class="form-group row">
                            <label for="menu" class="col-sm-2 col-form-label">Icon :</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="icon" name="icon" value="<?= $smId['icon'];?>">

                                <?= form_error('icon',' <small class ="text-danger pl-3">',' </small>');?>

                            </div>
                          </div>  



                           <div class="form-group">
                            <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                 <label class="form-check-label" for="is_active">
                                 Active?
                                </label>
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

          