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
// CHECK REQUEST METHOD
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

$newStatus = trim(
    $_POST['order_status'] ?? ''
);


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
// ALLOWED ORDER STATUSES
// =========================================

$allowedStatuses = [
    'Pending',
    'Preparing',
    'Out for Delivery',
    'Completed',
    'Cancelled'
];


// =========================================
// VALIDATE STATUS
// =========================================

if (!in_array($newStatus, $allowedStatuses, true)) {

    header(
        'Location: order_details.php?id=' .
        $orderId .
        '&message=' .
        urlencode('Invalid order status.')
    );

    exit;
}


// =========================================
// DATABASE CONNECTION
// =========================================

require '../database/config.php';

try {

    $pdo = getConnection();


    // =====================================
    // CHECK THAT ORDER EXISTS
    // =====================================

    $checkSql = "
        SELECT id
        FROM orders
        WHERE id = :order_id
        LIMIT 1
    ";


    $checkStmt = $pdo->prepare($checkSql);


    $checkStmt->bindValue(
        ':order_id',
        $orderId,
        PDO::PARAM_INT
    );


    $checkStmt->execute();


    if (!$checkStmt->fetch()) {

        header(
            'Location: orders.php?message=' .
            urlencode('Order not found.')
        );

        exit;
    }


    // =====================================
    // UPDATE ORDER STATUS
    // =====================================

    $updateSql = "
        UPDATE orders
        SET order_status = :order_status
        WHERE id = :order_id
    ";


    $updateStmt = $pdo->prepare($updateSql);


    $updateStmt->bindValue(
        ':order_status',
        $newStatus,
        PDO::PARAM_STR
    );


    $updateStmt->bindValue(
        ':order_id',
        $orderId,
        PDO::PARAM_INT
    );


    $updateStmt->execute();


    // =====================================
    // SUCCESS
    // =====================================

    header(
        'Location: order_details.php?id=' .
        $orderId .
        '&message=' .
        urlencode('Order status updated successfully.')
    );

    exit;


} catch (PDOException $e) {

    header(
        'Location: order_details.php?id=' .
        $orderId .
        '&message=' .
        urlencode('Unable to update order status.')
    );

    exit;
}