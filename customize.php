<?php

session_start();

if (!isset($_SESSION['customer_id'])) {

    $_SESSION['redirect_after_login'] = 'customize.php';

    header(
        'Location: login.php?status=error&message=' .
        urlencode('Please login first before customizing a pizza.')
    );

    exit;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customize Your Pizza - La Mia Pizzeria</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="style.css?v=8">

    <script src="script.js?v=3" defer></script>

</head>


<body class="order-page-body">


    <!-- =========================================
         HEADER
         ========================================= -->

    <header class="site-header">

        <div class="header-container">


            <!-- LOGO -->

            <a href="index.php" class="logo">

                <img
                    src="images/logo-primary.png"
                    alt="La Mia Pizzeria"
                >

            </a>


            <!-- NAVIGATION -->

            <nav class="main-navigation">

                <a href="index.php">Home</a>

                <a href="index.php#about">Our Story</a>

                <a href="index.php#menu">Menu</a>

                <a href="index.php#contact">Contact</a>

            </nav>


            <!-- LOGIN / CART / REGISTER -->

            <div class="auth-buttons">


                <a href="cart.php" class="btn cart-btn">
                    🛒 Cart
                </a>


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
         CUSTOMIZATION PAGE
         ========================================= -->

    <main class="custom-pizza-page">


        <!-- PAGE HEADING -->

        <section class="custom-pizza-heading">

            <h1>CUSTOMIZE YOUR PIZZA</h1>

            <p>
                Create your pizza, your way!
                Choose your favorite size, sauces, cheese,
                and toppings.
            </p>

        </section>



        <!-- =========================================
             CUSTOMIZATION CONTAINER
             ========================================= -->

        <section class="custom-pizza-container">


            <!-- =====================================
                 LEFT SIDE - CUSTOMIZATION OPTIONS
                 ===================================== -->

            <div class="custom-pizza-options">


                <!-- =================================
                     PIZZA SIZE
                     ================================= -->

                <div class="custom-section">

                    <h2>Pizza Size</h2>

                    <p class="custom-help">
                        Choose your pizza size.
                    </p>


                    <div class="size-options">


                        <label class="size-option">

                            <input
                                type="radio"
                                name="custom-size"
                                value="small"
                                data-price="230"
                                checked
                            >

                            <span>

                                Small

                                <strong>₱230</strong>

                            </span>

                        </label>


                        <label class="size-option">

                            <input
                                type="radio"
                                name="custom-size"
                                value="medium"
                                data-price="300"
                            >

                            <span>

                                Medium

                                <strong>₱300</strong>

                            </span>

                        </label>


                        <label class="size-option">

                           <input
                                type="radio"
                                name="custom-size"
                                value="large"
                                data-price="369"
                            >

                            <span>

                                Large

                                <strong>₱369</strong>

                            </span>

                        </label>


                    </div>

                </div>



                <!-- =================================
                     SAUCES
                     ================================= -->

                <div class="custom-section">

                    <h2>Sauces</h2>

                    <p class="custom-help">
                        Choose one sauce.
                    </p>


                    <div class="custom-options">


                        <label>

                            <input
                                type="radio"
                                name="custom-sauce"
                                value="Tomato Sauce"
                                data-price="0"
                                checked
                            >

                            <span>
                                Tomato Sauce
                                <strong>Included</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="radio"
                                name="custom-sauce"
                                value="White Cream Sauce"
                                data-price="30"
                            >

                            <span>
                                White Cream Sauce
                                <strong>+₱30</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="radio"
                                name="custom-sauce"
                                value="BBQ Sauce"
                                data-price="30"
                            >

                            <span>
                                BBQ Sauce
                                <strong>+₱30</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="radio"
                                name="custom-sauce"
                                value="Pesto Sauce"
                                data-price="40"
                            >

                            <span>
                                Pesto Sauce
                                <strong>+₱40</strong>
                            </span>

                        </label>


                    </div>

                </div>



                <!-- =================================
                     CHEESE
                     ================================= -->

                <div class="custom-section">

                    <h2>Cheese</h2>

                    <p class="custom-help">
                        Choose as many as you like.
                    </p>


                    <div class="custom-options">


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Mozzarella"
                                data-price="0"
                                checked
                            >

                            <span>
                                Mozzarella
                                <strong>Included</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Cheddar"
                                data-price="40"
                            >

                            <span>
                                Cheddar
                                <strong>+₱40</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Parmesan"
                                data-price="40"
                            >

                            <span>
                                Parmesan
                                <strong>+₱40</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Extra Mozzarella"
                                data-price="50"
                            >

                            <span>
                                Extra Mozzarella
                                <strong>+₱50</strong>
                            </span>

                        </label>


                    </div>

                </div>



                <!-- =================================
                     VEGGIES
                     ================================= -->

                <div class="custom-section">

                    <h2>Veggies</h2>

                    <p class="custom-help">
                        Choose your favorite vegetables.
                    </p>


                    <div class="custom-options">


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Bell Pepper"
                                data-price="25"
                            >

                            <span>
                                Bell Pepper
                                <strong>+₱25</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Onion"
                                data-price="20"
                            >

                            <span>
                                Onion
                                <strong>+₱20</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Black Olives"
                                data-price="30"
                            >

                            <span>
                                Black Olives
                                <strong>+₱30</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Spinach"
                                data-price="30"
                            >

                            <span>
                                Spinach
                                <strong>+₱30</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Tomatoes"
                                data-price="20"
                            >

                            <span>
                                Tomatoes
                                <strong>+₱20</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Corn"
                                data-price="25"
                            >

                            <span>
                                Corn
                                <strong>+₱25</strong>
                            </span>

                        </label>


                    </div>

                </div>



                <!-- =================================
                     MUSHROOMS
                     ================================= -->

                <div class="custom-section">

                    <h2>Mushrooms</h2>


                    <div class="custom-options">


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Button Mushrooms"
                                data-price="30"
                            >

                            <span>
                                Button Mushrooms
                                <strong>+₱30</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Extra Mushrooms"
                                data-price="40"
                            >

                            <span>
                                Extra Mushrooms
                                <strong>+₱40</strong>
                            </span>

                        </label>


                    </div>

                </div>



                <!-- =================================
                     MEATS
                     ================================= -->

                <div class="custom-section">

                    <h2>Meats</h2>

                    <p class="custom-help">
                        Add your favorite meats.
                    </p>


                    <div class="custom-options">


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Pepperoni"
                                data-price="50"
                            >

                            <span>
                                Pepperoni
                                <strong>+₱50</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Bacon"
                                data-price="50"
                            >

                            <span>
                                Bacon
                                <strong>+₱50</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Ham"
                                data-price="45"
                            >

                            <span>
                                Ham
                                <strong>+₱45</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Sausage"
                                data-price="50"
                            >

                            <span>
                                Sausage
                                <strong>+₱50</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Beef"
                                data-price="60"
                            >

                            <span>
                                Beef
                                <strong>+₱60</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Chicken"
                                data-price="55"
                            >

                            <span>
                                Chicken
                                <strong>+₱55</strong>
                            </span>

                        </label>


                    </div>

                </div>



                <!-- =================================
                     MORE TOPPINGS
                     ================================= -->

                <div class="custom-section">

                    <h2>More Toppings</h2>


                    <div class="custom-options">


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Pineapple"
                                data-price="25"
                            >

                            <span>
                                Pineapple
                                <strong>+₱25</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Jalapeño"
                                data-price="25"
                            >

                            <span>
                                Jalapeño
                                <strong>+₱25</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Garlic"
                                data-price="20"
                            >

                            <span>
                                Garlic
                                <strong>+₱20</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Extra Tomato"
                                data-price="20"
                            >

                            <span>
                                Extra Tomato
                                <strong>+₱20</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Basil"
                                data-price="20"
                            >

                            <span>
                                Basil
                                <strong>+₱20</strong>
                            </span>

                        </label>


                        <label>

                            <input
                                type="checkbox"
                                name="custom-topping"
                                value="Extra Sauce"
                                data-price="30"
                            >

                            <span>
                                Extra Sauce
                                <strong>+₱30</strong>
                            </span>

                        </label>


                    </div>

                </div>


            </div>



            <!-- =====================================
                 RIGHT SIDE - ORDER SUMMARY
                 ===================================== -->

            <aside class="custom-pizza-summary">


                <h2>YOUR CUSTOM PIZZA</h2>


                <div class="custom-summary-line">

                    <span>Size</span>

                    <strong id="custom-summary-size">
                        Small
                    </strong>

                </div>


                <div class="custom-summary-line">

                    <span>Sauce</span>

                    <strong id="custom-summary-sauce">
                        Tomato Sauce
                    </strong>

                </div>


                <div class="custom-summary-line">

                    <span>Toppings</span>

                    <strong id="custom-summary-toppings">
                        None
                    </strong>

                </div>


                <div class="custom-summary-divider"></div>


                <div class="custom-total">

                    <span>TOTAL</span>

                    <strong id="custom-total">
                        ₱230
                    </strong>

                </div>


                <!-- QUANTITY -->

                <div class="custom-quantity">

                    <label>Quantity:</label>


                    <div class="quantity-control">

                        <button
                            type="button"
                            id="custom-minus"
                        >
                            −
                        </button>


                        <span id="custom-quantity">
                            1
                        </span>


                        <button
                            type="button"
                            id="custom-plus"
                        >
                            +
                        </button>

                    </div>

                </div>


                <!-- ADD TO CART -->

                <button
                    type="button"
                    class="custom-add-cart-btn"
                    id="custom-add-cart"
                >
                    ADD CUSTOM PIZZA TO CART
                </button>


                <div
                    class="custom-cart-message"
                    id="custom-cart-message"
                ></div>


            </aside>


        </section>


    </main>


</body>

</html>