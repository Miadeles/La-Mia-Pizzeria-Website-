<?php

    session_start();

    if (!isset($_SESSION['customer_id'])) {
        $_SESSION['redirect_after_login'] = 'my_orders.php';

        header(
            'Location: login.php?status=error&message=' .
            urlencode('Please login first to view your order.')
        );
        exit;
    }

    require 'database/config.php';

    $customerId = (int) $_SESSION['customer_id'];
    $orderId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$orderId || $orderId <= 0) {
        header(
            'Location: my_orders.php?status=error&message=' .
            urlencode('Invalid order.')
        );
        exit;
    }


    try {
        $pdo = getConnection();

        /* =================================
        GET CUSTOMER'S ORDER
        ================================== */

        $sql = "
            SELECT
                id,
                order_number,
                full_name,
                phone,
                order_type,
                house_number,
                street,
                barangay,
                city,
                order_notes,
                payment_method,
                total_amount,
                order_status,
                created_at
            FROM orders
            WHERE id = :order_id
            AND customer_id = :customer_id
            LIMIT 1
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->bindValue(':customer_id', $customerId, PDO::PARAM_INT);
        $stmt->execute();

        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            header(
                'Location: my_orders.php?status=error&message=' .
                urlencode('Order not found.')
            );
            exit;
        }



        /* =================================
        GET ORDER ITEMS
        ================================== */

        $itemSql = "
            SELECT
                id,
                pizza_name,
                pizza_size,
                quantity,
                unit_price,
                sauce,
                toppings,
                item_total
            FROM order_items
            WHERE order_id = :order_id
            ORDER BY id ASC
        ";

        $itemStmt = $pdo->prepare($itemSql);
        $itemStmt->bindValue(':order_id', $orderId, PDO::PARAM_INT);
        $itemStmt->execute();

        $items = $itemStmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        die('Unable to load order details. Please try again later.');
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

    <title>Order Details - La Mia Pizzeria</title>

    <link
        rel="stylesheet"
        href="style.css?v=7"
    >

</head>


