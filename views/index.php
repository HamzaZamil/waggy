<?php include './header.php'; ?>

<!-- Hero Section -->
<section id="banner">
    <div class="swiper main-swiper">
        <div class="swiper-wrapper">

            <!-- Slide 1 -->
            <div class="swiper-slide py-3"
                style="height: 100vh; background-image: url('../images/tryHERO6.jpg'); background-size: cover; background-position: 20% center; position: relative;">
                <div class="row banner-content"
                    style="position: absolute; top: 0; left: 0; padding: 20px; width: 100%;">
                    <div class="content-wrapper col-md-4 p-3 mb-5 text-start">
                    <br>
                    
                        <h2 class="banner-title display-1 fw-normal fs-2">The Essentials to Keep Tails Wagging<span>and
                                Pets Purring</span></h2>
                               
                              
                        <div class="secondary-font text-uppercase mb-4" style="color: #C65D23;">The Best for Your Bestie
                        </div>
                    </div>
                </div>
            </div>


            <!-- Slide 2 -->
            <div class="swiper-slide py-3">
                <div class="row banner-content align-items-center">
                    <div class="img-wrapper col-12 col-md-5">
                        <img src="../images/catAD.png" class="img-fluid" style="object-fit: cover;">
                    </div>
                    <div class="content-wrapper col-12 col-md-7 p-5 mb-5">
                        <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                        <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                class="text-primary">your pets</span></h2>
                        <a href="shop.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                            shop now
                            <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>


            <div class="swiper-slide py-3">
                <div class="row banner-content align-items-center">
                    <div class="img-wrapper col-md-5">
                        <img src="../images/banner-img4.png" class="img-fluid">
                    </div>
                    <div class="content-wrapper col-md-7 p-5 mb-5">
                        <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                        <h2 class="banner-title display-1 fw-normal">Best destination for <span
                                class="text-primary">your pets</span>
                        </h2>
                        <a href="shop.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                            shop now
                            <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                                <use xlink:href="#arrow-right"></use>
                            </svg></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="swiper-pagination mb-5"></div>
    </div>
</section>
<style>
#banner {
    width: 100%;
    overflow: hidden;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .swiper-slide {
        height: 80vh;
        /* Slightly shorter for medium screens */
    }
}

.swiper-slide {

    background-size: cover;
    background-position: 20% center;
    height: 100vh;
}

.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.img-wrapper img {
    height: 100%;
    width: auto;
    object-fit: cover;
}

.h-100 {
    height: 100%;
}

.content-wrapper {
    padding-left: 0px;

}


@media (max-width: 768px) {
    .swiper-slide {
        height: 60vh;
        background-position: 15% center;

    }

    .img-wrapper img {
        height: auto;
        max-height: 50vh;
    }

    /* .content-wrapper {
        padding-left: 15px;
    } */

    /* @media (max-width: 768px) {}

    .banner-title {
        font-size: 2rem;

    }

    .content-wrapper {
        padding: 20px;

    } */
}

@media (max-width: 576px) {
    .swiper-slide {
        height: 50vh;
        background-position: 10% center;
    }

    .banner-title {
        font-size: 1.5rem;

    }

    .content-wrapper {
        padding: 10px;
    }
}
</style>
<!-- Swiper JS Initialization -->
<script>
var swiper = new Swiper('.main-swiper', {
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    speed: 800,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    // Adding CSS transitions for smoothness
    on: {
        transitionStart: function() {
            this.slides.css('transition', 'transform 0.8s ease-in-out');
        },
        transitionEnd: function() {
            this.slides.css('transition', 'transform 0.8s ease-in-out');
        },
    }
});
</script>


<!-- Categories Section -->
<section id="categories">
    <div class="container my-3 py-5">
        <div class="row my-5">
            <div class="col text-center">
                <a href="./shop2.php?categ-id=1" class="categories-item">
                    <iconify-icon class="category-icon" icon="ph:bowl-food"></iconify-icon>
                    <h5>Foodies</h5>
                </a>
            </div>
            <div class="col text-center">
                <a href="./shop2.php?categ-id=3" class="categories-item">
                    <iconify-icon class="category-icon" icon="ph:dog"></iconify-icon>
                    <h5>Dog Shop</h5>
                </a>
            </div>
            <div class="col text-center">
                <a href="./shop2.php?categ-id=2" class="categories-item">
                    <iconify-icon class="category-icon" icon="ph:cat"></iconify-icon>
                    <h5>Cat Shop</h5>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Best Selling Section -->
