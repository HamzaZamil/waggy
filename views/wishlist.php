<?php
session_start();
?>

<!-- wishlist.php -->
<?php include 'header.php'; ?>

<section id="wishlist" class="my-5">
    <div class="container">
        <h2 class="text-center display-3 fw-normal">Your Wishlist</h2>

        <?php
        // Example items in the wishlist (in a real scenario, retrieve from DB)
        $_SESSION['wishlist'] = [
            ['name' => 'Grey Hoodie', 'price' => '$18', 'image' => '../images/item1.jpg'],
            ['name' => 'Dog Food', 'price' => '$12', 'image' => '../images/item10.jpg'],
            ['name' => 'Soft Toy', 'price' => '$5', 'image' => '../images/item3.jpg'],
        ];

        if (isset($_SESSION['wishlist']) && count($_SESSION['wishlist']) > 0) {
            echo '<div class="row">';
            foreach ($_SESSION['wishlist'] as $item) {
                echo '
        <div class="col-md-4 my-3">
          <div class="card position-relative">
            <img src="' . $item['image'] . '" class="img-fluid rounded-4" alt="' . $item['name'] . '">
            <div class="card-body p-0">
              <h3 class="card-title pt-4 m-0">' . $item['name'] . '</h3>
              <h4 class="text-primary">' . $item['price'] . '</h4>
              <div class="d-flex justify-content-between mt-3">
                <a href="#" class="btn-cart me-3 px-4 pt-3 pb-3">
                  <h5 class="text-uppercase m-0">Add to Cart</h5>
                </a>
                <a href="wishlist.php?action=remove&name=' . urlencode($item['name']) . '" class="btn-wishlist px-4 pt-3">
                  <iconify-icon icon="mdi:trash-can-outline" class="fs-5"></iconify-icon>
                  <span>Remove</span>
                </a>
              </div>
            </div>
          </div>
        </div>';
            }
            echo '</div>';
        } else {
            echo '<p class="text-center">Your wishlist is empty.</p>';
        }

        // Remove item from wishlist
        if (isset($_GET['action']) && $_GET['action'] === 'remove') {
            $nameToRemove = $_GET['name'];
            foreach ($_SESSION['wishlist'] as $key => $item) {
                if ($item['name'] === $nameToRemove) {
                    unset($_SESSION['wishlist'][$key]);
                    $_SESSION['wishlist'] = array_values($_SESSION['wishlist']); // Re-index array
                    header('Location: wishlist.php'); // Refresh page after removal
                }
            }
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>