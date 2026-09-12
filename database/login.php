<?php

session_start();

require 'config.php';


/*
 * Make sure the login form was submitted
 */

if (!isset($_POST['login_button'])) {

    header('Location: ../login.php');

    exit;
}


/*
 * Get login information
 */

$login = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';


/*
 * Check that both fields were entered
 */

if ($login === '' || $password === '') {

    header(
        'Location: ../login.php?status=error&message='
        . urlencode('Please enter your Email / Username and Password.')
    );

    exit;
}


try {

    $pdo = getConnection();


    /*
     * Find customer using either username OR email
     */

    $sql = "
        SELECT id, username, email, phone, password
        FROM customers
        WHERE username = :login
           OR email = :login
        LIMIT 1
    ";


    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(
        ':login',
        $login
    );

    $stmt->execute();


    $customer = $stmt->fetch(PDO::FETCH_ASSOC);


    /*
     * Check customer and password
     */

    if (
        !$customer ||
        !password_verify($password, $customer['password'])
    ) {

        header(
            'Location: ../login.php?status=error&message='
            . urlencode('Invalid Email / Username or Password.')
        );

        exit;
    }


    /*
     * Store customer information in the session
     */

    $_SESSION['customer_id'] = $customer['id'];
    $_SESSION['username'] = $customer['username'];
    $_SESSION['email'] = $customer['email'];


    /*
    * Login successful
    */

    $redirectPage =
        $_SESSION['redirect_after_login'] ?? 'index.php';

    unset($_SESSION['redirect_after_login']);

    header('Location: ../' . $redirectPage);

    exit;

} catch (PDOException $e) {

    header(
        'Location: ../login.php?status=error&message='
        . urlencode('Unable to process login. Please try again.')
    );

    exit;
}