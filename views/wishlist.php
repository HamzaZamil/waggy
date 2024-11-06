<?php
include '../controllers/wishlistController.php';

$wishlistController = new WishlistController();
$wishlistController->handleWishlist();

$wishlistItems = $wishlistController->getWishlistItemsForDisplay();
include 'header.php';
?>

<section id="wishlist" class="my-5 pt-5">
  <div class="container">
    <h2 class="text-center display-3 fw-normal">Your Wishlist</h2>

    <?php if (!empty($wishlistItems)) : ?>
      <div class="row">
        <?php foreach ($wishlistItems as $item) : ?>
          <div class="col-md-4 my-3">
            <div class="card position-relative d-flex flex-column align-items-center" style="background:#f9f9fa; border-radius:15px;">
              <img src="<?php echo htmlspecialchars($item['product_img']); ?>" class="img-fluid rounded-4" alt="<?php echo htmlspecialchars($item['product_name']); ?>">
              <div class="card-body d-flex flex-column align-items-center">
                <h3 class="card-title pt-4 m-0"><?php echo htmlspecialchars($item['product_name']); ?></h3>
                <h4 class="text-primary">$<?php echo htmlspecialchars($item['product_price']); ?></h4>
                <div class="d-flex justify-content-between mt-1">
                  <form action="item_details.php?product_id=<?= $item['product_id'] ?>" method="POST" style="display:inline;">
                    <input type="hidden" name="img" value="<?= htmlspecialchars($item['product_img']) ?>">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($item['product_name']) ?>">
                    <input type="hidden" name="description" value="<?= htmlspecialchars($item['product_description']) ?>">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($item['product_price'] . ' JOD') ?>">
                    <button type="submit" class="btn-cart px-2 mx-2 pt-3 pb-3" style="background:none; border:1px solid lightgrey; border-radius:6px;">
                      <h5 class="text-uppercase m-0 fs-6">Add to Cart</h5>
                    </button>
                  </form>
                  <form method="POST" action="wishlist.php">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                    <input type="hidden" name="action" value="remove">
                    <button type="submit" class="btn-wishlist px-2 pt-3" style="border:1px solid lightgrey; border-radius:6px;padding:10px;background:none;">
                      <iconify-icon icon="mdi:heart" class="fs-6"></iconify-icon>
                      <span class="fs-6">Remove</span>
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