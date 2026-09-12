<?php

session_start();


// =========================================
// CHECK LOGIN FORM
// =========================================

if (!isset($_POST['admin_login'])) {

    header('Location: login.php');

    exit;
}


// =========================================
// GET LOGIN VALUES
// =========================================

$username = trim($_POST['admin_username'] ?? '');
$password = $_POST['admin_password'] ?? '';


// =========================================
// CHECK EMPTY FIELDS
// =========================================

if ($username === '' || $password === '') {

    header(
        'Location: login.php?message=' .
        urlencode('Please enter your username and password.')
    );

    exit;
}


// =========================================
// ADMIN LOGIN CREDENTIALS
// =========================================

$adminUsername = 'admin';

$adminPasswordHash =
    '$2y$12$/63uwiZkEq0Rb3NQn2S.C.Ed6K0OMDisFJIAEWD6MRd97g1O8lGjW';


// =========================================
// VERIFY ADMIN LOGIN
// =========================================

if (
    $username !== $adminUsername ||
    !password_verify($password, $adminPasswordHash)
) {

    header(
        'Location: login.php?message=' .
        urlencode('Invalid admin username or password.')
    );

    exit;
}


// =========================================
// ADMIN LOGIN SUCCESS
// =========================================

$_SESSION['admin_logged_in'] = true;

$_SESSION['admin_username'] = $adminUsername;


// =========================================
// GO TO ADMIN DASHBOARD
// =========================================

header('Location: index.php');

exit;