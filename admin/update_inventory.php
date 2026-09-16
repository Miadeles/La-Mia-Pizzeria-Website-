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
// ONLY ALLOW POST REQUEST
// =========================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: inventory.php');

    exit;
}


// =========================================
// GET FORM DATA
// =========================================

$inventoryId =
    (int) ($_POST['inventory_id'] ?? 0);

$stock =
    (int) ($_POST['stock'] ?? 0);

$isAvailable =
    (int) ($_POST['is_available'] ?? 0);


// =========================================
// VALIDATE INVENTORY ID
// =========================================

if ($inventoryId <= 0) {

    header(
        'Location: inventory.php?message=' .
        urlencode('Invalid inventory item.')
    );

    exit;
}


// =========================================
// VALIDATE STOCK
// =========================================

if ($stock < 0) {

    header(
        'Location: inventory.php?message=' .
        urlencode('Stock cannot be negative.')
    );

    exit;
}


// =========================================
// VALIDATE AVAILABILITY
// =========================================

if (
    $isAvailable !== 0 &&
    $isAvailable !== 1
) {

    header(
        'Location: inventory.php?message=' .
        urlencode('Invalid availability selection.')
    );

    exit;
}


// =========================================
// IF STOCK IS ZERO
// FORCE UNAVAILABLE
// =========================================

if ($stock === 0) {

    $isAvailable = 0;
}


// =========================================
// UPDATE DATABASE
// =========================================

try {

    $pdo = getConnection();


    $sql = "
        UPDATE inventory
        SET
            stock = :stock,
            is_available = :is_available
        WHERE id = :inventory_id
    ";


    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(
        ':stock',
        $stock,
        PDO::PARAM_INT
    );


    $stmt->bindValue(
        ':is_available',
        $isAvailable,
        PDO::PARAM_INT
    );


    $stmt->bindValue(
        ':inventory_id',
        $inventoryId,
        PDO::PARAM_INT
    );


    $stmt->execute();


    // =========================================
    // SUCCESS
    // =========================================

    header(
        'Location: inventory.php?message=' .
        urlencode('Inventory updated successfully.')
    );

    exit;


} catch (PDOException $e) {

    // =========================================
    // ERROR
    // =========================================

    header(
        'Location: inventory.php?message=' .
        urlencode('Unable to update inventory.')
    );

    exit;
}