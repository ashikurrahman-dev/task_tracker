
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Todo List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen py-10 px-4 font-sans">

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-purple-700">My Todo List</h1>

        <!-- Tabs -->
        <?php
        $currentStatus = $_GET['status'] ?? 'all';
        ?>

        <div class="flex justify-center space-x-4 mb-4">
            <a href="<?= BASE_URL ?>controller/taskController.php?status=all"
                class="px-4 py-2 rounded-full <?= $currentStatus === 'all' ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' ?>">
                All
            </a>
            <a href="<?= BASE_URL ?>controller/taskController.php?status=todo"
                class="px-4 py-2 rounded-full <?= $currentStatus === 'todo' ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' ?>">
                To Do
            </a>
            <a href="<?= BASE_URL ?>controller/taskController.php?status=in-progress"
                class="px-4 py-2 rounded-full <?= $currentStatus === 'in-progress' ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' ?>">
                Active
            </a>
            <a href="<?= BASE_URL ?>controller/taskController.php?status=done"
                class="px-4 py-2 rounded-full <?= $currentStatus === 'done' ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' ?>">
                Completed
            </a>
        </div>


        <!-- Add Task Input -->
        <form action="" method="POST" class="flex items-center gap-2 mb-6">
            <input type="text" name="task" placeholder="Add new task..."
                class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500" />
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                <i class="fas fa-plus"></i>
            </button>
        </form>


        <!-- Task List -->
        <ul class="space-y-4">
            <?php foreach ($tasks as $task): ?>
                <!-- Task Item -->
                <li class="bg-gray-50 px-4 py-3 rounded-lg flex justify-between items-center shadow-sm">
                    <div>
                        <p class="font-medium text-gray-800"><?= $task['description'] ?></p>
                        <p class="text-sm text-gray-500">Status: <?= $task['status'] ?></p>
                    </div>
                    <div class="flex items-center space-x-3 text-xl">
                        <!-- In Progress -->
                        <a title="In Progress"
                            href="<?= BASE_URL ?>controller/taskController.php?inProgressID=<?= $task['id'] ?>"
                            class="text-yellow-500 hover:text-yellow-600">
                            <i class="fas fa-spinner"></i>
                        </a>
                        <!-- Done -->
                        <a title="Done" href="<?= BASE_URL ?>controller/taskController.php?doneID=<?= $task['id'] ?>"
                            class="text-green-600 hover:text-green-700">
                            <i class="fas fa-check-circle"></i>
                        </a>
                        <!-- Edit -->
                        <a title="Edit" href="<?= BASE_URL ?>views/task/editTask.php?id=<?= $task['id'] ?>" class="text-blue-500 hover:text-blue-600">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Delete -->
                        <a title="Delete" href="<?= BASE_URL ?>controller/taskController.php?deleteID=<?= $task['id'] ?>"
                            class="text-red-500 hover:text-red-600">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</body>
</html>