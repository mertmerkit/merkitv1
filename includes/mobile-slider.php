
<link rel="stylesheet" href="/assets/css/owl-carousel.min.css" />
<style>
     
#sync1 
  .item {
    display: flex;
    align-items: center;
    text-align: center;
    height: 280px;
    margin: 5px 5px 0 5px;
    color: #fff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    text-align: center;
    overflow: hidden;
  }
  .item img {
    filter: brightness(0.55);
    object-fit: cover;
    width: 100%;
    height: 100%;
  }

#sync2 
  .item {
    overflow: hidden;
    background: #c9c9c9;
    margin: auto;
    display: flex;
    align-items: center;
    text-align: center;
    object-fit: cover;
    height: 60px;
    margin: 5px 2%;
    color: #fff;
    overflow: hidden;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    filter: brightness(0.325);
    cursor: pointer;
  }
  .item img {
    filter: brightness(0.55);
    object-fit: cover;
    width: 100%;
    height: 100%;
  }

  .current .item {
    filter: brightness(0.95) !important;
  }

.item {
  overflow: hidden;
}
.item img {
  transition: 0.25s;
}
.item img:hover {
  scale: 1.1;
  transition: 0.25s;
  cursor: pointer;
}
.item .item_info {
  width: 100%;
  height: 77.5px;
  position: absolute;
  overflow: hidden;
  right: 0;
  left: 0;
  bottom: 10px;
  margin: 0;
  text-shadow: 0px 0px 15px black;

  z-index: 5;
}
.item .item_info h4 {
  font-size: 1.3rem;
  width: 88%;
  text-overflow: ellipsis;
  color: white;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-align: left;
  padding-left: 10px;
  line-height: 27px;
  font-weight: 600;
  margin: 0;
  z-index: 5;
}
.item .item_info p {
  font-size: 0.95rem;
  line-height: 19px;
  margin-top: 5px;
  text-align: left;
  padding-left: 10px;
  width: 80%;
  z-index: 5;
  text-overflow: ellipsis;
  color: rgb(200, 200, 200);
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.item img {
  height: 100%;
  width: 100%;
  object-fit: cover;
}
.image_back {
  background: linear-gradient(
    0deg,
    rgba(0, 0, 0, 0.8547794117647058) 0%,
    rgba(0, 0, 0, 0.6979166666666667) 25%,
    rgba(0, 0, 0, 0.35057773109243695) 50%,
    rgba(0, 0, 0, 0) 75%,
    rgba(0, 0, 0, 0) 100%
  ) !important;
  position: absolute;
  z-index: 3;
  width: calc(100% - 10px);
  height: calc(100% - 5px);
}
.image_back_fix {
  position: absolute;
  z-index: 1;
  width: calc(100% - 10px);
  height: calc(100% - 5px);
  overflow: hidden;
  border-radius: 5px;

  background-image: url(https://svgshare.com/i/tMr.svg);
  background-size: 3px;
}
.slider_main {
  width: 100%;
  max-width: 1000px;
  margin: auto;
  border-radius:5px;
}


</style>

<div style="height:355px;display:none" class="slider_main slider-mobile" >



<div id="sync1"  class="owl-carousel owl-theme">

    <?php 
     $query = "SELECT title,adult, slug, hash, cover,description,slider_image,created_at FROM manga 
     WHERE status = 'published' AND slider_image IS NOT NULL AND slider_image <> '' 
     ORDER BY views LIMIT 4";
     $result = mysqli_query($connection, $query);
     while ($row = mysqli_fetch_array($result)) {
          $title = $row['title'];
          $cover = $row['cover'];
          $hash = $row['hash'];
          $slider_image = $row['slider_image'];
          $slug = $row['slug'];
          $description = $row['description'];
          $adult = $row['adult'];

          $mini = array();

          $mini['image'] = '/admin/uploads/'.$hash.'/cover/'.$cover;
    ?> 

    <a href="/manga/<?php echo $slug; ?>" class="<?php if($adult == 1){echo 'adult';} ?> item">

      <img src="<?php echo '/admin/uploads/'.$hash.'/cover/'.$slider_image; ?>" title="<?php echo $cover; ?>" alt="<?php echo $title; ?> Banner">

      <div class="item_info">

        <h4><?php echo $title; ?> </h4>

        <p> <?php echo $description; ?>  </p>

      </div>

      <div class="image_back"></div>

      <div class="image_back_fix"></div>

    </a>

    <?php } ?>



</div>




<div id="sync2" class="owl-carousel owl-theme">
  <?php 
     $query = "SELECT title,adult, slug, hash, cover,description,slider_image,created_at FROM manga 
     WHERE status = 'published' AND slider_image IS NOT NULL AND slider_image <> '' 
     ORDER BY views LIMIT 4";
     $result = mysqli_query($connection, $query);
     while ($row = mysqli_fetch_array($result)) {
          $title = $row['title'];
          $cover = $row['cover'];
          $hash = $row['hash'];
          $adult = $row['adult'];
    ?>

  <div class="item <?php if($adult == 1){echo 'adult';} ?>">

    <img src="<?php echo '/admin/uploads/'.$hash.'/cover/'.$cover; ?>" title="<?php echo $title; ?> mini" alt="<?php echo $title; ?> mini banner">

  </div>

  <?php } ?>



</div>



</div>


