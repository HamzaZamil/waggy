<?php
include 'header.php';
include '../controllers/productController.php';

$categories = [];
$products = [];

$productController = new ProductController();
$productController->shop($categories, $products);

$pet_clothing_id = null;
$cat_food_id = null;
$dog_food_id = null;
$cat_toys_tools_id = null;
$dog_toys_tools_id = null;

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
                                <a href="single-product.html"><img src="<?= $product_item["product_img"] ?>" class="img-fluid rounded-4" alt="image"></a>
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
                                            <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                                <h5 class="text-uppercase m-0">Add to Cart</h5>
                                            </a>
                                            <a href="#" class="btn-wishlist px-4 pt-3 ">
                                                <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
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
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
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
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
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
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
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
                                        <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </a>
                                        <a href="#" class="btn-wishlist px-4 pt-3">
                                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
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

<?php include 'footer.php'; ?>