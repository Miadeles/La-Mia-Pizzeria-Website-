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
// GET ORDER ID
// =========================================

$orderId = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

$message = $_GET['message'] ?? '';


// =========================================
// CHECK ORDER ID
// =========================================

if (!$orderId || $orderId <= 0) {

    header(
        'Location: orders.php?message=' .
        urlencode('Invalid order.')
    );

    exit;
}


// =========================================
// GET ORDER DETAILS
// =========================================

try {

    $pdo = getConnection();


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
        LIMIT 1
    ";


    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(
        ':order_id',
        $orderId,
        PDO::PARAM_INT
    );


    $stmt->execute();


    $order = $stmt->fetch(PDO::FETCH_ASSOC);


    // -----------------------------------------
    // ORDER NOT FOUND
    // -----------------------------------------

    if (!$order) {

        header(
            'Location: orders.php?message=' .
            urlencode('Order not found.')
        );

        exit;
    }


    // =========================================
    // GET ORDER ITEMS
    // =========================================

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


    $itemStmt->bindValue(
        ':order_id',
        $orderId,
        PDO::PARAM_INT
    );


    $itemStmt->execute();


    $orderItems = $itemStmt->fetchAll(
        PDO::FETCH_ASSOC
    );


} catch (PDOException $e) {

    header(
        'Location: orders.php?message=' .
        urlencode('Unable to load order details.')
    );

    exit;
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
        Order Details - La Mia Pizzeria
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
                    ORDER DETAILS
                </h1>


                <p>

                    Order Number:
                    <strong>

                        <?= htmlspecialchars(
                            $order['order_number']
                        ) ?>

                    </strong>

                </p>


            </div>


            <?php if ($message !== ''): ?>

                <div class="checkout-form-card">

                    <p>
                        <?= htmlspecialchars($message) ?>
                    </p>

                </div>

            <?php endif; ?>



            <!-- =================================
                 ORDER INFORMATION
            ================================== -->

            <div class="checkout-form-card">


                <h2>
                    ORDER INFORMATION
                </h2>



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


            </div>



            <!-- =================================
                 CUSTOMER INFORMATION
            ================================== -->

            <div class="checkout-form-card">


                <h2>
                    CUSTOMER INFORMATION
                </h2>



                <!-- FULL NAME -->

                <div class="receipt-info-row">

                    <span>
                        Full Name
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



                <!-- =================================
                     DELIVERY ADDRESS
                ================================== -->

                <?php if (
                    strtolower(
                        $order['order_type']
                    ) === 'delivery'
                ): ?>


                    <div class="receipt-info-row">

                        <span>
                            House Number
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                $order['house_number']
                                ?? ''
                            ) ?>

                        </strong>

                    </div>



                    <div class="receipt-info-row">

                        <span>
                            Street
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                $order['street']
                                ?? ''
                            ) ?>

                        </strong>

                    </div>



                    <div class="receipt-info-row">

                        <span>
                            Barangay
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                $order['barangay']
                                ?? ''
                            ) ?>

                        </strong>

                    </div>



                    <div class="receipt-info-row">

                        <span>
                            City
                        </span>


                        <strong>

                            <?= htmlspecialchars(
                                $order['city']
                                ?? ''
                            ) ?>

                        </strong>

                    </div>


                <?php endif; ?>


            </div>



            <!-- =================================
                 ORDER NOTES
            ================================== -->

            <?php if (
                trim(
                    $order['order_notes'] ?? ''
                ) !== ''
            ): ?>


                <div class="checkout-form-card">


                    <h2>
                        ORDER NOTES
                    </h2>


                    <p>

                        <?= nl2br(
                            htmlspecialchars(
                                $order['order_notes']
                            )
                        ) ?>

                    </p>


                </div>


            <?php endif; ?>



            <!-- =================================
                 ORDERED PIZZAS
            ================================== -->

            <div class="checkout-form-card">


                <h2>
                    ORDERED PIZZAS
                </h2>



                <?php foreach (
                    $orderItems
                    as $item
                ): ?>


                    <div
                        class="my-order-card"
                        style="margin-bottom: 20px;"
                    >


                        <!-- PIZZA NAME -->

                        <div class="receipt-info-row">

                            <span>
                                Pizza
                            </span>


                            <strong>

                                <?= htmlspecialchars(
                                    $item['pizza_name']
                                ) ?>

                            </strong>

                        </div>



                        <!-- SIZE -->

                        <div class="receipt-info-row">

                            <span>
                                Size
                            </span>


                            <strong>

                                <?= htmlspecialchars(
                                    ucfirst(
                                        $item['pizza_size']
                                    )
                                ) ?>

                            </strong>

                        </div>



                        <!-- QUANTITY -->

                        <div class="receipt-info-row">

                            <span>
                                Quantity
                            </span>


                            <strong>

                                <?= (int)
                                    $item['quantity'] ?>

                            </strong>

                        </div>



                        <!-- UNIT PRICE -->

                        <div class="receipt-info-row">

                            <span>
                                Unit Price
                            </span>


                            <strong>

                                ₱<?= number_format(
                                    (float)
                                    $item['unit_price'],
                                    2
                                ) ?>

                            </strong>

                        </div>



                        <!-- =================================
                             CUSTOM SAUCE
                        ================================== -->

                        <?php if (
                            trim(
                                $item['sauce'] ?? ''
                            ) !== ''
                        ): ?>


                            <div class="receipt-info-row">

                                <span>
                                    Sauce
                                </span>


                                <strong>

                                    <?= htmlspecialchars(
                                        $item['sauce']
                                    ) ?>

                                </strong>

                            </div>


                        <?php endif; ?>



                        <!-- =================================
                             CUSTOM TOPPINGS
                        ================================== -->

                        <?php if (
                            trim(
                                $item['toppings'] ?? ''
                            ) !== ''
                        ): ?>


                            <div class="receipt-info-row">

                                <span>
                                    Toppings
                                </span>


                                <strong>

                                    <?= htmlspecialchars(
                                        $item['toppings']
                                    ) ?>

                                </strong>

                            </div>


                        <?php endif; ?>



                        <!-- ITEM TOTAL -->

                        <div class="receipt-info-row">

                            <span>
                                Item Total
                            </span>


                            <strong>

                                ₱<?= number_format(
                                    (float)
                                    $item['item_total'],
                                    2
                                ) ?>

                            </strong>

                        </div>


                    </div>


                <?php endforeach; ?>


            </div>



            <!-- =================================
                UPDATE ORDER STATUS
            ================================== -->

            <div class="checkout-form-card">


                <h2>
                    UPDATE ORDER STATUS
                </h2>


                <div class="receipt-info-row">

                    <span>
                        Current Status
                    </span>


                    <strong>

                        <?= htmlspecialchars(
                            $order['order_status']
                        ) ?>

                    </strong>

                </div>



                <form
                    action="update_order_status.php"
                    method="POST"
                >


                    <!-- ORDER ID -->

                    <input
                        type="hidden"
                        name="order_id"
                        value="<?= (int) $order['id'] ?>"
                    >



                    <!-- STATUS -->

                    <div class="checkout-form-group">


                        <label for="order_status">

                            Change Order Status

                        </label>


                        <select
                            id="order_status"
                            name="order_status"
                            required
                        >


                            <option
                                value="Pending"
                                <?= $order['order_status'] === 'Pending'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Pending
                            </option>


                            <option
                                value="Preparing"
                                <?= $order['order_status'] === 'Preparing'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Preparing
                            </option>


                            <option
                                value="Out for Delivery"
                                <?= $order['order_status'] === 'Out for Delivery'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Out for Delivery
                            </option>


                            <option
                                value="Completed"
                                <?= $order['order_status'] === 'Completed'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Completed
                            </option>


                            <option
                                value="Cancelled"
                                <?= $order['order_status'] === 'Cancelled'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Cancelled
                            </option>


                        </select>


                    </div>



                    <!-- UPDATE BUTTON -->

                    <div class="checkout-place-order">


                        <button
                            type="submit"
                            id="place-order-btn"
                        >
                            UPDATE STATUS
                        </button>


                    </div>


                </form>


            </div>



            <!-- =================================
                 ORDER TOTAL
            ================================== -->

            <div class="checkout-form-card">


                <div class="receipt-info-row">


                    <span>
                        TOTAL
                    </span>


                    <strong>

                        ₱<?= number_format(
                            (float)
                            $order['total_amount'],
                            2
                        ) ?>

                    </strong>


                </div>


            </div>



            <!-- =================================
                 BACK TO ORDERS
            ================================== -->

            <div class="checkout-place-order">


                <a
                    href="orders.php"
                    id="place-order-btn"
                >
                    BACK TO ORDERS
                </a>


            </div>



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