<section id="bestselling" class="my-5" style="background:#f9f3ec; padding: 80px 0; height: 700px; ">
    <div class="container ">
        <div class="section-header d-md-flex justify-content-between align-items-center mb-1">
            <h2 class="display-5 fw-normal">New Items</h2>
            <div>
                <a href="./shop2.php?categ-id=1" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                    shop now
                    <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="swiper bestselling-swiper mb-4"> 
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="card" style="background:#f9f9fa;">
                            <a href="single-product.html"><img src="../inserted_img/fresh_kisses_treats.jpg"
                                    class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body d-flex flex-column align-items-center">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Fresh Kisses</h3>
                                </a>
                                <div class="card-text">
                                    <h3 class="secondary-font text-primary">20.54JOD</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card " style="background:#f9f9fa;">
                            <a href="single-product.html"><img src="../inserted_img/sweater.jpg"
                                    class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body d-flex flex-column align-items-center">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Sweater</h3>
                                </a>
                                <div class="card-text">
                                    <h3 class="secondary-font text-primary">7.08JOD</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card " style="background:#f9f9fa;">
                            <a href="single-product.html"><img src="../inserted_img/9lives.jpg"
                                    class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body d-flex flex-column align-items-center">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">9Lives Seafood</h3>
                                </a>
                                <div class="card-text">
                                    <h3 class="secondary-font text-primary">10.89JOD</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card " style="background:#f9f9fa;">
                            <a href="single-product.html"><img src="../inserted_img/chew_toy.png"
                                    class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body d-flex flex-column align-items-center">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Chew Toy</h3>
                                </a>
                                <div class="card-text">
                                    <h3 class="secondary-font text-primary">14.17JOD</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card " style="background:#f9f9fa;">
                            <a href="single-product.html"><img src="../inserted_img/hoodie.jpg"
                                    class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body d-flex flex-column align-items-center">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">Hoodie</h3>
                                </a>
                                <div class="card-text">
                                    <h3 class="secondary-font text-primary">7.08JOD</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card position-relative" style="background:#f9f9fa;">
                            <a href="single-product.html"><img src="../inserted_img/3pcs.jpg"
                                    class="img-fluid rounded-4" alt="image"></a>
                            <div class="card-body d-flex flex-column align-items-center">
                                <a href="single-product.html">
                                    <h3 class="card-title pt-4 m-0">3Pcs Outfit</h3>
                                </a>
                                <div class="card-text">
                                    <h3 class="secondary-font text-primary">9.92JOD</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>






<!-- Testimonials Section -->

<section id="testimonial" class="my-5 py-5">
    <div class="container">
        <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
            <h2 class="display-3 fw-normal">Celebrating 100+ Happy Customers and Counting!</h2>
        </div>
        <div class="row align-items-stretch">
            <!-- Left Section for Testimonials Carousel -->
            <div class="col-lg-6 d-flex align-items-center">
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner h-100">
                        <div class="carousel-item active h-100" data-bs-interval="10000">
                            <div class="testimonial-box d-flex justify-content-center align-items-center h-100 p-4">
                                <div class="testimonial-content w-75">
                                    <!-- <h5>First Testimonial</h5> -->
                                    <p>"I absolutely love shopping at Waggy! They have an amazing wide selection of pet
                                        food that my dogs can’t get enough of. The staff is always friendly and ready to
                                        help me find the perfect outfit for my pup. Highly recommend!"
                                    </p>
                                    <p> Nouha Yaseen</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item h-100" data-bs-interval="2000">
                            <div class="testimonial-box d-flex justify-content-center align-items-center h-100 p-4">
                                <div class="testimonial-content w-75">
                                    <!-- <h5>Second Testimonial</h5> -->
                                    <p>"I can’t say enough good things about Waggy! Their selection of pet apparel is
                                        fantastic, and I love that they carry eco-friendly products. My cat loves her
                                        new bed, and I feel good about supporting a store that cares about pet health
                                        and the environment."</p>
                                    <p> Rami Zeyad</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item h-100">
                            <div class="testimonial-box d-flex justify-content-center align-items-center h-100 p-4">
                                <div class="testimonial-content w-75">
                                    <!-- <h5>Third Testimonial</h5> -->
                                    <p>"I recently bought a set of dog grooming tools from Waggy, and they work
                                        wonderfully! The quality is excellent, and I love that I could find everything I
                                        needed in one place. The pet food selection is also impressive, with many
                                        options for different diets."</p>
                                    <p> Rahaf Bader</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"
                            style="background-color: black;"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"
                            style="background-color: black;"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Right Section for Static Image -->
            <div class="col-lg-6 p-0">
                <div class="testimonial-image"></div>
            </div>
        </div>
    </div>
</section>

<style>
.testimonial-box {
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
}


.testimonial-content {
    text-align: center;
}

/* Match the height of the left and right sections */
#testimonial .row {
    height: 100%;
    min-height: 500px;
    /* Minimum height for large screens */
}

/* Carousel and Testimonial Box Styling */
.carousel,
.carousel-inner,
.carousel-item,
.testimonial-box {
    height: 100%;
}

