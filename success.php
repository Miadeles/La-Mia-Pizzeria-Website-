<?php

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: register.php');
    exit;
}

require 'database/config.php';

try {
    $pdo = getConnection();

    $sql = "SELECT id, username, email, phone
            FROM customers
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$customer) {
        header('Location: register.php');
        exit;
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration Successful | La Mia Pizzeria</title>

    <link rel="stylesheet" href="style.css?v=3">
</head>

<body class="success-page">

    <div class="success-container">

        <h1>REGISTRATION SUCCESSFUL!</h1>

        <div class="success-card">

            <!-- Logo -->
            <img
                src="images/logo-zoomed.png"
                alt="La Mia Pizzeria"
                class="success-logo"
            >

            <p class="success-message">
                Your La Mia Pizzeria account has been created successfully.
            </p>

            <!-- Customer Information -->
            <div class="success-info">

                <div class="success-row">
                    <span class="success-label">ID</span>
                    <span class="success-value">
                        <?= htmlspecialchars($customer['id']) ?>
                    </span>
                </div>

                <div class="success-row">
                    <span class="success-label">Username</span>
                    <span class="success-value">
                        <?= htmlspecialchars($customer['username']) ?>
                    </span>
                </div>

                <div class="success-row">
                    <span class="success-label">Email</span>
                    <span class="success-value">
                        <?= htmlspecialchars($customer['email']) ?>
                    </span>
                </div>

                <div class="success-row">
                    <span class="success-label">Phone Number</span>
                    <span class="success-value">
                        <?= htmlspecialchars($customer['phone']) ?>
                    </span>
                </div>

            </div>

            <a href="register.php" class="success-button">
                REGISTER ANOTHER ACCOUNT
            </a>

        </div>

    </div>

</body>

</html>