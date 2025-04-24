<?php
require_once __DIR__ . "/../../includes/functions.php";

$id = validateInput($_REQUEST['id']);
$stmt = $pdo->prepare('SELECT description FROM task WHERE id=?');
$stmt->execute([$id]);
$task = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $task = $_POST['task'];
        if ($task == '') {
            throw new Exception('Task field can not be empty.');
        }
        $stmt = $pdo->prepare('UPDATE task SET description=? WHERE id=?');
        $stmt->execute([$task, $id]);

        header('Location: ' . BASE_URL .'controller/taskController.php');
        exit();

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Todo List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen py-4 px-4 font-sans">
<nav class="bg-white shadow px-16 py-2 mb-10 flex justify-between items-center">
        <!-- Logo or App Name -->
        <a href="<?= BASE_URL ?>controller/taskController.php" class="text-xl font-bold text-purple-700">📝 TodoApp</a>

        <div class="flex items-center space-x-4">
            <span class="text-gray-700 font-medium">
                <?= "Ashikur Rahman" ?>
            </span>
            <a href="<?= BASE_URL ?>controller/auth/logoutController.php" class="text-white bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition">
                Logout
            </a>
        </div>
    </nav>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-purple-700">My Todo Edit</h1>
        <!-- edit Task Input -->
        <form action="" method="POST" class="flex items-center gap-2 mb-6">
            <input type="text" name="task" placeholder="Add new task..." value="<?= $task['description'] ?>"
                class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500" />
            <?php if (isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                <i class="fas fa-check"></i>
            </button>
        </form>
    </div>

</body>

</html>