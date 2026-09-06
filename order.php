<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Now - La Mia Pizzeria</title>

    <link rel="stylesheet" href="style.css?v=7">
    <script src="script.js?v=2" defer></script>
</head>

<body class="order-page-body">

    <!-- =========================================
         HEADER
         ========================================= -->

    <header class="site-header">
        <div class="header-container">

            <!-- LOGO -->
            <a href="index.php" class="logo">
                <img src="images/logo-primary.png" alt="La Mia Pizzeria">
            </a>

            <!-- NAVIGATION -->
            <nav class="main-navigation">
                <a href="index.php">Home</a>
                <a href="index.php#about">Our Story</a>
                <a href="index.php#popular-pizza">Menu</a>
                <a href="index.php#location">Contact</a>
            </nav>

            <!-- LOGIN / REGISTER -->
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
         ORDERING PAGE
         ========================================= -->

    <main class="order-page">

        <!-- PAGE TITLE -->
        <section class="order-heading">
            <h1>ORDER YOUR PIZZA</h1>
            <p>Choose your favorite pizza and make your order.</p>
        </section>

        <!-- =========================================
             PIZZA ORDER GRID
             ========================================= -->

        <section class="pizza-order-grid">

            <!-- =====================================
                 PEPPERONI
                 ===================================== -->
            <div class="pizza-order-card">
                <div class="pizza-image-container">
                    <img src="images/pepperoni-pizza.jpg" alt="Pepperoni Pizza">
                </div>

                <div class="pizza-order-content">
                    <h2>Pepperoni</h2>

                    <p>
                        Classic pizza topped with rich tomato sauce,
                        mozzarella cheese, and delicious pepperoni.
                    </p>

                    <div class="pizza-price">₱399</div>

                    <div class="pizza-size">
                        <label for="pepperoni-size">Size:</label>

                        <select id="pepperoni-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="pizza-quantity">
                        <label>Quantity:</label>

                        <div class="quantity-control">
                            <button type="button">−</button>
                            <span>0</span>
                            <button type="button">+</button>
                        </div>
                    </div>

                    <div class="cart-message"></div>

                    <button type="button" class="add-cart-btn">
                        ADD TO CART
                    </button>
                </div>
            </div>

            <!-- =====================================
                 MARGHERITA
                 ===================================== -->
            <div class="pizza-order-card">
                <div class="pizza-image-container">
                    <img src="images/margherita-pizza.png" alt="Margherita Pizza">
                </div>

                <div class="pizza-order-content">
                    <h2>Margherita</h2>

                    <p>
                        A simple classic made with tomato sauce,
                        mozzarella cheese, and fresh basil.
                    </p>

                    <div class="pizza-price">₱349</div>

                    <div class="pizza-size">
                        <label for="margherita-size">Size:</label>

                        <select id="margherita-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="pizza-quantity">
                        <label>Quantity:</label>

                        <div class="quantity-control">
                            <button type="button">−</button>
                            <span>0</span>
                            <button type="button">+</button>
                        </div>
                    </div>

                    <div class="cart-message"></div>

                    <button type="button" class="add-cart-btn">
                        ADD TO CART
                    </button>
                </div>
            </div>

            <!-- =====================================
                 CREAMY SPINACH
                 ===================================== -->
            <div class="pizza-order-card">
                <div class="pizza-image-container">
                    <img src="images/creamy-spinach-pizza.png" alt="Creamy Spinach Pizza">
                </div>

                <div class="pizza-order-content">
                    <h2>Creamy Spinach</h2>

                    <p>
                        Creamy sauce, mozzarella cheese, and
                        flavorful spinach baked to perfection.
                    </p>

                    <div class="pizza-price">₱429</div>

                    <div class="pizza-size">
                        <label for="creamy-spinach-size">Size:</label>

                        <select id="creamy-spinach-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="pizza-quantity">
                        <label>Quantity:</label>

                        <div class="quantity-control">
                            <button type="button">−</button>
                            <span>0</span>
                            <button type="button">+</button>
                        </div>
                    </div>

                    <div class="cart-message"></div>

                    <button type="button" class="add-cart-btn">
                        ADD TO CART
                    </button>
                </div>
            </div>

            <!-- =====================================
                 NEW YORK STYLE
                 ===================================== -->
            <div class="pizza-order-card">
                <div class="pizza-image-container">
                    <img src="images/new-york-style-pizza.png" alt="New York Style Pizza">
                </div>

                <div class="pizza-order-content">
                    <h2>New York Style</h2>

                    <p>
                        Thin, foldable crust topped with tomato sauce
                        and generous mozzarella cheese.
                    </p>

                    <div class="pizza-price">₱449</div>

                    <div class="pizza-size">
                        <label for="new-york-size">Size:</label>

                        <select id="new-york-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="pizza-quantity">
                        <label>Quantity:</label>

                        <div class="quantity-control">
                            <button type="button">−</button>
                            <span>0</span>
                            <button type="button">+</button>
                        </div>
                    </div>

                    <div class="cart-message"></div>

                    <button type="button" class="add-cart-btn">
                        ADD TO CART
                    </button>
                </div>
            </div>

            <!-- =====================================
                 HAWAIIAN
                 ===================================== -->
            <div class="pizza-order-card">
                <div class="pizza-image-container">
                    <img src="images/hawaiian-pizza.png" alt="Hawaiian Pizza">
                </div>

                <div class="pizza-order-content">
                    <h2>Hawaiian</h2>

                    <p>
                        A sweet and savory favorite topped with
                        ham, pineapple, tomato sauce, and mozzarella cheese.
                    </p>

                    <div class="pizza-price">₱429</div>

                    <div class="pizza-size">
                        <label for="hawaiian-size">Size:</label>

                        <select id="hawaiian-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="pizza-quantity">
                        <label>Quantity:</label>

                        <div class="quantity-control">
                            <button type="button">−</button>
                            <span>0</span>
                            <button type="button">+</button>
                        </div>
                    </div>

                    <div class="cart-message"></div>

                    <button type="button" class="add-cart-btn">
                        ADD TO CART
                    </button>
                </div>
            </div>


            <!-- =====================================
                 EXTRAVAGANZZA
                 ===================================== -->
            <div class="pizza-order-card">
                <div class="pizza-image-container">
                    <img src="images/extravaganzza-pizza.png" alt="Extravaganzza Pizza">
                </div>

                <div class="pizza-order-content">
                    <h2>Extravaganzza</h2>

                    <p>
                        A loaded pizza packed with delicious toppings,
                        mozzarella cheese, and rich tomato sauce.
                    </p>

                    <div class="pizza-price">₱499</div>

                    <div class="pizza-size">
                        <label for="extravaganzza-size">Size:</label>

                        <select id="extravaganzza-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="pizza-quantity">
                        <label>Quantity:</label>

                        <div class="quantity-control">
                            <button type="button">−</button>
                            <span>0</span>
                            <button type="button">+</button>
                        </div>
                    </div>

                    <div class="cart-message"></div>

                    <button type="button" class="add-cart-btn">
                        ADD TO CART
                    </button>
                </div>
            </div>

            <!-- =====================================
                 CHEESE MANIA
                 ===================================== -->
            <div class="pizza-order-card">
                <div class="pizza-image-container">
                    <img src="images/cheese-mania-pizza.png" alt="Cheese Mania Pizza">
                </div>

                <div class="pizza-order-content">
                    <h2>Cheese Mania</h2>

                    <p>
                        A cheesy favorite covered with rich tomato sauce,
                        mozzarella cheese, and a generous cheese topping.
                        BSJIBSJBAJXJAXKLNWJ
                        KXNJSNJCBBSCJXNSXLK.
                        UUCBUCNKDKCWOIENVIWEN.
                    </p>

                    <div class="pizza-price">₱449</div>

                    <div class="pizza-size">
                        <label for="cheese-mania-size">Size:</label>

                        <select id="cheese-mania-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="pizza-quantity">
                        <label>Quantity:</label>

                        <div class="quantity-control">
                            <button type="button">−</button>
                            <span>0</span>
                            <button type="button">+</button>
                        </div>
                    </div>

                    <div class="cart-message"></div>

                    <button type="button" class="add-cart-btn">
                        ADD TO CART
                    </button>
                </div>
            </div>


            <!-- =====================================
                 SPINACH & GLAZED BACON
                 ===================================== -->
            <div class="pizza-order-card">
                <div class="pizza-image-container">
                    <img src="images/spinach-and-glazed-baconpizza.png" alt="Spinach and Glazed Bacon Pizza">
                </div>

                <div class="pizza-order-content">
                    <h2>Spinach &amp; Glazed Bacon</h2>

                    <p>
                        Flavorful spinach combined with glazed bacon,
                        mozzarella cheese, and a delicious pizza sauce.
                    </p>

                    <div class="pizza-price">₱459</div>

                    <div class="pizza-size">
                        <label for="spinach-bacon-size">Size:</label>

                        <select id="spinach-bacon-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="pizza-quantity">
                        <label>Quantity:</label>

                        <div class="quantity-control">
                            <button type="button">−</button>
                            <span>0</span>
                            <button type="button">+</button>
                        </div>
                    </div>

                    <div class="cart-message"></div>

                    <button type="button" class="add-cart-btn">
                        ADD TO CART
                    </button>
                </div>
            </div>

            <!-- =====================================
                 AMERICAN BACON & CHEESEBURGER
                 ===================================== -->
            <div class="pizza-order-card">
                <div class="pizza-image-container">
                    <img src="images/american-bacon-and-cheeseburger-pizza.png" alt="American Bacon and Cheeseburger Pizza">
                </div>

                <div class="pizza-order-content">
                    <h2>American Bacon &amp; Cheeseburger</h2>

                    <p>
                        A hearty combination of savory bacon,
                        cheeseburger-inspired toppings, tomato sauce, and cheese.
                    </p>

                    <div class="pizza-price">₱479</div>

                    <div class="pizza-size">
                        <label for="american-bacon-size">Size:</label>

                        <select id="american-bacon-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="pizza-quantity">
                        <label>Quantity:</label>

                        <div class="quantity-control">
                            <button type="button">-</button>
                            <span>0</span>
                            <button type="button">+</button>
                        </div>
                    </div>

                    <div class="cart-message"></div>

                    <button type="button" class="add-cart-btn">
                        ADD TO CART
                    </button>
                </div>
            </div>

        </section>
    </main>

</body>

</html>
