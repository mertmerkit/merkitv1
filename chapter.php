<?php require('./settings.php') ?>
<?php include('./includes/header.php') ?>
<?php include('./includes/topbar.php') ?>
<div class="topbar-fix"></div>



<?php
     if (isset($_GET['id'])) {
          $id = $_GET['id'];
     }
     $query = 'SELECT * FROM chapter WHERE id ='.$id;
     $result = mysqli_query($connection, $query);
     if($row = mysqli_fetch_assoc($result)){ 
          $id = $row['id'];
          $manga_id = $row['manga_id'];
          $title =  $row['title'];
          $images =  $row['images'];
          $slug =  $row['slug'];
          $volume =  $row['volume'];
          $hash =  $row['hash'];
     }

     $query = 'SELECT * FROM manga WHERE id ='.$manga_id;
     $result = mysqli_query($connection, $query);
     if($row = mysqli_fetch_assoc($result)){ 
          $manga_id = $row['id'];
          $manga_title =  $row['title'];
          $manga_hash =  $row['hash'];
          $manga_slug =  $row['slug'];
     }
     ?>
     <title><?php echo $manga_title; ?> <?php echo $title; ?> - Merkitv1</title>
     <meta name="description" content="<?php echo $manga_title; ?> <?php echo $title; ?> - Merkitv1 | En kaliteli türkçe manga okuma platformu...">
 
      <?php



     $chapterquery = "SELECT * FROM chapter WHERE manga_id = '$id' AND status='published' ORDER BY volume+0 ASC";
     $chapterresult = mysqli_query($connection, $chapterquery);


     $queries = [
          'asc' => "SELECT * FROM chapter WHERE manga_id = '$id' AND status='published' ORDER BY volume+0 ASC LIMIT 1",
          'desc' => "SELECT * FROM chapter WHERE manga_id = '$id' AND status='published' ORDER BY volume+0 DESC LIMIT 1",
      ];
      
      $results = [
          'id' => [],
          'title' => []
      ];
      
      foreach ($queries as $key => $query) {
          $result = mysqli_query($connection, $query);
          if ($row = mysqli_fetch_assoc($result)) {
              $results['id'][$key] = $row['id'];
              $results['title'][$key] = $row['title'];
          }
      }
      
      
?>

<?php

if (!isset($_SESSION['last_view_time']) || (time() - $_SESSION['last_view_time']) >= 15) {
    $update_views_query = "UPDATE chapter SET views = views + 1 WHERE id = ?";
    $stmt_views = mysqli_prepare($connection, $update_views_query);

    mysqli_stmt_bind_param($stmt_views, "i", $id);
    mysqli_stmt_execute($stmt_views);

    $update_views_query_2 = "UPDATE manga SET views = views + 1 WHERE id = ?";
    $stmt_views_2 = mysqli_prepare($connection, $update_views_query_2);

    mysqli_stmt_bind_param($stmt_views_2, "i", $manga_id);
    mysqli_stmt_execute($stmt_views_2);

    $_SESSION['last_view_time'] = time();
}

?>



