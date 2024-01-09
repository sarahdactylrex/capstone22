<?php
require_once 'include/header.php';
?>

<html>
<head>
<style>
div.gallery {
  border: 2px solid #ccc;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 24.99999%;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
</style>
</head>
<body>

<h2>Gallery</h2>
<h5>Clicked images will pop up in new window.</h5>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/orange_lily.jpg">
      <img src="include/images/orange_lily.jpg" alt="Orange Lily" width="600" height="400">
    </a>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/ferris.jpg">
      <img src="include/images/ferris.jpg" alt="Wheel" width="600" height="400">
    </a>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/abandonded.jpg">
      <img src="include/images/abandonded.jpg" alt="Abandonded" width="600" height="400">
    </a>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/clingmans.jpg">
      <img src="include/images/clingmans.jpg" alt="Clingmans" width="600" height="400">
    </a>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/beach.jpg">
      <img src="include/images/beach.jpg" alt="Beach" width="600" height="400">
    </a>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/maple.jpg">
      <img src="include/images/maple.jpg" alt="Maple" width="600" height="400">
    </a>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/lily.jpg">
      <img src="include/images/lily.jpg" alt="Lily" width="600" height="400">
    </a>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/sunrise.jpg">
      <img src="include/images/sunrise.jpg" alt="Sunrise" width="600" height="400">
    </a>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/city.jpg">
      <img src="include/images/city.jpg" alt="City" width="600" height="400">
    </a>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="include/images/bridge.jpg">
      <img src="include/images/bridge.jpg" alt="Bridge" width="600" height="400">
    </a>
  </div>
</div>


<div class="clearfix"></div>

</body>
</html>

<?php require_once 'include/footer.php' ?>