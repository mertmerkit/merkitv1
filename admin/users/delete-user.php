<?php require('../settings.php'); ?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUser'])){

    $id = $_POST['id'];
     $sql = 'DELETE FROM `users` WHERE id = ?';
     $stmt = mysqli_prepare($connection, $sql);
     mysqli_stmt_bind_param($stmt, "i", $id);
 
     if (mysqli_stmt_execute($stmt)) {
     }else{
         $_SESSION['error'] = 'Dosya silinirken bir hata oluştu.';
 

         header('Location: ../users');
         exit();
     }


}



header('Location: ../users');
exit();