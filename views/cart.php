<?php
include './header.php';
include '../controllers/cartController.php';

$cartController = new CartController();
$cartItems = $cartController->getCartItems();
$cartItemsNo = $cartController->getCartItemsCount();

$coupons = $cartController->getCoupons();
$address = $cartController->getAddress();
// print_r($coupons);
?>

<div id="cart_page" class="container my-5">
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <!-- Use flex utilities to position elements -->
                    <div class="cart-header row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <div class="items-no-header col-auto text-muted">
                            <?= $cartItemsNo ?> items
                        </div>
                    </div>
                </div>

                <?php
                if (!empty($cartItems)) :
                    foreach ($cartItems as $item) :
                ?>
                        <div class="row border-top border-bottom py-3 cart-item-row" data-product-id="<?= $item['product_id'] ?>">
                            <div class="row main align-items-center justify-content-between">
                                <div class="col-2 text-center">
                                    <img class="img-fluid" src="<?= $item['product_img'] ?>">
                                </div>
                                <div class="col text-center">
                                    <div><?= $item['product_name'] ?></div>
                                </div>
                                <div class="col text-center quantity-container">
                                    <a href="javascript:void(0);" class="decrease-quantity" data-product-id="<?= $item['product_id'] ?>">-</a>
                                    <span class="border px-2 quantity"><?= $item['quantity'] ?></span>
                                    <a href="javascript:void(0);" class="increase-quantity" data-product-id="<?= $item['product_id'] ?>">+</a>
                                </div>
                                <div class="col text-center">
                                    <?= $item['product_price'] ?> JOD
                                </div>
                                <div class="col text-center" style="flex: 0 0 20px; max-width: 20px;">
                                    <span class="close delete-item" data-product-id="<?= $item['product_id'] ?>" style="cursor: pointer;">
                                        <iconify-icon icon="ic:baseline-delete" class="fs-5"></iconify-icon>
                                    </span>
                                </div>
                            </div>
                        </div>

                    <?php
                    endforeach;
                else :
                    ?>
                    <p class="text-center">Your cart is empty.</p>
                <?php endif; ?>


                <a href="./shop2.php?categ-id=1" class="d-block mt-3 text-muted">
                    &leftarrow; Back to shop
                </a>
            </div>

            <!-- Checkout Section -->
            <div class="col-md-4 summary">
                <h5><b>Checkout</b></h5>
                <hr>
                <div class="row">
                    <div class="col text-left">ITEMS: <?= $cartItemsNo ?></div>
                    <div class="totalCart col text-right"> <?= $cartController->totalCart(); ?> JOD</div>
                </div>
                <form method="POST" action="../controllers/couponController.php" style="margin-bottom:-10px;">
                    <p>Shipping Address </p>
                    <input id="address" class="form-control" placeholder="<?= $address ?>" style="margin-top:-20px;">

                    <!-- Coupon Dropdown and Add Coupon Button -->
                    <p>Available Coupons</p>
                    <select name="couponSelect" class="form-control mb-3" style="margin-top:-20px;">
                        <?php
                        if (!empty($coupons)) :
                            foreach ($coupons as $coupon) :
                        ?>
                                <option class="text-muted" value="<?= $coupon['coupon_id'] ?>"><?= $coupon['coupon_name'] ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option class="text-muted">No coupons Available</option>
                        <?php endif; ?>
                    </select>
                    <input type="submit" name="submit_button" value="Add Coupon" style="width:100px;margin-top:-10px;" class="btn btn-primary btn-sm ">
                    <div class="row">
                        <div class="col text-left">Delivery fee :</div>
                        <div class="col text-right"> 5 JOD</div>
                    </div>
                </form>
                <div class="row border-top pt-3 mt-3">
                    <div class="col">TOTAL PRICE</div>
                    <div class="totalCartAfterCoupon col text-right">
                        <?php
                        if (isset($_GET['total'])) {
                            echo $_GET['total'];
                        } else {
                            echo $cartController->totalCart() + 5;
                        }
                        ?>
                        JOD
                    </div>
                </div>
                <button class="btn btn-primary btn-block mt-3 fs-6">Place Order</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        //--------- Cart Section AJAX ---------
        // Handle increase quantity
        document.querySelectorAll(".increase-quantity").forEach(button => {
            button.addEventListener("click", function() {
                let productId = this.dataset.productId;
                let quantitySpan = this.closest(".quantity-container").querySelector(".quantity");
                let currentQuantity = parseInt(quantitySpan.textContent);

                updateQuantityIncrease(productId, currentQuantity + 1, quantitySpan);
            });
        });

        function updateQuantityIncrease(productId, newQuantity, quantitySpan) {
            fetch("../controllers/cartController.php?action=updateQuantityIncrease", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        productId: productId,
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        quantitySpan.textContent = data.newQuantity;

                        // Call updateCartSummary to refresh item count and total cart value
                        updateCartSummaryIncrease();
                    } else {
                        alert("Failed to update quantity");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        // Handle decrease quantity
        document.querySelectorAll(".decrease-quantity").forEach(button => {
            button.addEventListener("click", function() {
                let productId = this.dataset.productId;
                let quantitySpan = this.closest(".quantity-container").querySelector(".quantity");
                let currentQuantity = parseInt(quantitySpan.textContent);

                if (currentQuantity > 1) { // Minimum quantity should be 1
                    updateQuantity(productId, currentQuantity - 1, quantitySpan);
                }
            });
        });

        // Handle delete item
        document.querySelectorAll(".delete-item").forEach(button => {
            button.addEventListener("click", function() {
                let productId = this.dataset.productId;
                deleteItem(productId);
            });
        });

        // Update quantity function
        function updateQuantity(productId, newQuantity, quantitySpan) {
            fetch("../controllers/cartController.php?action=updateQuantity", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        productId: productId,
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        quantitySpan.textContent = data.newQuantity;

                        // Call updateCartSummary to refresh item count and total cart value
                        updateCartSummary();
                    } else {
                        alert("Failed to update quantity");
                    }
                })
                .catch(error => console.error("Error:", error));
        }


        // Delete item function
        function deleteItem(productId) {
            fetch("../controllers/cartController.php?action=deleteItem", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        productId: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartItemRow = document.querySelector(`.cart-item-row[data-product-id="${productId}"]`);
                        if (cartItemRow) {
                            cartItemRow.style.transition = "opacity 0.5s";
                            cartItemRow.style.opacity = "0";
                            setTimeout(() => {
                                cartItemRow.remove(); // Remove the item from the DOM after the fade effect

                                // Update item count and total cart value
                                updateCartSummary();
                            }, 500);
                        }
                    } else {
                        alert("Failed to delete item");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        // Functions to update cart summary
        function updateCartSummaryIncrease() {
            // Update cart items count
            const itemCountElement = document.querySelector(".summary .text-left");
            const currentItemCount = parseInt(itemCountElement.textContent.match(/\d+/)[0]);
            itemCountElement.textContent = `ITEMS: ${currentItemCount + 1}`;

            // update cart items count in the header
            const itemCountElement2 = document.querySelector(".cart-header .items-no-header");
            const currentItemCount2 = parseInt(itemCountElement2.textContent.match(/\d+/)[0]);
            itemCountElement2.textContent = `${currentItemCount + 1} items`;


            // Fetch updated total cart value
            fetch("../controllers/cartController.php?action=getTotalCartValue")
                .then(response => response.json())
                .then(data => {
                    const totalElement = document.querySelector(".summary .row .totalCart");
                    totalElement.textContent = `${data.total} JOD`;
                })
                .catch(error => console.error("Error:", error));
        }

        function updateCartSummary() {
            // Update cart items count
            const itemCountElement = document.querySelector(".summary .text-left");
            const currentItemCount = parseInt(itemCountElement.textContent.match(/\d+/)[0]);
            itemCountElement.textContent = `ITEMS: ${currentItemCount - 1}`;

            // update cart items count in the header
            const itemCountElement2 = document.querySelector(".cart-header .items-no-header");
            const currentItemCount2 = parseInt(itemCountElement2.textContent.match(/\d+/)[0]);
            itemCountElement2.textContent = `${currentItemCount - 1} items`;


            // Fetch updated total cart value
            fetch("../controllers/cartController.php?action=getTotalCartValue")
                .then(response => response.json())
                .then(data => {
                    const totalElement = document.querySelector(".summary .row .totalCart");
                    totalElement.textContent = `${data.total} JOD`;
                })
                .catch(error => console.error("Error:", error));
        }

        //--------- Cehckout Section AJAX ------------
        document.getElementById("address").addEventListener("change", function() {
            const newAddress = this.value;
            updateShippingAddress(newAddress);
        });

        function updateShippingAddress(address) {
            fetch("../controllers/cartController.php?action=updateAddress", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        address: address
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert("Failed to update address");
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    });

    //-------- Handle Place Order Button ----------
    document.querySelector(".btn.btn-primary.btn-block.mt-3.fs-6").addEventListener("click", function() {
    <?php if (!isset($_SESSION['user_id'])): ?>
        // Show login alert if the user is not logged in
        Swal.fire({
            icon: 'warning',
            title: 'You must log in',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php'; // Redirect to login
            }
        });
    <?php else: ?>
        // User is logged in, proceed with placing the order
        fetch('../controllers/placeProduct.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Placed Successfully!',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php'; // Redirect to homepage
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to place the order',
                        timer: 5000,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    <?php endif; ?>
    });
</script>

<?php include './footer.php'; ?>