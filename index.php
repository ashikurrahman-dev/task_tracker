<?php
define("BASE_URL","http://task_tracker.test/");
session_start();
if(isset($_SESSION['user'])){
  header('Location: ' . BASE_URL .'controller/taskController.php');
  exit();
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Todo App - Welcome</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 min-h-screen text-white font-sans">

  <!-- Navbar -->
  <header class="flex justify-between items-center px-6 py-4">
    <h1 class="text-2xl font-bold">📝 TodoApp</h1>
    <div class="space-x-4">
      <a href="<?= BASE_URL ?>views/auth/login.php"
         class="bg-white text-indigo-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">Sign In</a>
      <a href="<?= BASE_URL ?>views/auth/register.php"
         class="bg-indigo-800 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-900 transition">Sign Up</a>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="flex flex-col justify-center items-center text-center mt-32 px-4">
    <h2 class="text-5xl font-extrabold mb-4">Welcome to TodoApp</h2>
    <p class="text-xl max-w-2xl mb-6">
      Stay organized and boost your productivity. Create, track, and manage your tasks with ease — all in one clean interface.
    </p>
    <a href="<?= BASE_URL ?>views/auth/register.php"
       class="bg-white text-indigo-700 px-6 py-3 rounded-full font-bold text-lg hover:bg-gray-100 transition">
      Get Started
    </a>
  </section>

</body>
</html>
