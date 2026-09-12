<?php

date_default_timezone_set('Asia/Manila');

session_start();

if (!isset($_SESSION['customer_id'])) {

    header(
        'Location: login.php?status=error&message=' .
        urlencode('Please login first before placing an order.')
    );

    exit;
}


// =========================================
// CHECK THAT THE FORM WAS SUBMITTED
// =========================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: checkout.php');
    exit;

}


// =========================================
// GET FORM DATA
// =========================================

$fullName = trim($_POST['full_name'] ?? '');

$phone = trim($_POST['phone'] ?? '');

$orderType = $_POST['order_type'] ?? '';

$houseNumber = trim($_POST['house_number'] ?? '');

$street = trim($_POST['street'] ?? '');

$barangay = trim($_POST['barangay'] ?? '');

$city = trim($_POST['city'] ?? '');

$orderNotes = trim($_POST['order_notes'] ?? '');

$paymentMethod = $_POST['payment_method'] ?? '';

$cartData = $_POST['cart_data'] ?? '';


// =========================================
// VALIDATION
// =========================================

$errors = [];


// =========================================
// FULL NAME
// =========================================

if ($fullName === '') {

    $errors[] = 'Full Name is required.';

}


// =========================================
// PHONE NUMBER
// =========================================

if ($phone === '') {

    $errors[] = 'Phone Number is required.';

}


// =========================================
// ORDER TYPE
// =========================================

if (
    $orderType !== 'delivery' &&
    $orderType !== 'pickup'
) {

    $errors[] = 'Please select Delivery or Pickup.';

}


// =========================================
// DELIVERY VALIDATION
// =========================================

if ($orderType === 'delivery') {


    if ($street === '') {

        $errors[] =
            'Street / Purok is required for delivery.';

    }


    if ($barangay === '') {

        $errors[] =
            'Barangay is required for delivery.';

    }


    if ($city === '') {

        $errors[] =
            'City is required for delivery.';

    }

}


// =========================================
// PAYMENT METHOD
// =========================================

if (
    $paymentMethod !== 'cash' &&
    $paymentMethod !== 'gcash'
) {

    $errors[] =
        'Please select a payment method.';

}


// =========================================
// CART VALIDATION
// =========================================

$cart = json_decode($cartData, true);

if (
    !is_array($cart) ||
    count($cart) === 0
) {

    $errors[] =
        'Your cart is empty. Please add a pizza before placing your order.';

}


// =========================================
// RETURN TO CHECKOUT IF THERE ARE ERRORS
// =========================================

if (!empty($errors)) {

    $_SESSION['checkout_errors'] = $errors;

    $_SESSION['checkout_form'] = [

        'full_name' => $fullName,

        'phone' => $phone,

        'order_type' => $orderType,

        'house_number' => $houseNumber,

        'street' => $street,

        'barangay' => $barangay,

        'city' => $city,

        'order_notes' => $orderNotes,

        'payment_method' => $paymentMethod

    ];


    header('Location: checkout.php');

    exit;

}


// =========================================
// CALCULATE ORDER TOTAL
// =========================================

$total = 0;

foreach ($cart as $item) {

    $price = (float) ($item['price'] ?? 0);

    $quantity = (int) ($item['quantity'] ?? 0);

    $total += $price * $quantity;

}


// =========================================
// CREATE TEMPORARY ORDER NUMBER
// =========================================

$orderNumber =
    'LM-' . date('YmdHis');


// =========================================
// CREATE ORDER DATE
// =========================================

$orderDate =
    date('F j, Y g:i A');


// =========================================
// SUCCESS / DIGITAL RECEIPT
// =========================================

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Order Receipt - La Mia Pizzeria
    </title>

    <link rel="stylesheet"
          href="style.css?v=7">

</head>


