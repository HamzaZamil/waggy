<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Waggy</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/vendor.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Chilanka&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../css/profileStyle.css">

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Chilanka&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css"></script>

    <!-- Cart Style -->
    <link rel="stylesheet" href="../css/cart_style.css">


    <style>
        .heart-icon {
            cursor: pointer;
            font-size: 1.5em;
            color: red;
        }

        .heart-icon.filled {
            color: red;
        }

        .heart-icon.outline {
            color: gray;
        }

        .alert-position {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            display: none;
        }

        .rounded-sweetalert {
            border-radius: 20px !important;
        }

        /* Container styling */
        .section {
            padding-top: 2rem;
            background-color: #f8f9fa;
        }

        /* Card styling */
        .card1 {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .card1 h5 {
            font-weight: bold;
        }

        .card1 img {
            width: 100%;
            height: auto;
        }

        /* Footer button */
        .card-footer button {
            background-color: #dfb074;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            width: 100%;
            font-weight: bold;
        }

        .card-footer button:hover {
            background-color: #c6a56b;
        }

        #cart_page .title {
            margin-bottom: 5vh;
        }

        #cart_page .card {
            margin: auto;
            max-width: 950px;
            width: 90%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 1rem;
            border: transparent;
        }

        @media(max-width:767px) {
            #cart_page .card {
                margin: 3vh auto;
            }
        }

        #cart_page .cart {
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }

        @media(max-width:767px) {
            #cart_page .cart {
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem;
            }
        }

        #cart_page .summary {
            background-color: #f9f3ec;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 4vh;
            color: rgb(65, 65, 65);
        }

        @media(max-width:767px) {
            #cart_page .summary {
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem;
            }
        }

        #cart_page .summary .col-2 {
            padding: 0;
        }

        #cart_page .summary .col-10 {
            padding: 0;
        }

        #cart_page .border-top,
        #cart_page .title .border-bottom {
            border-top: var(--bs-border-width) var(--bs-border-style) #000 !important;
            border-bottom: var(--bs-border-width) var(--bs-border-style) #000!important;
        }

        #cart_page .row {
            margin: 0;
        }

        #cart_page .title b {
            font-size: 1.5rem;
        }

        #cart_page .main {
            margin: 0;
            padding: 2vh 0;
            width: 100%;
        }

        #cart_page .col-2,
        #cart_page .col {
            padding: 0 1vh;
        }

        #cart_page a {
            padding: 0 1vh;
        }

        #cart_page .close {
            margin-left: auto;
            font-size: 0.7rem;
        }

        #cart_page img {
            width: 3.5rem;
        }

        #cart_page .back-to-shop {
            margin-top: 4.5rem;
        }

        #cart_page h5 {
            margin-top: 4vh;
        }

        #cart_page hr {
            margin-top: 1.25rem;
        }

        #cart_page form {
            padding: 2vh 0;
        }

        #cart_page select {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        #cart_page input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        #cart_page input:focus::-webkit-input-placeholder {
            color: transparent;
        }

        #cart_page .btn {
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0;
        }

        #cart_page .btn:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            user-select: none;
            transition: none;
        }

        #cart_page .btn:hover {
            color: white;
        }

        #cart_page a {
            color: black;
        }

        #cart_page a:hover {
            color: black;
            text-decoration: none;
        }

        #cart_page #code {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center;
        }
    </style>
</head>

