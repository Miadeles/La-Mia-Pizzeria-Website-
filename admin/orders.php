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
    // GET ALL ORDERS
    // =========================================

    $orders = [];

    $databaseError = '';


    try {

        $pdo = getConnection();


        $sql = "
            SELECT
                id,
                order_number,
                full_name,
                phone,
                order_type,
                payment_method,
                total_amount,
                order_status,
                created_at
            FROM orders
            ORDER BY created_at DESC
        ";


        $stmt = $pdo->query($sql);


        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $e) {

        $databaseError =
            'Unable to load orders. Please try again later.';

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
        Manage Orders - La Mia Pizzeria
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
                PAGE HEADER
            ================================== -->

            <div class="checkout-form-card">


                <h1>
                    MANAGE ORDERS
                </h1>


                <p>
                    View and manage all customer orders.
                </p>


            </div>


            <!-- =================================
                DATABASE ERROR
            ================================== -->

            <?php if ($databaseError !== ''): ?>


                <div class="checkout-form-card">


                    <p>
                        <?= htmlspecialchars(
                            $databaseError
                        ) ?>
                    </p>


                </div>


            <?php endif; ?>


            <!-- =================================
                NO ORDERS
            ================================== -->

            <?php if (
                $databaseError === '' &&
                empty($orders)
            ): ?>


                <div class="checkout-form-card">


                    <h2>
                        NO ORDERS
                    </h2>


                    <p>
                        There are currently no customer
                        orders.
                    </p>


                </div>


            <?php endif; ?>


            <!-- =================================
                ORDER LIST
            ================================== -->

            <?php foreach ($orders as $order): ?>


                <div class="checkout-form-card my-order-card">


                    <!-- ORDER NUMBER -->

                    <div class="receipt-info-row">


                        <span>
                            Order Number
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                $order['order_number']
                            ) ?>

                        </strong>


                    </div>


                    <!-- CUSTOMER -->

                    <div class="receipt-info-row">


                        <span>
                            Customer
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                $order['full_name']
                            ) ?>

                        </strong>


                    </div>


                    <!-- PHONE -->

                    <div class="receipt-info-row">


                        <span>
                            Phone
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                $order['phone']
                            ) ?>

                        </strong>


                    </div>


                    <!-- ORDER TYPE -->

                    <div class="receipt-info-row">


                        <span>
                            Order Type
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                ucfirst(
                                    $order['order_type']
                                )
                            ) ?>

                        </strong>


                    </div>


                    <!-- PAYMENT -->

                    <div class="receipt-info-row">


                        <span>
                            Payment
                        </span>


                        <strong>


                            <?php if (
                                $order['payment_method']
                                === 'cash'
                            ): ?>

                                Cash

                            <?php else: ?>

                                Online Payment

                            <?php endif; ?>


                        </strong>


                    </div>


                    <!-- TOTAL -->

                    <div class="receipt-info-row">


                        <span>
                            Total
                        </span>


                        <strong>

                            ₱<?= number_format(
                                (float)
                                $order['total_amount'],
                                2
                            ) ?>

                        </strong>


                    </div>


                    <!-- STATUS -->

                    <div class="receipt-info-row">


                        <span>
                            Status
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                $order['order_status']
                            ) ?>

                        </strong>


                    </div>


                    <!-- DATE -->

                    <div class="receipt-info-row">


                        <span>
                            Date
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                date(
                                    'F j, Y g:i A',
                                    strtotime(
                                        $order['created_at']
                                    )
                                )
                            ) ?>

                        </strong>


                    </div>


                    <!-- VIEW ORDER -->

                    <div class="checkout-place-order">


                        <a
                            href="order_details.php?id=<?= (int) $order['id'] ?>"
                            id="place-order-btn"
                        >
                            VIEW ORDER
                        </a>


                    </div>


                </div>


            <?php endforeach; ?>



            <!-- =================================
                BACK TO DASHBOARD
            ================================== -->

            <div class="checkout-place-order">


                <a
                    href="index.php"
                    id="place-order-btn"
                >
                    BACK TO DASHBOARD
                </a>


            </div>


        </section>


    </main>


</body>
</html>