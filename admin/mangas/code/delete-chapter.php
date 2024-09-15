<?php require('../../settings.php'); ?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteChapter'])){

     $id = $_POST['id'];
     $manga_id = $_POST['manga_id'];
     $manga_hash = $_POST['manga_hash'];
     $hash = $_POST['hash'];

     $folder_path_chapter = '../../uploads/'.$manga_hash.'/chapters/'.$hash.'/';
     
     deleteFolder($folder_path_chapter);

     if(!is_dir($folder_path_chapter)){
          $_SESSION['success'] = 'Dosya Başarıyla Silindi.';
     }else{
     }


     $sql = 'DELETE FROM `chapter` WHERE id = ?';
     $stmt = mysqli_prepare($connection, $sql);
     mysqli_stmt_bind_param($stmt, "i", $id);
 
     if (mysqli_stmt_execute($stmt)) {
     }else{
         $_SESSION['error'] = 'Dosya silinirken bir hata oluştu.';
 

         header('Location: ../single.php?id='.$manga_id);
         exit();
     }


}



header('Location: ../single.php?id='.$manga_id);
exit();