<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Cart - La Mia Pizzeria</title>

    <link rel="stylesheet" href="style.css?v=7">
</head>

<body class="cart-page-body">

        <!-- =========================================
         HEADER
        ========================================= -->

    <header class="site-header">

        <div class="header-container">

            <a href="index.php" class="logo">
                <img src="images/logo-primary.png" alt="La Mia Pizzeria">
            </a>

            <nav class="main-navigation">

                <a href="index.php">Home</a>

                <a href="index.php#about">
                    Our Story
                </a>

                <a href="index.php#popular-pizza">
                    Menu
                </a>

                <a href="index.php#location">
                    Contact
                </a>

            </nav>

            <div class="auth-buttons">

                <?php if (isset($_SESSION['customer_id'])): ?>

                    <a href="logout.php" class="btn login-btn">
                        <span class="login-icon">👤</span>
                        Logout
                    </a>

                <?php else: ?>

                    <a href="login.php" class="btn login-btn">
                        <span class="login-icon">👤</span>
                        Login
                    </a>

                <?php endif; ?>

                <a href="register.php" class="btn register-btn">
                    <span class="register-icon">👤</span>
                    Register
                </a>

            </div>

        </div>

    </header>


        <!-- =========================================
         CART
        ========================================= -->

    <main class="cart-page">

        <a href="order.php" class="continue-shopping-btn">
            ← CONTINUE SHOPPING
        </a>

        <section class="cart-heading">

            <h1>YOUR CART</h1>

            <p>
                Review your selected pizzas before checkout.
            </p>

        </section>


        <section class="cart-container">

            <div id="cart-items">

                <!-- Cart items will be displayed here by JavaScript -->

            </div>


            <div class="cart-summary">

                <h2>Order Summary</h2>

                <div class="cart-total-row">

                    <span>Total</span>

                    <strong id="cart-total">
                        ₱0
                    </strong>

                </div>


                <a href="checkout.php" id="checkout-btn">
                    CHECKOUT
                </a>
                
            </div>

        </section>

    </main>


    <!-- =========================================
         CART JAVASCRIPT
         ========================================= -->

    <script src="script.js?v=2" defer></script>

</body>

</html>