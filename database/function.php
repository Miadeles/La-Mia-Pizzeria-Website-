<?php

require 'config.php';
require 'validation.php';


if (!isset($_POST['register'])) {

    header('Location: ../register.php');

    exit;
}


$result = validateCustomerInput($_POST);

$errors = $result['errors'];


if (!empty($errors)) {

    $message = implode(' ', $errors);

    header(
        'Location: ../register.php?status=error&message='
        . urlencode($message)
    );

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


    header(
        'Location: ../success.php?id=' . $newId
    );

    exit;


} catch (PDOException $e) {

    header(
        'Location: ../register.php?status=error&message='
        . urlencode($e->getMessage())
    );

    exit;
}