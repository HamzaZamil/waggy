<?php
ob_start();

include './header.php';
include '../controllers/productController.php';
include '../controllers/wishlistController.php';
$categId = $_GET['categ-id']; 
$categories = [];
$products = [];
$wishlistItems = [];

$productController = new ProductController();
$productController->shop($categories, $products);

$wishlistController = new WishlistController();
$wishlistItems = $wishlistController->getWishlistItemsForDisplay();

$dog_toys_tools_id = 1;
$dog_food_id = 2;
$cat_toys_tools_id = 3;
$cat_food_id = 4;
$cats_clothing_id = 5;
$dogs_clothing_id = 6;
$pet_clothing_ids = [$cats_clothing_id, $dogs_clothing_id]; // Group clothing category IDs
$pet_food_ids = [$cat_food_id, $dog_food_id];
$pet_toys_tools_ids = [$cat_toys_tools_id, $dog_toys_tools_id];
?>


<!-- Clothing Section -->
<section id="clothing" class="my-5">
    <div class="container my-5 py-5">
        <div class="section-header d-md-flex justify-content-between align-items-center">
            <h2 class="display-3 fw-normal">Clothing</h2>
        </div>

        <div class="isotope-container row">
            <?php
            foreach ($products as $product_item) {
                if (
                    ($categId == 1 && in_array($product_item["category_id"], $pet_clothing_ids)) || // All clothing items
                    ($categId == 2 && $product_item["category_id"] == $cats_clothing_id) || // Cat clothing only
                    ($categId == 3 && $product_item["category_id"] == $dogs_clothing_id) // Dog clothing only
                ) {
            ?>
                    <div class="item col-md-4 col-lg-3 my-4">
                        <div class="card position-relative">

                        <img src="../inserted_img/<?=$product_item['product_img']?>" class="img-fluid rounded-4" alt="image">


                            <div class="card-body d-flex flex-column align-items-center">
                                <a href="single-product.html">
                                    <h4 class="card-title pt-4 m-0"><?= $product_item["product_name"] ?></h4>
                                </a>

                                <div class="card-text d-flex flex-column align-items-center">
                                    <h4 class="secondary-font text-primary"><?= $product_item["product_price"] ?> JOD</h4>

                                    <div class="d-flex gap-3 mt-2">
                                        <div class="d-flex gap-3 mt-3">
                                            <form action="item_details.php?product_id=<?= $product_item['product_id'] ?>" method="POST" style="display:inline;">
                                                <input type="hidden" name="img" value="<?= htmlspecialchars($product_item['product_img']) ?>">
                                                <input type="hidden" name="name" value="<?= htmlspecialchars($product_item['product_name']) ?>">
                                                <input type="hidden" name="description" value="<?= htmlspecialchars($product_item['product_description']) ?>">
                                                <input type="hidden" name="price" value="<?= htmlspecialchars($product_item['product_price'] . ' JOD') ?>">
                                                <button type="submit" class="btn-cart px-2 pt-3 pb-3" style="background:none; border:1px solid lightgrey; border-radius:6px;">
                                                    <h5 class="text-uppercase m-0 fs-6">Add to Cart</h5>
                                                </button>
                                            </form>


                                            <a href="#" class="btn-wishlist px-4 pt-3">
                                                <form method="POST" action="../controllers/WishlistController.php" style="display: inline;">
                                                    <input type="hidden" name="product_id" value="<?= $product_item["product_id"] ?>">
                                                    <input type="hidden" name="action" value="<?= $wishlistController->isInWishlist($product_item["product_id"]) ? 'remove' : 'add' ?>">
                                                    <button type="submit" style="border: none; background: none;">
                                                        <iconify-icon icon="<?= $wishlistController->isInWishlist($product_item["product_id"]) ? 'mdi:heart' : 'mdi:heart-outline' ?>" class="fs-5"></iconify-icon>
                                                    </button>
                                                </form>
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>



<!-- Foodies Section -->
<section id="foodies" class="my-5">
    <div class="container my-5 py-5">
        <div class="section-header d-md-flex justify-content-between align-items-center">
            <h2 class="display-3 fw-normal">Foodies</h2>
        </div>

        <div class="isotope-container row">
            <?php
            foreach ($products as $product_item) {
                if (
                    ($categId == 1 && in_array($product_item["category_id"], $pet_food_ids)) || // All clothing items
                    ($categId == 2 && $product_item["category_id"] == $cat_food_id) || // Cat clothing only
                    ($categId == 3 && $product_item["category_id"] == $dog_food_id) // Dog clothing only
                ) {
            ?>
                    <div class="item col-md-4 col-lg-3 my-4">
                        <div class="card position-relative">
                        <img src="../inserted_img/<?=$product_item['product_img']?>" class="img-fluid rounded-4" alt="image">
                            <div class="card-body d-flex flex-column align-items-center">
                                <a href="single-product.html">
                                    <h4 class="card-title pt-4 m-0"><?= $product_item["product_name"] ?></h4>
                                </a>

                                <div class="card-text d-flex flex-column align-items-center">
                                    <h4 class="secondary-font text-primary"><?= $product_item["product_price"] ?> JOD</h4>

                                    <div class="d-flex gap-3 mt-2">
                                        <div class="d-flex gap-3 mt-3">
                                            <form action="item_details.php?product_id=<?= $product_item['product_id'] ?>" method="POST" style="display:inline;">
                                                <input type="hidden" name="img" value="<?= htmlspecialchars($product_item['product_img']) ?>">
                                                <input type="hidden" name="name" value="<?= htmlspecialchars($product_item['product_name']) ?>">
                                                <input type="hidden" name="description" value="<?= htmlspecialchars($product_item['product_description']) ?>">
                                                <input type="hidden" name="price" value="<?= htmlspecialchars($product_item['product_price'] . ' JOD') ?>">
                                                <button type="submit" class="btn-cart px-2 pt-3 pb-3" style="background:none; border:1px solid lightgrey; border-radius:6px;">
                                                    <h5 class="text-uppercase m-0 fs-6"></h5>
                                                </button>
                                            </form>


                                            <a href="#" class="btn-wishlist px-4 pt-3">
                                                <form method="POST" action="../controllers/WishlistController.php" style="display: inline;">
                                                    <input type="hidden" name="product_id" value="<?= $product_item["product_id"] ?>">
                                                    <input type="hidden" name="action" value="<?= $wishlistController->isInWishlist($product_item["product_id"]) ? 'remove' : 'add' ?>">
                                                    <button type="submit" style="border: none; background: none;">
                                                        <iconify-icon icon="<?= $wishlistController->isInWishlist($product_item["product_id"]) ? 'mdi:heart' : 'mdi:heart-outline' ?>" class="fs-5"></iconify-icon>
                                                    </button>
                                                </form>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Toys & Tools Section -->
<section id="toys-tools" class="my-5">
    <div class="container my-5 py-5">
        <div class="section-header d-md-flex justify-content-between align-items-center">
            <h2 class="display-3 fw-normal">Toys & Tools</h2>
        </div>

        <div class="isotope-container row">
            <?php
            foreach ($products as $product_item) {
                if (
                    ($categId == 1 && in_array($product_item["category_id"], $pet_toys_tools_ids)) || // All clothing items
                    ($categId == 2 && $product_item["category_id"] == $cat_toys_tools_id) || // Cat clothing only
                    ($categId == 3 && $product_item["category_id"] == $dog_toys_tools_id) // Dog clothing only
                ) {
            ?>
                    <div class="item col-md-4 col-lg-3 my-4">
                        <div class="card position-relative">
                            <img src="../inserted_img/<?=$product_item['product_img']?>" class="img-fluid rounded-4" alt="image">
                            <div class="card-body d-flex flex-column align-items-center ">
                                <a href="single-product.html">
                                    <h4 class="card-title pt-4 m-0"><?= $product_item["product_name"] ?></h4>
                                </a>

                                <div class="card-text d-flex flex-column align-items-center">
                                    <h4 class="secondary-font text-primary"><?= $product_item["product_price"] ?> JOD</h4>

                                    <div class="d-flex gap-3 mt-2">
                                        <div class="d-flex gap-3 mt-3">
                                            <form action="item_details.php?product_id=<?= $product_item['product_id'] ?>" method="POST" style="display:inline;">
                                                <input type="hidden" name="img" value="<?= htmlspecialchars($product_item['product_img']) ?>">
                                                <input type="hidden" name="name" value="<?= htmlspecialchars($product_item['product_name']) ?>">
                                                <input type="hidden" name="description" value="<?= htmlspecialchars($product_item['product_description']) ?>">
                                                <input type="hidden" name="price" value="<?= htmlspecialchars($product_item['product_price'] . ' JOD') ?>">
                                                <button type="submit" class="btn-cart px-2 pt-3 pb-3" style="background:none; border:1px solid lightgrey; border-radius:6px;">
                                                    <h5 class="text-uppercase m-0 fs-6">Add to Cart</h5>
                                                </button>
                                            </form>

                                            <a href="#" class="btn-wishlist px-4 pt-3">
                                                <form method="POST" action="../controllers/WishlistController.php" style="display: inline;">
                                                    <input type="hidden" name="product_id" value="<?= $product_item["product_id"] ?>">
                                                    <input type="hidden" name="action" value="<?= $wishlistController->isInWishlist($product_item["product_id"]) ? 'remove' : 'add' ?>">
                                                    <button type="submit" style="border: none; background: none;">
                                                        <iconify-icon icon="<?= $wishlistController->isInWishlist($product_item["product_id"]) ? 'mdi:heart' : 'mdi:heart-outline' ?>" class="fs-5"></iconify-icon>
                                                    </button>
                                                </form>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<?php include './footer.php' ?>