<body class="cart-page-body">

    <!-- =================================
        HEADER
    ================================== -->

    <header class="checkout-header">

        <div class="checkout-header-inner">

            <a href="index.php">
                <img
                    src="images/logo-primary.png"
                    alt="La Mia Pizzeria"
                >
            </a>

            <a
                href="my_orders.php"
                class="checkout-back-link"
            >
                MY ORDERS
            </a>

        </div>

    </header>


    <!-- =================================
        ORDER DETAILS
    ================================== -->

    <main class="checkout-page">

        <div class="checkout-container">

            <!-- ORDER HEADER -->

            <div class="checkout-form-card">

                <h1>ORDER DETAILS</h1>

                <div class="receipt-info-row">

                    <span>Order Number</span>

                    <strong>
                        <?= htmlspecialchars($order['order_number']) ?>
                    </strong>

                </div>

                <div class="receipt-info-row">

                    <span>Date</span>

                    <strong>
                        <?= htmlspecialchars($order['created_at']) ?>
                    </strong>

                </div>

                <div class="receipt-info-row">

                    <span>Order Type</span>

                    <strong>
                        <?= htmlspecialchars($order['order_type']) ?>
                    </strong>

                </div>

                <div class="receipt-info-row">

                    <span>Payment Method</span>

                    <strong>
                        <?= htmlspecialchars($order['payment_method']) ?>
                    </strong>

                </div>

                <div class="receipt-info-row">

                    <span>Order Status</span>

                    <strong>
                        <?= htmlspecialchars($order['order_status']) ?>
                    </strong>

                </div>

            </div>


            <!-- =================================
                CUSTOMER INFORMATION
            ================================== -->

            <div class="checkout-form-card">

                <h2>CUSTOMER INFORMATION</h2>

                <div class="receipt-info-row">

                    <span>Full Name</span>

                    <strong>
                        <?= htmlspecialchars($order['full_name']) ?>
                    </strong>

                </div>

                <div class="receipt-info-row">

                    <span>Phone</span>

                    <strong>
                        <?= htmlspecialchars($order['phone']) ?>
                    </strong>

                </div>

            </div>


            <!-- =================================
                DELIVERY ADDRESS
            ================================== -->

            <?php if (strtolower($order['order_type']) === 'delivery'): ?>

                <div class="checkout-form-card">

                    <h2>DELIVERY ADDRESS</h2>

                    <div class="receipt-info-row">

                        <span>House Number</span>

                        <strong>
                            <?= htmlspecialchars($order['house_number'] ?? '') ?>
                        </strong>

                    </div>

                    <div class="receipt-info-row">

                        <span>Street</span>

                        <strong>
                            <?= htmlspecialchars($order['street'] ?? '') ?>
                        </strong>

                    </div>

                    <div class="receipt-info-row">

                        <span>Barangay</span>

                        <strong>
                            <?= htmlspecialchars($order['barangay'] ?? '') ?>
                        </strong>

                    </div>

                    <div class="receipt-info-row">

                        <span>City</span>

                        <strong>
                            <?= htmlspecialchars($order['city'] ?? '') ?>
                        </strong>

                    </div>

                </div>

            <?php endif; ?>


            <!-- =================================
                ORDER NOTES
            ================================== -->

            <?php if (!empty($order['order_notes'])): ?>

                <div class="checkout-form-card">

                    <h2>ORDER NOTES</h2>

                    <p>
                        <?= nl2br(htmlspecialchars($order['order_notes'])) ?>
                    </p>

                </div>

            <?php endif; ?>


            <!-- =================================
                ORDERED PIZZAS
            ================================== -->

            <div class="checkout-form-card">

                <h2>ORDERED PIZZAS</h2>

                <?php if (!empty($items)): ?>

                    <?php foreach ($items as $item): ?>

                        <div class="receipt-info-row">

                            <span>
                                <?= htmlspecialchars($item['pizza_name']) ?>

                                —
                                <?= htmlspecialchars($item['pizza_size']) ?>

                                ×
                                <?= (int) $item['quantity'] ?>
                            </span>

                            <strong>
                                ₱<?= number_format(
                                    (float) $item['item_total'],
                                    2
                                ) ?>
                            </strong>

                        </div>


                        <!-- CUSTOM PIZZA DETAILS -->

                        <?php if (
                            strtolower($item['pizza_name']) === 'custom pizza'
                        ): ?>

                            <?php if (!empty($item['sauce'])): ?>

                                <div class="receipt-info-row">

                                    <span>Custom Sauce</span>

                                    <strong>
                                        <?= htmlspecialchars($item['sauce']) ?>
                                    </strong>

                                </div>

                            <?php endif; ?>


                            <?php if (!empty($item['toppings'])): ?>

                                <div class="receipt-info-row">

                                    <span>Custom Toppings</span>

                                    <strong>
                                        <?= htmlspecialchars($item['toppings']) ?>
                                    </strong>

                                </div>

                            <?php endif; ?>

                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php else: ?>

                    <p>No items found for this order.</p>

                <?php endif; ?>

            </div>


            <!-- =================================
                ORDER TOTAL
            ================================== -->

            <div class="checkout-form-card">

                <div class="receipt-info-row">

                    <span>ORDER TOTAL</span>

                    <strong>
                        ₱<?= number_format(
                            (float) $order['total_amount'],
                            2
                        ) ?>
                    </strong>

                </div>

            </div>


            <!-- =================================
                BACK BUTTON
            ================================== -->

            <div class="checkout-place-order">

                <a
                    href="my_orders.php"
                    class="place-order-btn"
                >
                    BACK TO MY ORDERS
                </a>

            </div>

        </div>

    </main>


    <!-- =================================
        FOOTER
    ================================== -->

    <footer>

        <p>
            © <?= date('Y') ?> La Mia Pizzeria. All Rights Reserved.
        </p>

    </footer>

</body>

</html>