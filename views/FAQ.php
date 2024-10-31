<?php include './header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs - Waggy Shop</title>
    <style>
        /* Global Body Styling */
        .big {
           
            color: #333;
            background: url('../images/background-img1.png') repeat left;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            margin-bottom: -50px;
        }

        /* FAQ Section Styling */
        .faq {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }

        .big h2 {
            font-size: 2em;
            padding: 10px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ffdd57;
        }

        .faq-item {
            padding: 15px 20px;
            border-bottom: 1px solid #eaeaea;
            transition: background 0.5s ease-out;
            position: relative;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-item h3 {
            font-size: 1.2em;
            color: #444;
            margin: 0;
            cursor: pointer;
            transition: color 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-item h3:hover {
            color: #ffdd57;
        }

        .faq-item p {
            font-size: 1em;
            color: #666;
            margin-top: 10px;
            display: none;
            line-height: 1.5;
        }

        /* Reveal animation */
        .faq-item.show p {
            display: block;
            animation: fadeIn 0.4s ease-in-out;
        }

        /* Icon Styling */
        .faq-item h3::after {
            content: '+';
            font-size: 1.4em;
            transition: transform 0.3s ease;
        }

        .faq-item.show h3::after {
            content: '-';
            transform: rotate(180deg);
        }

        /* Animation */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
<div class="big">
<h2>Frequently Asked Questions</h2>

<!-- FAQ Section -->
<section id="faq" class="faq">
    <div class="faq-item">
        <h3>What types of food do you offer for cats?</h3>
        <p>We provide a variety of high-quality cat foods to meet your pet's nutritional needs at every life stage.</p>
    </div>
    <div class="faq-item">
        <h3>How do I know which grooming tools are best for my cat?</h3>
        <p>Each grooming tool in our shop is selected for its safety and effectiveness. Check our product descriptions to find the best fit for your cat’s coat type.</p>
    </div>
    <div class="faq-item">
        <h3>Are all products in Waggy Shop tested for safety?</h3>
        <p>Yes, we carefully review and test each product for safety and quality to ensure the best for your pet.</p>
    </div>
    <div class="faq-item">
        <h3>What’s the return policy if my cat doesn’t like a product?</h3>
        <p>We offer a 30-day return policy on most items. Please refer to our return policy page for more details.</p>
    </div>
    <div class="faq-item">
        <h3>How often should I replace cat toys and feeding accessories?</h3>
        <p>We recommend replacing toys and accessories when they show signs of wear to ensure safety and hygiene for your pet.</p>
    </div>
</section>
</div>
<script>
    // Event listeners for mouseover and mouseout to reveal/hide answers
    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('mouseover', () => {
            item.classList.add('show');
        });
        item.addEventListener('mouseout', () => {
            item.classList.remove('show');
        });
    });
</script>

</body>
</html>
<?php include './footer.php'; ?>
