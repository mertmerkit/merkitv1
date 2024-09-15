<?php
session_start();

if(!isset($_SESSION['role'])){
  header('Location: ../');
  die();
}elseif($_SESSION['role'] < 1){
  header('Location: ../');
  die();
}

?>

<link rel="stylesheet" href="assets/default.css">


<?php

require_once(__DIR__.'/includes/db.php');

date_default_timezone_set('Europe/Istanbul');
$currentDateTime = new DateTime();
$currentDateTime->setTimezone(new DateTimeZone('Europe/Istanbul'));
$formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');





  function trtoeng($text) { 
     $trChars = array('ç', 'Ç', 'ğ', 'Ğ', 'ı', 'I', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü', ' ');
     $enChars = array('c', 'c', 'g', 'g', 'i', 'i','i', 'o', 'o', 's', 's', 'u', 'u', '-');
   
     // Türkçe karakterleri İngilizce karakterlere dönüştür
     $text = str_replace($trChars, $enChars, $text);
   
   
     // Birden fazla boşluğu tek bir "-" ile değiştirin
     $text = preg_replace('/-+/', '-', $text);
   
     // Özel karakterleri temizleyin ve boşlukları "-" ile değiştirin
     $text = preg_replace('/[^A-Za-z0-9\-]/', '', $text);
   
     $text = strtolower($text);
   
     return $text;
  } 

  function deleteFolder($folder_path) {
     if (is_dir($folder_path)) {
         $files = glob($folder_path . '/*'); // alt dosyalari al
   
         foreach ($files as $file) {
             if (is_file($file)) {
                 unlink($file); // dosyalari sil
             } elseif (is_dir($file)) {
               deleteFolder($file); //  fonksiyon ile alt klasorleri sil
             }
         }
   
         rmdir($folder_path); //  ana klasoru sil
     }
   } 
   

  function isActivePage($page) {

    $currentUrl = $_SERVER['REQUEST_URI'];

    if (strpos($currentUrl, $page) !== false) {
        echo 'active';
    }

    
  }


function cleanFileName($filename){
  $cleanedName = preg_replace('/[^\w\s.-]/', '', $filename);
  $cleanedName = preg_replace('/\s+/', '', $cleanedName);

  $cleanedName = trim($cleanedName);
  
  return $cleanedName;
}

function cleanFileNameWithExtension($filename){ 
  $cleanedName = preg_replace('/[^\w\s-]/', '', $filename);
  $cleanedName = preg_replace('/\s+/', '', $cleanedName);
  $cleanedName = preg_replace('/.webp/', '', $cleanedName);
  $cleanedName = preg_replace('/.jpg/', '', $cleanedName);
  $cleanedName = preg_replace('/.png/', '', $cleanedName);
  $cleanedName = preg_replace('/.gif/', '', $cleanedName);
  $cleanedName = preg_replace('/.jfif/', '', $cleanedName);
  $cleanedName = preg_replace('/.jpeg/', '', $cleanedName);

  $cleanedName = trim($cleanedName);
  
  return $cleanedName;
}

function uniqname($filename){

  $filenamenew = cleanFileNameWithExtension($filename);

  $filenameExt = pathinfo($filename);

  $fileExtension = $filenameExt['extension'];
  
  $sha256Hashed = hash('sha256', $filenamenew);
  $sha256Hash = bin2hex($sha256Hashed);

  $uniqueName = $sha256Hash; // Örneğin, dosya uzantısı .jpg ile eklenebilir
  
  return $uniqueName;
}








if(isset($_SESSION['success']))
{
    ?>

          <div style="z-index: 9999" class="position-fixed  toast align-items-center fade show toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
               <div class="d-flex">
                    <div class="toast-body">
                         <strong>Tebrikler !</strong> <?= $_SESSION['success']; ?>
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
               </div>
          </div>
    <?php 
    unset($_SESSION['success']);
}


if(isset($_SESSION['error']))
{
    ?>

          <div id="toaster" style="z-index: 9999" class="position-fixed toast align-items-center fade show toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" data-bs-autohide="true" aria-atomic="true">
               <div class="d-flex">
                    <div class="toast-body">
                         <strong>Hata !</strong> <?= $_SESSION['error']; ?>
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
               </div>
          </div>
    <?php 
    unset($_SESSION['error']);
}

