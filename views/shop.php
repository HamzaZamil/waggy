<?php
ob_start();

include 'header.php';
include '../controllers/productController.php';
include '../controllers/wishlistController.php';
include '../controllers/cartController.php';

$categories = [];
$products = [];
$wishlistItems = [];

$productController = new ProductController();
$productController->shop($categories, $products);

$wishlistController = new WishlistController();
$wishlistItems = $wishlistController->getWishlistItemsForDisplay();

$cartController = new CartController();

$pet_clothing_id = $cat_food_id = $dog_food_id = $cat_toys_tools_id = $dog_toys_tools_id =  null;

foreach ($categories as $category) {
    switch ($category['category_name']) {
        case 'pet_clothing':
            $pet_clothing_id = $category["category_id"];
            break;
        case 'cats_food':
            $cat_food_id = $category["category_id"];
            break;
        case 'dogs_food':
            $dog_food_id = $category["category_id"];
            break;
        case 'cats_toys_tools':
            $cat_toys_tools_id = $category["category_id"];
            break;
        case 'dogs_toys_tools':
            $dog_toys_tools_id = $category["category_id"];
            break;
    }
}

// Handle the Add to Cart action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'] ?? 1; // Default quantity to 1 if not provided
    $cartController->addToCart($productId, $quantity);
}
?>

