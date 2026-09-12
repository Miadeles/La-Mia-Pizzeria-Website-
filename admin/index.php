<?php

session_start();


// =========================================
// ADMIN LOGIN PROTECTION
// =========================================

if (
    !isset($_SESSION['admin_logged_in']) ||
    $_SESSION['admin_logged_in'] !== true
) {

    header('Location: login.php');

    exit;
}


// =========================================
// DATABASE CONNECTION
// =========================================

require '../database/config.php';


// =========================================
// DEFAULT DASHBOARD VALUES
// =========================================

$totalOrders = 0;
$pendingOrders = 0;
$preparingOrders = 0;
$outForDeliveryOrders = 0;
$completedOrders = 0;
$cancelledOrders = 0;
$totalCustomers = 0;

$databaseError = '';


// =========================================
// GET DASHBOARD DATA
// =========================================

try {

    $pdo = getConnection();


    // -----------------------------------------
    // TOTAL ORDERS
    // -----------------------------------------

    $stmt = $pdo->query("
        SELECT COUNT(*)
        FROM orders
    ");

    $totalOrders = (int) $stmt->fetchColumn();


    // -----------------------------------------
    // PENDING ORDERS
    // -----------------------------------------

    $stmt = $pdo->query("
        SELECT COUNT(*)
        FROM orders
        WHERE order_status = 'Pending'
    ");

    $pendingOrders = (int) $stmt->fetchColumn();


    // -----------------------------------------
    // PREPARING ORDERS
    // -----------------------------------------

    $stmt = $pdo->query("
        SELECT COUNT(*)
        FROM orders
        WHERE order_status = 'Preparing'
    ");

    $preparingOrders = (int) $stmt->fetchColumn();


    // -----------------------------------------
    // OUT FOR DELIVERY
    // -----------------------------------------

    $stmt = $pdo->query("
        SELECT COUNT(*)
        FROM orders
        WHERE order_status = 'Out for Delivery'
    ");

    $outForDeliveryOrders = (int) $stmt->fetchColumn();


    // -----------------------------------------
    // COMPLETED ORDERS
    // -----------------------------------------

    $stmt = $pdo->query("
        SELECT COUNT(*)
        FROM orders
        WHERE order_status = 'Completed'
    ");

    $completedOrders = (int) $stmt->fetchColumn();


    // -----------------------------------------
    // CANCELLED ORDERS
    // -----------------------------------------

    $stmt = $pdo->query("
        SELECT COUNT(*)
        FROM orders
        WHERE order_status = 'Cancelled'
    ");

    $cancelledOrders = (int) $stmt->fetchColumn();


    // -----------------------------------------
    // TOTAL CUSTOMERS
    // -----------------------------------------

    $stmt = $pdo->query("
        SELECT COUNT(*)
        FROM customers
    ");

    $totalCustomers = (int) $stmt->fetchColumn();


} catch (PDOException $e) {

    $databaseError =
        'Unable to load dashboard information.';

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
        Admin Dashboard - La Mia Pizzeria
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
                 DASHBOARD HEADER
            ================================== -->

            <div class="checkout-form-card">


                <h1>
                    ADMIN DASHBOARD
                </h1>


                <p>

                    Welcome,
                    <strong>
                        <?= htmlspecialchars(
                            $_SESSION['admin_username']
                            ?? 'Admin'
                        ) ?>
                    </strong>

                </p>


            </div>



            <!-- =================================
                 DATABASE ERROR
            ================================== -->

            <?php if ($databaseError !== ''): ?>


                <div class="checkout-form-card">

                    <p>
                        <?= htmlspecialchars($databaseError) ?>
                    </p>

                </div>


            <?php endif; ?>



            <!-- =================================
                 ORDER STATISTICS
            ================================== -->

            <div class="checkout-form-card">


                <h2>
                    ORDER OVERVIEW
                </h2>



                <!-- TOTAL ORDERS -->

                <div class="receipt-info-row">

                    <span>
                        Total Orders
                    </span>

                    <strong>
                        <?= $totalOrders ?>
                    </strong>

                </div>



                <!-- PENDING -->

                <div class="receipt-info-row">

                    <span>
                        Pending
                    </span>

                    <strong>
                        <?= $pendingOrders ?>
                    </strong>

                </div>



                <!-- PREPARING -->

                <div class="receipt-info-row">

                    <span>
                        Preparing
                    </span>

                    <strong>
                        <?= $preparingOrders ?>
                    </strong>

                </div>



                <!-- OUT FOR DELIVERY -->

                <div class="receipt-info-row">

                    <span>
                        Out for Delivery
                    </span>

                    <strong>
                        <?= $outForDeliveryOrders ?>
                    </strong>

                </div>



                <!-- COMPLETED -->

                <div class="receipt-info-row">

                    <span>
                        Completed
                    </span>

                    <strong>
                        <?= $completedOrders ?>
                    </strong>

                </div>



                <!-- CANCELLED -->

                <div class="receipt-info-row">

                    <span>
                        Cancelled
                    </span>

                    <strong>
                        <?= $cancelledOrders ?>
                    </strong>

                </div>


            </div>



            <!-- =================================
                 CUSTOMER STATISTICS
            ================================== -->

            <div class="checkout-form-card">


                <h2>
                    CUSTOMER OVERVIEW
                </h2>


                <div class="receipt-info-row">

                    <span>
                        Registered Customers
                    </span>


                    <strong>
                        <?= $totalCustomers ?>
                    </strong>

                </div>


            </div>



            <!-- =================================
                 MANAGE ORDERS
            ================================== -->

            <div class="checkout-form-card">


                <h2>
                    ORDER MANAGEMENT
                </h2>


                <p>
                    View customer orders and manage
                    their order status.
                </p>


                <div class="checkout-place-order">


                    <a
                        href="orders.php"
                        id="place-order-btn"
                    >
                        MANAGE ORDERS
                    </a>


                </div>


            </div>



            <!-- =================================
                 WEBSITE
            ================================== -->

            <div class="checkout-place-order">


                <a
                    href="../index.php"
                    id="place-order-btn"
                >
                    VIEW WEBSITE
                </a>


            </div>



            <!-- =================================
                 ADMIN LOGOUT
            ================================== -->

            <div class="checkout-place-order">


                <a
                    href="logout.php"
                    id="place-order-btn"
                >
                    ADMIN LOGOUT
                </a>


            </div>


        </section>


    </main>


</body>

</html>