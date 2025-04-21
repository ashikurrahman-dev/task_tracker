<?php 
require_once __DIR__ . '/../../includes/functions.php';

// if(isset($_SESSION["user"])){
//     header("Location: " . BASE_URL ."public/dashboard.php");
//     exit();
// }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try{
        $email = validateInput($_POST['email']);
        $password = validateInput($_POST['password']);

        if($email === ''){
            throw new Exception('Email can not be empty');
        }
        if($password === ''){
            throw new Exception('Password can not be empty');
        }
        
        validatePassword($password);
        validateEmail($email);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);

        if($stmt->rowCount() === 0){
            throw new Exception("Email is not found");
        }
        $user = $stmt->fetch();

        if(!password_verify($password, $user["password"])){
            throw new Exception("Password does not match.");
        }

        $_SESSION['user'] = $user;
        header('Location:' . BASE_URL . 'views/task/index.php');
        exit();

    } catch(Exception $e){
        $error = $e->getMessage();
    }    
}