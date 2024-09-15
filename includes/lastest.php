<div class="bg-container rounded">
<div class="recommend-title">Son Yayınlananlar <hr></div>
<div class="lastest-container d-grid">
<?php 

// İlk sorgu: Son yayınlanan bölümlerin manga_id'lerini al
$query = "SELECT manga_id FROM chapter WHERE status='published' ORDER BY release_date DESC";
$result = mysqli_query($connection, $query);
$last_chapter_ids = array();
while ($row = mysqli_fetch_array($result)) {
    $last_chapter_ids[] = $row['manga_id'];
}

// manga_id'leri virgülle ayrılmış bir dizeye dönüştür
$last_chapter_ids_str = implode(",", $last_chapter_ids);


// Eğer dizi boş değilse ikinci sorguyu çalıştır
if (!empty($last_chapter_ids)) {
    // İkinci sorgu: manga_id'lere göre manga tablolarından verileri al
    $query = "SELECT * FROM manga WHERE status='published' AND id IN ($last_chapter_ids_str) ORDER BY FIELD(id, $last_chapter_ids_str)";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result)) {
     $title =  $row['title'];
     $id = $row['id'];
     $score = $row['score'];
     $cover = $row['cover'];
     $hash = $row['hash'];
     $slug = $row['slug'];
     $adult = $row['adult'];
     $created_at = $row['created_at'];


     $querychapter = "SELECT * FROM chapter WHERE status='published' AND  manga_id =".$id." ORDER BY volume+0 DESC LIMIT 3 ";
     $resultchapter = mysqli_query($connection, $querychapter);
     $simdi = new DateTime();
     $zamantarih = new DateTime($created_at);
     $fark = $zamantarih->diff($simdi);

     if ($fark->y == 0 && $fark->m == 0 && $fark->d < 10) {
          $yeni = ' <i class="text-danger fa-solid blink fa-fire-flame-curved fs-6"></i>  Yeni';
     }else{
          $yeni = ' <i class="fa fa-circle text-success blink"></i> Devam Ediyor';
    }
?>




<div class="lastest <?php if($adult == 1){echo 'adult';} ?>">
     <div class="lastest-content">
          <a href="/manga/<?php echo $slug; ?>" class="left">
               <img src="/admin/uploads/<?php echo $hash; ?>/cover/<?php echo $cover; ?>" alt="">
          </a>
          <div class="right">
               <div class="info">
                    <a href="/manga/<?php echo $slug; ?>" class="title"><?php echo $title; ?></a>
                    <div class="info-mini">
                         <span class="info-star"> <i style="color:#FFD43B" class="fa-solid fa-star"></i> <?php echo $score; ?> </span>
                         <span class="info-status"> <?php echo $yeni; ?> </span>
                    </div>
               </div>

               <div class="chapters">
                    <?php 
                    while ($rowchapter = mysqli_fetch_array($resultchapter)) {
                         $chapter_id = $rowchapter['id'];
                         $chapter_title = $rowchapter['title'];
                         $chapter_release_date = $rowchapter['release_date'];
                    ?>
                    <a href="/chapter/<?php echo $chapter_id; ?>" class="single-chapter">
                         <?php echo $chapter_title; ?> <span> <?php echo saatonce($chapter_release_date); ?></span>
                    </a>
                    <?php }?>

                    <a href="/manga/<?php echo $slug; ?>" class="all-chapters">
                         Tüm Bölümler
                    </a>
               </div>

          </div>
     </div>
</div>

<?php     }
}
?>
</div>
</div>
