
<?php
require('settings.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Formdan gelen bilgileri al ve temizle
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = $_POST['password'];

    // Kullanıcıyı sorgula
    $sql = "SELECT id, password, role FROM users WHERE username = ?";
    $stmt = $connection->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row['role'];
            } else {
                echo "Hatalı şifre!";
            }
        } else {
            echo "Kullanıcı bulunamadı!";
        }

        $stmt->close();
    } else {
        // Handle query preparation error
        echo "Query preparation error: " . $connection->error;
    }

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
                        <h1 class="h3 mb-0 text-gray-800">Login</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow m-3">
                              <form name="loginForm" method="post" onsubmit="return validateForm()">
                                   <input type="text" name="username" placeholder="Kullanıcı Adı" required><br>
                                   <input type="password" name="password" placeholder="Şifre" required><br>
                                   <button id='login' name='login' type="submit">Giriş Yap</button>
                              </form>

                           
                    </div>
                </div>
            </div>
        </div>
    </div>



