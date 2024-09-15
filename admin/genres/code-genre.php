<?php
require('../settings.php');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_new_genre'])){


     $title = trim(preg_replace('/^\s{0,3}/', '', $_POST['title']));
     if(!empty($slug)){
          $slug = trim(preg_replace('/^\s{0,3}/', '', $_POST['slug']));
     }else{
          $slug = trim(preg_replace('/^\s{0,3}/', '', trtoeng($_POST['title'])));
     }

     $query = 'INSERT INTO genres (title, slug) VALUES (?, ?)';
     $stmt = $connection->prepare($query);
     $stmt->bind_param("ss", $title, $slug);

     if ($stmt->execute()) {
          $_SESSION['message'] = "Veriler başarıyla eklendi.";
          header('Location: index.php');
          exit();
      } else {
          $_SESSION['message'] = "Sorgu çalıştırma hatası: " . $stmt->error;
          header('Location: index.php');
          exit();
      }

}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_genre'])){

     $id = trim(preg_replace('/^\s{0,3}/', '', $_POST['id']));
     $title = trim(preg_replace('/^\s{0,3}/', '', $_POST['title']));
     $slug = trim(preg_replace('/^\s{0,3}/', '', $_POST['slug']));


     $query = "UPDATE genres SET 
     `title` = '$title',
     `slug` = '$slug'
     WHERE `id` = '$id'";
     
     echo $id; 
     if (mysqli_query($connection, $query)) {
          $_SESSION['message'] = "Veriler başarıyla güncellendi";
          header('Location: index.php');
          exit;
      } else {
          $_SESSION['message'] = "Veri güncellenirken bir hata oluştu: " . mysqli_error($connection);
          header('Location: index.php');
          exit;
      }

}




if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteGenre'])){

     $id = $_POST['id'];
     $hash = $_POST['hash'];

     $sql = 'DELETE FROM `genres` WHERE id = ?';
     $stmt = mysqli_prepare($connection, $sql);
     mysqli_stmt_bind_param($stmt, "i", $id);
 
     if (mysqli_stmt_execute($stmt)) {
          $_SESSION['message'] = 'Dosya Başarıyla Silindi.';

          header('Location: index.php');
          exit();

     }else{
         $_SESSION['message'] = 'Dosya silinirken bir hata oluştu.';
 
         header('Location: index.php');
         exit();
     }

}