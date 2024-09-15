<?php require('../settings.php'); ?>
<?php include('../includes/header.php'); ?>
<?php include('../role/admin.php'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<?php 
$query = 'SELECT id,title,type,status,cover,hash FROM manga';
$result = mysqli_query($connection, $query);
?>


    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content" >

                 <?php include('../includes/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Mangalar</h1>
                        <a href="add-new.php" class="h3 mb-0 text-black-800 btn btn-primary ">Yeni Manga Ekle</a>
                    </div>



                    
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th style='width:50px'>ID</th>
                                    <th>Kapak Fotoğrafı</th>
                                    <th>Başlık</th>
                                    <th>Tür</th>
                                    <th>Yayınlanma Durumu</th>
                                    <th style='width:120px'></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)){ 
                                $id = $row['id'];
                                $title =  $row['title'];
                                $cover =  $row['cover'];
                                $type =  $row['type'];
                                $status =  $row['status'];
                                $hash =  $row['hash'];
                            ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td id='imgcnter'><img src="/admin/uploads/<?php echo $hash.'/cover/'.$cover ?>" alt="cover image"></td>
                                <td ><?php echo $title ?></td>
                                <td class="text-capitalize"><?php echo $type ?></td>
                                <td><?php if($status == 'draft'){echo 'Taslak Halinde';}else{ echo 'Yayında'; } $status ?></td>
                                
                                <td style='height:50px;display:flex;justify-content:space-around'>
                                    <a href="/admin/mangas/single.php?id=<?php echo $id; ?>"><i class="fa-xl fa-xl fas fa-fw fa-pen"></i></a>
                                    <?php if($_SESSION['role'] > 4){?>

                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id ?>">
                                    <i class="fa-xl fas fa-fw fa-trash"></i>
                                    </a>
                                    
                                    <?php } ?>

                                </td>
                            </tr>
                            
                            <?php if($_SESSION['role'] > 4){?>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $id ?>" tabindex="1" aria-labelledby="deleteModal<?php echo $id ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModal<?php echo $id ?>Label">Delete <?php echo $title ?></h5>
                                        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-xl fa-xl fas fa-fw fa-close"></i></a>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete <?php echo $title ?> and ALL chapters of this manga ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method='POST' action="./code/delete-manga.php" enctype="multipart/form-data">
                                            <input type="hidden" value="<?php echo $id ?>" name='id'>
                                            <input type="hidden" value="<?php echo $hash ?>" name='hash'>
                                            <button type='submit' type="button" name='deleteManga' class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            <?php } ?>
                            <?php } ?>

                            </tbody>
                        </table>














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
