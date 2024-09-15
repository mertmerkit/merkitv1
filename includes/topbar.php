<nav>
    <div class="topbar d-block position-absolute text-white" style="top:0;right:0;left:0;z-index:99;backdrop-filter:blur(5px);background: linear-gradient(180deg, rgba(1,2,3,1) 0%, rgba(1,2,3,0.5) 75%, rgba(1,2,3,0.25) 100%);">
        <div class="topbar-content d-flex justify-content-between align-items-center mx-5 py-3" style="height:60px">
            <div class="w-100 left  justify-content-start align-items-center">
                <a href="#" onclick="openNav()">
                    <i class="fs-4 fa fa-bars" aria-hidden="true"></i>
                </a>
            </div>


            <div class="w-100 left-desktop d-flex align-items-center gap-4" style="font-size:0.975rem">
                <a href="/" class="">Ana Sayfa</a>
                <a href="/listem" class="">Listem</a>
                <a href="https://discord.gg/https://discord.gg/fPzhzc9UdB" class="">Discord</a>
                <?php if(!isset($_SESSION['username'])){ ?><a href="/login" class="">Giriş Yap</a> <?php } else{ echo '<a href="/logout.php" class=""> Çıkış Yap </a>'; } ?>
            </div>


            <a href="/" class="center d-flex justify-content-center align-items-center" style="width:75px">
                <img style='width:50px;height:50px;object-fit:cover' src="/assets/images/logo.png" alt="Logo">
            </a>


        </div>
    </div>
</nav>

<div id="sepetSearch" class="sepetSearch text-white bg-black position-absolute end-0 start-0 p-2" style="display:none;z-index:99;margin-top:60px">
    <div class="d-flex">
        <input type="search" id="form1" class="form-control w-100" style="border-radius: 15px 0 0 15px" />
        <button type="button" class="btn btn-primary" style="border-radius:0 15px 15px 0" data-mdb-ripple-init onclick="search()"> 
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>

<style>


/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

<div id="sepetSidenav" class="sidenav">
    <a href="javascript:void(0)" class="fs-1 closebtn" onclick="closeNav()">&times;</a>
    
    <div class="sidenav-content">
        <a href="/">Ana Sayfa</a>
        <a href="/listem" class='noborder'>Listem</a>
        <div class="divider"></div>
        <div class="divider"></div>
        <?php if(!isset($_SESSION['username'])){ ?>
            <a href="/login">Giriş Yap</a>
            <a href="/register" class='noborder'>Kayıt Ol</a>
        <?php }else{ echo '<a href="#">'.$_SESSION['username'].'</a> <a href="/logout">Çıkış Yap</a>';} ?>

        <a href="#">
            <div class="adultContentToggle rounded text-nowrap px-2 py-1"  style="color:rgb(181, 181, 181);cursor:pointer;border:1px solid gray; font-size:12px">
                    Yetişkin İçerik
            </div>
        </a>

    </div>

</div>

<script>
	function openNav() {
  document.getElementById("sepetSidenav").style.width = "250px";
}
function closeNav() {
  document.getElementById("sepetSidenav").style.width = "0";
}
function openSearch() {
  document.getElementById("sepetSearch").style.display = "block";
  document.getElementById("closeSearch").style.display = "block";
  document.getElementById("buttonSearch").style.display = "none";
}

function closeSearch() {
    document.getElementById("sepetSearch").style.display = "none";
    document.getElementById("closeSearch").style.display = "none";
    document.getElementById("buttonSearch").style.display = "block";

}
function search() {
        var inputVal = document.getElementById('form1').value;
        var searchUrl = 'http://onigirimanga.com/search?p=' + inputVal;
        window.location.href = searchUrl;
}

function searchDesktop() {
        var inputVal = document.getElementById('searchQueryInput').value;
        var searchUrl = 'http://onigirimanga.com/search?p=' + inputVal;
        window.location.href = searchUrl;
}



// adult content


document.addEventListener('DOMContentLoaded', (event) => {
    const toggleButtons = document.querySelectorAll('.adultContentToggle');
    const adultDivs = document.querySelectorAll('.adult');

    // Load preference from Local Storage
    const storedDisplayPreference = localStorage.getItem('adultContentDisplay');
    if (storedDisplayPreference) {
        setAdultContentDisplay(storedDisplayPreference);
    }

    const storedBgPreference = localStorage.getItem('adultContentBg');
    if (storedBgPreference) {
        setAdultContentBg(storedBgPreference);
    }

    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const currentDisplay = adultDivs[0].style.display;
            const newDisplay = currentDisplay === 'block' ? 'none' : 'block';
            setAdultContentDisplay(newDisplay);
            localStorage.setItem('adultContentDisplay', newDisplay);

            const currentBg = button.style.color;
            const newBg = currentBg === 'rgb(255, 255, 255)' ? 'rgb(181, 181, 181)' : 'rgb(255, 255, 255)';
            setAdultContentBg(newBg);
            localStorage.setItem('adultContentBg', newBg);
        });
    });

    function setAdultContentDisplay(display) {
        adultDivs.forEach(div => {
            div.style.display = display;
        });
    }

    function setAdultContentBg(bg) {
        toggleButtons.forEach(button => {
            button.style.color = bg;
        });
    }
});


</script>