<?php
require_once __DIR__ . "/../includes/functions.php";


// Create a task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    try {
        $task = validateInput($_POST['task']);
        $user_id = $_SESSION['user']['id'];
        $stmt = $pdo->prepare("INSERT INTO task(user_id, description) VALUES(?, ?)");
        $stmt->execute([$user_id, $task]);
    } catch (Exception $e) {
        // Optional
    }
    // Redirect to prevent form resubmission
    header('Location: ' . BASE_URL . 'controller/taskController.php');
    exit();
}

// Update task to 'in-progress'
if (isset($_REQUEST["inProgressID"])) {
    $id = validateInput($_REQUEST["inProgressID"]);
    $stmt = $pdo->prepare("UPDATE task SET status=? WHERE id=?");
    $stmt->execute(['in-progress', $id]);
    header('Location: ' . BASE_URL . 'controller/taskController.php');
    exit();
}

// Update task to 'done'
if (isset($_REQUEST["doneID"])) {
    $id = validateInput($_REQUEST["doneID"]);
    $stmt = $pdo->prepare("UPDATE task SET status=? WHERE id=?");
    $stmt->execute(['done', $id]);
    header('Location: ' . BASE_URL . 'controller/taskController.php');
    exit();
}


// Delete a task
if (isset($_REQUEST["deleteID"])) {
    $id = validateInput($_REQUEST["deleteID"]);
    $stmt = $pdo->prepare("DELETE FROM task WHERE id=?");
    $stmt->execute([$id]);
    header('Location: ' . BASE_URL . 'controller/taskController.php');
    exit();
}

// Fetch tasks based on status
if (isset($_REQUEST['status']) && $_REQUEST['status'] !== 'all') {
    $status = validateInput($_REQUEST['status']);
    $stmt = $pdo->prepare("SELECT * FROM task WHERE status=? ORDER BY id DESC");
    $stmt->execute([$status]);
    $tasks = $stmt->fetchAll();
} else {
    // Fetch all tasks by default
    $stmt = $pdo->prepare("SELECT * FROM task ORDER BY id DESC");
    $stmt->execute();
    $tasks = $stmt->fetchAll();
}

// Show the view
require_once __DIR__ . '/../views/task/allTask.php';
exit();
