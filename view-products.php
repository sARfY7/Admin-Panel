<?php
  require("dbConnection.php");
  // require("isAuth.php");
  $select_products = $pdo->query("SELECT * FROM products");
  $products = $select_products->fetchAll();
?>
<?php include('includes/common-head.php'); ?>
    <title>View Products</title>
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
  </head>
  <body>
    <?php include('includes/nav.php'); ?>
    <div class="wrapper">
        <div class="heading">View Products</div>
        <div class="products-container">
          <?php foreach ($products as $product) { ?>
          <div class="product-box">
            <div class="product-box__image">
                <div class="product-box__image-slider owl-carousel owl-theme">
                  <?php 
                    $select_product_images = $pdo->prepare("SELECT image_name FROM images WHERE product_id = ?");
                    $select_product_images->execute([$product["id"]]);
                    $images = $select_product_images->fetchAll(); 
                    foreach($images as $image) {
                  ?>
                    <div> <img src="uploads/<?php echo $image["image_name"] ?>" alt=""> </div>
                  <?php } ?>
                  </div>
              <!-- <img src="img/product-img.jpg" alt=""> -->
            </div>
            <div class="product-box__desc">
              <div class="product-box__name"><?php echo $product["name"] ?></div>
              <div class="product-box__price">
                <div class="product-box__currency">&#8377;</div>
                <div class="product-box__amount"><?php echo $product["price"] ?></div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
    </div>

    <!-- <script src="js/main.js"></script> -->
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/view-products.js"></script>
  </body>
</html>
