<?php

session_start();


// =========================================
// CUSTOMER LOGIN PROTECTION
// =========================================

if (!isset($_SESSION['customer_id'])) {

    $_SESSION['redirect_after_login'] = 'profile.php';

    header('Location: login.php');

    exit;
}


// =========================================
// DATABASE CONNECTION
// =========================================

require 'database/config.php';


// =========================================
// DEFAULT VALUES
// =========================================

$message = '';
$error = '';

$customer = null;


// =========================================
// GET CUSTOMER INFORMATION
// =========================================

try {

    $pdo = getConnection();


    $sql = "
        SELECT
            id,
            username,
            email,
            phone
        FROM customers
        WHERE id = :customer_id
        LIMIT 1
    ";


    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(
        ':customer_id',
        $_SESSION['customer_id'],
        PDO::PARAM_INT
    );


    $stmt->execute();


    $customer =
        $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$customer) {

        session_destroy();

        header('Location: login.php');

        exit;
    }


} catch (PDOException $e) {

    $error =
        'Unable to load your profile information.';
}


// =========================================
// GET MESSAGE
// =========================================

if (isset($_GET['message'])) {

    $message =
        $_GET['message'];
}

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
        My Profile - La Mia Pizzeria
    </title>


    <link
        rel="stylesheet"
        href="style.css"
    >

</head>


<body class="cart-page-body">


    <main class="checkout-page">


        <section class="checkout-container">


            <!-- =================================
                 PAGE HEADER
            ================================== -->

            <div class="checkout-form-card">


                <h1>
                    MY PROFILE
                </h1>


                <p>
                    Manage your La Mia Pizzeria account information.
                </p>


            </div>



            <!-- =================================
                 MESSAGE
            ================================== -->

            <?php if ($message !== ''): ?>


                <div class="checkout-form-card">


                    <p>
                        <?= htmlspecialchars($message) ?>
                    </p>


                </div>


            <?php endif; ?>



            <!-- =================================
                 ERROR
            ================================== -->

            <?php if ($error !== ''): ?>


                <div class="checkout-form-card">


                    <p>
                        <?= htmlspecialchars($error) ?>
                    </p>


                </div>


            <?php endif; ?>



            <!-- =================================
                 PROFILE FORM
            ================================== -->

            <?php if ($customer): ?>


                <div class="checkout-form-card">


                    <h2>
                        ACCOUNT INFORMATION
                    </h2>


                    <form
                        action="update_profile.php"
                        method="POST"
                    >


                        <!-- USERNAME -->

                        <div class="checkout-form-group">


                            <label for="username">
                                Username
                            </label>


                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="<?= htmlspecialchars(
                                    $customer['username']
                                ) ?>"
                                required
                            >


                        </div>



                        <!-- EMAIL -->

                        <div class="checkout-form-group">


                            <label for="email">
                                Email
                            </label>


                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?= htmlspecialchars(
                                    $customer['email']
                                ) ?>"
                                required
                            >


                        </div>



                        <!-- PHONE -->

                        <div class="checkout-form-group">


                            <label for="phone">
                                Phone Number
                            </label>


                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="<?= htmlspecialchars(
                                    $customer['phone']
                                ) ?>"
                                required
                            >


                        </div>



                        <!-- SAVE -->

                        <div class="checkout-place-order">


                            <button
                                type="submit"
                                id="place-order-btn"
                            >
                                SAVE CHANGES
                            </button>


                        </div>


                    </form>


                </div>


            <?php endif; ?>



            <!-- =================================
                 NAVIGATION
            ================================== -->

            <div class="checkout-place-order">


                <a
                    href="my_orders.php"
                    id="place-order-btn"
                >
                    MY ORDERS
                </a>


            </div>



            <div class="checkout-place-order">


                <a
                    href="index.php"
                    id="place-order-btn"
                >
                    BACK TO HOME
                </a>


            </div>


        </section>


    </main>


</body>

</html>