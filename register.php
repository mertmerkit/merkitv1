
<?php require('./settings.php') ?>
<?php include('./includes/header.php') ?>
<?php include('./includes/topbar.php') ?>
<div class="topbar-fix"></div>



<div class="backlogin">
    <img class="w-100 h-100 object-fit-cover" src="/assets/images/login-register-img.jpg" alt="">
</div>

<title>Merkitv1 - Kayıt Ol</title>


<div class="login d-flex align-items-center justify-content-center margin-auto w-100 h-100">

<div class="login-content">

<div class="h-100 gap-3 d-flex flex-column align-items-center justify-content-center margin-auto" style="background:#0009;width:400px">
    <i style="font-size:90px" class=" fa fa-user"></i>
    <h1>Kayıt Ol</h1>

    <form action="/code/register-code.php" class="d-flex flex-column gap-2 " name="loginForm" method="post" onsubmit="return validateForm()">
        <input name="email" required type="email" class="userform" id="email"  placeholder="Email Adresi">
        <input name="username" required type="text" class="userform" id="username"  placeholder="Kullanıcı Adı">
        <input name="password" required type="password" class="userform" style="color:black" id="floatingPassword" placeholder="Şifre">
        <button class="userform" id='register' name='register' type="submit">Kayıt Ol</button>
        <span class="mt-1 text-light">Zaten Hesabın var mı? <a class="text-primary" href="/login"> Giriş Yap</a></span>
    </form>
</div>
</div>
</div>


<?php include('./includes/footer.php') ?>

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
