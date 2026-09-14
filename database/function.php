<?php

session_start();

require 'config.php';
require 'validation.php';


if (!isset($_POST['register'])) {

    header('Location: ../register.php');

    exit;
}


$result = validateCustomerInput($_POST);

$errors = $result['errors'];


if (!empty($errors)) {

    /*
    * Store validation error temporarily in the session
    */

    $_SESSION['register_error'] = implode(' ', $errors);


    /*
    * Store username, email, and phone temporarily
    * so they can be restored on the registration page.
    *
    * Password is intentionally NOT stored.
    */

    $_SESSION['register_form'] = [
        'username' => $_POST['username'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? ''
    ];


    /*
    * Return to registration page
    */

    header('Location: ../register.php');

    exit;
}


try {

    $pdo = getConnection();


    /*
    * Check if username or email already exists
    */

    $checkSql = "
        SELECT id
        FROM customers
        WHERE username = :username
           OR email = :email
        LIMIT 1
    ";

    $checkStmt = $pdo->prepare($checkSql);

    $checkStmt->bindValue(
        ':username',
        $result['data']['username']
    );

    $checkStmt->bindValue(
        ':email',
        $result['data']['email']
    );

    $checkStmt->execute();


    if ($checkStmt->fetch()) {

        header(
            'Location: ../register.php?status=error&message='
            . urlencode('Username or email is already registered.')
        );

        exit;
    }


    /*
    * Securely hash the password
    */

    $hashedPassword = password_hash(
        $result['data']['password'],
        PASSWORD_DEFAULT
    );


    /*
    * Insert new customer
    */

    $sql = "
        INSERT INTO customers
        (username, email, phone, password)
        VALUES
        (:username, :email, :phone, :password)
    ";


    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(
        ':username',
        $result['data']['username']
    );

    $stmt->bindValue(
        ':email',
        $result['data']['email']
    );

    $stmt->bindValue(
        ':phone',
        $result['data']['phone']
    );

    $stmt->bindValue(
        ':password',
        $hashedPassword
    );


    $stmt->execute();


    $newId = $pdo->lastInsertId();


    /*
    * Automatically log in the newly registered customer
    */

    $_SESSION['customer_id'] = $newId;

    $_SESSION['username'] = $result['data']['username'];

    $_SESSION['email'] = $result['data']['email'];


    /*
    * Go directly to homepage
    */

    header('Location: ../index.php');

    exit;


} catch (PDOException $e) {

    header(
        'Location: ../register.php?status=error&message='
        . urlencode($e->getMessage())
    );

    exit;
}