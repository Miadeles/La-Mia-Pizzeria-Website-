<?php

$status  = $_GET['status'] ?? null;
$message = $_GET['message'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | La Mia Pizzeria</title>

    <link rel="stylesheet" href="style.css?v=4">
</head>

<body class="register-page">

    <div class="register-container">

        <h1>NEW USER REGISTRATION</h1>

        <div class="register-card">

            <!-- Logo -->
            <img
                src="images/logo-zoomed.png"
                alt="La Mia Pizzeria"
                class="register-logo"
            >

            <?php if ($status === 'error'): ?>

                <div class="register-error">
                    <?= htmlspecialchars($message) ?>
                </div>

            <?php endif; ?>


            <!-- Registration Form -->
            <form
                method="POST"
                action="database/function.php"
                class="register-form"
            >

                <!-- Username -->
                <div class="input-group">

                    <div class="input-icon">
                        &#128100;
                    </div>

                    <input
                        type="text"
                        name="username"
                        placeholder="Username"
                        required
                    >

                </div>


                <!-- Email -->
                <div class="input-group">

                    <div class="input-icon email-icon">
                        &#9993;
                    </div>

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required
                    >

                </div>


                <!-- Phone Number -->
                <div class="input-group">

                    <div class="input-icon phone-icon">
                        &#9742;
                    </div>

                    <input
                        type="text"
                        name="phone"
                        placeholder="Phone Number"
                        required
                    >

                </div>


                <!-- Password -->
                <div class="input-group">

                    <div class="input-icon">
                        &#128274;
                    </div>

                    <input
                        type="password"
                        name="password"
                        placeholder="Set Password"
                        required
                    >

                </div>


                <!-- Confirm Password -->
                <div class="input-group">

                    <div class="input-icon">
                        &#128274;
                    </div>

                    <input
                        type="password"
                        name="confirm_password"
                        placeholder="Confirm Password"
                        required
                    >

                </div>


                <!-- Register Button -->
                <button
                    type="submit"
                    name="register"
                    class="register-button"
                >
                    <span class="register-button-icon">&#128100;</span>
                    REGISTER NOW
                </button>

            </form>


            <!-- Login Link -->
            <p class="login-link">

                Already have an account?
                <span>→</span>

                <a href="login.php">
                    Go to <strong>Login</strong>
                </a>

            </p>

        </div>

    </div>

</body>

</html>