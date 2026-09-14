<?php

    $status  = $_GET['status'] ?? null;
    $message = $_GET['message'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | La Mia Pizzeria</title>

    <link
        rel="stylesheet"
        href="style.css?v=5"
    >

</head>


<body class="login-page">


    <div class="login-container">


        <!-- TITLE -->

        <h1>LOGIN</h1>


        <!-- LOGIN CARD -->

        <div class="login-card">


            <!-- LOGO -->

            <img
                src="images/logo-zoomed.png"
                alt="La Mia Pizzeria"
                class="login-logo"
            >


            <!-- ERROR MESSAGE -->

            <?php if ($status === 'error'): ?>

                <div class="login-error">

                    <?= htmlspecialchars($message) ?>

                </div>

            <?php endif; ?>


            <!-- LOGIN FORM -->

            <form
                method="POST"
                action="database/login.php"
                class="login-form"
            >


                <!-- EMAIL / USERNAME -->

                <div class="login-input-group">

                    <div class="login-input-icon">
                        &#128100;
                    </div>

                    <input
                        type="text"
                        name="login"
                        placeholder="Email / Username"
                        required
                    >

                </div>


                <!-- PASSWORD -->

                <div class="login-input-group">

                    <div class="login-input-icon">
                        &#128274;
                    </div>

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                    >

                </div>


                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    name="login_button"
                    class="login-submit-button"
                >

                    <span class="login-submit-icon">
                        &#128100;
                    </span>

                    LOG IN

                </button>


            </form>


            <!-- REGISTER LINK -->

            <p class="register-link">

                Don't have an account?

                <span>→</span>

                <a href="register.php">
                    Go to <strong>Register</strong>
                </a>

            </p>


        </div>


    </div>


</body>

</html>