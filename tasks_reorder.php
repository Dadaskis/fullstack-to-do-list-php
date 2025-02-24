<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:5173/");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'db_connection.php';
include 'task_manager.php';

// Handle CORS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Max-Age: 3600");
    exit(0);
}

// Create an instance of the TaskManager class
$taskManager = new TaskManager($conn);

// Handle the request
try {
    $method = $_SERVER['REQUEST_METHOD'];
    $response = [];

    switch ($method) {
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $response = $taskManager->reorderTasks($data);
            break;

        default:
            http_response_code(405); // Method Not Allowed
            $response = ["error" => "Method not allowed"];
            break;
    }

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    $conn->close();
}
?>