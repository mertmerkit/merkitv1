<?php require_once(__DIR__.'../../settings.php'); ?>
<div>
<div class="swiper AdSlider">
    <div class="swiper-wrapper">
     <?php 
     $query = "SELECT title, adult, slug, hash, genres, cover,slider_image,score,created_at FROM manga 
     WHERE status = 'published' AND slider_image IS NOT NULL AND slider_image <> '' AND adult = '0' 
     ORDER BY RAND() LIMIT 4";
     $result = mysqli_query($connection, $query);
     while ($row = mysqli_fetch_array($result)) {
          $title = $row['title'];
          $score = $row['score'];
          $hash = $row['hash'];
          $slider_image = $row['slider_image'];
          $slug = $row['slug'];
          $release_date = $row['created_at'];
          $genres = $row['genres'];
          $adult = $row['adult'];

          $simdi = new DateTime();
          $zamantarih = new DateTime($release_date);
          $fark = $zamantarih->diff($simdi);
      
          if ($fark->y == 0 && $fark->m == 0 && $fark->d < 10) {
               $yeni = ' <i class="fa fa-circle blink"></i> Yeni';
          }else{
               $yeni = ' <i class="fa fa-circle blink"></i> Devam Ediyor';
         }
 
     ?> 
      <a href="/manga/<?php echo $slug; ?>" class="<?php if($adult == 1){echo 'adult';} ?> swiper-slide">
          <div class="slider-content">
               <div class="slider-background"></div>
               <div class="slider-image">
                    <img src="/admin/uploads/<?php echo $hash.'/cover/'.$slider_image ; ?>" alt="<?php echo $title; ?> oku">
               </div>
               <div class="slider-info">
                    <div class="slider-title">
                         <h4><?php echo $title; ?></h4>
                    </div>
                    <div class="slider-mini">
                         <span class="slider-star"> <i style="color:#FFD43B" class="fa-solid fa-star"></i> <?php echo $score ?> </span>
                         <span class="slider-status"> <?php echo $yeni; ?> </span>
                    </div>
                    <div class="slider-categories">
                         <?php 
                         $genres = json_decode($genres);
                         foreach($genres as $genre){
                              echo '<span>'.$genre.'</span>';
                         }
                         ?>
                         
                    </div>
               </div>

          </div>
      </a>

      <?php } ?>
    </div>
    <div class="swiper-button-next text-white"><i class="fa-solid fa-circle-chevron-right"></i></div>
    <div class="swiper-button-prev text-white"><i class="fa-solid fa-circle-chevron-left"></i></div>
    <div class="swiper-pagination"></div>
  </div>
</div>
</div>

