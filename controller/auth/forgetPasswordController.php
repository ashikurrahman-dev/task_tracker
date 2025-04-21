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
            validateEmail($email);

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
            }

            
        } catch(Exception $e) {
            $error = $e->getMessage();
        }
    }
}