<!-- Clothing Section -->
<section id="clothing" class="my-5 overflow-hidden">
    <div class="container pb-5">
        <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
            <h2 class="display-3 fw-normal">Pet Clothing</h2>
        </div>

        <div class="products-carousel swiper">
            <div class="swiper-wrapper">
                <?php
                foreach ($products as $product_item) {
                    if ($product_item["category_id"] == $pet_clothing_id) {
                ?>
                        <div class="swiper-slide">
                            <div class="card position-relative">
                                <a href="javascript:void(0);" onclick="showProductDetails(
                                    '<?= $product_item["product_img"] ?>',
                                    '<?= htmlspecialchars($product_item["product_name"]) ?>',
                                    '<?= htmlspecialchars($product_item["product_description"]) ?>',
                                    '<?= $product_item["product_price"] ?> JOD'
                                )">
                                    <img src="<?= $product_item["product_img"] ?>" class="img-fluid rounded-4" alt="image">
                                </a>
                                <div class="card-body p-0">
                                    <a href="javascript:void(0);" onclick="showProductDetails(
                                        '<?= $product_item["product_img"] ?>',
                                        '<?= htmlspecialchars($product_item["product_name"]) ?>',
                                        '<?= htmlspecialchars($product_item["product_description"]) ?>',
                                        '<?= $product_item["product_price"] ?> JOD'
                                    )">
                                        <h3 class="card-title pt-4 m-0"><?= $product_item["product_name"] ?></h3>
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

                                        <h3 class="secondary-font text-primary"><?= $product_item["product_price"] ?> JOD</h3>

                                        <div class="d-flex flex-wrap mt-3">
                                            <!-- Add to Cart Button as a form submission -->
                                            <form method="POST" action="">
                                                <input type="hidden" name="product_id" value="<?= $product_item["product_id"] ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="action" value="add_to_cart">
                                                <button type="submit" class="btn-cart me-3 px-4 pt-3 pb-3" style="border: 1px solid lightgrey; border-radius:6px; background: none;">
                                                    <h5 class="text-uppercase m-0">Add to Cart</h5>
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
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Food Section -->
<section id="foodies" class="my-5">
    <div class="container my-5 py-5">
        <div class="section-header d-md-flex justify-content-between align-items-center">
            <h2 class="display-3 fw-normal">Pet Foodies</h2>
            <div class="mb-4 mb-md-0">
                <p class="m-0">
                    <button class="filter-button me-4 active" data-filter="*">ALL</button>
                    <button class="filter-button me-4" data-filter=".dog">DOG</button>
                    <button class="filter-button me-4" data-filter=".cat">CAT</button>
                </p>
            </div>
        </div>

        <div class="isotope-container row">
            <?php
            foreach ($products as $product_item) {
                if ($product_item["category_id"] == $dog_food_id) {
            ?>
                    <div class="item dog col-md-4 col-lg-3 my-4">
                        <div class="card position-relative">
                            <a href="single-product.html"><img src='<?= $product_item["product_img"] ?>' class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0"><?= $product_item["product_name"] ?></h3>
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

                                    <h3 class="secondary-font text-primary"><?= $product_item["product_price"] ?> JOD</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <form method="POST" action="">
                                            <input type="hidden" name="product_id" value="<?= $product_item["product_id"] ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="action" value="add_to_cart">
                                            <button type="submit" class="btn-cart me-3 px-4 pt-3 pb-3" style="border: 1px solid lightgrey; border-radius:6px; background: none;">
                                                <h5 class="text-uppercase m-0">Add to Cart</h5>
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
            <?php
                }
            }
            ?>

            <?php
            foreach ($products as $product_item) {
                if ($product_item["category_id"] == $cat_food_id) {
            ?>
                    <div class="item cat col-md-4 col-lg-3 my-4">
                        <div class="card position-relative">
                            <a href="single-product.html"><img src='<?= $product_item["product_img"] ?>' class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0"><?= $product_item["product_name"] ?></h3>
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

                                    <h3 class="secondary-font text-primary"><?= $product_item["product_price"] ?> JOD</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <form method="POST" action="">
                                            <input type="hidden" name="product_id" value="<?= $product_item["product_id"] ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="action" value="add_to_cart">
                                            <button type="submit" class="btn-cart me-3 px-4 pt-3 pb-3" style="border: 1px solid lightgrey; border-radius:6px; background: none;">
                                                <h5 class="text-uppercase m-0">Add to Cart</h5>
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
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Toys and Tools Section -->
<section id="toys-tools" class="my-5">
    <div class="container my-5 py-5">
        <div class="section-header d-md-flex justify-content-between align-items-center">
            <h2 class="display-3 fw-normal">Pet Toys & Tools</h2>
            <div class="mb-4 mb-md-0">
                <p class="m-0">
                    <button class="filter-button me-4 active" data-filter="*">ALL</button>
                    <button class="filter-button me-4" data-filter=".dog">DOG</button>
                    <button class="filter-button me-4" data-filter=".cat">CAT</button>
                </p>
            </div>
        </div>

        <div class="isotope-container row">
            <?php
            foreach ($products as $product_item) {
                if ($product_item["category_id"] == $dog_toys_tools_id) {
            ?>
                    <div class="item dog col-md-4 col-lg-3 my-4">
                        <div class="card position-relative">
                            <a href="single-product.html"><img src='<?= $product_item["product_img"] ?>' class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0"><?= $product_item["product_name"] ?></h3>
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

                                    <h3 class="secondary-font text-primary"><?= $product_item["product_price"] ?> JOD</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <form method="POST" action="">
                                            <input type="hidden" name="product_id" value="<?= $product_item["product_id"] ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="action" value="add_to_cart">
                                            <button type="submit" class="btn-cart me-3 px-4 pt-3 pb-3" style="border: 1px solid lightgrey; border-radius:6px; background: none;">
                                                <h5 class="text-uppercase m-0">Add to Cart</h5>
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
            <?php
                }
            }
            ?>

            <?php
            foreach ($products as $product_item) {
                if ($product_item["category_id"] == $cat_toys_tools_id) {
            ?>
                    <div class="item cat col-md-4 col-lg-3 my-4">
                        <div class="card position-relative">
                            <a href="single-product.html"><img src='<?= $product_item["product_img"] ?>' class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body p-0">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0"><?= $product_item["product_name"] ?></h3>
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

                                    <h3 class="secondary-font text-primary"><?= $product_item["product_price"] ?> JOD</h3>

                                    <div class="d-flex flex-wrap mt-3">
                                        <form method="POST" action="">
                                            <input type="hidden" name="product_id" value="<?= $product_item["product_id"] ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="action" value="add_to_cart">
                                            <button type="submit" class="btn-cart me-3 px-4 pt-3 pb-3" style="border: 1px solid lightgrey; border-radius:6px; background: none;">
                                                <h5 class="text-uppercase m-0">Add to Cart</h5>
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
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<script>
function showProductDetails(img, name, description, price) {
    Swal.fire({
        html: `
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <img src="${img}" alt="${name}" style="width: 50%; border-radius: 8px; margin-bottom: 15px;">
                    <h3 style="text-align: center;">${name}</h3>
                </div>
                <div style="text-align: center; max-width: 80%;">
                    <h4>Description:</h4>
                    <p>${description}</p>
                    <h4 class="text-primary">${price}</h4>
                </div>
            </div>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: '50%',
        customClass: {
            popup: 'rounded-sweetalert'
        }
    });
}
</script>


<?php
include 'footer.php';
ob_end_flush();
?>