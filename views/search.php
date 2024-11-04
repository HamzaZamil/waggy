<?php


include 'header.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  
</head>

<body>
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Search Result</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php if (!empty($searchResults)) { 
                    foreach ($searchResults as $product_item) { ?>
                    <div class="swiper-slide">
                        <div class="card position-relative">
                            <a href="javascript:void(0);" onclick="showProductDetails(
                                    '<?= htmlspecialchars($product_item['product_img']) ?>',
                                    '<?= htmlspecialchars($product_item['product_name']) ?>',
                                    '<?= htmlspecialchars($product_item['product_description']) ?>',
                                    '<?= htmlspecialchars($product_item['product_price']) ?> JOD'
                                )">
                                <img src="<?= htmlspecialchars($product_item['product_img']) ?>" class="img-fluid rounded-4" alt="image">
                            </a>
                            <div class="card-body p-0">
                                <a href="javascript:void(0);" onclick="showProductDetails(
                                        '<?= htmlspecialchars($product_item['product_img']) ?>',
                                        '<?= htmlspecialchars($product_item['product_name']) ?>',
                                        '<?= htmlspecialchars($product_item['product_description']) ?>',
                                        '<?= htmlspecialchars($product_item['product_price']) ?> JOD'
                                    )">
                                    <h3 class="card-title pt-4 m-0"><?= htmlspecialchars($product_item['product_name']) ?></h3>
                                </a>

                                <div class="card-text">
                                    <span class="rating secondary-font">
                                        <?php
                                            $stars_num = mt_rand(2, 5);
                                            for ($i = 1; $i <= $stars_num; $i++) {
                                                echo '<iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>';
                                            }
                                            echo $stars_num . ".0";
                                        ?>
                                    </span>

                                    <h3 class="secondary-font text-primary"><?= htmlspecialchars($product_item['product_price']) ?> JOD</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <!-- Add to Cart Button as a form submission -->
                                        <form method="POST" action="path_to_your_add_to_cart_logic.php">
                                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_item['product_id']) ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="action" value="add_to_cart">
                                            <button type="submit" class="btn-cart me-3 px-4 pt-3 pb-3" style="border: 1px solid lightgrey; border-radius:6px; background: none;">
                                                <h5 class="text-uppercase m-0">Add to Cart</h5>
                                            </button>
                                        </form>
                                        <a href="#" class="btn-wishlist px-4 pt-3">
                                            <form method="POST" action="../controllers/WishlistController.php" style="display: inline;">
                                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_item['product_id']) ?>">
                                                <input type="hidden" name="action" value="<?= $wishlistController->isInWishlist($product_item['product_id']) ? 'remove' : 'add' ?>">
                                                <button type="submit" style="border: none; background: none;">
                                                    <iconify-icon icon="<?= $wishlistController->isInWishlist($product_item['product_id']) ? 'mdi:heart' : 'mdi:heart-outline' ?>" class="fs-5"></iconify-icon>
                                                </button>
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } 
                } else {
                    echo '<p>No products found.</p>'; 
                } 
                ?>
            </div>
        </div>
    </section>
</body>
</html>
<?php include 'footer.php'; ?>