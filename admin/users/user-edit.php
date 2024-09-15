

<?php require('../settings.php'); ?>
<?php include('../includes/header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<?php include('../role/admin.php'); ?>



<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
}
$query = 'SELECT * FROM users WHERE id ='.$id;
$result = mysqli_query($connection, $query);
if($row = mysqli_fetch_assoc($result)){ 
     $id = $row['id'];
     $username =  $row['username'];
     $role =  $row['role'];

     if($role == 5){
          $_SESSION['error'] = 'Yöneticinin Profili Düzenlemez.';
          header('Location: ./');
          exit;
     }
}
?>


    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                 <?php include('../includes/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 my-4">
                    </div>

                    <!-- Content Row -->

                    <div class="row m-5">
                    <form class="needs-validation" enctype="multipart/form-data" action='user-edit-code.php' method='POST'>

                         <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id ?>" required>

                         <div class="row g-3">
                         <div class="col-sm-6">
                         <label for="username" class="form-label">Kullanıcı Adı</label>
                         <input type="username" class="form-control" id="username" name="username" placeholder="" value="<?php echo $username ?>" required>
                         </div>

                         <?php if($_SESSION['role'] > 1){?>
                         <div class="col-md-6">
                         <label for="role" class="form-label">Yetkisi</label>
                         <select class="form-select" id="role" required name='role'>
                              <option <?php if($role == 0){ echo "selected";} ?> value="0"> Okuyucu </option>
                              <option <?php if($role == 2){ echo "selected";} ?> value="1"> Çevirmen </option>
                              <option <?php if($role == 3){ echo "selected";} ?> value="3"> Editör </option>
                              <option <?php if($role == 4){ echo "selected";} ?> value="4"> Admin </option>
                         </select>
                         </div>
                         <?php }else{echo '<input type="text" hidden name="role" value="'.$role.'">';};?>


                         <hr class="my-4">
                         <input type="submit" class="w-100 btn btn-primary btn-lg" name="updateUser" value='Kullanıcı Bilgisini Güncelle'>
                    </form>


                    
               </div>

                </div>
            </div>
        </div>
    </div>


    <?php include('../includes/footer.php'); ?>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     
    <script>
          $(document).ready(function() {
               $('.js-example-basic-multiple').select2();
          });

     </script>