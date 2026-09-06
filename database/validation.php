<?php


function validateRequired(string $value, string $label): ?string
{
    return trim($value) === ''
        ? "$label is required."
        : null;
}


function validateEmailFormat(string $value): ?string
{
    return filter_var($value, FILTER_VALIDATE_EMAIL)
        ? null
        : "Enter a valid email address.";
}


function validatePassword(string $value): ?string
{
    if (strlen($value) < 8) {
        return "Password must be at least 8 characters.";
    }

    if (!preg_match('/[A-Z]/', $value)) {
        return "Password must contain at least one uppercase letter.";
    }

    if (!preg_match('/[a-z]/', $value)) {
        return "Password must contain at least one lowercase letter.";
    }

    if (!preg_match('/[0-9]/', $value)) {
        return "Password must contain at least one number.";
    }

    if (!preg_match('/[^A-Za-z0-9]/', $value)) {
        return "Password must contain at least one special character.";
    }

    return null;
}


function validatePasswordMatch(
    string $password,
    string $confirmPassword
): ?string {

    return $password === $confirmPassword
        ? null
        : "Passwords do not match.";
}


function validateCustomerInput(array $post): array
{
    $username = trim($post['username'] ?? '');
    $email = trim($post['email'] ?? '');
    $phone = trim($post['phone'] ?? '');

    $password = $post['password'] ?? '';
    $confirmPassword = $post['confirm_password'] ?? '';


    $errors = [];


    /*
     * USERNAME
     */

    $usernameRequired = validateRequired(
        $username,
        'Username'
    );

    if ($usernameRequired !== null) {

        $errors[] = $usernameRequired;

    }


    /*
     * EMAIL
     */

    $emailRequired = validateRequired(
        $email,
        'Email'
    );

    if ($emailRequired !== null) {

        $errors[] = $emailRequired;

    } else {

        $emailFormat = validateEmailFormat($email);

        if ($emailFormat !== null) {

            $errors[] = $emailFormat;

        }
    }


    /*
     * PHONE NUMBER
     */

    $phoneRequired = validateRequired(
        $phone,
        'Phone Number'
    );

    if ($phoneRequired !== null) {

        $errors[] = $phoneRequired;

    }


    /*
     * PASSWORD
     */

    $passwordRequired = validateRequired(
        $password,
        'Password'
    );

    if ($passwordRequired !== null) {

        $errors[] = $passwordRequired;

    } else {

        $passwordValidation = validatePassword($password);

        if ($passwordValidation !== null) {

            $errors[] = $passwordValidation;

        }
    }


    /*
     * CONFIRM PASSWORD
     */

    $confirmRequired = validateRequired(
        $confirmPassword,
        'Confirm Password'
    );

    if ($confirmRequired !== null) {

        $errors[] = $confirmRequired;

    } elseif ($password !== '') {

        $passwordMatch = validatePasswordMatch(
            $password,
            $confirmPassword
        );

        if ($passwordMatch !== null) {

            $errors[] = $passwordMatch;

        }
    }


    /*
     * Return validation result
     */

    return [

        'errors' => $errors,

        'data' => [

            'username' => $username,

            'email' => $email,

            'phone' => $phone,

            'password' => $password

        ]

    ];
}