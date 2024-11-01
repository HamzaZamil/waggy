// -------------- Cart Viewing---------------
let listCartHTML = document.querySelector(".listCart");
let iconCart = document.querySelector(".icon-cart");
let iconCartSpan = document.querySelector(".icon-cart span");
let body = document.querySelector("body");
let closeCart = document.querySelector(".close");
let overlay = document.querySelector(".overlay");

iconCart.addEventListener("click", () => {
  body.classList.toggle("showCart");
  overlay.style.opacity = body.classList.contains("showCart") ? "1" : "0"; // Show overlay
});

closeCart.addEventListener("click", () => {
  body.classList.toggle("showCart");
  overlay.style.opacity = "0"; // Hide overlay
});

// Ensure overlay is clicked to close cart
overlay.addEventListener("click", () => {
  body.classList.remove("showCart");
  overlay.style.opacity = "0"; // Hide overlay
});

// ------------ Show items in the cart -------------

document.addEventListener("DOMContentLoaded", function () {
  // Elements
  let listCartHTML = document.querySelector(".listCart");
  let iconCart = document.querySelector(".icon-cart");

  // Fetch and display cart items
  async function displayCartItems() {
      try {
          console.log("Fetching cart items..."); // Debug log
          let response = await fetch('../controllers/CartController.php?action=getCartItems');
          let cartItems = await response.json();
          console.log("Cart items fetched:", cartItems); // Debug log

          // Clear existing items
          listCartHTML.innerHTML = "";

          if (cartItems.length === 0) {
              listCartHTML.innerHTML = "<p>Your cart is empty.</p>"; // Show message if cart is empty
              return;
          }

          cartItems.forEach(item => {
              let cartItem = document.createElement("div");
              cartItem.className = "cart-item";
              cartItem.innerHTML = `
                  <div class="image">
                      <img src="${item.product_img}" alt="${item.product_name}">
                  </div>
                  <div class="name">${item.product_name}</div>
                  <div class="totalPrice">$${(item.product_price * item.quantity).toFixed(2)}</div>
                  <div class="quantity">
                      <span class="minus" data-product-id="${item.product_id}">-</span>
                      <span>${item.quantity}</span>
                      <span class="plus" data-product-id="${item.product_id}">+</span>
                  </div>
              `;
              listCartHTML.appendChild(cartItem);
          });

          addQuantityEventListeners(); // Add event listeners to new buttons

      } catch (error) {
          console.error("Error fetching cart items:", error);
      }
  }

  // Event listener for the cart icon
  if (iconCart) {
      iconCart.addEventListener("click", () => {
          console.log("Cart icon clicked"); // Debug log
          displayCartItems();
      });
  } else {
      console.error("Cart icon not found!"); // Log error if not found
  }

  function addQuantityEventListeners() {
      // Add event listeners for plus and minus buttons
      const plusButtons = document.querySelectorAll('.plus');
      const minusButtons = document.querySelectorAll('.minus');

      plusButtons.forEach(button => {
          button.addEventListener('click', async () => {
              const productId = button.dataset.productId;
              let quantityElement = button.previousElementSibling;
              let currentQuantity = parseInt(quantityElement.innerText);
              const newQuantity = currentQuantity + 1;

              // Call the update quantity function
              const updated = await updateCartQuantity(productId, newQuantity);
              if (updated) {
                  quantityElement.innerText = newQuantity; // Update the quantity display
              }
          });
      });

      minusButtons.forEach(button => {
          button.addEventListener('click', async () => {
              const productId = button.dataset.productId;
              let quantityElement = button.nextElementSibling;
              let currentQuantity = parseInt(quantityElement.innerText);
              const newQuantity = currentQuantity > 1 ? currentQuantity - 1 : 1; // Prevent quantity from going below 1

              // Call the update quantity function
              const updated = await updateCartQuantity(productId, newQuantity);
              if (updated) {
                  quantityElement.innerText = newQuantity; // Update the quantity display
              }
          });
      });
  }

  async function updateCartQuantity(productId, quantity) {
      try {
          const response = await fetch('../controllers/CartController.php?action=updateCartQuantity', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
              },
              body: JSON.stringify({ productId, quantity }),
          });

          const result = await response.json();
          return result.success; // Assuming your PHP returns { success: true/false }
      } catch (error) {
          console.error("Error updating cart quantity:", error);
          return false;
      }
  }
});