<body class="cart-page-body">


    <main class="checkout-page">


        <!-- =====================================
             ORDER PLACED
        ====================================== -->

        <section class="checkout-container">


            <div class="checkout-form-card order-success-card">


                <h1>
                    ORDER PLACED!
                </h1>


                <p>
                    Thank you for ordering from La Mia Pizzeria.
                </p>


            </div>



            <!-- =================================
                 DIGITAL RECEIPT
            ================================== -->

            <div class="checkout-form-card receipt-card">


                <h2>
                    DIGITAL RECEIPT
                </h2>


                <!-- ORDER NUMBER -->

                <div class="receipt-info-row">

                    <span>
                        Order Number
                    </span>

                    <strong>
                        <?= htmlspecialchars($orderNumber) ?>
                    </strong>

                </div>


                <!-- DATE -->

                <div class="receipt-info-row">

                    <span>
                        Date
                    </span>

                    <strong>
                        <?= htmlspecialchars($orderDate) ?>
                    </strong>

                </div>


                <!-- CUSTOMER -->

                <div class="receipt-info-row">

                    <span>
                        Customer Name
                    </span>

                    <strong>
                        <?= htmlspecialchars($fullName) ?>
                    </strong>

                </div>


                <!-- PHONE -->

                <div class="receipt-info-row">

                    <span>
                        Phone Number
                    </span>

                    <strong>
                        <?= htmlspecialchars($phone) ?>
                    </strong>

                </div>


                <!-- ORDER TYPE -->

                <div class="receipt-info-row">

                    <span>
                        Order Type
                    </span>

                    <strong>
                        <?= htmlspecialchars(ucfirst($orderType)) ?>
                    </strong>

                </div>


                <?php if ($orderType === 'delivery'): ?>


                    <!-- DELIVERY ADDRESS -->

                    <div class="receipt-section">

                        <h3>
                            DELIVERY ADDRESS
                        </h3>


                        <p>

                            <?php if ($houseNumber !== ''): ?>

                                <?= htmlspecialchars($houseNumber) ?>,

                            <?php endif; ?>

                            <?= htmlspecialchars($street) ?>,

                            <?= htmlspecialchars($barangay) ?>,

                            <?= htmlspecialchars($city) ?>

                        </p>

                    </div>


                <?php endif; ?>


                <!-- PAYMENT -->

                <div class="receipt-info-row">

                    <span>
                        Payment Method
                    </span>

                    <strong>

                        <?php if ($paymentMethod === 'cash'): ?>

                            Cash

                        <?php else: ?>

                            Online Payment

                        <?php endif; ?>

                    </strong>

                </div>


                <!-- ORDERED PIZZAS -->

                <div class="receipt-section">

                    <h3>
                        ORDERED PIZZAS
                    </h3>


                    <?php foreach ($cart as $item): ?>

                        <?php

                        $itemName =
                            $item['name'] ?? '';

                        $itemSize =
                            $item['size'] ?? '';

                        $itemQuantity =
                            (int) ($item['quantity'] ?? 0);

                        $itemPrice =
                            (float) ($item['price'] ?? 0);

                        $itemTotal =
                            $itemPrice * $itemQuantity;

                        ?>


                        <div class="receipt-item">


                            <div>

                                <strong>
                                    <?= htmlspecialchars($itemName) ?>
                                </strong>


                                <p>

                                    Size:
                                    <?= htmlspecialchars($itemSize) ?>

                                    <br>

                                    Quantity:
                                    <?= $itemQuantity ?>

                                    <br>

                                    Price:
                                    ₱<?= number_format(
                                        $itemPrice,
                                        2
                                    ) ?>

                                </p>

                            </div>


                            <strong>

                                ₱<?= number_format(
                                    $itemTotal,
                                    2
                                ) ?>

                            </strong>


                        </div>


                    <?php endforeach; ?>


                </div>


                <?php if ($orderNotes !== ''): ?>


                    <!-- ORDER NOTES -->

                    <div class="receipt-section">

                        <h3>
                            ORDER NOTES
                        </h3>


                        <p>
                            <?= nl2br(
                                htmlspecialchars($orderNotes)
                            ) ?>
                        </p>

                    </div>


                <?php endif; ?>


                <!-- TOTAL -->

                <div class="receipt-total">

                    <span>
                        TOTAL
                    </span>


                    <strong>

                        ₱<?= number_format(
                            $total,
                            2
                        ) ?>

                    </strong>

                </div>


            </div>



            <!-- =================================
                 BACK TO HOME
            ================================== -->

            <div class="checkout-place-order">


                <a href="index.php"
                   id="place-order-btn">

                    BACK TO HOME

                </a>


            </div>


        </section>


    </main>


    <script>

     localStorage.removeItem("pizzaCart");

    </script>


</body>

</html>