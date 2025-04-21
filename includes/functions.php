<?php
require_once(__DIR__ . "/../config/db.php");
define("BASE_URL","http://task_tracker.test/");
session_start();

function validateInput($input) {
    return trim(htmlspecialchars($input));
}

function validateEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        throw new Exception("Invalid email.");
    }
}

function isEmailUnique($email){
    GLOBAL $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $rowCount = $stmt->rowCount();

    if($rowCount){
        throw new Exception("Email already exists.");
    }
}

function validatePassword($password){
    if(strlen($password) < 6){
        throw new Exception("Password must be 6 charecters");
    }
}