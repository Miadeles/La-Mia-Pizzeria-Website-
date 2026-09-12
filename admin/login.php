<?php

session_start();


// =========================================
// IF ADMIN IS ALREADY LOGGED IN
// =========================================

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {

    header('Location: index.php');
    exit;

}


// =========================================
// GET LOGIN MESSAGE
// =========================================

$message = $_GET['message'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Admin Login - La Mia Pizzeria
    </title>

    <link
        rel="stylesheet"
        href="../style.css?v=7"
    >

</head>


<body class="cart-page-body">


    <main class="checkout-page">


        <section class="checkout-container">


            <!-- =================================
                 ADMIN LOGIN CARD
            ================================== -->

            <div class="checkout-form-card">


                <h1>
                    ADMIN LOGIN
                </h1>


                <p>
                    Login to manage La Mia Pizzeria orders.
                </p>



                <!-- =================================
                     ERROR MESSAGE
                ================================== -->

                <?php if ($message !== ''): ?>

                    <p>
                        <?= htmlspecialchars($message) ?>
                    </p>

                <?php endif; ?>



                <!-- =================================
                     LOGIN FORM
                ================================== -->

                <form
                    action="login_process.php"
                    method="POST"
                >


                    <!-- USERNAME -->

                    <div class="checkout-form-group">

                        <label for="admin_username">
                            Username
                        </label>

                        <input
                            type="text"
                            id="admin_username"
                            name="admin_username"
                            required
                            autocomplete="username"
                        >

                    </div>



                    <!-- PASSWORD -->

                    <div class="checkout-form-group">

                        <label for="admin_password">
                            Password
                        </label>

                        <input
                            type="password"
                            id="admin_password"
                            name="admin_password"
                            required
                            autocomplete="current-password"
                        >

                    </div>



                    <!-- LOGIN BUTTON -->

                    <div class="checkout-place-order">

                        <button
                            type="submit"
                            id="place-order-btn"
                            name="admin_login"
                        >
                            LOGIN
                        </button>

                    </div>


                </form>


            </div>



            <!-- =================================
                 BACK TO WEBSITE
            ================================== -->

            <div class="checkout-place-order">

                <a
                    href="../index.php"
                    id="place-order-btn"
                >
                    BACK TO WEBSITE
                </a>

            </div>


        </section>


    </main>


</body>

</html>