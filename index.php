<?php require('./settings.php') ?>
<title>Merkitv1 - Türkçe Mangalar</title>

<?php include('./includes/header.php') ?>
<?php include('./includes/discord.php') ?>
<link rel="stylesheet" href="/assets/css/swiper-bundle.min.css"/>
<link rel="stylesheet" href="/assets/css/owl-carousel.min.css"/>
<?php include('./includes/topbar.php') ?>
<div class="mobile-topbar-fix"></div>
<?php include('./includes/slider.php') ?>



<?php

?>

<div class="page-content">
<?php include('./includes/mobile-slider.php') ?>
<div class="d-flex gap-4">
  <div class="d-flex flex-column w-100 gap-4" >
    <?php include('./includes/recommend.php') ?> 
    <?php include('./includes/lastest.php') ?>
  </div>
  <div class="trendscontainer" style="max-width:400px"><?php include('./includes/trends.php') ?></div>
</div>


</div>








<script src="/assets/js/swiper-bundle.min.js"></script>
<?php include('./includes/footer.php') ?>
<script src="/assets/js/owl-carousel.min.js" ></script>

<script>
     $(document).ready(function () {
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var slidesPerPage = 4; //globaly define number of elements per page
    var syncedSecondary = true;
  
    sync1
      .owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: false,
        touch: false,
        dots: false,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplaySpeed: 1000,
        autoplayHoverPause: true,
  
        navText: [
          '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
          '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
        ]
      })
      .on("changed.owl.carousel", syncPosition);
  
    sync2
      .on("initialized.owl.carousel", function () {
        sync2.find(".owl-item").eq(0).addClass("current");
      })
      .owlCarousel({
        items: slidesPerPage,
        dots: false,
        nav: false,
        smartSpeed: 200,
        slideSpeed: 500,
        slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
        responsiveRefreshRate: 100
      })
      .on("changed.owl.carousel", syncPosition2);
  
    function syncPosition(el) {
      //if you set loop to false, you have to restore this next line
      //var current = el.item.index;
  
      //if you disable loop you have to comment this block
      var count = el.item.count - 1;
      var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
  
      if (current < 0) {
        current = count;
      }
      if (current > count) {
        current = 0;
      }
  
      //end block
  
      sync2
        .find(".owl-item")
        .removeClass("current")
        .eq(current)
        .addClass("current");
      var onscreen = sync2.find(".owl-item.active").length - 1;
      var start = sync2.find(".owl-item.active").first().index();
      var end = sync2.find(".owl-item.active").last().index();
  
      if (current > end) {
        sync2.data("owl.carousel").to(current, 100, true);
      }
      if (current < start) {
        sync2.data("owl.carousel").to(current - onscreen, 100, true);
      }
    }
  
    function syncPosition2(el) {
      if (syncedSecondary) {
        var number = el.item.index;
        sync1.data("owl.carousel").to(number, 100, true);
      }
    }
  
    sync2.on("click", ".owl-item", function (e) {
      e.preventDefault();
      var number = $(this).index();
      sync1.data("owl.carousel").to(number, 300, true);
    });
  });
  
</script>