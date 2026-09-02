<?php

function validateRequired(string $value, string $label): ?string
{
    return trim($value) === '' ? "$label is required." : null;
}


function validateEmailFormat(string $value): ?string
{
    return filter_var($value, FILTER_VALIDATE_EMAIL)
        ? null
        : "Enter a valid email address.";
}


function validatePassword(string $value): ?string
{
    return strlen($value) >= 8
        ? null
        : "Password must be at least 8 characters.";
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


    $errors = array_filter([

        validateRequired($username, 'Username'),

        validateRequired($email, 'Email'),

        validateEmailFormat($email),

        validateRequired($phone, 'Phone Number'),

        validateRequired($password, 'Password'),

        validatePassword($password),

        validateRequired($confirmPassword, 'Confirm Password'),

        validatePasswordMatch($password, $confirmPassword),

    ]);


    $errors = array_values($errors);


    if (empty($errors)) {

        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);
        $phone = htmlspecialchars($phone);

    }


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