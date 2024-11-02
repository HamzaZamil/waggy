<?php
include './header.php';
require_once '../includes/autoload.php'; // Autoloader for controllers

$product_id = $_GET['product_id'] ?? null;
$productController = new ProductController();
$category_id = $productController->getCategory($product_id);

// Fetch related products
$relatedProducts = $productController->getRelatedProducts($category_id, $product_id);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_img = isset($_POST['img']) ? htmlspecialchars($_POST['img']) : '';
    $product_name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $product_description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    $product_price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';
}
?>

<!-- Details Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="<?= $product_img ?>" alt="product" style="border-radius:15px;" />
            </div>
            <div class="col-md-6" style="box-shadow:0 3px 5px rgba(0, 0, 0, 0.125); padding:30px; border-radius:20px;">
                <h1 class="display-5 fw-bolder"><?= $product_name ?></h1>
                <div class="fs-5 mb-4">
                    <span style="color: #dfb074;"><?= $product_price ?></span>
                </div>
                <p class="lead"><?= $product_description ?></p>

                <div style="display:flex; flex-direction:column;justify-content:center;align-items:center;">
                    <!-- Quantity Selector Layout -->
                    <div class="d-inline-flex quantity-selector text-center border border-secondary rounded" style="width: fit-content;">
                        <button class="btn btn-outline-secondary" id="decrementBtn" type="button">-</button>
                        <input class="form-control text-center" id="inputQuantity" type="quantity" value="1" min="1" style="width: 50px; border: none; text-align: center;" readonly />
                        <button class="btn btn-outline-secondary" id="incrementBtn" type="button">+</button>
                    </div>

                    <!-- Add to Cart Form -->
                    <form id="addToCartForm" method="post">
                        <button class="btn btn-outline-dark mt-3" type="submit" name="add_to_cart" style="width:400px;">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
<section class="py-2 bg-light" style="margin-bottom:-50px;">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($relatedProducts as $relatedProduct): ?>
                <div class="col mb-5">
                    <div class="card1 card h-100 position-relative">
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= $relatedProduct['product_img'] ?>" alt="<?= $relatedProduct['product_name'] ?>" />

                        <!-- Product details-->
                        <div class="card-body p-4 text-center">
                            <h5 class="fw-bolder"><?= $relatedProduct['product_name'] ?></h5>
                            <p class="mb-0"><?= $relatedProduct['product_price'] ?> JOD</p>
                        </div>

                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 bg-transparent">
                            <form method="post" action="item_details.php?product_id=<?= $relatedProduct['product_id'] ?>">
                                <input type="hidden" name="img" value="<?= htmlspecialchars($relatedProduct['product_img']) ?>">
                                <input type="hidden" name="name" value="<?= htmlspecialchars($relatedProduct['product_name']) ?>">
                                <input type="hidden" name="description" value="<?= htmlspecialchars($relatedProduct['product_description']) ?>">
                                <input type="hidden" name="price" value="<?= htmlspecialchars($relatedProduct['product_price'] . ' JOD') ?>">
                                <button type="submit" name="view">View</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    // Quantity controls
    const quantityInput = document.getElementById('inputQuantity');
    const incrementBtn = document.getElementById('incrementBtn');
    const decrementBtn = document.getElementById('decrementBtn');

    incrementBtn.addEventListener('click', function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    decrementBtn.addEventListener('click', function() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });

    // AJAX "Add to Cart" action
    document.getElementById('addToCartForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting normally

        <?php if (!isset($_SESSION['user_id'])): ?>
            // Show login alert if the user is not logged in
            Swal.fire({
                icon: 'warning',
                title: 'You must log in to add items to the cart',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php'; // Redirect to login
                }
            });
        <?php else: ?>
            // User is logged in, proceed with AJAX request
            const formData = new FormData();
            formData.append('product_id', <?= json_encode($product_id) ?>);
            formData.append('quantity', quantityInput.value);

            fetch('../controllers/add_to_cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Product added to cart successfully',
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to add product to cart',
                            text: data.message || 'An error occurred'
                        });
                    }
                })
                .catch(error => console.error('Error:', error));

        <?php endif; ?>
    });
</script>

<?php include './footer.php'; ?>