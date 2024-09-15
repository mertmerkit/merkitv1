
<?php require('../settings.php'); ?>
<?php include('../includes/header.php'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<?php 
$query = 'SELECT * FROM users';
$result = mysqli_query($connection, $query);
?>



<?php include('../includes/header.php'); ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                 <?php include('../includes/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Kullanıcılar</h1>
                    </div>

                    <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th style='width:50px'>ID</th>
                                    <th>Kullanıcı Adı</th>
                                    <th>E Posta</th>
                                    <th>Yetkisi</th>
                                    <th style='width:120px'></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)){ 
                                $id = $row['id'];
                                $username =  $row['username'];
                                $email =  $row['email'];
                                $role =  $row['role'];
                                if($role == 0){
                                    $role = 'Kullanıcı';
                                }elseif($role == 1){
                                    $role = 'Çevirmen';
                                }elseif($role == 3){
                                    $role = 'Editör';
                                }elseif($role == 4){
                                    $role = 'Admin';
                                }elseif($role == 5){
                                    $role = 'Yönetici';
                                }
                            ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $username ?></td>
                                <td><?php echo $email ?></td>
                                <td><?php echo $role ?></td>
                                <td style='height:50px;display:flex;justify-content:space-around'>
                                    <?php  if($role != 'Yönetici'){ ?>

                                    <a href="./user-edit.php?id=<?php echo $id; ?>"><i class="fa-xl fa-xl fas fa-fw fa-pen"></i></a>
                                    </a>

                                    <?php if($_SESSION['role'] > 4){?>


                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id ?>">
                                    <i class="fa-xl fas fa-fw fa-trash"></i>
                                    </a>
                                    
                                    <?php } ?>



                                    <?php if($_SESSION['role'] > 4){?>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?php echo $id ?>" tabindex="1" aria-labelledby="deleteModal<?php echo $id ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModal<?php echo $id ?>Label">Delete <?php echo $username ?></h5>
                                                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-xl fa-xl fas fa-fw fa-close"></i></a>
                                            </div>
                                            <div class="modal-body">
                                               <?php echo $username ?> isimli kullanıcıyı silmek istediğinize emin misiniz ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                                <form method='POST' action="./delete-user.php" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?php echo $id ?>" name='id'>
                                                    
                                                    <button type='submit' type="button" name='deleteUser' class="btn btn-danger">Sil</button>
                                          
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    <?php } ?>

                                    <?php } ?>


                                </td>
                            </tr>
                 
                            <?php } ?>

                            </tbody>
                        </table>



                           
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
