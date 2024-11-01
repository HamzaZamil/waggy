<?php
 include './header.php'; 
 include '../controllers/cartController.php';

 $cartController = new CartController();
 $cartItems = $cartController->getCartItems();
 $cartItemsNo = $cartController->getCartItemsCount();
 ?>

<div id="cart_page" class="container my-5">
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <!-- Use flex utilities to position elements -->
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <div class="col-auto text-muted">
                            <?= $cartItemsNo ?> items
                        </div>
                    </div>
                </div>

                <?php 
                if (!empty($cartItems)) : 
                     foreach ($cartItems as $item) :
                ?>
                <div class="row border-top border-bottom py-3">
                    <div class="row main align-items-center justify-content-between">
                        <div class="col-2 text-center">
                            <img class="img-fluid" src="<?=$item['product_img']?>">
                        </div>
                        <div class="col text-center">
                            <div><?=$item['product_name']?></div>
                        </div>
                        <div class="col text-center">
                            <a href="#">-</a>
                            <span class="border px-2"><?=$item['quantity']?></span>
                            <a href="#">+</a>
                        </div>
                        <div class="col text-center">
                        <?=$item['product_price'] * $item['product_quantity'] ?> JOD
                        </div>
                        <div class="col text-center" style="flex: 0 0 20px; max-width: 20px;">
                            <span class="close" style="cursor: pointer;"><iconify-icon icon="ic:baseline-delete" class="fs-5"></iconify-icon></span>
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

            <div class="col-md-4 summary">
                <h5><b>Checkout</b></h5>
                <hr>
                <div class="row">
                    <div class="col text-left">ITEMS: <?= $cartItemsNo ?></div>
                    <div class="col text-right"> 132.00 JOD</div>
                </div>
                <form>
                    <p>SHIPPING</p>
                    <select class="form-control mb-3">
                        <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                    </select>
                    <p>GIVE CODE</p>
                    <input id="code" class="form-control" placeholder="Enter your code">
                </form>
                <div class="row border-top pt-3 mt-3">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">&euro; 137.00</div>
                </div>
                <button class="btn btn-primary btn-block mt-3">Place Order</button>
            </div>
        </div>
    </div>
</div>

<?php include './footer.php'; ?>