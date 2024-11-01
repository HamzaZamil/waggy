// -------------- Cart Viewing---------------
let listCartHTML = document.querySelector(".listCart");
let iconCart = document.querySelector(".icon-cart");
let iconCartSpan = document.querySelector(".icon-cart span");
let body = document.querySelector("body");
let closeCart = document.querySelector(".close");
let overlay = document.querySelector(".overlay");
let cart = [];

iconCart.addEventListener("click", () => {
  body.classList.toggle("showCart");
  overlay.style.opacity = body.classList.contains("showCart") ? "1" : "0"; // Show overlay
});

closeCart.addEventListener("click", () => {
  body.classList.toggle("showCart");
  overlay.style.opacity = "0"; // Hide overlay
});

// Ensure overlay is clicked to close cart (if desired)
overlay.addEventListener("click", () => {
  body.classList.remove("showCart");
  overlay.style.opacity = "0"; // Hide overlay
});
