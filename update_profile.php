<?php

session_start();


// =========================================
// CUSTOMER LOGIN PROTECTION
// =========================================

if (!isset($_SESSION['customer_id'])) {

    header('Location: login.php');

    exit;
}


// =========================================
// ONLY ALLOW POST REQUEST
// =========================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: profile.php');

    exit;
}


// =========================================
// DATABASE CONNECTION
// =========================================

require 'database/config.php';


// =========================================
// GET FORM DATA
// =========================================

$username =
    trim($_POST['username'] ?? '');

$email =
    trim($_POST['email'] ?? '');

$phone =
    trim($_POST['phone'] ?? '');

$customerId =
    (int) $_SESSION['customer_id'];


// =========================================
// BASIC VALIDATION
// =========================================

if (
    $username === '' ||
    $email === '' ||
    $phone === ''
) {

    header(
        'Location: profile.php?message=' .
        urlencode('Please complete all profile information.')
    );

    exit;
}


// =========================================
// VALIDATE EMAIL
// =========================================

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    header(
        'Location: profile.php?message=' .
        urlencode('Please enter a valid email address.')
    );

    exit;
}


try {

    $pdo = getConnection();


    // =========================================
    // CHECK USERNAME / EMAIL
    // =========================================

    $checkSql = "
        SELECT
            id
        FROM customers
        WHERE
            (username = :username OR email = :email)
            AND id != :customer_id
        LIMIT 1
    ";


    $checkStmt =
        $pdo->prepare($checkSql);


    $checkStmt->bindValue(
        ':username',
        $username
    );


    $checkStmt->bindValue(
        ':email',
        $email
    );


    $checkStmt->bindValue(
        ':customer_id',
        $customerId,
        PDO::PARAM_INT
    );


    $checkStmt->execute();


    if ($checkStmt->fetch()) {

        header(
            'Location: profile.php?message=' .
            urlencode(
                'Username or email is already being used.'
            )
        );

        exit;
    }


    // =========================================
    // UPDATE CUSTOMER
    // =========================================

    $updateSql = "
        UPDATE customers
        SET
            username = :username,
            email = :email,
            phone = :phone
        WHERE id = :customer_id
    ";


    $updateStmt =
        $pdo->prepare($updateSql);


    $updateStmt->bindValue(
        ':username',
        $username
    );


    $updateStmt->bindValue(
        ':email',
        $email
    );


    $updateStmt->bindValue(
        ':phone',
        $phone
    );


    $updateStmt->bindValue(
        ':customer_id',
        $customerId,
        PDO::PARAM_INT
    );


    $updateStmt->execute();


    // =========================================
    // UPDATE SESSION
    // =========================================

    $_SESSION['username'] =
        $username;

    $_SESSION['email'] =
        $email;


    // =========================================
    // SUCCESS
    // =========================================

    header(
        'Location: profile.php?message=' .
        urlencode('Profile updated successfully.')
    );

    exit;


} catch (PDOException $e) {

    // =========================================
    // DATABASE ERROR
    // =========================================

    header(
        'Location: profile.php?message=' .
        urlencode('Unable to update your profile.')
    );

    exit;
}