<body>
    <!-- <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div> -->

    <!-- NAVBAR -->
    <header>
        <div class="container py-2">
            <div class="row py-4 pb-0 pb-sm-4 align-items-center">
                <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                    <div class="main-logo">
                        <a href="index.php">
                            <img src="../images/logo.png" alt="logo" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
                    <div class="support-box text-end d-none d-xl-block">
                        <span class="fs-6 secondary-font text-muted">Phone</span>
                        <h5 class="mb-0">+962-795894333</h5>
                    </div>
                </div>

                <div
                    class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
                    <div class="support-box text-end d-none d-xl-block">
                        <span class="fs-6 secondary-font text-muted">Email</span>
                        <h5 class="mb-0">waggy@gmail.com</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <hr class="m-0">
        </div>

        <div class="container">
            <nav class="main-menu d-flex navbar navbar-expand-lg">
                <div class="d-flex d-lg-none align-items-end mt-3">
                    <ul class="d-flex justify-content-end list-unstyled m-0">
                        <li>
                            <?php if ($isLoggedIn): ?>
                        <li class="dropdown">

                            <a href="#" class="mx-3" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="userProfile.php">Profile</a>

                                    <div class="dropdown-divider"></div>
                                    <a href="../controllers/LogoutController.php" class="dropdown-item">Logout</a>
                                </div>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="login_register.php" class="mx-3">
                                <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                            </a>
                        </li>
                    <?php endif; ?>
                    </li>
                    <li>
                        <a href="wishlist.php" class="mx-3">
                            <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
                        </a>
                    </li>


                        <li>
                            <a href="wishlist.php" class="mx-3">
                                <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
                            </a>
                        </li>


                    </ul>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header justify-content-center">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <?php
                    // Get the current file name from the URL
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    ?>

                    <div class="offcanvas-body justify-content-between">
                        <ul class="navbar-nav menu-list list-unstyled d-flex gap-md-3 mb-0">
                            <li class="nav-item">
                                <a href="index.php"
                                    class="nav-link <?php echo $currentPage == 'index.php' ? 'active' : ''; ?>">Home</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown"
                                    aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu" aria-labelledby="pages">
                                    <li><a href="shop2.php?categ-id=1" class="dropdown-item">All</a></li>
                                    <li><a href="shop2.php?categ-id=2" class="dropdown-item">Cats</a></li>
                                    <li><a href="shop2.php?categ-id=3" class="dropdown-item">Dogs</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="about-us.php" class="nav-link <?php echo $currentPage == 'about-us.php' ? 'active' : ''; ?>">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="contact_us.php"
                                    class="nav-link <?php echo $currentPage == 'contact_us.php' ? 'active' : ''; ?>">Contact
                                    Us</a>
                            </li>
                        </ul>

                        <div class="d-none d-lg-flex align-items-end">
                            <ul class="d-flex justify-content-end list-unstyled m-0">
                                <li>
                                    <?php if ($isLoggedIn): ?>
                                        <!-- Check if the user is logged in -->
                                        <a href="#" class="mx-3" role="button" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="userProfile.php">Profile</a></li>
                                            <li><a href="../controllers/LogoutController.php"
                                                    class="dropdown-item">Logout</a></li>
                                        </ul>
                                    <?php else: ?>
                                        <a href="login_register.php" class="mx-3">
                                            <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                        </a>
                                    <?php endif; ?>
                        <ul class="d-flex justify-content-end list-unstyled m-0">
                            <div class="d-none d-lg-flex align-items-end">
                                <?php if ($isLoggedIn): ?>
                                <li class="dropdown">

                                    <a href="#" class="mx-3" role="button" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="userProfile.php">Profile</a>
                                        <a href="../controllers/LogoutController.php" class="dropdown-item">Logout</a>
                                    </ul>
                                </li>
                                <?php else: ?>
                                <li>
                                    <a href="login_register.php" class="mx-3">
                                        <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                    </a>
                                </li>
                                <?php endif; ?>
                                </li>


                                <li>
                                    <a href="wishlist.php" class="mx-3">
                                        <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
                                    </a>
                                </li>

                                <li>
                                    <a href="./cart.php" class="icon-cart">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="filled" viewBox="0 0 18 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                                        </svg>
                                        <span id="iconCartQuantity">0</span>
                                    </a>
                                </li>

                            </div>
                        </ul>

                    </div>
                </div>
        </div>
       
    </header>

    <!-- <div class="overlay"></div>
    <div class="cartTab">
        <h1>Shopping Cart</h1>
        <div class="listCart">

        </div>
        <div class="btns">
            <button class="close">CLOSE</button>
            <button class="checkOut"><a href="#">Check Out</a></button>
        </div>
    </div> -->