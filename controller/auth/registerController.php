<?php
require_once __DIR__ . "/../../includes/functions.php";
if (isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'controller/taskController.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = validateInput($_POST['name']);
        $email = validateInput($_POST['email']);
        $password = validateInput($_POST['password']);
        $retype_password = validateInput($_POST['retype_password']);

        if ($name === '') {
            throw new Exception('Name field can not be empty.');
        }
        if ($email === '') {
            throw new Exception('Email field can not be empty.');
        }
        validateEmail($email);
        isEmailUnique($email);

        if ($password === '' || $retype_password === '') {
            throw new Exception('Password field can not be empty.');
        }
        validatePassword($password);
        if ($password !== $retype_password) {
            throw new Exception('Password must be match.');
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users(name, email, password) VALUES(?,?,?)");
        $stmt->execute([$name, $email, $password]);

        header("Location: " . BASE_URL . "views/auth/login.php");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}