/* Right Section Image Styling */
.testimonial-image {
    background-image: url('../images/happydog.jpg');
    /* Replace with actual image path */
    background-size: cover;
    background-position: center;
    height: 100%;
}

/* Carousel arrows in black */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: black;
    border-radius: 50%;
    width: 40px;
    height: 40px;
}

/* Hide image on smaller screens */
@media (max-width: 992px) {
    .testimonial-image {
        display: none;
    }
}
</style>




<!-- Register Section -->
<section id="register" style="background: url('../images/background-img.png') no-repeat;">
    <div class="container ">
        <div class="row my-5 py-5">
            <div class="offset-md-3 col-md-6 my-5 ">
                <h2 class="display-3 fw-normal text-center">Get 20% Off on <span class="text-primary">first
                        Purchase</span>
                </h2>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg rounded-1"><a href="./login_register.php"
                            style="color: white;">Register it now</a></button>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Companies Logo Section -->
<section id="banner-2" class="my-3" style="height: auto;">
    <div class="container">
        <h2 class="display-3 fw-normal text-center">Favorite Brands Among Our Customers</h2>
        <div class="row my-5 align-items-center justify-content-center">
            <!-- Logo 1 -->
            <div class="col-6 col-md-2 text-center mb-4">
                <!-- Adjusted column widths -->
                <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                    <img src="../images/9lives.png" alt="9 Lives" style="max-width: 100%; height: auto;">
                    <h5 class="mt-2">9 Lives</h5>
                </div>
            </div>
            <!-- Logo 2 -->
            <div class="col-6 col-md-2 text-center mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                    <img src="../images/imac.jpg" alt="IMAC" style="max-width: 100%; height: auto;">
                    <h5 class="mt-2">IMAC</h5>
                </div>
            </div>
            <!-- Logo 3 -->
            <div class="col-6 col-md-2 text-center mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                    <img src="../images/INABA.jpg" alt="INABA" style="max-width: 100%; height: auto;">
                    <h5 class="mt-2">INABA</h5>
                </div>
            </div>
            <!-- Logo 4 -->
            <div class="col-6 col-md-2 text-center mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                    <img src="../images/proplan.png" alt="Purina" style="max-width: 100%; height: auto;">
                    <h5 class="mt-2">Purina</h5>
                </div>
            </div>
            <!-- Logo 5 -->
            <div class="col-6 col-md-2 text-center mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                    <img src="../images/Royal-Canin-Logo.png" alt="Royal Canin" style="max-width: 100%; height: auto;">
                    <h5 class="mt-2">Royal Canin</h5>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Services Section -->
<section id="service">
    <div class="container py-5 my-5">
        <div class="row g-md-5 pt-4">
            <h2 class="display-3 fw-normal text-center">Our Services</h2>
            <div class="col-6 col-md-3 my-3">
                <div class="card border-0 text-center d-flex align-items-center justify-content-center"
                    style="min-height: 300px; padding: 10px;">
                    <div>
                        <iconify-icon class="service-icon text-primary" icon="la:shopping-cart"></iconify-icon>
                    </div>
                    <h3 class="card-title py-2 m-0">Cash on Delivery</h3>
                    <div class="card-text">
                        <p class="blog-paragraph fs-6">Pay when you receive your order. Convenient and hassle-free!</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 my-3">
                <div class="card border-0 text-center d-flex align-items-center justify-content-center"
                    style="min-height: 300px; padding: 10px;">
                    <div>
                        <iconify-icon class="service-icon text-primary" icon="la:user-check"></iconify-icon>
                    </div>
                    <h3 class="card-title py-2 m-0">24/7 Customer Support</h3>
                    <div class="card-text">
                        <p class="blog-paragraph fs-6">Our team is available around the clock to assist you.</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 my-3">
                <div class="card border-0 text-center d-flex align-items-center justify-content-center"
                    style="min-height: 300px; padding: 10px;">
                    <div>
                        <iconify-icon class="service-icon text-primary" icon="la:tag"></iconify-icon>
                    </div>
                    <h3 class="card-title py-2 m-0">Same-Day Shipping</h3>
                    <div class="card-text">
                        <p class="blog-paragraph fs-6">Place your order by 12 PM and get it delivered the same day!</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 my-3">
                <div class="card border-0 text-center d-flex align-items-center justify-content-center"
                    style="min-height: 300px; padding: 10px;">
                    <div>
                        <iconify-icon class="service-icon text-primary" icon="la:award"></iconify-icon>
                    </div>
                    <h3 class="card-title py-2 m-0">Quality Guarantee</h3>
                    <div class="card-text">
                        <p class="blog-paragraph fs-6">Our products meet the highest standards of durability and
                            excellence.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include './footer.php'; ?>