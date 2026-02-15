![image](https://github.com/user-attachments/assets/9fb38611-2bc2-4180-b3fb-c913981640ca)

Frontend: https://github.com/Dadaskis/fullstack-to-do-list-react

# Full Stack To-Do List Application (PHP)

A simple, full-stack task management application built with PHP that allows users to create, read, update, delete, and reorder tasks. This project demonstrates basic CRUD operations and database integration with a focus on simplicity and functionality.

## Features

- Create new tasks
- View all existing tasks
- Update task descriptions
- Delete tasks
- Reorder tasks with drag-and-drop functionality
- Persistent storage using MySQL database

## HTTP Requests Supported

The application supports the following HTTP requests:

### GET Requests
- `/tasks.php` - Retrieve all tasks from the database
- `/task_manager.php` - Load the main task management interface

### POST Requests
- `/tasks.php` - Create a new task
- `/tasks_reorder.php` - Update the order of tasks after drag-and-drop operations

### PUT Requests
- `/tasks.php` - Update an existing task's description

### DELETE Requests
- `/tasks.php` - Delete a specific task from the database

## Project Structure

```
fullstack-to-do-list-php-master/
├── .htaccess               # Apache configuration for URL rewriting
├── db_connection.php       # Database connection configuration
├── Dockerfile              # Docker container configuration
├── README.md               # Project documentation
├── show_code.py            # Utility script to display code files
├── task_manager.php        # Main application interface
├── tasks.php               # REST API endpoint for task operations
├── tasks_reorder.php       # API endpoint for task reordering
└── tree.py                 # Python script to display directory tree
```

## Database Schema

The application uses a MySQL database with a single `tasks` table:

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_description TEXT NOT NULL,
    task_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Installation

### Installation

1. Ensure you have PHP 7.4+ and MySQL installed
2. Create a MySQL database and update the credentials in `db_connection.php`
3. Run the SQL schema to create the tasks table
4. Place the files in your web server's document root
5. Access `task_manager.php` through your web browser

## API Endpoints

### GET /tasks.php
Returns a JSON array of all tasks with their IDs, descriptions, and current order.

### POST /tasks.php
Creates a new task. Expects a JSON body with a `task_description` field.

### PUT /tasks.php
Updates an existing task. Expects a JSON body with `id` and `task_description` fields.

### DELETE /tasks.php
Deletes a task. Expects a JSON body with an `id` field.

### POST /tasks_reorder.php
Updates task order after drag-and-drop. Expects a JSON array of task IDs in their new order.

## Technologies Used

- PHP 7.4+
- MySQL

## License
MIT License. Happiness to everyone!
