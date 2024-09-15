<?php require('../settings.php'); ?>
<?php include('../role/admin.php'); ?>

<?php include('../includes/header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<?php 
if (isset($_GET['manga_id'])) {
     $manga_id = $_GET['manga_id'];
     $query = 'SELECT id,title,hash FROM manga WHERE id ='.$manga_id;
     $result = mysqli_query($connection, $query); 

     if($row = mysqli_fetch_assoc($result)){ 
          $manga_hash = $row['hash'];
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
                <div class="row m-5">
                    <form class="needs-validation" enctype="multipart/form-data" action='code/add-chapter-code.php' method='POST'>

                         <input type="hidden" class="form-control" id="manga_id" name="manga_id" placeholder="" value="<?php echo $manga_id ?>" required>
                         <input type="hidden" class="form-control" id="manga_hash" name="manga_hash" placeholder="" value="<?php echo $manga_hash ?>" required>


                         <div class="row g-3">
                         <div class="col-sm-6">
                         <label for="volume" class="form-label">Kaçıncı Bölüm</label>
                         <input type="number" class="form-control" id="volume" name="volume" placeholder="" value="" required>
                         </div>

                         <div class="col-sm-6">
                         <label for="expanded_title" class="form-label">Tam Adı <span class="text-body-secondary">(Opsiyonel)</span></label>
                         <input type="text" class="form-control" id="expanded_title" name="expanded_title" placeholder="" value="">
                         </div>

                         <div class="col-sm-6">
                         <label for="cover" class="form-label">Kapak Fotoğrafı <span class="text-body-secondary">(Opsiyonel)</span></label>
                         <input type="file" class="form-control" id="cover" name='cover' >
                         </div>

                         <div class="col-sm-6">
                         <label for="content" class="form-label"> Bölüm İçeriği </label>
                         <input type="file" class="form-control" id="content" name='content[]' required multiple>
                         </div>


                         <div class="col-md-6">
                         <label for="status" class="form-label">Yayınlanma Durumu</label>
                         <select class="form-select" id="status" required name='status'>
                              <option selected value="published"> Yayında </option>
                              <option value="draft"> Taslak Halinde </option>
                         </select>
                         </div>
                         

                         <div class="col-sm-6">
                         <label for="release" class="form-label">Yayınlanma Tarihi<span class="text-body-secondary"> (Optional)</span></label>
                         <input type="text" class="form-control" id="release" name="release" value="<?php echo $formattedDateTime; ?>">
                         </div>

                         <hr class="my-4">
                         <input type="submit" class="w-100 btn btn-primary btn-lg" name="createChapter" value='Bölümü Ekle'>
                    </form>
               </div>
               </div>


                <!-- End Page Content -->




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



