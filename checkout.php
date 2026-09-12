<?php

session_start();

if (!isset($_SESSION['customer_id'])) {

    $_SESSION['redirect_after_login'] = 'checkout.php';

    header(
        'Location: login.php?status=error&message=' .
        urlencode('Please login first before checkout.')
    );

    exit;
}

$checkoutErrors = $_SESSION['checkout_errors'] ?? [];

$checkoutForm = $_SESSION['checkout_form'] ?? [];

unset($_SESSION['checkout_errors']);
unset($_SESSION['checkout_form']);

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Checkout - La Mia Pizzeria</title>

    <link rel="stylesheet" href="style.css?v=7">

</head>


<body class="cart-page-body">


    <!-- =========================================
         HEADER
    ========================================= -->

    <header class="site-header">

        <div class="header-container">


            <!-- LOGO -->

            <a href="index.php" class="logo">

                <img src="images/logo-primary.png"
                     alt="La Mia Pizzeria">

            </a>


            <!-- NAVIGATION -->

            <nav class="main-navigation">

                <a href="index.php">
                    Home
                </a>

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


            <!-- AUTH BUTTONS -->

            <div class="auth-buttons">


                <a href="cart.php"
                   class="btn cart-btn">

                    🛒 Cart

                </a>


                <?php if (isset($_SESSION['customer_id'])): ?>

                    <a href="logout.php"
                       class="btn login-btn">

                        <span class="login-icon">
                            👤
                        </span>

                        Logout

                    </a>

                <?php else: ?>

                    <a href="login.php"
                       class="btn login-btn">

                        <span class="login-icon">
                            👤
                        </span>

                        Login

                    </a>

                <?php endif; ?>


                <a href="register.php"
                   class="btn register-btn">

                    <span class="register-icon">
                        👤
                    </span>

                    Register

                </a>


            </div>


        </div>

    </header>



    <!-- =========================================
         CHECKOUT PAGE
    ========================================= -->

    <main class="checkout-page">


        <!-- PAGE HEADING -->

        <section class="cart-heading">

            <h1>
                CHECKOUT
            </h1>

            <p>
                Review your order before placing it.
            </p>

        </section>



            <!-- =========================================
                CHECKOUT CONTAINER
            ========================================= -->

            <section class="checkout-container">

                <?php if (!empty($checkoutErrors)): ?>

                    <div class="checkout-error">

                        <?php foreach ($checkoutErrors as $error): ?>

                            <p>
                        <?= htmlspecialchars($error) ?>
                    </p>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>


            <!-- =====================================
                 CHECKOUT FORM
            ====================================== -->

            <form method="POST"
                  action="place_order.php"
                  id="checkout-form">

                  <input type="hidden" 
                         name="cart_data" 
                         id="cart-data">


                <!-- =================================
                     ORDER SUMMARY
                ================================== -->

                <div class="checkout-order">

                    <h2>
                        ORDER SUMMARY
                    </h2>


                    <div id="checkout-items">
                        <!-- Cart items will appear here -->
                    </div>


                    <div class="checkout-total">

                        <span>
                            Total
                        </span>


                        <strong id="checkout-total">
                            ₱0.00
                        </strong>

                    </div>

                </div>



                <!-- =================================
                     CUSTOMER INFORMATION
                ================================== -->

                <div class="checkout-form-card">

                    <h2>
                        CUSTOMER INFORMATION
                    </h2>


                    <!-- FULL NAME -->

                    <div class="checkout-form-group">

                        <label for="checkout-name">
                            Full Name
                        </label>


                        <input
                            type="text"
                            id="checkout-name"
                            name="full_name"
                            placeholder="Enter your full name"
                            value="<?= htmlspecialchars($checkoutForm['full_name'] ?? '') ?>"
                            required
                        >

                    </div>


                    <!-- PHONE NUMBER -->

                    <div class="checkout-form-group">

                        <label for="checkout-phone">
                            Phone Number
                        </label>


                        <input
                            type="text"
                            id="checkout-phone"
                            name="phone"
                            placeholder="Enter your phone number"
                            value="<?= htmlspecialchars($checkoutForm['phone'] ?? '') ?>"
                            required
                        >

                    </div>

                </div>



                <!-- =================================
                     ORDER TYPE
                ================================== -->

                <div class="checkout-form-card">

                    <h2>
                        ORDER TYPE
                    </h2>


                    <div class="order-type-options">


                        <!-- DELIVERY -->

                        <label class="radio-option">

                            <input
                                type="radio"
                                name="order_type"
                                value="delivery"
                                checked
                            >

                            <span>
                                Delivery
                            </span>

                        </label>


                        <!-- PICKUP -->

                        <label class="radio-option">

                            <input
                                type="radio"
                                name="order_type"
                                value="pickup"
                            >

                            <span>
                                Pickup
                            </span>

                        </label>


                    </div>

                </div>



                <!-- =================================
                     DELIVERY ADDRESS
                ================================== -->

                <div class="checkout-form-card"
                     id="delivery-address-section">


                    <h2>
                        DELIVERY ADDRESS
                    </h2>


                    <!-- HOUSE / UNIT -->

                    <div class="checkout-form-group">

                        <label for="house-number">

                            House / Unit No.

                            <span class="optional-label">
                                (Optional)
                            </span>

                        </label>


                        <input
                            type="text"
                            id="house-number"
                            name="house_number"
                            placeholder="House or unit number (optional)"
                        >

                    </div>



                    <!-- STREET / PUROK -->

                    <div class="checkout-form-group">

                        <label for="street">
                            Street / Purok
                        </label>


                        <input
                            type="text"
                            id="street"
                            name="street"
                            placeholder="Street name"
                        >

                    </div>



                    <!-- BARANGAY -->

                    <div class="checkout-form-group">

                        <label for="barangay">
                            Barangay
                        </label>


                        <input
                            type="text"
                            id="barangay"
                            name="barangay"
                            placeholder="Barangay"
                        >

                    </div>



                    <!-- CITY -->

                    <div class="checkout-form-group">

                        <label for="city">
                            City
                        </label>


                        <input
                            type="text"
                            id="city"
                            name="city"
                            placeholder="City"
                        >

                    </div>



                    <!-- ORDER NOTES -->

                    <div class="checkout-form-group">

                        <label for="order-notes">
                            Order Notes
                        </label>


                        <textarea
                            id="order-notes"
                            name="order_notes"
                            placeholder="Special instructions (optional)"
                            rows="4"
                        ></textarea>

                    </div>


                </div>



                <!-- =================================
                     MODE OF PAYMENT
                ================================== -->

                <div class="checkout-form-card payment-card">


                    <h2>
                        MODE OF PAYMENT
                    </h2>


                    <div class="order-type-options">


                        <!-- CASH -->

                        <label class="radio-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="cash"
                                checked
                                required
                            >

                            <span>
                                Cash
                            </span>

                        </label>



                        <!-- ONLINE PAYMENT -->

                        <label class="radio-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="gcash"
                            >

                            <span>
                                Online Payment
                            </span>

                        </label>


                    </div>


                </div>



                <!-- =================================
                     PLACE ORDER
                ================================== -->

                <div class="checkout-place-order">


                    <button
                        type="submit"
                        id="place-order-btn"
                    >
                        PLACE ORDER
                    </button>


                </div>


            </form>


        </section>


    </main>



    <!-- =========================================
         JAVASCRIPT
    ========================================= -->

    <script src="script.js?v=2"
            defer>
    </script>


</body>

</html>