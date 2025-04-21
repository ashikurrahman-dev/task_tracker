<?php
require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendOTP()
{
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $email = validateInput($_POST['email']);
            if ($email === '') {
                throw new Exception('Email field can not be empty.');
            }
            // validateEmail($email);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                throw new Exception("Invalid email.");
            }

            $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);
            $rowCount = $stmt->rowCount();

            if (!$rowCount) {
                throw new Exception("Email not found.");
            }

            $otp = rand(100000, 999999);
            $stmt = $pdo->prepare("UPDATE users SET otp=? WHERE email=?");
            $stmt->execute([$otp, $email]);
            $_SESSION['otp'] = $otp;

            try {
                $phpmailer = new PHPMailer();
                $phpmailer->isSMTP();
                $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 2525;
                $phpmailer->Username = '3e0ba1483da339';
                $phpmailer->Password = '40a5651de0da01';

                $phpmailer->setFrom('ashikur@gmail.com');
                $phpmailer->addAddress($email);
                $phpmailer->addReplyTo('ashikur@gmail.com');
                $phpmailer->isHTML(true);
                $phpmailer->Subject = 'Forget Password';
                $phpmailer->Body = "<p>Your otp code is <strong>$otp</strong></p>";
                $phpmailer->send();
            } catch (Exception $e) {
                $error = $e->getMessage();
                return $error;
            }

            header("Location: " . BASE_URL . "views/auth/verifyOTP.php?email=$email");
            exit();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}


function verifyOTP()
{
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $email = validateInput($_REQUEST['email']);
            $otp = validateInput($_POST['otp']);

            if ($otp === '') {
                throw new Exception('OTP field can not be empty');
            }
            if ($otp != $_SESSION['otp']) {
                throw new Exception('Invalid OTP');
            }

            $stmt = $pdo->prepare("UPDATE users SET otp=? WHERE email=?");
            $stmt->execute([0, $email]);
            unset($_SESSION['otp']);

            header("Location: " . BASE_URL . "views/auth/resetPassword.php?email=$email");
            exit();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}


function resetPassword(){
    global $pdo;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        try{
            $email = validateInput($_REQUEST['email']);
            $password = validateInput($_POST['password']);
            $retype_password = validateInput($_POST['retype_password']);
            
            if($password === '' || $retype_password === ''){
                throw new Exception('Password field can not be empty.');
            }
            if(strlen($password) < 6){
                throw new Exception('Password minimun 6 charecters');
            }
            if($password !== $retype_password){
                throw new Exception('Password must be match');
            }
    
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password=? WHERE email=?");
            $stmt->execute([$password, $email]);
    
            header("Location: " . BASE_URL . "views/auth/login.php");
            exit();
        } catch(Exception $e){
            return $e->getMessage();
        }
    }
}