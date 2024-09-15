<?php
session_start();
include(__DIR__.'/includes/db.php');

date_default_timezone_set('Europe/Istanbul');
$currentDateTime = new DateTime();
$currentDateTime->setTimezone(new DateTimeZone('Europe/Istanbul'));
$formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

function isActivePage($page) {
     $currentUrl = $_SERVER['REQUEST_URI'];

     if (strpos($currentUrl, $page) !== false) {
          echo 'active';
     }

}

$discord_photo = '/assets/images/logo.png';


function saatonce($zamantarih) {
     $simdi = new DateTime();
     $zamantarih = new DateTime($zamantarih);
     $fark = $zamantarih->diff($simdi);
     if ($fark->y > 0) {
         return $fark->y . " yıl önce";
     } elseif ($fark->m > 0) {
         return $fark->m . " ay önce";
     } elseif ($fark->d > 0) {
         return $fark->d . " gün önce";
     } elseif ($fark->h > 0) {
         return $fark->h . " saat önce";
     } elseif ($fark->i > 0) {
         return $fark->i . " dakika önce";
     } elseif ($fark->s > 0) { 
         return $fark->s . " saniye önce";
     } else {
         return "Az önce";
     }
 }

 function yeni($zamantarih) {
    $simdi = new DateTime();
    $zamantarih = new DateTime($zamantarih);
    $fark = $zamantarih->diff($simdi);

    if ($fark->y == 0 && $fark->m == 0 && $fark->d < 10) {
        return "Yeni";
    }
}




if(isset($_SESSION['success']))
{
    ?>

          <div style="z-index: 9999" class="position-relative  toast align-items-center fade show toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
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

          <div id="toaster" style="z-index: 9999" class="position-relative toast align-items-center fade show toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" data-bs-autohide="true" aria-atomic="true">
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




?>


<link rel="stylesheet" href="/assets/css/style.css">
