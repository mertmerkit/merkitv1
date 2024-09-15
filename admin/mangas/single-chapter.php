

<?php require('../settings.php'); ?>
<?php include('../includes/header.php'); ?>
<?php include('../role/admin.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">



<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
}
$query = 'SELECT * FROM chapter WHERE id ='.$id;
$result = mysqli_query($connection, $query);
if($row = mysqli_fetch_assoc($result)){ 
     $id = $row['id'];
     $title =  $row['title'];
     $status =  $row['status'];
     $hash =  $row['hash'];
     $volume =  $row['volume'];
     $slug =  $row['slug'];
     $cover =  $row['cover'];
     $manga_id =  $row['manga_id'];
     $images =  $row['images'];
}


// Get manga hash
$querymangahash = 'SELECT * FROM manga WHERE id ='.$manga_id;
$resultmangahash = mysqli_query($connection, $querymangahash);
if($rowmangahash = mysqli_fetch_assoc($resultmangahash)){ 
     $manga_hash =  $rowmangahash['hash'];
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
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row m-5">
                    <form class="needs-validation" enctype="multipart/form-data" action='code/update-chapter-code.php' method='POST'>

                         <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id ?>" required>
                         <input type="hidden" class="form-control" id="content" name="content" value="<?php echo $content ?>" required>
                         <input type="hidden" class="form-control" id="hash" name="hash" value="<?php echo $hash ?>" required>
                         <input type="hidden" class="form-control" id="manga_hash" name="manga_hash" value="<?php echo $manga_hash ?>" required>
                         <input type="hidden" class="form-control" id="manga_id" name="manga_id" value="<?php echo $manga_id ?>" required>
                         <input type="hidden" class="form-control" id="used_cover" name="used_cover" value="<?php echo $cover ?>" required>
                         <input type="hidden" class="form-control" id="images" name="images" value="<?php echo htmlspecialchars($images) ?>" required>

                         <div class="row g-3">
                         <div class="col-sm-6">
                         <label for="volume" class="form-label">Kaçıncı Bölüm</label>
                         <input type="number" class="form-control" id="volume" name="volume" placeholder="" value="<?php echo $volume ?>" required>
                         </div>

                         <div class="col-sm-6">
                         <label for="title" class="form-label">Tam Adı<span class="text-body-secondary">(Opsiyonel)</span></label>
                         <input type="text" class="form-control" id="title" name="title" placeholder="" value="<?php echo $title ?>">
                         </div>
                         
                         <div class="col-sm-6">
                         <label for="slug" class="form-label">Slug</label>
                         <input type="text" class="form-control" id="slug" name="slug" placeholder="" value="<?php echo $slug ?>">
                         </div>
                         <?php if($_SESSION['role'] > 3){?>

                         <div class="col-md-6">
                         <label for="status" class="form-label">Yayınlanma Durumu</label>
                         <select class="form-select" id="status" required name='status'>
                              <option <?php if($status == 'draft'){echo 'selected';} ?> value="draft"> Yayında </option>
                              <option <?php if($status == 'published'){echo 'selected';} ?> value="published"> Taslak Halinde </option>
                         </select>
                         </div>
                         <?php }else{echo '<input type="text" hidden name="status" value="'.$status.'">';};?>

                         <div class="col-sm-6">
                         <label for="cover" class="form-label">Kapak Fotoğrafı</label>
                         <input type="file" accept=".jpeg, .jpg, .png, .webp, .gif" class="form-control" id="cover" name='cover'>
                         <?php if(!empty($cover)){ ?>
                         <label for="cover" class="form-label"><img src="/admin/uploads/<?php echo $manga_hash?>/chapters/<?php echo $hash.'/'.$cover ?>" style='height:85px' alt=""></label>
                         <?php } ?>
                         </div>

                         <div class="col-sm-6">
                         <label for="content"  class="form-label"> Bölüm İçeriği (Güncelle)</label>
                         <input type="file" accept=".jpeg, .jpg, .png, .webp, .gif" class="form-control" id="content" name='content[]'  multiple>
                         </div>

                         <hr class="my-4">
                         <input type="submit" class="w-100 btn btn-primary btn-lg" name="updateChapter" value='Bölümü Güncelle'>
                    </form>
     
                    <hr class="my-4">
                    <h4 class="text-center">Bölüm İçeriği</h4>
                    <hr class="my-4">

                    <?php
                    $imageArray = json_decode($images, true);
                    foreach ($imageArray as $file) {
                         echo '<div style="text-align: center;">';
                         echo '<img style="max-width: 100%; height: auto; display: block; margin: auto;" src="/admin/uploads/'. $manga_hash .'/chapters/'. $hash.'/'.  $file . '" alt="' . $file . '">';
                         echo '</div>';
                    }
 
                    ?>



                    
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