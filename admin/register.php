<?php
require('settings.php');

// get user ip
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.ipify.org");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$user_ip = curl_exec($ch);
curl_close($ch);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

     if (!preg_match('/^[a-zA-Z0-9ğüşıöçĞÜŞİÖÇ]+$/', $username)) {
          die("Kullanıcı adı sadece harf ve rakamlardan oluşmalıdır.");
}
     


$username = $_POST['username'];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Şifreyi hash'leme
$role = '0'; // 0 kullanici 1 editor 2 dizgici 3 son kontrolcu 4 admin 5 yonetici

$query = 'SELECT username FROM users WHERE ip = ?';

// Prepare the statement
$stmt = mysqli_prepare($connection, $query);

// Bind the parameter
mysqli_stmt_bind_param($stmt, 's', $user_ip);

// Execute the statement
mysqli_stmt_execute($stmt);

// Store the result
$result = mysqli_stmt_get_result($stmt);

// Check if any rows were returned
if (mysqli_num_rows($result) >= 3) {
     die('Aynı IP adresiyle en fazla 3 hesap oluşturulabilir. Destek almak için lütfen Discord\'a girin.'); 
 }
 
 // Check if the username already exists
 $query_username = 'SELECT username FROM users WHERE username = ?';
 $stmt_username = mysqli_prepare($connection, $query_username);
 mysqli_stmt_bind_param($stmt_username, 's', $username);
 mysqli_stmt_execute($stmt_username);
 $result_username = mysqli_stmt_get_result($stmt_username);
 
 if (mysqli_num_rows($result_username) > 0) {
     die('Bu kullanıcı adı zaten mevcut. Lütfen farklı bir kullanıcı adı seçin.');
 }
 


// Close the statement
mysqli_stmt_close($stmt);
$sql = "INSERT INTO users (username, ip, password) VALUES (?, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("sss", $username, $user_ip, $password);
$stmt->execute();
if ($stmt->affected_rows > 0) {
     echo "Kayıt başarılı!";
 } else {
     echo "Hata: " . $connection->error;
 }
 $stmt->close();

$connection->close();
}

?>


<?php include('includes/header.php'); ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include('includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                 <?php include('includes/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Register</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow m-3">
                        <form name="loginForm" method="post" onsubmit="return validateForm()">
                            <input type="text" name="username" placeholder="Kullanıcı Adı" required><br>
                            <input type="password" name="password" placeholder="Şifre" required><br>
                            <button id='register' name='register' type="submit">Giriş Yap</button>
                        </form>

                           
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;
            var usernameRegex = /^[a-zA-Z0-9ğüşıöçĞÜŞİÖÇ]+$/; // Türkçe karakter dışındaki özel karakterleri engelleyen regex
            var passwordRegex = /^[a-zA-Z0-9!@#$%^&*()_+{}|:"<>?\-=\[\]\\;',.\/]+$/; // Özel karakterleri engelleyen regex

            if (!usernameRegex.test(username)) {
                alert("Kullanıcı adı sadece harf ve rakamlardan oluşmalıdır.");
                return false;
            }

            if (!passwordRegex.test(password)) {
                alert("Şifrede özel karakter kullanılamaz.");
                return false;
            }

            return true;
        }
    </script>
