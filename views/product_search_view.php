<?php

// include './header.php';
include_once '../model/product.php'; 
include_once '../controllers/productController.php';

$productController = new ProductController();


if (!isset($products)) {
    $products = []; 
}


?>
<style>
    .no-items-alert {
        border-radius: 15px;
        padding: 20px;
        background-color: #fff3cd;
        /* Light yellow background */
        border: 1px solid #ffeeba;
        /* Light yellow border */
        color: #856404;
        /* Dark yellow text */
    }

    .no-items-alert h5 {
        font-weight: bold;
    }

    .no-items-alert p {
        margin-bottom: 0;
    }
</style>
<div class="container my-5 py-5">

    <div class="isotope-container row">
        <?php if (!empty($products)): ?>
        <?php foreach ($products as $product_item): ?>
        <div class="item col-md-4 col-lg-3 my-4">
            <div class="card position-relative" style="border-radius: 15px">
                <img src='<?= $product_item["product_img"] ?>' class="img-fluid rounded-4" alt="image">
                <div class="card-body d-flex flex-column align-items-center">
                    <a href="single-product.php?product_id=<?= $product_item['product_id'] ?>">
                        <h4 class="card-title pt-4 m-0"><?= $product_item["product_name"] ?></h4>
                    </a>
                    <div class="card-text d-flex flex-column align-items-center">
                        <h4 class="secondary-font text-primary"><?= $product_item["product_price"] ?> JOD</h4>
                        <div class="d-flex gap-3 mt-2">
                            <div class="d-flex gap-3 mt-3">
                                <form action="item_details.php?product_id=<?= $product_item['product_id'] ?>"
                                    method="POST" style="display:inline;">
                                    <input type="hidden" name="img"
                                        value="<?= htmlspecialchars($product_item['product_img']) ?>">
                                    <input type="hidden" name="name"
                                        value="<?= htmlspecialchars($product_item['product_name']) ?>">
                                    <input type="hidden" name="description"
                                        value="<?= htmlspecialchars($product_item['product_description']) ?>">
                                    <input type="hidden" name="price"
                                        value="<?= htmlspecialchars($product_item['product_price'] . ' JOD') ?>">
                                    <button type="submit" class="btn-cart px-2 pt-3 pb-3"
                                        style="background:none; border:1px solid lightgrey; border-radius:6px;">
                                        <h5 class="text-uppercase m-0 fs-6">Add to Cart</h5>
                                    </button>
                                </form>
                                <a href="#" class="btn-wishlist px-4 pt-3">
                                    <form method="POST" action="../controllers/WishlistController.php"
                                        style="display: inline;">
                                        <input type="hidden" name="product_id"
                                            value="<?= $product_item["product_id"] ?>">
                                        <input type="hidden" name="action"
                                            value="<?= $wishlistController->isInWishlist($product_item["product_id"]) ? 'remove' : 'add' ?>">
                                        <button type="submit" style="border: none; background: none;">
                                            <iconify-icon
                                                icon="<?= $wishlistController->isInWishlist($product_item["product_id"]) ? 'mdi:heart' : 'mdi:heart-outline' ?>"
                                                class="fs-5"></iconify-icon>
                                        </button>
                                    </form>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="col-12 text-center my-4">
            <div class="alert alert-warning" style="border-radius: 15px; padding: 20px;">
                <h5 class="alert-heading">No Products Found</h5>
                <p>We couldn’t find any products matching your search criteria.</p>
                <hr>
                <p class="mb-0">Please check your search terms or explore other categories!</p>
            </div>
        </div>
        <?php endif; ?>
    </div>


</div>


<?php include './footer.php' ?>