<div class="chapter my-5 max-w-100 m-auto">
    <div class="chapter-content d-flex flex-column gap-4 m-auto" style="max-width: 1200px;">
        <div class="rounded top bg-container w-100 p-4">
            <h1 class="title fs-5 text-center p-3 ">
                <?php echo $manga_title.' '.$title;?>
            </h1>
            <div class="description text-center p-2 px-4" style="color: rgb(200, 200, 200)">
                <?php echo $manga_title.' adlı serinin '.$volume.'. bölümünü okumaktasınız. '.$manga_title.' Serisinin diğer bölümlerini de sitemizden okuyabilirsiniz.' ;?>
            </div>
            <hr style="color:red">
            <div class="manga_chapter_reklam"><h2><?php echo $manga_title;?> oku </h2> <h3> <?php echo $manga_title;?> türkçe oku </h3>  <h4> <?php echo $manga_title;?>  </h4>  <h5> <?php echo $manga_title;?> manga oku </h5></div>
        </div>

        <div class="bg-container text-danger gap-3 d-flex flex-wrap align-items-center rounded justify-content-start p-3 ">
                <a href="/">Ana Sayfa</a> > <a href="/manga/<?php echo $manga_slug; ?>"><?php echo $manga_title; ?></a> > <a href="/chapter/<?php echo $id; ?>"> <?php echo $title; ?></a>
        </div>

        <div class="text-danger gap-3 d-flex flex-wrap align-items-center rounded justify-content-between ">
                <select class="w-100 bg-dark  rounded p-1" style="border:1px solid rgb(100,100,100); color: rgb(225,225,225)" onchange="window.location.href = '/chapter/' + this.value;">
                    <?php 
                        $query = 'SELECT * FROM chapter WHERE manga_id ='.$manga_id.' ORDER BY volume+0 asc';
                        $result = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($result)){ 
                             $chp_id = $row['id'];
                             $chp_title = $row['title'];
                        ?>
                            <option value="<?php echo $chp_id; ?>" <?php if($chp_id == $id){echo 'selected';} ?>>
                                <?php echo $chp_title; ?>
                            </option>
                        <?php }; ?>
                </select>
                <div class="nextprev w-100 d-flex align-items-center justify-content-between gap-2">
                    <?php 
                    $query = 'SELECT * FROM chapter WHERE volume =' . ($volume - 1) . ' AND manga_id = '.$manga_id.' AND  status = "published" LIMIT 1';
                    $result = mysqli_query($connection, $query);
                    if($row = mysqli_fetch_assoc($result)){ 
                        echo '<a href="/chapter/'.$row['id'].'" class="w-50 text-center py-2 text-white rounded" style="background:darkred"> Önceki </a>';
                    }else{
                        echo '<div href="" class="w-50 text-center py-2 text-white rounded" style="background:#3f1717"> Önceki </div>';
                    }
                    $query = 'SELECT * FROM chapter WHERE volume =' . ($volume + 1) . ' AND manga_id = '.$manga_id.' AND  status = "published" LIMIT 1';
                    $result = mysqli_query($connection, $query);
                    if($row = mysqli_fetch_assoc($result)){ 
                        echo '<a href="/chapter/'.$row['id'].'"  class="w-50 text-center py-2 text-white rounded" style="background:darkred"> Sonraki </a>';
                    }
                    else{
                        echo '<div href="" class="w-50 text-center py-2 text-white rounded" style="background:#3f1717"> Sonraki </d>';
                    }
                    ?>
                </div>
        </div>

		<?php 
		$query = 'SELECT * FROM ads WHERE page = "chapter" AND active = "1"  order by RAND() LIMIT 1';
     	$result = mysqli_query($connection, $query);
     	if($row = mysqli_fetch_assoc($result)){ 
          $ad_image = $row['image'];
          $ad_href =  $row['href'];
		?>
			<a href="<?php echo $ad_href; ?>" class="d-block ads w-100 mb-2" >
				<img class="w-100 h-100 object-fit-cover"  style="max-height:370px;" src="<?php echo $ad_image; ?>" alt="" />
			</a>
		<?php } ?>
        <div class="chapter-content w-100 m-auto" style="max-width:850px">
            <?php 
                $images = json_decode($images);

                foreach ($images as $image) {
                    echo "<img class='w-100' src='/admin/uploads/$manga_hash/chapters/$hash/$image' />";
                }
            ?>
        </div>
        
    </div>


        <div class="text-danger gap-3 d-flex flex-wrap align-items-center rounded justify-content-between p-3 ">
                <select class="w-100 bg-dark  rounded p-1" style="border:1px solid rgb(100,100,100); color: rgb(225,225,225)" onchange="window.location.href = '/chapter/' + this.value;">
                    <?php 
                        $query = 'SELECT * FROM chapter WHERE manga_id ='.$manga_id.' ORDER BY volume+0 asc';
                        $result = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($result)){ 
                             $chp_id = $row['id'];
                             $chp_title = $row['title'];
                        ?>
                            <option value="<?php echo $chp_id; ?>" <?php if($chp_id == $id){echo 'selected';} ?>>
                                <?php echo $chp_title; ?>
                            </option>
                        <?php }; ?>
                </select>
                <div class="nextprev w-100 d-flex align-items-center justify-content-between gap-2">
                    <?php 
                    $query = 'SELECT * FROM chapter WHERE volume =' . ($volume - 1) . ' AND manga_id = '.$manga_id.' AND status = "published" LIMIT 1';
                    $result = mysqli_query($connection, $query);
                    if($row = mysqli_fetch_assoc($result)){ 
                        echo '<a href="/chapter/'.$row['id'].'" class="w-50 text-center py-2 text-white rounded" style="background:darkred"> Önceki </a>';
                    }else{
                        echo '<div href="" class="w-50 text-center py-2 text-white rounded" style="background:#3f1717"> Önceki </div>';
                    }
                    $query = 'SELECT * FROM chapter WHERE volume =' . ($volume + 1) . ' AND manga_id = '.$manga_id.' AND status = "published" LIMIT 1';
                    $result = mysqli_query($connection, $query);
                    if($row = mysqli_fetch_assoc($result)){ 
                        echo '<a href="/chapter/'.$row['id'].'"  class="w-50 text-center py-2 text-white rounded" style="float:right;background:darkred"> Sonraki </a>';
                    }else{
                        echo '<div href="" class="w-50 text-center py-2 text-white rounded" style="background:#3f1717"> Sonraki </div>';
                    }
                    ?>
                </div>
        </div>

        <div class="fs-4 rounded bg-container d-flex align-items-center justify-content-center text-align-center p-3" style="font-weight:600">
            
            <div class="disqus mt-4">
            <div id="disqus_thread"></div>
<script>
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://onigirimanga.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<?php include('./includes/footer.php') ?>
