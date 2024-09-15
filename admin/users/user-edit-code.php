<?php 
require('../settings.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateUser'])) {

        $id = $_POST['id'];
        $username = $_POST['username'];
        $role = $_POST['role'];
   

// Veritabanına ekle
$query = "UPDATE users SET 
`username` = '$username',
`role` = '$role'
WHERE `id` = $id";

if (mysqli_query($connection, $query)) {
    echo "Veriler başarıyla eklendi.";
    header('Location: ../users');
    exit;
} else {
    echo "Sorgu çalıştırma hatası: " . mysqli_error($connection);
    header('Location: ../users');
    exit;
}

}

   