<?php
include '../controllers/wishlistController.php';

$wishlistController = new WishlistController();
$wishlistController->handleWishlist();

$wishlistItems = $wishlistController->getWishlistItemsForDisplay();
include 'header.php';
?>

<section id="wishlist" class="my-5">
  <div class="container">
    <h2 class="text-center display-3 fw-normal">Your Wishlist</h2>

    <?php if (!empty($wishlistItems)) : ?>
      <div class="row">
        <?php foreach ($wishlistItems as $item) : ?>
          <div class="col-md-4 my-3">
            <div class="card position-relative">
              <img src="<?php echo htmlspecialchars($item['product_img']); ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($item['product_name']); ?>">
              <div class="card-body p-0">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($item['product_name']); ?></h3>
                <h4 class="text-primary">$<?php echo htmlspecialchars($item['product_price']); ?></h4>
                <div class="d-flex justify-content-between mt-3">
                  <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                  </a>
                  <form method="POST" action="wishlist.php">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                    <input type="hidden" name="action" value="remove">
                    <button type="submit" class="btn-wishlist px-4 pt-3">
                      <iconify-icon icon="mdi:heart" class="fs-5"></iconify-icon>
                      <span>Remove</span>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else : ?>
      <p class="text-center">Your wishlist is empty.</p>
    <?php endif; ?>
  </div>
</section>

<?php include 'footer.php'; ?>