<?php require('./settings.php') ?>

<?php include('./includes/header.php') ?>
<title>Merkitv1 - Listem</title>

<?php include('./includes/topbar.php') ?>
<div class="mobile-topbar-fix"></div>

<div style="margin-top:90px"></div>
<div class="m-auto" style="max-width:1200px">
     <div class="d-flex gap-4">

          <div class="bg-container">
               <div class="position-relative d-flex justify-content-between align-items-center">
                    <h1 class="fs-4">Kitaplık</h1>
                    <span class="sil btn btn-danger py-1">Sil</span>
               </div>
               <hr>
               <p class="bg-container" style="font-size:14px;background:rgb(35,35,35)">
               Kitaplığa Eklediğiniz Seriler Burada Gösterilir. Kitaplığınıza Maximum 50 Seri Ekleyebilirsiniz. Not: Kitaplığı Kullanmak için Herhangi Bir Kayıt Oluşturmanız Gerekmez.
               </p>
               <ul id="liste">

               </ul>
          </div>

          <div class="trendscontainer" style="max-width:400px"><?php include('./includes/trends.php') ?></div>

     </div>
</div>

<?php include('./includes/footer.php') ?>


<script>
     document.querySelector('.sil').addEventListener('click', function() {
            let elements = document.querySelectorAll('.delete-button');
            elements.forEach(function(element) {
                element.style.display = 'block';
            });
     });
  function addItemToList(title, imageUrl, mangaURL) {
    var liste = document.getElementById("liste");
    var listItem = document.createElement("li");
    listItem.className = 'list-item';
    listItem.innerHTML = "<a href='"+ mangaURL +"' class='bookmarks-single'><div class='img'><img src='" + imageUrl + "' alt='" + title + "' > </div> <div class='manga-title'>" + title + "</div></a>";

    var deleteButton = document.createElement("button");
    deleteButton.textContent = "Sil";
    deleteButton.className = "delete-button";
    deleteButton.addEventListener("click", function() {
      listItem.remove();
      removeFromLocalStorage(title, imageUrl, mangaURL);
    });

    listItem.appendChild(deleteButton);
    liste.appendChild(listItem);
  }



  function removeFromLocalStorage(title, imageUrl, mangaURL) {
    var listem = JSON.parse(localStorage.getItem("listem"));
    listem = listem.filter(function(item) {
      return item.title !== title || item.imageUrl !== imageUrl || item.mangaURL !== mangaURL ;
    });
    localStorage.setItem("listem", JSON.stringify(listem));
  }

  // Sayfa yenilendiğinde listeyi localStorage'den geri yükle
  window.addEventListener("load", function() {
    var listem = JSON.parse(localStorage.getItem("listem"));
    if (listem) {
      listem.forEach(function(item) {
        addItemToList(item.title, item.imageUrl, item.mangaURL);
      });
    }
  });
</script>