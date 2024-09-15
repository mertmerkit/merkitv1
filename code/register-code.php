<?php

require('../settings.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

     if (!preg_match('/^[a-zA-Z0-9ğüşıöçĞÜŞİÖÇ]+$/', $username)) {
          $_SESSION['error'] = "Kullanıcı adı sadece harf ve rakamlardan oluşmalıdır.";
          header('Location: ../register');
          exit();
    }
     


$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Şifreyi hash'leme
$role = '0'; // 0 kullanici 1 editor 2 dizgici 3 son kontrolcu 4 admin 5 yonetici


 // Check if the username already exists
 $query_username = 'SELECT username FROM users WHERE username = ?';
 $stmt_username = mysqli_prepare($connection, $query_username);
 mysqli_stmt_bind_param($stmt_username, 's', $username);
 mysqli_stmt_execute($stmt_username);
 $result_username = mysqli_stmt_get_result($stmt_username);
 
 $query_email = 'SELECT email FROM users WHERE email = ?';
 $stmt_email = mysqli_prepare($connection, $query_email);
 mysqli_stmt_bind_param($stmt_email, 's', $email);
 mysqli_stmt_execute($stmt_email);
 $result_email = mysqli_stmt_get_result($stmt_email);


 if (mysqli_num_rows($result_username) > 0) {
    $usercheck = 'Kullanıcı Adı';
 }else{
    $usercheck = '';
 }

 if(mysqli_num_rows($result_email) > 0){
    if (mysqli_num_rows($result_username) > 0) {
        $mailcheck = 've Email';
    }else{
        $mailcheck = 'Email';
    }
 }{
    $mailcheck = '';
 }
 
 if(!empty($usercheck) || !empty($mailcheck)){
    $_SESSION['error'] = $usercheck." ".$mailcheck." Kullanılıyor. Lütfen farklı bir ".$usercheck." ".$mailcheck." seçin.";
    header('Location: ../register');
    exit();
 }


$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);
$stmt->execute();
if ($stmt->affected_rows > 0) {
     $_SESSION['success'] = "Kayıt başarılı! Artık giriş yapabilirsiniz.";
     header('Location: ../login');
     exit();
 } else {
     echo "Hata: " . $connection->error;
 }
 $stmt->close();

$connection->close();
}
