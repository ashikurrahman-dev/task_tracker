<?php
require_once __DIR__ . '/../../controller/auth/loginController.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login</h2>
        <form action="" method="POST" class="space-y-5">
            <div>
                <label class="block mb-1 text-gray-600">Email</label>
                <input type="email" name="email" value="<?php if(isset($email)){ echo $email; } ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" />
            </div>
            <div>
                <label class="block mb-1 text-gray-600">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" />
            </div>
            <?php if (isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <button type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition duration-300">
                Sign In
            </button>
        </form>
        <div class="flex justify-between items-center mt-4 text-sm">
            <a href="<?= BASE_URL; ?>views/auth/register.php"
                class="text-purple-600 hover:underline">Back to Sign Up</a>
            <a href="<?= BASE_URL; ?>public/forgetPassword.php" class="text-purple-600 hover:underline">Forgot Password?</a>
        </div>
    </div>
</body>

</html>