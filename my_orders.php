<?php

session_start();


// =========================================
// LOGIN PROTECTION
// =========================================

if (!isset($_SESSION['customer_id'])) {

    $_SESSION['redirect_after_login'] = 'my_orders.php';

    header(
        'Location: login.php?status=error&message=' .
        urlencode('Please login first to view your orders.')
    );

    exit;
}


// =========================================
// DATABASE CONNECTION
// =========================================

require 'database/config.php';


// =========================================
// GET LOGGED-IN CUSTOMER ID
// =========================================

$customerId = (int) $_SESSION['customer_id'];


// =========================================
// GET CUSTOMER ORDERS
// =========================================

try {

    $pdo = getConnection();


    $sql = "
        SELECT
            id,
            order_number,
            order_type,
            payment_method,
            total_amount,
            order_status,
            created_at
        FROM orders
        WHERE customer_id = :customer_id
        ORDER BY created_at DESC
    ";


    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(
        ':customer_id',
        $customerId,
        PDO::PARAM_INT
    );


    $stmt->execute();


    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {

    $orders = [];

    $databaseError =
        'Unable to load your orders. Please try again later.';

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
        My Orders - La Mia Pizzeria
    </title>


    <link
        rel="stylesheet"
        href="style.css?v=7"
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
                    MY ORDERS
                </h1>


                <p>
                    View your previous orders from
                    La Mia Pizzeria.
                </p>


            </div>



            <!-- =================================
                 DATABASE ERROR
            ================================== -->

            <?php if (isset($databaseError)): ?>


                <div class="checkout-form-card">


                    <p>
                        <?= htmlspecialchars($databaseError) ?>
                    </p>


                </div>


            <?php endif; ?>



            <!-- =================================
                 NO ORDERS
            ================================== -->

            <?php if (
                !isset($databaseError) &&
                empty($orders)
            ): ?>


                <div class="checkout-form-card">


                    <h2>
                        NO ORDERS YET
                    </h2>


                    <p>
                        You have not placed any orders yet.
                    </p>


                    <div class="checkout-place-order">


                        <a
                            href="index.php"
                            id="place-order-btn"
                        >
                            ORDER A PIZZA
                        </a>


                    </div>


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
                 BACK HOME
            ================================== -->

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