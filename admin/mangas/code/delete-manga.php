<?php require('../../settings.php'); ?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteManga'])){

     $id = $_POST['id'];
     $hash = $_POST['hash'];

     $folder_path = '../../uploads/'.$hash.'/';
     $folder_path_cover =  '../../uploads/'.$hash.'/cover/';
     $folder_path_chapters = '../../uploads/'.$hash.'/chapters/';

     
     deleteFolder($folder_path);
     deleteFolder($folder_path_cover);
     deleteFolder($folder_path_chapters);

     if(!is_dir($folder_path) && !is_dir($folder_path_cover) && !is_dir($folder_path_chapters)){
          $_SESSION['success'] = 'Dosya Başarıyla Silindi.';
     }


     $sql = 'DELETE FROM `manga` WHERE id = ?';
     $stmt = mysqli_prepare($connection, $sql);
     mysqli_stmt_bind_param($stmt, "i", $id);
 
     if (mysqli_stmt_execute($stmt)) {
     }else{
         $_SESSION['error'] = 'Dosya silinirken bir hata oluştu.';
 

         header('Location: ../index.php');
         exit();
     }


}



header('Location: ../index.php');
exit();