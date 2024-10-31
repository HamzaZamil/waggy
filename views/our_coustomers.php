<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Waggy Shop Carousel</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Carousel Section */
    .carousel {
      width: 100%;
      overflow: hidden;
      position: relative;
    }
    
    .pet-carousel {
      padding: 2rem 1rem;
      text-align: center;
      background-color: #faf4ed;
    }

    .pet-carousel h2 {
      color: #333;
      margin-bottom: 1.5rem;
      font-size: 2rem;
    }

    /* Carousel Track */
    .carousel-track {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }

    /* Pet Card */
    .pet-card {
      background-color: rgba(255, 251, 242, 0.9);
      border-radius: 12px;
      width: 250px;
      margin: 0 1rem;
      padding: 1rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .pet-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .pet-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 0.8rem;
    }

    .pet-card h3 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 0.3rem;
    }

    .pet-card p {
      font-size: 0.9rem;
      color: #777;
    }

    /* Pagination styling */
    .pagination {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      transform: translateY(-50%);
    }

    .pagination button {
      background-color: rgba(250, 244, 237, 0.8);
      color: #333;
      border: none;
      padding: 0.5rem;
      cursor: pointer;
      font-size: 1.2rem;
      border-radius: 50%;
      opacity: 0.7;
      transition: opacity 0.3s, transform 0.3s;
    }

    .pagination button:hover {
      opacity: 1;
      transform: scale(1.15);
    }
  </style>
</head>
<body>
  <!-- Pet Carousel Section -->
  <section class="pet-carousel">
    <h2>Meet Our Lovely Customers</h2>
    <div class="carousel">
      <div class="carousel-track">
        <!-- Pet Cards -->
        <div class="pet-card">
          <img src="../images/pet1.jpeg" alt="Charlie the Dog">
          <h3>Charlie</h3>
          <p>Playful & Friendly</p>
        </div>
        <div class="pet-card">
          <img src="../images/pet2.jpeg" alt="Bella the Cat">
          <h3>Bella</h3>
          <p>Curious & Sweet</p>
        </div>
        <div class="pet-card">
          <img src="../images/pet5.jpg" alt="E'too the Dog">
          <h3>E'too</h3>
          <p>Mysterious & Whiskered</p>
        </div>
        <div class="pet-card">
          <img src="../images/pet4.jpg" alt="Shakira the Cat">
          <h3>Shakira</h3>
          <p>Agile & Curious</p>
        </div>
        <div class="pet-card">
          <img src="../images/pet3.jpg" alt="Lolo the Dog">
          <h3>Lolo</h3>
          <p>Playful & Friendly</p>
        </div>
        <div class="pet-card">
          <img src="../images/pet6.jpeg" alt="Whisker the Cat">
          <h3>Whisker</h3>
          <p>Soft & Clever</p>
        </div>
        <div class="pet-card">
          <img src="../images/pet7.jpeg" alt="Waggyx the Dog">
          <h3>Waggyx</h3>
          <p>Graceful & Friendly</p>
        </div>
        <div class="pet-card">
          <img src="../images/pet8.jpeg" alt="Roxa the Dog">
          <h3>Roxa</h3>
          <p>Curious & Sweet</p>
        </div>
        <div class="pet-card">
          <img src="../images/pet9.jpeg" alt="Qamior the Dog">
          <h3>Qamior</h3>
          <p>Playful & Friendly</p>
        </div>
        <div class="pet-card">
          <img src="../images/pet10.jpeg" alt="Windx the Cat">
          <h3>Windx</h3>
          <p>Independent & Affectionate</p>
        </div>
      </div>
      <!-- Pagination -->
      <div class="pagination">
        <button class="prev" onclick="moveCarousel(-1)">&#10094;</button>
        <button class="next" onclick="moveCarousel(1)">&#10095;</button>
      </div>
    </div>
  </section>

  <!-- JavaScript for Carousel -->
  <script>
    let currentIndex = 0;
    const track = document.querySelector('.carousel-track');
    const petCards = document.querySelectorAll('.pet-card');
    const autoSlideInterval = 3000;
    let autoSlide;

    function updateCarousel() {
      track.style.transform = `translateX(-${currentIndex * (petCards[0].offsetWidth + 20)}px)`;
    }

    function moveCarousel(direction) {
      currentIndex = (currentIndex + direction + petCards.length) % petCards.length;
      updateCarousel();
      resetAutoSlide();
    }

    function resetAutoSlide() {
      clearInterval(autoSlide);
      autoSlide = setInterval(() => moveCarousel(1), autoSlideInterval);
    }

    // Initialize auto slide
    resetAutoSlide();
  </script>
</body>
</html>
