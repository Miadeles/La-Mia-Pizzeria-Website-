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
    // DEFAULT VALUES
    // =========================================

    $inventory = [];

    $message = '';

    $error = '';


    // =========================================
    // GET INVENTORY
    // =========================================

    try {

        $pdo = getConnection();


        $stmt = $pdo->query("
            SELECT
                id,
                pizza_name,
                stock,
                is_available,
                updated_at
            FROM inventory
            ORDER BY id ASC
        ");


        $inventory = $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );


    } catch (PDOException $e) {

        $error =
            'Unable to load inventory information.';

    }


    // =========================================
    // GET MESSAGE
    // =========================================

    if (isset($_GET['message'])) {

        $message =
            $_GET['message'];

    }

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Inventory - La Mia Pizzeria
    </title>


    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="admin.css">

</head>


<body class="cart-page-body">


    <main class="checkout-page">


        <section class="checkout-container">


            <!-- =================================
                 PAGE HEADER
            ================================== -->

            <div class="checkout-form-card">


                <h1>
                    INVENTORY
                </h1>


                <p>
                    Manage pizza stock and availability.
                </p>


            </div>



            <!-- =================================
                 MESSAGE
            ================================== -->

            <?php if ($message !== ''): ?>


                <div class="checkout-form-card">

                    <p>
                        <?= htmlspecialchars($message) ?>
                    </p>

                </div>


            <?php endif; ?>



            <!-- =================================
                 ERROR
            ================================== -->

            <?php if ($error !== ''): ?>


                <div class="checkout-form-card">

                    <p>
                        <?= htmlspecialchars($error) ?>
                    </p>

                </div>


            <?php endif; ?>



            <!-- =================================
                 INVENTORY LIST
            ================================== -->

            <div class="checkout-form-card inventory-list-card">


                <h2>
                    PIZZA STOCK
                </h2>


                <div class="inventory-grid">


                    <?php foreach (
                        $inventory
                        as $item
                    ): ?>


                        <div class="inventory-item">


                            <div
                                class="receipt-info-row"
                                style="align-items: center;"
                            >


                                <!-- PIZZA NAME -->

                                <span>

                                    <?= htmlspecialchars(
                                        $item['pizza_name']
                                    ) ?>

                                </span>



                                <!-- STOCK -->

                                <strong>

                                    <?= (int)
                                        $item['stock'] ?>

                                    available

                                </strong>


                            </div>



                            <!-- UPDATE FORM -->

                            <form
                                action="update_inventory.php"
                                method="POST"
                                class="inventory-form"
                            >


                                <input
                                    type="hidden"
                                    name="inventory_id"
                                    value="<?= (int) $item['id'] ?>"
                                >


                                <div
                                    class="checkout-form-group"
                                >


                                    <label
                                        for="stock-<?= (int) $item['id'] ?>"
                                    >
                                        Stock Quantity
                                    </label>


                                    <input
                                        type="number"
                                        id="stock-<?= (int) $item['id'] ?>"
                                        name="stock"
                                        value="<?= (int) $item['stock'] ?>"
                                        min="0"
                                        required
                                    >


                                </div>



                                <div
                                    class="checkout-form-group"
                                >


                                    <label
                                        for="availability-<?= (int) $item['id'] ?>"
                                    >
                                        Availability
                                    </label>


                                    <select
                                        id="availability-<?= (int) $item['id'] ?>"
                                        name="is_available"
                                        required
                                    >


                                        <option
                                            value="1"
                                            <?= (int) $item['is_available'] === 1
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Available
                                        </option>


                                        <option
                                            value="0"
                                            <?= (int) $item['is_available'] === 0
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Unavailable
                                        </option>


                                    </select>


                                </div>



                                <div
                                    class="checkout-place-order"
                                >


                                    <button
                                        type="submit"
                                        id="place-order-btn"
                                    >
                                        UPDATE INVENTORY
                                    </button>


                                </div>


                            </form>


                        </div>


                    <?php endforeach; ?>


                </div>


            </div>



            <!-- =================================
                 NAVIGATION
            ================================== -->

            <div class="checkout-place-order">


                <a
                    href="index.php"
                    id="place-order-btn"
                >
                    BACK TO DASHBOARD
                </a>


            </div>



            <div class="checkout-place-order">


                <a
                    href="orders.php"
                    id="place-order-btn"
                >
                    MANAGE ORDERS
                </a>


            </div>


        </section>


    </main>


</body>

</html>