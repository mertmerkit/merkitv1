<?php
 require('../settings.php');

if(!empty($_SESSION['username'])){
     echo $_SESSION['username'];
 }

 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
     // Formdan gelen bilgileri al ve temizle
     $usernamemail = mysqli_real_escape_string($connection, $_POST['usernamemail']);
     $password = $_POST['password'];

     // Kullanıcıyı sorgula
     $sql = "SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ?";
     $stmt = $connection->prepare($sql);
     
     if ($stmt) {
         $stmt->bind_param("ss", $usernamemail, $usernamemail);
         $stmt->execute();
         $result = $stmt->get_result();

         if ($result->num_rows > 0) {
             $row = $result->fetch_assoc();
             if (password_verify($password, $row["password"])) {
                 $_SESSION['username'] = $row['username'];
                 $_SESSION['email'] = $row['email'];
                 $_SESSION['role'] = $row['role'];
                 $_SESSION['success'] = "Başarıyla Giriş Yaptın! Hoşgeldin '".$_SESSION['username']."'";
                 header('Location: ../admin/');
                 exit();
                 
             } else {
               $_SESSION['error'] = "Hatalı şifre!";
               header('Location: ../login');
               exit();
             }
         } else {
             $_SESSION['error'] = "Kullanıcı bulunamadı!";
             header('Location: ../login');
         }
         $stmt->close();
         exit();
     } else {
         echo "Query preparation error: " . $connection->error;
     }
     $connection->close();
 }