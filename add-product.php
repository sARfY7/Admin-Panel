<?php include('includes/common-head.php'); ?>
    <title>Add Product</title>
  </head>
  <body>
    <?php include('includes/nav.php'); ?>
    <div class="wrapper">
        <div class="heading">Add Product</div>
        <div class="product">
            <form action="addProduct.php" method="POST">
                <div class="product__image">
                    <div class="product__preview">
                    </div>
                    <div class="product__overlay">
                        <input id="product_image" type="file" name="product_image" multiple accept="image/*">
                    </div>
                </div>
                <div class="product__desc">
                    <div class="product__name">
                        <input type="text" name="product_name" placeholder="Enter Product Name">
                    </div>
                    <div class="product__price">
                        <input type="text" name="product_price" placeholder="Enter Product Price">
                    </div>
                    <div class="product__add">
                        <input type="submit" value="Add Product">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- <script src="js/main.js"></script> -->
    <script src="js/add-product.js"></script>
  </body>
</html>
