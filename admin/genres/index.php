<?php require('../settings.php'); ?>
<?php include('../includes/header.php'); ?>
<?php include('../role/admin.php'); ?>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<?php 
$query = 'SELECT id,title,slug FROM genres';
$result = mysqli_query($connection, $query);

?>


    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content" >


                 <?php  include('../includes/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Kategoriler</h1>
                    </div>




               <div class="row">

               
               <div  class="col-sm-6">

               <form class='row' action="code-genre.php" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-6">
                         <label for="name" class="form-label">İsim</label>
                         <input type="text" class="form-control" id="name" name="title" placeholder="" value="" required>
                    </div>
                    <div class="col-sm-6">
                         <label for="slug" class="form-label">Slug<span class="text-body-secondary">(Optional)</span></label>
                         <input type="text" class="form-control" id="slug" name="slug" placeholder="" value="">
                    </div>
                    <div class="col-12">
                         <input type="submit" class="mt-4 w-100 btn btn-primary btn-lg" id="create_new_genre" name="create_new_genre" placeholder="" value="Yeni Kategori Ekle">
                    </div>
               </form>

               <hr class="my-5">
               
               <?php 

                    if (isset($_GET['id'])) {
                         $single = $_GET['id'];
                         $single_query = 'SELECT id,title,slug FROM genres WHERE id = '.$single;
                         $single_result = mysqli_query($connection, $single_query);
                    
                         if($sigle_row = mysqli_fetch_assoc($single_result)){ 
                              $single_id = $sigle_row['id'];
                              $single_title = $sigle_row['title'];
                              $single_slug = $sigle_row['slug'];
                         }
               ?>
                    
               <form class='row' action="code-genre.php" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-6">
                         <label for="name" class="form-label">İsim</label>
                         <input type="hidden" name='id' value='<?php echo $single_id; ?>'>
                         <input type="text" class="form-control" id="name" name="title" placeholder="" value="<?php echo $single_title ?>">
                    </div>
                    <div class="col-sm-6">
                         <label for="slug" class="form-label">Slug</label>
                         <input type="text" class="form-control" id="slug" name="slug" placeholder="" value="<?php echo $single_slug ?>">
                    </div>
                    <div class="col-12">
                         <input type="submit" class="mt-4 w-100 btn btn-primary btn-lg" id="update_genre" name="update_genre" placeholder="" value="Kategoriyi Güncelle">
                    </div>
               </form>

               <?php 
               }
               ?>

               </div>


               <div class="col-sm-6">

               <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                         <tr>
                              <th style='width:50px'>ID</th>
                              <th>İsim</th>
                              <th>Slug</th>
                              <th style='width:120px'></th>
                         </tr>
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)){ 
                         $id = $row['id'];
                         $title =  $row['title'];
                         $slug =  $row['slug'];
                    ?>
                    <tr>
                         <td><?php echo $id ?></td>
                         <td><?php echo $title ?></td>
                         <td><?php echo $slug ?></td>
                         <td style='height:50px;display:flex;justify-content:space-around'>
                              <a href="./index.php?id=<?php echo $id; ?>"><i class="fa-xl fa-xl fas fa-fw fa-pen"></i></a>
                              <a type="button" class="" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id ?>"><i class="text-danger fa-xl fa-xl fas fa-fw fa-trash"></i></a>
                         </td>
                    </tr>

                    <div class="modal fade" id="deleteModal<?php echo $id ?>" tabindex="1" aria-labelledby="deleteModal<?php echo $id ?>Label" aria-hidden="true">
                         <div class="modal-dialog">
                              <div class="modal-content">
                              <div class="modal-header">
                                   <h5 class="modal-name" id="deleteModal<?php echo $id ?>Label">Delete <?php echo $title ?></h5>
                                   <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-xl fa-xl fas fa-fw fa-close"></i></a>
                              </div>
                              <div class="modal-body">
                                   <?php echo $title ?> adlı kategoriyi Silmek İstediğine Emin Misin  ?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                   <form method='POST' action="./code-genre.php" enctype="multipart/form-data">
                                   <input type="hidden" value="<?php echo $id ?>" name='id'>
                                   <input type="hidden" value="<?php echo $hash ?>" name='hash'>
                                   <button type='submit' type="button" name='deleteGenre' class="btn btn-danger">Sil</button>
                                   </form>
                              </div>
                              </div>
                         </div>
                    </div>
                    <?php } ?>

                    </tbody>
               </table>

               </div>

               </div>









                              </div>
                         </div>
                    </div>
               </div>

               <style>
               #imgcnter {width:50px;height:50px;object-fit: cover;}
               #imgcnter img{width:100%;height:100%;object-fit: cover;}
               </style>
    


    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>new DataTable('#example');</script>
    <?php include('../includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
