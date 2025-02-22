<?php
class TaskManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function fetchTasks(?int $id = null): array {
        try {
            if ($id) {
                $stmt = $this->conn->prepare("SELECT * FROM tasks WHERE id = ?");
                $stmt->bind_param("i", $id);
            } else {
                $stmt = $this->conn->prepare("SELECT * FROM tasks");
            }
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Failed to fetch tasks: " . $e->getMessage());
        }
    }

    public function createTask(string $title, string $description): array {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $description);
            $stmt->execute();
            return [
                "id" => $stmt->insert_id,
                "title" => $title,
                "description" => $description,
            ];
        } catch (Exception $e) {
            throw new Exception("Failed to create task: " . $e->getMessage());
        }
    }

    public function updateTask(int $id, string $title, string $description): array {
        try {
            $stmt = $this->conn->prepare("UPDATE tasks SET title = ?, description = ? WHERE id = ?");
            $stmt->bind_param("ssi", $title, $description, $id);
            $stmt->execute();
            return ["message" => "Task updated"];
        } catch (Exception $e) {
            throw new Exception("Failed to update task: " . $e->getMessage());
        }
    }

    public function deleteTask(int $id): array {
        try {
            $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return ["message" => "Task deleted"];
        } catch (Exception $e) {
            throw new Exception("Failed to delete task: " . $e->getMessage());
        }
    }
}
?>