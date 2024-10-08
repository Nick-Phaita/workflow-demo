<?php
require 'connection.php';
require 'mailer.php';

// User registration function
function register($email, $password) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    return $stmt->execute([$email, $hashed_password]);
}

// User login function
function login($email, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    return $user && password_verify($password, $user['password']);
}

// Send registration notification
function sendRegistrationNotification($email) {
    $subject = "New User Registration";
    $message = "A new user has registered with the email: $email.";
    sendEmail('admin@gmail.com', $subject, $message);  // Change to your Gmail account
}
?>

