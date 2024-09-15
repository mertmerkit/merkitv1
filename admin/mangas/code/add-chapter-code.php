<?php 
require('../../settings.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createChapter'])) {
     if (isset($_FILES['content'])) {
          $errors = [];
          $file_names = [];
  
          $volume = $_POST['volume'];
          $manga_id = $_POST['manga_id'];
          $manga_hash = $_POST['manga_hash'];
          $status = $_POST['status'];
          $hash = uniqid(); 
          $title = (!empty($_POST['chapterName'])) ? $_POST['chapterName'] : 'Bölüm ' . $volume;
          $slug = trtoeng($title);


          $allowedTypes = array("image/jpeg", "image/jpg", "image/png", "image/webp", "image/gif");
          $folder_path = '../../uploads/'.$manga_hash.'/chapters/';
          $folder_path_chapters = '../../uploads/'.$manga_hash.'/chapters/'.$hash.'/';
          if(!is_dir($folder_path_chapters)){mkdir($folder_path_chapters);}

          if (isset($_FILES['cover'])) {
            $cover_name = $_FILES['cover']['name'];
            $cover_type = $_FILES['cover']['type'];
            $cover_tmp = $_FILES['cover']['tmp_name'];
            
            $file_path = $folder_path_chapters . $cover_name;
            
            if (in_array($cover_type, $allowedTypes)) {
                move_uploaded_file($cover_tmp, $file_path);
            }else{
                $cover_name = '';
            }
       }



          foreach ($_FILES['content']['tmp_name'] as $key => $tmp_name) {
               $file_name = $_FILES['content']['name'][$key];
               $file_type = $_FILES['content']['type'][$key];
               $file_tmp = $_FILES['content']['tmp_name'][$key];
               $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
   
               // Yeni dosya adını oluştur
               $new_file_name = cleanFileName($file_name);
               $file_path = '../../uploads/' . $manga_hash. '/chapters/' . $hash .'/' . $new_file_name;
               
               $folder_path = '../../uploads/' . $manga_hash .'/chapters/'. $hash. '/';
   
               if (!is_dir($folder_path)) {
                   mkdir($folder_path);
               }

               if (in_array($file_type, $allowedTypes)) {
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        $file_names[] = $new_file_name;
                    } else {
                        $errors[] = 'Resim yüklenirken bir hata oluştu.';
                    }
                }else{
                    header('Location: ../single.php?id='.$manga_id);
                    $connection->close();exit;
                }
           }
   
           if (empty($errors)) {
   
               // Yüklenen resimleri JSON formatında saklamak için bir dizi oluştur
               $images = [];
   
               foreach ($file_names as $key => $file_name) {
                   $images[($key)] = $file_name;
               }
   
               // JSON formatına dönüştür
               $jsonImages = json_encode($images);
   
               // Veritabanına ekle
               $query = "INSERT INTO chapter (cover, manga_id, title, images, volume, status, slug, hash) VALUES (?, ?, ? ,?, ?, ?, ?, ?)";
               $stmt = $connection->prepare($query);
               $stmt->bind_param('ssssssss', $cover_name, $manga_id, $title ,$jsonImages, $volume, $status, $slug, $hash);
   
               if ($stmt->execute()) {
                   $_SESSION['succes'] = 'Bölüm başarıyla yüklendi ve veritabanına kaydedildi.';
                   header('Location: ../single.php?id='.$manga_id);
                   $connection->close();exit;
               } else {
                   $_SESSION['error'] = 'Veritabanına kaydetme sırasında bir hata oluştu.';
                  header('Location: ../single.php?id='.$manga_id);
                   $connection->close();exit;
               } 
   
               // mysqli bağlantısını kapat

           } else {
               foreach ($errors as $error) {
                   $_SESSION['error'] = $error . '<br>';
               }
           }
       }
   }
   
   header('Location: ../single.php?id='.$manga_id);
   exit;

   