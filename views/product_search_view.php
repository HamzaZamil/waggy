<?php
ob_start();

include_once './header.php';
include_once '../controllers/productController.php';
include_once '../controllers/wishlistController.php';


$productController = new ProductController();
$products = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['find']) && !empty(trim($_GET['find']))) {
    $products = $productController->search();
} else {
    $productController->shop($categories, $products);
}

$searchTerm = isset($_GET['find']) ? htmlspecialchars($_GET['find']) : '';
?>


<style>
    .no-results-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 400px;
        text-align: center;
        background-color: rgba(209, 190, 170, 0.5);
        padding: 20px;
        border-radius: 10px;
    }


    .no-results-message h5 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .no-results-message p {
        font-size: 1rem;
        color: #777;
    }

    #search-form {
        display: flex;
        width: 100%;
    }


    @media (max-width: 767px) {
        #search-form {
            display: none;
            margin-top: 5px;
        }


        #search-bar.active #search-form {
            display: flex;
            z-index: 100;
        }


        #search-input {
            width: auto;
            max-width: 200px;
        }

        .search {
            width: auto;
            max-width: 200px;
            margin-left: 25px;
        }
    }
</style>


<!-- search -->
<section id="search-bar" class="mt-5 pt-5">
    <div class="container ">
        <div class="section-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="display-5 fw-normal">Products</h2>
            <div class="input-group h-25" style="width:300px;">
                <form class="d-flex w-100 search" role="search" method="get"
                    action="product_search_view.php?action=search">
                    <input class="form-control w-100" type="search" name="find" placeholder="Search" aria-label="Search"
                        value="<?= $searchTerm ?>">



                </form>
            </div>
        </div>
    </div>
</section>

<!-- result -->
<?php if (!empty($products)): ?>
<div class="container my-1 py-1 " id="clothing">
    <div class="isotope-container row">

        <?php foreach ($products as $product_item): ?>
        <div class="item col-md-4 col-lg-3 my-4">
            <div class="card position-relative" style="border-radius:15px;">
                <img src="../inserted_img/<?= $product_item['product_img'] ?>" class="img-fluid rounded-4" alt="image">
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
        <div class="col-12 text-center">
            <img src="../images/noproduct2.png" alt="No Products Found" style="height:300px">
            <div class="no-results-message">
                <h5 class="display-5 fw-normal">No Products Found</h5>
                <p class="display-5">Sorry, we couldn't find products matching your search.</p>

            </div>

        </div>
        <?php endif; ?>

    </div>
</div>


<?php include './footer.php'; ?>