<?php include './header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Waggy Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Apply background to the parent container */
        .content-wrapper {
            background-size: cover;
            color: #333;
            text-align: center;
        }
        .our-mission {
            padding: 3rem 1rem;
        }

        .our-mission {
            padding-bottom: 1.35rem;
            margin-bottom: 60px;
        }

        .mission-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.2rem;
        }

        .mission-content p {
            max-width: 1000px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.9rem;
            margin-bottom: 1.5rem;
        }

        /* Containers */
        #team {
            padding: 40px;
        }

        .box {
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            background: #fff;
            transition: 0.4s;
            text-align: center;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .box:hover {
            transform: scale(0.9);
        }

        .box img {
            width: 100%;
            height: auto;
            max-width: 100%;
            max-height: 150px;
            object-fit: contain;
            margin-bottom: 15px;
            display: block;
            border-radius: 5px;
        }

        h4.title {
            margin-left: 0;
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 18px;
            color: #deae6f;

        }

        p {
            font-size: 14px;
            margin-left: 0;
            margin-bottom: 0;
            line-height: 20px;
        }

       .section-divider {
            display: block;
            width: 100px;
            height: 3px;
            background: var(--secondColor);
            background: #deae6f;
            margin: 0 auto;
            margin-bottom: 20px;
        }
        .waggy-shop {
            font-weight: 600;
            color: #deae6f;
        }
    </style>
</head>

<body>

    <!-- Main content wrapper with background applied -->
    <div class="content-wrapper pt-5">
        <!-- Our Mission Section -->
        <section class="our-mission" id="mission">
            <div class="mission-content">
                <h2> About Us</h2>
                <span class="section-divider"></span>
                <p>At <span class="waggy-shop">Waggy Shop</span>, we’re passionate about elevating the quality of life for pets and their owners. Our
                    mission is to bring pet owners the finest selection of tools, toys, and nutrition products,
                    carefully crafted to support every stage of a pet's life. We believe that happy, healthy pets come
                    from access to quality care products and expertly tailored foods, and we are committed to sourcing
                    the best so you can focus on the joy of pet companionship.
                    At Waggy Shop, we’re here to support a fulfilling pet lifestyle, helping you create memorable, happy
                    moments every day.</p>
            </div>
        </section>

        <h1 class="section-title">Our Team</h1>


        <!-- Team Members -->
        <div id="team">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <img src="../images/avatar men sultan.png" alt="avatar" class="box-image">
                        <h4 class="title">Sultan Bkerat</h4>
                        <p class="description">Role: Product Owner</p>
                        <p class="description">Software Engineering</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <img src="../images/avatar men hamza 3.png" alt="avatar" class="box-image">
                        <h4 class="title">Hamza Zamil</h4>
                        <p class="description">Role: Scrum Master</p>
                        <p class="description">Software Engineering</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <img src="../images/avatar sara ayah.jpg" alt="avatar" class="box-image">
                        <h4 class="title">Sara Sleman</h4>
                        <p class="description">Role: Developer</p>
                        <p class="description">Computer Science</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <img src="../images/avatar sara ayah.jpg" alt="" class="box-image">
                        <h4 class="title">Aya Garallah</h4>
                        <p class="description">Role: Developer</p>
                        <p class="description">Arichtecture</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <img src="../images/avatar men sami.png" alt="avatar sami" class="box-image">
                        <h4 class="title">Sami Yassien</h4>
                        <p class="description">Role: Developer</p>
                        <p class="description">Computer Science</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include './footer.php'; ?>