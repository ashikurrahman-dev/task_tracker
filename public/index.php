<?php
define("BASE_URL", "http://task-trackaer.test/");
session_start();

if (isset($_SESSION["user"])) {
  header("Location: " . BASE_URL . "public/dashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-600 min-h-screen text-white font-sans">

  <!-- Navbar -->
  <header class="flex justify-between items-center px-6 py-4">
    <h1 class="text-2xl font-bold">MyWebsite</h1>
    <div class="space-x-4">
      <a href="<?= BASE_URL ?>public/auth/login.php"
        class="bg-white text-purple-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">Sign In</a>
      <a href="<?= BASE_URL ?>public/auth/register.php"
        class="bg-purple-800 text-white px-4 py-2 rounded-lg font-semibold hover:bg-purple-900 transition">Sign Up</a>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="flex flex-col justify-center items-center text-center mt-32 px-4">
    <h2 class="text-4xl md:text-5xl font-bold mb-4">Welcome to My Website</h2>
    <p class="text-lg md:text-xl max-w-2xl mb-6">
      This is a beautiful and minimal landing page built with Tailwind CSS. Whether you're here to explore or create an
      account, you're in the right place.
    </p>
    <a href="<?= BASE_URL ?>public/auth/register.php"
      class="bg-white text-purple-700 px-6 py-3 rounded-full font-bold text-lg hover:bg-gray-100 transition">
      Get Started
    </a>
  </section>

</body>

</html>