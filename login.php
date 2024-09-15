
<?php require('./settings.php') ?>

<?php include('./includes/header.php') ?>
<title>Merkitv1 - Giriş Yap</title>

<?php include('./includes/topbar.php') ?>
<div class="topbar-fix"></div>


<div class="backlogin">
<img class="w-100 h-100 object-fit-cover" src="/assets/images/login-register-img.jpg" alt="">
</div>



<div class="login d-flex align-items-center justify-content-center margin-auto w-100 h-100">

<div class="login-content">

<div class="h-100 gap-3 d-flex flex-column align-items-center justify-content-center margin-auto" style="background:#0009;width:400px">
    <i style="font-size:90px" class=" fa fa-user"></i>
    <h1>Giriş Yap</h1>

    <form action="/code/login-code.php" class="d-flex flex-column gap-2 " name="loginForm" method="post" onsubmit="return validateForm()">
        <input name="usernamemail" required type="text" class="userform" id="usernamemail"  placeholder="Kullanıcı Adı veya E Posta">
        <input name="password" required type="password" class="userform" style="color:black" id="floatingPassword" placeholder="Şifre">
        <button class="userform" id='login' name='login' type="submit">Giriş Yap</button>
        <span class="mt-1 text-light">Hesabın yok mu? <a class="text-primary" href="/register"> Kayıt Ol</a></span>
    </form>
</div>



</div>


</div>



<?php include('./includes/footer.php') ?>