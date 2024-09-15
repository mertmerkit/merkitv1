<?php
require('../../settings.php');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['createManga'])){

     $title = trim(preg_replace('/^\s{0,3}/', '', $_POST['title']));
     $alternative = trim(preg_replace('/^\s{0,3}/', '', $_POST['alternative']));
     $description = trim(preg_replace('/^\s{0,3}/', '', $_POST['description']));
     $score = trim(preg_replace('/^\s{0,9}/', '', $_POST['score']));
     $year = trim(preg_replace('/^\s{0,3}/', '', $_POST['year']));
     $type = trim(preg_replace('/^\s{0,3}/', '', $_POST['type']));
     $calendar = trim(preg_replace('/^\s{0,3}/', '', $_POST['calendar']));
     $artist = trim(preg_replace('/^\s{0,3}/', '', $_POST['artist']));
     $adult = trim(preg_replace('/^\s{0,3}/', '', $_POST['adult']));
     $author = trim(preg_replace('/^\s{0,3}/', '', $_POST['author']));
     $status = trim(preg_replace('/^\s{0,3}/', '', $_POST['status']));
     $hash = uniqid();
     $slug = trtoeng($title);


     if(!empty($_POST['genres'])){$genre = json_encode($_POST['genres'], JSON_UNESCAPED_UNICODE);}else{
          $genre = '';
     }

     $cover = $_FILES['cover']['name'];
     $chapter_cover = $_FILES['chapter_cover']['name'];



     // Folder structure and covers
     $allowedTypes = array("image/jpeg", "image/jpg", "image/png", "image/webp", "image/gif");
     
     $folder_path =  '../../uploads/' . $hash . '/';
     $folder_path_cover = '../../uploads/' . $hash . '/' . 'cover/';
     $folder_path_chapters = '../../uploads/' . $hash . '/' . 'chapters/';


     if(!is_dir($folder_path)){mkdir($folder_path);}
     if(!is_dir($folder_path_cover)){mkdir($folder_path_cover);}
     if(!is_dir($folder_path_chapters)){mkdir($folder_path_chapters);}

     if (isset($_FILES['cover'])) {
          $cover_name = $_FILES['cover']['name'];
          $cover_type = $_FILES['cover']['type'];
          $cover_tmp = $_FILES['cover']['tmp_name'];

          $file_path = $folder_path_cover . $cover_name;
          if (in_array($cover_type, $allowedTypes)) {
               move_uploaded_file($cover_tmp, $file_path);
          }
     }

     if (isset($_FILES['chapter_cover'])) {
          $chapter_cover_name = $_FILES['chapter_cover']['name'];
          $chapter_cover_tmp = $_FILES['chapter_cover']['tmp_name'];
          $chapter_cover_type = $_FILES['chapter_cover']['type'];

          $file_path = $folder_path_cover . $chapter_cover_name;
          if (in_array($chapter_cover_type, $allowedTypes)) {
               move_uploaded_file($chapter_cover_tmp, $file_path);
          }
     }

     $title = mysqli_real_escape_string($connection, $title);
     $alternative = mysqli_real_escape_string($connection, $alternative);
     $slug = mysqli_real_escape_string($connection, $slug);
     $score = mysqli_real_escape_string($connection, $score);
     $cover_name = mysqli_real_escape_string($connection, $cover_name);
     $chapter_cover_name = mysqli_real_escape_string($connection, $chapter_cover_name);
     $genre = mysqli_real_escape_string($connection, $genre);
     $artist = mysqli_real_escape_string($connection, $artist);
     $author = mysqli_real_escape_string($connection, $author);
     $year = mysqli_real_escape_string($connection, $year);
     $status = mysqli_real_escape_string($connection, $status);
     $adult = mysqli_real_escape_string($connection, $adult);
     $type = mysqli_real_escape_string($connection, $type);
     $calendar = mysqli_real_escape_string($connection, $calendar);

     // Insert datas to database
     
     $query = 'INSERT INTO manga (adult, title, alternative_title, slug, description, score, cover, chapter_cover, genres, artist, author, year, status, type, calendar, hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
     $stmt = $connection->prepare($query);
     $stmt->bind_param("ssssssssssssssss", $adult, $title, $alternative, $slug, $description, $score, $cover_name, $chapter_cover_name, $genre, $artist, $author, $year, $status, $type, $calendar, $hash);
     
     if ($stmt->execute()) {
         $_SESSION['message'] = "Veriler başarıyla eklendi.";
         header('Location: ../index.php');
         exit;
     } else {
         $_SESSION['message'] = "Sorgu çalıştırma hatası: " . $stmt->error;
         header('Location: ../index.php');
         exit;
     }
     
      
}