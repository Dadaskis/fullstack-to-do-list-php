<?php
header("Content-Type: application/json"); // Set response type to JSON
include 'db_connection.php'; // Include your database connection file

// Get the HTTP method (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Handle GET request (fetch all tasks or a single task)
if ($method === 'GET') {
    if (isset($_GET['id'])) {
        // Fetch a single task by ID
        $id = $_GET['id'];
        $sql = "SELECT * FROM tasks WHERE id = $id";
    } else {
        // Fetch all tasks
        $sql = "SELECT * FROM tasks";
    }
    $result = $conn->query($sql);
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
    echo json_encode($tasks);
}

if ($method === 'POST') {
    // Decode the JSON input
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract data
    $title = $data['title'];
    $description = $data['description'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description); // "ss" means two string parameters

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["message" => "Task created"]);
    } else {
        echo json_encode(["error" => "Error creating task"]);
    }

    // Close the statement
    $stmt->close();
}

// Handle PUT request (update a task)
if ($method === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $title = $data['title'];
    $description = $data['description'];
    $sql = "UPDATE tasks SET title = '$title', description = '$description' WHERE id = $id";
    if ($conn->query($sql)) {
        echo json_encode(["message" => "Task updated"]);
    } else {
        echo json_encode(["error" => "Error updating task"]);
    }
}

// Handle DELETE request (delete a task)
if ($method === 'DELETE') {
    $id = $_GET['id'];
    $sql = "DELETE FROM tasks WHERE id = $id";
    if ($conn->query($sql)) {
        echo json_encode(["message" => "Task deleted"]);
    } else {
        echo json_encode(["error" => "Error deleting task"]);
    }
}

$conn->close();
?>