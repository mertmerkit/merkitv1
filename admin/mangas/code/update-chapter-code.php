<?php 
require('../../settings.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateChapter'])) {

        $id = $_POST['id'];
        $volume = $_POST['volume'];
        $manga_id = $_POST['manga_id'];
        $manga_hash = $_POST['manga_hash'];
        $status = $_POST['status'];
        $hash = $_POST['hash'];

            
        $title = $_POST['title'];
        $slug = $_POST['slug'];



        
        $folder_path = __DIR__ . '../../../uploads/'.$manga_hash.'/chapters/';
        $folder_path_chapters = __DIR__ . '../../../uploads/'.$manga_hash.'/chapters/'.$hash.'/';


        $allowedTypes = array("image/jpeg", "image/jpg", "image/png", "image/webp", "image/gif");

        if (isset($_FILES['cover']) && is_uploaded_file($_FILES['cover']['tmp_name']))  {
            $file_type = $_FILES["cover"]["type"];
            $cover_name = $_FILES['cover']['name'];
            $cover_tmp = $_FILES['cover']['tmp_name'];
            
            $file_path = $folder_path_chapters . $cover_name;

            
            if (in_array($file_type, $allowedTypes)) {
                move_uploaded_file($cover_tmp, $file_path);
                $cover = $cover_name;
            }else{
                $cover = $_POST['used_cover'];
            }
        }else{
            $cover = $_POST['used_cover'];
        }

        
        if (isset($_FILES['content'])) {
            $errors = [];
            $file_names = [];
        
            foreach ($_FILES['content']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['content']['name'][$key];
                $file_type = $_FILES['content']['type'][$key];
                $file_tmp = $_FILES['content']['tmp_name'][$key];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
                // Yeni dosya adını oluştur
                $new_file_name = cleanFileName($file_name);
                $file_path = '../../uploads/' . $manga_hash . '/chapters/' . $hash . '/' . $new_file_name;
        
                $folder_path = '../../uploads/' . $manga_hash . '/chapters/' . $hash . '/';
        
                if (!is_dir($folder_path)) {
                    mkdir($folder_path);
                }

        
                if (in_array($file_type, $allowedTypes)) {
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        $file_names[] = $new_file_name;
                    } else {
                        $errors[] = 'Resim yüklenirken bir hata oluştu: ' . $_FILES['content']['error'][$key];
                    }
                }else{$errors[] = 'Farkli dosya Tipi';}
            }
        
            if (empty($errors)) {
                // Yüklenen resimleri JSON formatında saklamak için bir dizi oluştur
                $images = [];
                foreach ($file_names as $key => $file_name) {
                    $images[$key] = $file_name;
                }
                // JSON formatına dönüştür
                $images = json_encode($images);
            } else {
                $images = $_POST['images'];
            }
        }
        else{
            $images = $_POST['images'];
        }



          
// Veritabanına ekle
$query = "UPDATE chapter SET 
`cover` = '$cover',
`manga_id` = '$manga_id',
`title` = '$title',
`images` = '$images',
`volume` = '$volume',
`status` = '$status',
`slug` = '$slug',
`hash` = '$hash'
WHERE `id` = $id";

if (mysqli_query($connection, $query)) {
    echo "Veriler başarıyla eklendi.";
    header('Location: ../single-chapter.php?id='.$id);
    exit;
} else {
    echo "Sorgu çalıştırma hatası: " . mysqli_error($connection);
    header('Location: ../single-chapter.php?id='.$id);
    exit;
}

}

   