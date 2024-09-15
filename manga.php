<?php require('./settings.php') ?>
<?php include('./includes/header.php') ?>
<?php include('./includes/topbar.php') ?>
<div class="topbar-fix"></div>




<?php
     if (isset($_GET['slug'])) {
          $slug = $_GET['slug'];
     $query = 'SELECT * FROM manga WHERE slug ="'.$slug.'"';
     $result = mysqli_query($connection, $query);
     if($row = mysqli_fetch_assoc($result)){ 
          $id = $row['id'];
          $title =  $row['title'];
          $alternative_title =  $row['alternative_title'];
          $artist =  $row['artist'];
          $author =  $row['author'];
          $year =  $row['year'];
          $score =  $row['score'];
          $views =  $row['views'];
          $description =  $row['description'];
          $cover =  $row['cover'];
          $chapter_cover =  $row['chapter_cover'];
          $type =  $row['type'];
          $status =  $row['status'];
          $hash =  $row['hash'];
          $genre =  $row['genres'];
     }

     ?>
     <title><?php echo $title; ?> Türkçe Oku - Merkitv1 </title>
     <meta name="description" content="<?php echo $title; ?> - Merkitv1 | En kaliteli türkçe manga okuma platformu...">

      <?php


     $chapterquery = "SELECT * FROM chapter WHERE manga_id = '$id' AND status='published' ORDER BY volume+0 DESC";
     $chapterresult = mysqli_query($connection, $chapterquery);

     $countchapter_query = "SELECT COUNT(*) as chapter_count FROM chapter WHERE status='published' AND manga_id=".$id;
     $countchapter_result = mysqli_query($connection, $countchapter_query);
     $countchapter_row = mysqli_fetch_assoc($countchapter_result);
     $chapter_count = $countchapter_row['chapter_count'];

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
    // Update the "post_views" column in the "posts" table
    $update_views_query = "UPDATE manga SET views = views + 1 WHERE id = ?";
    $stmt_views = mysqli_prepare($connection, $update_views_query);

    // Assuming $post_id holds the post ID value

    mysqli_stmt_bind_param($stmt_views, "i", $id);
    mysqli_stmt_execute($stmt_views);

    // Update the last view time in the session
    $_SESSION['last_view_time'] = time();
}
?>






<div class="manga">
     <div class=" manga-content d-grid gap-4 justify-">

     <div class="left rounded overflow-hidden">
          <div class="thumb">
               <img id="image" src="<?php echo '/admin/uploads/'.$hash.'/cover/'.$cover; ?>" alt="">
          </div>
          <div class="charts">
               <div class="star">
                    <i style="color:white" class="fa-solid fa-star"></i> 
                    <div><?php echo $score; ?></div>
               </div>
               <div class="views">
                    <i style="color:white" class="fa-solid fa-eye"></i>
                    <div><?php echo $views; ?></div>
               </div>
               <div class="chapters">
                    <i style="color:white" class="fa-solid fa-book-open"></i>
                    <div><?php echo $chapter_count; ?></div>
               </div>
          </div>
          <div class="first-last d-flex justify-content-between align-items-center">
               <?php if($chapter_count > 1){ ?>
               <a class="btn" href="/chapter/<?php echo $results['id']['asc'] ?>"><?php echo $results['title']['asc'] ?></a>
               <a class="btn" href="/chapter/<?php echo $results['id']['desc'] ?>"><?php echo $results['title']['desc'] ?></a>
               <?php }else{ ?>
                    <a class="btn w-100" ><?php echo 'Henüz Bölüm Yok' ?></a>
               <?php } ?>
          </div>
          <a id="ekleButton" style="cursor:pointer" class=" text-white border-none add-list d-flex justify-content-center align-items-center rounded p-2 cursor-pointer">
               Listeme Ekle
          </a>
     </div>

     <div class="right d-flex flex-column gap-4 w-100">
          <div class="info d-flex flex-column rounded bg-container" ">
               <div id='title' class="title fs-2"><?php echo $title; ?></div>
               <div class="categories mt-1 d-flex nowrap gap-2">
                    <?php  
                    $genre = json_decode($genre);
                    foreach($genre as $genres)
                         echo '<a href="http://localhost/search?category='.$genres.'" class="span py-1 px-2 rounded text-white" style="font-size:12px; background: var(--bg-container-second)">'.$genres.'</a>'
                    ?>
               </div>
               <div class="synopsis mt-3"><?php echo $description; ?></div>
          </div>
          <div class="chapters rounded bg-container">
               <div class="chapters-title fs-5 m-0">Bölümler<hr></div>
               <div class="search"></div>


               <input type="text" class="form-control mb-4" style="color:rgb(200,200,200);background:var(--bg-container-second);border:none" id="chapterSearch" onkeyup="chapterSearch()" placeholder="Bölüm Ara.." title="Aradığınız bölümü yazınız...">


               <div id="allchp" class="all-chapters">
                    <?php 
                    while($row = mysqli_fetch_assoc($chapterresult)){ 
                         $chapter_id = $row['id'];
                         $chapter_volume =  $row['volume'];
                         $chapter_title =  $row['title'];
                         $chapter_hash =  $row['hash'];
                         $chapter_status =  $row['status'];
                         $chapter_views = $row['views'];
                         $chapter_thumb = $row['cover'];
                         $chapter_date = $row['release_date'];
                    ?>
                    <a href="/chapter/<?php echo $chapter_id; ?>" class="single-chapter">
                         <div class="left">
                              <div class="image">
                                   <img src="
                                   <?php 
                                        if(!isset($chapter_thumb) || empty($chapter_thumb) ){
                                             echo '/admin/uploads/'.$hash.'/cover/'.$chapter_cover; 
                                        }else{
                                             echo '/admin/uploads/'.$hash.'/chapters/'.$chapter_hash.'/'.$chapter_thumb; 
                                        }
                                   ?>
                                   " alt="">
                              </div>
                         </div>
                         <div class="right">
                              <div class="chapter-info">
                                   <div class="chpname top"><?php echo $chapter_title; ?></div>
                                   <div class="bottom"><?php echo saatonce($chapter_date); ?> <span><?php echo $chapter_views; ?> okunma</span></div>
                              </div>
                         </div>
                    </a>

                    <?php } ?>
               </div>
          </div>
     </div>

     </div>
