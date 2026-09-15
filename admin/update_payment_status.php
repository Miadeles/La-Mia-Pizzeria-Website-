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
// CHECK FORM SUBMISSION
// =========================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: orders.php');

    exit;
}


// =========================================
// GET FORM DATA
// =========================================

$orderId = filter_input(
    INPUT_POST,
    'order_id',
    FILTER_VALIDATE_INT
);

$paymentStatus =
    $_POST['payment_status'] ?? '';


// =========================================
// VALIDATE ORDER ID
// =========================================

if (!$orderId || $orderId <= 0) {

    header(
        'Location: orders.php?message=' .
        urlencode('Invalid order.')
    );

    exit;
}


// =========================================
// VALIDATE PAYMENT STATUS
// =========================================

$allowedStatuses = [

    'Pending Verification',
    'Paid',
    'Rejected'

];

if (!in_array(
    $paymentStatus,
    $allowedStatuses,
    true
)) {

    header(
        'Location: order_details.php?id=' .
        $orderId .
        '&message=' .
        urlencode('Invalid payment status.')
    );

    exit;
}


// =========================================
// UPDATE PAYMENT STATUS
// =========================================

try {

    $pdo = getConnection();


    $sql = "
        UPDATE orders
        SET payment_status = :payment_status
        WHERE id = :order_id
    ";


    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(
        ':payment_status',
        $paymentStatus
    );


    $stmt->bindValue(
        ':order_id',
        $orderId,
        PDO::PARAM_INT
    );


    $stmt->execute();


    if ($stmt->rowCount() === 0) {

        header(
            'Location: order_details.php?id=' .
            $orderId .
            '&message=' .
            urlencode('No payment status change was made.')
        );

        exit;
    }


    header(
        'Location: order_details.php?id=' .
        $orderId .
        '&message=' .
        urlencode('Payment status updated successfully.')
    );

    exit;


} catch (PDOException $e) {

    header(
        'Location: order_details.php?id=' .
        $orderId .
        '&message=' .
        urlencode('Unable to update payment status.')
    );

    exit;
}