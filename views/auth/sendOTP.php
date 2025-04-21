<?php
require_once __DIR__ ."/../../controller/auth/forgetPasswordController.php";
$error = sendOTP();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md text-center">
        <h1 class="text-2xl font-bold text-purple-700 mb-6">Forgot Password</h1>

        <form action="" method="POST" class="space-y-5">
            <div>
                <label for="email" class="block text-left text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="<?php if (isset($email)) {
                    echo $email;
                } ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" />
            </div>
            <?php if (isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <button type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition duration-300">
                Send OTP
            </button>
        </form>

        <div class="mt-4">
            <a href="<?= BASE_URL; ?>views/auth/login.php" class="text-purple-600 hover:underline text-sm">← Back to
                Login</a>
        </div>
    </div>

</body>

</html>