</div>



<script>
function chapterSearch() {
    var input, filter, div, a, i, txtValue;
    input = document.getElementById("chapterSearch");
    filter = input.value.toUpperCase();
    div = document.getElementById("allchp");
    a = div.getElementsByTagName("a");
    chpname = div.getElementsByClassName('chpname');

    for (i = 0; i < a.length; i++) {
        txtValue = chpname[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}








function updateButtonState() {
  var title = document.getElementById("title").innerText;
  var listem = JSON.parse(localStorage.getItem("listem")) || [];
  var exists = listem.some(function(item) {
    return item.title === title;
  });

  var ekleButton = document.getElementById("ekleButton");
  if (exists) {
    ekleButton.textContent = "Listemden Çıkart";
  } else {
    ekleButton.textContent = "Listeme Ekle";
  }
}

document.getElementById("ekleButton").addEventListener("click", function() {
  var title = document.getElementById("title").innerText;
  var imageUrl = document.getElementById("image").src;
  var mangaURL = window.location.href;

  var listem = JSON.parse(localStorage.getItem("listem")) || [];
  var exists = listem.some(function(item) {
    return item.title === title;
  });

  if (exists) {
    removeFromLocalStorage(title);
  } else {
    addItemToList(title, imageUrl, mangaURL);
  }
  updateButtonState();
});

function addItemToList(title, imageUrl, mangaURL) {
  var listem = JSON.parse(localStorage.getItem("listem")) || [];
  var exists = listem.some(function(item) {
    return item.title === title;
  });

  if (!exists) {
    var deleteButton = document.createElement("button");
    deleteButton.textContent = "Sil";
    deleteButton.className = "delete-button";
    deleteButton.addEventListener("click", function() {
      removeFromLocalStorage(title);
      updateButtonState();
    });

  
    // Add the item to the list
    listem.push({ title: title, imageUrl: imageUrl, mangaURL: mangaURL });
    localStorage.setItem("listem", JSON.stringify(listem));
  }
}

function removeFromLocalStorage(title) {
  var listem = JSON.parse(localStorage.getItem("listem")) || [];
  listem = listem.filter(function(item) {
    return item.title !== title;
  });
  localStorage.setItem("listem", JSON.stringify(listem));
}

// Sayfa yenilendiğinde listeyi localStorage'den geri yükle
window.addEventListener("load", function() {
  var listem = JSON.parse(localStorage.getItem("listem")) || [];
  listem.forEach(function(item) {
    addItemToList(item.title, item.imageUrl, item.mangaURL);
  });
  updateButtonState();
});


</script>

     
<?php include('./includes/footer.php'); } ?>
