<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Mia Pizzeria</title>

    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- HEADER -->
    <header class="site-header">

        <div class="header-container">

            <!-- PRIMARY LOGO -->
            <a href="#home" class="logo">
             <img src="images/logo-primary.png" alt="La Mia Pizzeria">
            </a>

            <!-- NAVIGATION -->
             <nav class="main-navigation">
             <a href="#home">Home</a>
             <a href="#about">Our Story</a>
             <a href="#menu">Menu</a>
                <a href="#contact">Contact</a>
            </nav>

         <!-- LOGIN / REGISTER -->
            <div class="auth-buttons">

                <a href="#login" class="btn login-btn">
                  <span class="login-icon">👤</span>
                  Login
                </a>

                <a href="#register" class="btn register-btn">
                    <span class="register-icon">👤</span>
                  Register
                </a>

            </div>

        </div>

    </header>

    <!-- ========================================
     HERO / BANNER
    ========================================= -->

    <section class="hero">

        <!-- BANNER BACKGROUND -->
        <img src="images/banner.png"
         alt="La Mia Pizzeria"
         class="banner-image">

        <!-- ORDER NOW BUTTON -->
        <a href="#menu" class="order-now-button">
            ORDER NOW
         <span class="arrow">➜</span>
        </a>


    </section>

      <!-- =========================================
      ABOUT LA MIA PIZZERIA
      ========================================= -->

        <section class="about-section" id="about">

            <div class="about-content">

                <h2>ABOUT LA MIA PIZZERIA</h2>

                <div class="about-subtitle">
                    Freshly crafted with love <span>🍃</span>
                </div>

                <p>
                     La Mia Pizzeria is a local pick-up and delivery pizza business founded by a young girl from Dumaguete City, Negros Oriental, who dreamed of creating a pizza brand that combines her love for good food, creativity, and the joy of sharing meals with others. Inspired by her name, Mia, and the Bisaya expression "Lami-a!", meaning delicious, La Mia Pizzeria was created with the idea of serving flavorful and satisfying pizzas that customers can conveniently enjoy at home. What began as a small personal dream grew into a pizza business focused on freshly prepared pizzas, quality ingredients, and convenient ordering. Through its pick-up and delivery service, La Mia Pizzeria aims to bring a warm and enjoyable pizza experience to the local community—one delicious slice at a time.
                </p>

            </div>

        </section>


        <!-- =========================================
        POPULAR PIZZA
        ========================================= -->

        <section class="popular-pizza-section" id="menu">

            <div class="popular-pizza-content">

                <h2>POPULAR PIZZA</h2>

                    <div class="pizza-grid">

                        <!-- 1. PEPPERONI -->
                        <div class="pizza-card">
                         <img src="images/pepperoni-pizza.jpg" alt="Pepperoni Pizza">
                        <div class="pizza-name">PEPPERONI PIZZA</div>
                    </div>

                        <!-- 2. MARGHERITA -->
                        <div class="pizza-card">
                          <img src="images/margherita-pizza.png" alt="Margherita Pizza">
                        <div class="pizza-name">MARGHERITA PIZZA</div>
                    </div>

                        <!-- 3. CREAMY SPINACH -->
                        <div class="pizza-card">
                          <img src="images/creamy-spinach-pizza.png" alt="Creamy Spinach Pizza">
                        <div class="pizza-name">CREAMY SPINACH PIZZA</div>
                    </div>

                       <!-- 4. NEW YORK STYLE -->
                       <div class="pizza-card">
                         <img src="images/new-york-style-pizza.png" alt="New York Style Pizza">
                       <div class="pizza-name">NEW YORK STYLE PIZZA</div>
                    </div>

                       <!-- 5. HAWAIIAN -->
                       <div class="pizza-card">
                         <img src="images/hawaiian-pizza.png" alt="Hawaiian Pizza">
                       <div class="pizza-name">HAWAIIAN PIZZA</div>
                    </div>

                       <!-- 6. SPINACH & GLAZED BACON -->
                       <div class="pizza-card">
                         <img src="images/spinach-and-glazed-baconpizza.png" alt="Spinach and Glazed Bacon Pizza">
                       <div class="pizza-name">SPINACH & GLAZED BACON PIZZA</div>
                    </div>

                       <!-- 7. EXTRAVAGANZZA -->
                       <div class="pizza-card">
                         <img src="images/extravaganzza-pizza.png" alt="Extravaganzza Pizza">
                       <div class="pizza-name">EXTRAVAGANZZA PIZZA</div>
                    </div>
   
                        <!-- 8. CHEESE MANIA -->
                        <div class="pizza-card">
                         <img src="images/cheese-mania-pizza.png" alt="Cheese Mania Pizza">
                        <div class="pizza-name">CHEESE MANIA PIZZA</div>
                    </div>

                        <!-- 9. AMERICAN BACON & CHEESEBURGER -->
                        <div class="pizza-card">
                         <img src="images/american-bacon-and-cheeseburger-pizza.png" alt="American Bacon and Cheeseburger Pizza">
                        <div class="pizza-name">AMERICAN BACON & CHEESEBURGER PIZZA</div>
                     </div>

                </div>

            </div>

        </section>


        <!-- =========================================
        LA MIA PIZZERIA TIMELINE
        ========================================= -->

        <section class="timeline-section" id="timeline">

            <div class="timeline-content">

                <!-- TITLE -->
                <h2>LA MIA PIZZERIA</h2>

                <!-- SUBTITLE -->
                <p class="timeline-intro">
                  A JOURNEY BUILT AROUND GOOD PIZZA,<br>
                  FLAVORFUL, AND SHARED MOMENTS.
                </p>


                <!-- =========================================
                TIMELINE
                ========================================= -->

            <div class="timeline">


            <!-- =====================================
                 1. THE BEGINNING — LEFT
            ====================================== -->

            <div class="timeline-item left">

                <div class="timeline-card">

                    <img
                        src="images/timeline-beginning.png"
                        alt=""
                        class="timeline-frame"
                    >

                    <div class="timeline-text">

                        <div class="timeline-year">
                            2025
                        </div>

                        <div class="timeline-title">
                            THE BEGINNING
                        </div>

                        <p>
                            La Mia Pizzeria is founded in
                            Dumaguete City with a simple
                            vision: to serve delicious pizza
                            through convenient pick-up
                            and delivery services.
                        </p>

                    </div>

                </div>

            </div>


            <!-- =====================================
                 2. ONLINE ORDERING — RIGHT
            ====================================== -->

            <div class="timeline-item right timeline-item-2">

                <div class="timeline-card">

                    <img
                        src="images/timeline-online-ordering.png"
                        alt=""
                        class="timeline-frame"
                    >

                    <div class="timeline-text">

                        <div class="timeline-year">
                            2025
                        </div>

                        <div class="timeline-title">
                            ONLINE ORDERING
                        </div>

                        <p>
                            We launch our online ordering
                            system, making it easier for
                            customers to browse the menu,
                            customize their pizza, and
                            place orders anytime.
                        </p>

                    </div>

                </div>

            </div>


            <!-- =====================================
                 3. GROWING THE MENU — LEFT
            ====================================== -->

            <div class="timeline-item left timeline-item-3">

                <div class="timeline-card">

                    <img
                        src="images/timeline-growing-menu.png"
                        alt=""
                        class="timeline-frame"
                    >

                    <div class="timeline-text">

                        <div class="timeline-year">
                            2025
                        </div>

                        <div class="timeline-title">
                            GROWING THE MENU
                        </div>

                        <p>
                            We introduce new pizza flavors,
                            sizes and customizable toppings
                            to give our customers more
                            choices and a more personalized
                            pizza experience.
                        </p>

                    </div>

                </div>

            </div>


            <!-- =====================================
                 4. EXPANDING DELIVERY — RIGHT
            ====================================== -->

            <div class="timeline-item right timeline-item-4">

                <div class="timeline-card">

                    <img
                        src="images/timeline-expanding-delivery.png"
                        alt=""
                        class="timeline-frame"
                    >

                    <div class="timeline-text">

                        <div class="timeline-year">
                            2026
                        </div>

                        <div class="timeline-title">
                            EXPANDING DELIVERY
                        </div>

                        <p>
                            Our delivery service expands to
                            reach more customers across
                            Dumaguete and nearby areas,
                            bringing La Mia Pizzeria closer
                            to more pizza lovers.
                        </p>

                    </div>

                </div>

            </div>


            <!-- =====================================
                 5. GROWING LOCAL BRAND — LEFT
            ====================================== -->

            <div class="timeline-item left timeline-item-5">

                <div class="timeline-card">

                    <img
                        src="images/timeline-growing-local-brand.png"
                        alt=""
                        class="timeline-frame"
                    >

                    <div class="timeline-text">

                        <div class="timeline-year">
                            2026
                        </div>

                        <div class="timeline-title">
                            A GROWING LOCAL BRAND
                        </div>

                        <p>
                            La Mia Pizzeria continues to grow
                            as a trusted local brand known
                            for delicious pizza, quality service,
                            and our warm, local identity.
                        </p>

                    </div>

                </div>

            </div>


        </div>

    </div>


        <!-- =========================================
            PIZZA CUSTOMIZATION SECTION
        ========================================= -->

    <section class="pizza-customization-section" id="customize">

        <!-- BACKGROUND DESIGN -->
         <img
         src="images/pizza-customization-bg.png"
         alt="Pizza customization"
         class="pizza-customization-bg"
        >


        <!-- =========================================
            LEFT-SIDE TEXT
        ========================================== -->

        <div class="customization-content">

            <!-- SMALL HEADING -->
            <div class="customize-small-title">
             CUSTOMIZE YOUR
            </div>


            <!-- MAIN TITLE -->
            <div class="customize-main-title">
                PIZZA
            </div>


            <!-- GREEN BANNER TEXT -->
            <div class="customize-sunday">
                EVERY SUNDAY
            </div>


            <!-- DESCRIPTION -->
            <p class="customize-description">
                Create your pizza, your way! Choose your<br>
                favorite toppings, sauces, and cheese<br>
                combinations and make it <span>uniquely yours.</span>
            </p>


            <!-- =========================================
                CATEGORY LABELS
            ========================================== -->

            <div class="customize-categories">

                <div class="customize-category">
                    <span>&nbsp;&nbsp;SAUCES</span>
                </div>

                <div class="customize-category">
                    <span>&nbsp;&nbsp;CHEESE</span>
                </div>

                <div class="customize-category">
                    <span>VEGGIES</span>
                </div>

                <div class="customize-category">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;MUSHROOMS</span>
                </div>

                <div class="customize-category">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;MEATS</span>
                </div>

                <div class="customize-category">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MORE TOPPINGS</span>
                </div>

            </div>


            <!-- =========================================
                CUSTOMIZE BUTTON
            ========================================== -->

            <button class="customize-button" type="button">
                <span>CUSTOMIZE NOW</span>
                <span class="customize-arrow">›</span>
            </button>

        </div>


        <!-- =========================================
            RIGHT-SIDE TEXT
        ========================================== -->

        <div class="customize-right-text">

            <div>Make it</div>
            <div>yours!</div>

        </div>


    </section>


    <!-- =========================================
     FIND US / LOCATION SECTION
    ========================================= -->

    <section class="location-section" id="contact">

            <!-- BACKGROUND DESIGN -->
            <img
            src="images/location-backdesign.png"
            alt=""
                class="location-background"
            >

            <!-- LOCATION CONTENT -->
            <div class="location-content">

            <!-- MAIN TITLE -->
            <h2>FIND US</h2>

            <p class="location-subtitle">
                Come visit La Mia Pizzeria
            </p>


            <!-- LOCATION TITLE -->
            <h3>OUR LOCATION</h3>


            <!-- TWO-COLUMN CONTENT -->
            <div class="location-container">


                <!-- LEFT: MAP / LOCATION PHOTO -->
                <div class="location-map">

                    <img
                        src="images/location-photo.png"
                        alt="La Mia Pizzeria Location"
                    >

                </div>


                <!-- RIGHT: INFORMATION CARD -->
                <div class="location-info">


                    <!-- FIND US -->
                    <div class="location-info-item">

                        <div class="location-icon">
                            📍
                        </div>

                        <div>
                            <h4>FIND US</h4>

                            <p>
                                La Mia Pizzeria<br>
                                Dumaguete City,<br>
                                Negros Oriental<br>
                                Philippines
                            </p>
                        </div>

                    </div>


                    <!-- DIVIDER -->
                    <div class="location-divider"></div>


                    <!-- CONTACT -->
                    <div class="location-info-item">

                        <div class="location-icon">
                            📞
                        </div>

                        <div>
                            <h4>CONTACT</h4>

                            <p>
                                0962 890 7902<br>
                                lamia.pizzeria@gmail.com
                            </p>
                        </div>

                    </div>


                    <!-- DIVIDER -->
                    <div class="location-divider"></div>


                    <!-- OPENING HOURS -->
                    <div class="location-info-item">

                        <div class="location-icon">
                            🕒
                        </div>

                        <div>
                            <h4>OPENING HOURS</h4>

                            <p>
                                Monday - Sunday<br>
                                9:00 AM - 8:00 PM
                            </p>
                        </div>

                    </div>


                    <!-- DIVIDER -->
                    <div class="location-divider"></div>


                    <!-- GET DIRECTIONS BUTTON -->
                    <a href="#" class="directions-button">
                        <span>➤</span>
                        GET DIRECTIONS
                        <strong>→</strong>
                    </a>


                </div>

            </div>

        </div>

    </section>



    <!-- =========================================
     FOOTER
    ========================================= -->

    <footer class="footer">

        <div class="footer-content">

            <!-- =========================================
                LA MIA PIZZERIA
            ========================================== -->

            <div class="footer-brand">

                <h2>LA MIA PIZZERIA</h2>

                <p class="footer-tagline">
                    Freshly crafted with love
                </p>

                <img
                    src="images/flag-of-the-philippines.webp"
                    alt="Philippines Flag"
                    class="philippines-flag"
                >

            </div>


            <!-- =========================================
                FOLLOW US
            ========================================== -->

            <div class="footer-follow">

                <h3>FOLLOW US</h3>

                <p class="footer-small-text">
                    Stay connected with us!
                </p>


                <!-- FACEBOOK -->

                <div class="social-link">

                    <img
                        src="images/facebook-logo.png"
                        alt="Facebook"
                    >

                    <span>La Mia Pizzeria</span>

                </div>


            <!-- INSTAGRAM -->

            <div class="social-link">

                <img
                    src="images/instagram-logo.webp"
                    alt="Instagram"
                >

                <span>@lamia.pizzeria</span>

            </div>


            <!-- TIKTOK -->

            <div class="social-link">

                <img
                    src="images/tiktok-logo.webp"
                    alt="TikTok"
                >

                <span>@lamiapizzeria</span>

            </div>

        </div>


            <!-- =========================================
                QUICK LINKS
            ========================================== -->

            <div class="footer-links">

                <h3>QUICK LINKS</h3>

                <a href="#home">Home</a>
                <a href="#story">Our Story</a>
                <a href="#menu">Menu</a>
                <a href="#order">Order Now</a>
                <a href="#location">Location</a>

            </div>


            <!-- =========================================
                CONTACT US
            ========================================== -->

            <div class="footer-contact">

                <h3>CONTACT US</h3>


                <div class="contact-row">

                    <span class="contact-icon">☎</span>

                    <span>0962 890 7902</span>

                </div>


                <div class="contact-row">

                    <span class="contact-icon">✉</span>

                    <span>lamia.pizzeria@gmail.com</span>

                </div>


                <div class="contact-row location-row">

                    <span class="contact-icon">⌖</span>

                    <span>
                        Dumaguete City,<br>
                        Negros Oriental, Philippines
                    </span>

                </div>

            </div>

        </div>


        <!-- =========================================
            COPYRIGHT
        ========================================== -->

        <div class="footer-bottom">

            <p>
                © 2026 La Mia Pizzeria. All Rights Reserved.
            </p>

        </div>

    </footer>


</body>
</html>