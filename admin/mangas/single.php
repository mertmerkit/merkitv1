

<?php require('../settings.php'); ?>
<?php include('../includes/header.php'); ?>
<?php include('../role/admin.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">



<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
}
$query = 'SELECT * FROM manga WHERE id ='.$id;
$result = mysqli_query($connection, $query);
if($row = mysqli_fetch_assoc($result)){ 
     $id = $row['id'];
     $title =  $row['title'];
     $alternative_title =  $row['alternative_title'];
     $slug =  $row['slug'];
     $artist =  $row['artist'];
     $author =  $row['author'];
     $year =  $row['year'];
     $score =  $row['score'];
     $description =  $row['description'];
     $cover =  $row['cover'];
     $chapter_cover =  $row['chapter_cover'];
     $type =  $row['type'];
     $status =  $row['status'];
     $hash =  $row['hash'];
     $genre =  $row['genres'];
     $calendar =  $row['calendar'];
     $slider_image =  $row['slider_image'];
     $adult =  $row['adult'];
}
?>

    <!-- Page Wrapper -->
    <div id="wrapper">

                              <?php };?>
                        </div> 
                    </div>

                    <!-- Content Row -->

                    <div class="row m-5">
                    <form class="needs-validation" enctype="multipart/form-data" action='code/update-manga.php' method='POST'>
                         <div class="row g-3">
                         <div class="col-sm-6">
                         <input type="hidden" name='id' value='<?php echo $id;?>'>
                         <input type="hidden" name='hash' value='<?php echo $hash;?>'>
                         <input type="hidden" name='cover_name' value='<?php echo $cover;?>'>
                         <input type="hidden" name='chapter_cover_name' value='<?php echo $chapter_cover;?>'>
                         <input type="hidden" name='slider_image_name' value='<?php echo $slider_image;?>'>
							 
                         <label for="title" class="form-label">Başlık</label>
                         <input type="text" class="form-control" id="title" name="title" placeholder="" value="<?php echo $title ?>">
                         </div>

                         <div class="col-sm-6">
                         <label for="alternative" class="form-label">Alternatif Başlık <span class="text-body-secondary">(Optional)</span></label>
                         <input type="text" class="form-control" id="alternative" name="alternative" placeholder="" value="<?php echo $alternative_title ?>">
                         </div>

                         <div class="col-sm-6">
                         <label for="slug" class="form-label">Slug</label>
                         <input type="text" class="form-control" id="slug" name="slug" placeholder="" value="<?php echo $slug ?>">
                         </div>

                         <div class="col-sm-6">
                         <label for="artist" class="form-label">Çizer <span class="text-body-secondary">(Optional)</span></label>
                         <input type="text" class="form-control" id="artist" name="artist" placeholder="" value="<?php echo $artist ?>" >
                         </div>

                         <div class="col-sm-6">
                         <label for="author" class="form-label">Yazar <span class="text-body-secondary">(Optional)</span></label>
                         <input type="text" class="form-control" id="author" name="author" placeholder="" value="<?php echo $author ?>" >
                         </div>

                         <div class="col-sm-6">
                         <label for="year" class="form-label"> Yayınlanma Tarihi </label>
                         <input type="number" class="form-control" id="year" name='year' value="<?php echo $year ?>">
                         </div>

                         <div class="col-sm-6">
                         <label for="score" class="form-label"> Serinin Puanı </label>
                         <input type="number" class="form-control" id="score" name='score' value="<?php echo $score ?>">
                         </div>



                         <div class="col-sm-6">
                         <label for="type" class="form-label">Tür</label>
                         <select class="form-select" id="type" required name='type'>
                              <option <?php if($score == 'manhwa'){ echo 'selected';}?> value="manhwa"> Manhwa </option>
                              <option <?php if($score == 'manhua'){ echo 'selected';}?> value="manhua"> Manhua </option>
                              <option <?php if($score == 'manga'){ echo 'selected';}?> value="manga"> Manga </option>
                              <option <?php if($score == 'webtoon'){ echo 'selected';}?> value="webtoon"> Webtoon </option>
                         </select>
                         </div>


                         <?php if($_SESSION['role'] > 3){ ?>
                         <div class="col-md-4">
                         <label for="status" class="form-label">Yayınlanma Durumu</label>
                         <select class="form-select" id="status" name='status'>
                              <option <?php if($status == 'published'){ ?> selected <?php } ?>value="published"> Yayında </option>
                              <option <?php if($status == 'draft'){ ?>  <?php } ?> value="draft"> Taslak Halinde </option>
                         </select>
                         </div>

                         <?php }else{ ;?>
                              <select hidden class="form-select" id="status" required name='status'>
                              <option  selected value="draft"> Draft </option>
                              </select>
                         <?php } ;?>
                        

                        

                         <div class="col-md-4">
                         <label for="country" class="form-label">Kategori(ler)</label>
                         <select class="js-example-basic-multiple form-select" name="genres[]" multiple="multiple" >
                              <?php 
                              $querygenre = 'SELECT title,id FROM genres';
                              $resultgenre = mysqli_query($connection, $querygenre);
                              while($rowgenre = mysqli_fetch_assoc($resultgenre)){ 
                                   ?>
                                   <option  value="<?php echo $rowgenre['title'] ?>"
                                   <?php
                                   if (strpos($genre, $rowgenre['title']) !== false) {
                                        echo 'selected';
                                    }?>
                                    ><?php echo $rowgenre['title']?></option>
                                    <?php
                              }
                              
                              ?>
               
                         </select>
                         </div>

                         <div class="col-12">
                              <label for="description" class="form-label">Açıklama</label>
                              <div class="input-group has-validation">
                                   <textarea style='height:175px' class="form-control" id="description" name="description" placeholder=""><?php echo $description ?></textarea>
                              </div>
                         </div>

         
                         
                         <div class="col-sm-6">
                         <label for="cover" class="form-label">Kapak Fotoğrafı</label>
                         <input type="file" class="form-control" id="cover" name='cover'>
                         <?php if(!empty($cover)){ ?>
                         <label for="cover" class="form-label"><img style="width: 100%;max-height:100px" src="/admin/uploads/<?php echo $hash.'/cover/'. $cover ?>" alt=""></label>
                         <?php } ?>
                         </div>

                         <div class="col-sm-6">
                         <label for="chapter_cover" class="form-label"> Bölüm Kapak Fotoğrafı </label>
                         <input type="file" class="form-control" id="chapter_cover" name='chapter_cover'>
                         <?php if(!empty($chapter_cover)){ ?>
                         <label for="chapter_cover" class="form-label"><img style="width: 100%;max-height:100px" src="/admin/uploads/<?php echo $hash.'/cover/'. $chapter_cover ?>" alt=""></label>
                         <?php } ?>
                         </div>
							 
                         <div class="col-sm-6">
                         <label for="slider_image" class="form-label"> Slider Fotoğrafı </label>
                         <input type="file" class="form-control" id="slider_image" name='slider_image'>
                         <?php if(!empty($slider_image)){ ?>
                         <label for="slider_image" class="form-label"><img style="width: 100%;max-height:100px" src="/admin/uploads/<?php echo $hash.'/cover/'. $slider_image ?>" alt=""></label>
                         <?php } ?>
                         </div>






                         <hr class="my-4">
                         <input type="submit" class="w-100 btn btn-primary btn-lg" name="updateManga" value='Mangayı Güncelle'>
                    </form>
     
                    <hr class="my-4">
                    <h4 class="text-center">Chapters</h4>
                    <hr class="my-4">

                    <?php include('./template/all-chapters.php')?>

                    
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