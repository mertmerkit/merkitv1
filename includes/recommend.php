

<div class="recommend-container w-100 rounded flex-shrink bg-container">
     <div class="recommend-title">Önerilen Seriler <hr></div>
    
     <div class="swiper RecommendSlider">
          <div class="swiper-wrapper">
          <?php 
          $query = "SELECT adult,title,slug,hash,cover FROM manga WHERE status='published' AND adult = '0' ORDER BY rand()";
          $result = mysqli_query($connection, $query);
          while ($row = mysqli_fetch_array($result)) {
               $title = $row['title'];
               $hash = $row['hash'];
               $cover = $row['cover'];
               $slug = $row['slug'];
               $adult = $row['adult'];
          ?> 

          <a href="/manga/<?php echo $slug; ?>" class="swiper-slide" style="display:block">
               <div class="slider-content">
                    <div class="slider-background"></div>
                    <div class="slider-image"><img src="/admin/uploads/<?php echo $hash ?>/cover/<?php echo $cover ?>" alt=""></div>
                    <div class="slider-info">
                         <div class="slider-title">
                         <?php echo $title ?>
                         </div>
                    </div>
               </div>
          </a>

          <?php }; ?>

          </div>
     
     
     </div>
</div>



