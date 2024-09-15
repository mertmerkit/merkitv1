<?php require('../settings.php'); ?>
<?php include('../role/admin.php'); ?>

<?php include('../includes/header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">



    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include('../includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                 <?php include('../includes/topbar.php'); ?>




                <!-- Begin Page Content -->
                <div class="row m-5">
                    <form class="needs-validation" enctype="multipart/form-data" action='code/add-new-code.php' method='POST'>
                         <div class="row g-3">
                         <div class="col-sm-6">
                         <label for="title" class="form-label"> Başlık </label>
                         <input type="text" class="form-control" id="title" name="title" placeholder="" value="" required>
                         </div>

                         <div class="col-sm-6">
                         <label for="alternative" class="form-label"> Alternatif Başlık <span class="text-body-secondary">(Optional)</span></label>
                         <input type="text" class="form-control" id="alternative" name="alternative" placeholder="" value="">
                         </div>

                         <div class="col-sm-6">
                         <label for="artist" class="form-label"> Çizer <span class="text-body-secondary">(Optional)</span></label>
                         <input type="text" class="form-control" id="artist" name="artist" placeholder="" value="" >
                         </div>

                         <div class="col-sm-6">
                         <label for="author" class="form-label"> Yazar <span class="text-body-secondary">(Optional)</span></label>
                         <input type="text" class="form-control" id="author" name="author" placeholder="" value="" >
                         </div>

                         <div class="col-sm-6">
                         <label for="year" class="form-label"> Yayınlanma Tarihi </label>
                         <input type="number" class="form-control" id="year" name='year' required>
                         </div>

                         <div class="col-sm-6">
                         <label for="score" class="form-label"> Serinin Puanı </label>
                         <input type="number" class="form-control" id="score" name='score'>
                         </div>

                         <div class="col-12">
                              <label for="description" class="form-label">Açıklama</label>
                              <div class="input-group has-validation">
                                   <textarea style='height:175px' class="form-control" id="description" name="description" placeholder="" ></textarea>
                              </div>
                         </div>

                         <div class="col-sm-6">
                         <label for="cover" class="form-label">Kapak Fotoğrafı</label>
                         <input type="file" class="form-control" id="cover" name='cover' required>
                         </div>

                         <div class="col-sm-6">
                         <label for="chapter_cover" class="form-label"> Bölüm Kapak Fotoğrafı </label>
                         <input type="file" class="form-control" id="chapter_cover" name='chapter_cover'>
                         </div>


                         <?php if($_SESSION['role'] > 3){ ?>

                         <div class="col-md-4">
                         <label for="status" class="form-label">Yayınlanma Durumu </label>
                         <select class="form-select" id="status" required name='status'>
                              <option selected value="published"> Yayında </option>
                              <option value="draft"> Taslak Halinde </option>
                         </select>
                         </div>
                         <?php }else{ ;?>
                              <select hidden class="form-select" id="status" required name='status'>
                                   <option  selected value="draft"> Draft </option>
                              </select>
                         <?php } ;?>



                         <div class="col-md-4">
                         <label for="type" class="form-label">Tür</label>
                         <select class="form-select" id="type" required name='type'>
                              <option selected value="manhwa"> Manhwa </option>
                              <option value="manhua"> Manhua </option>
                              <option value="manga"> Manga </option>
                              <option value="webtoon"> Webtoon </option>
                         </select>
                         </div>


                         <div class="col-md-4">
                         <label for="country" class="form-label">Kategori(ler)</label>
                         <select class="js-example-basic-multiple form-select" name="genres[]" multiple="multiple" >
                              <?php 
                              $genrequery = 'SELECT title FROM genres';
                              $genreresult = mysqli_query($connection, $genrequery);
                              while($genrerow = mysqli_fetch_assoc($genreresult)){ 
                                   $genre = $genrerow['title'];
                                   ?>
                                   <option value="<?php echo $genrerow['title'] ?>"><?php echo $genrerow['title'] ?></option>
                                   <?php
                              }
                              ?>
                         </select>
                         </div>

                         <hr class="my-4">
                         <input type="submit" class="w-100 btn btn-primary btn-lg" name="createManga" value='Mangayı Oluştur'>
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