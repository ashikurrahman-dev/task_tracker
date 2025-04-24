# Task Tracker

A simple task management application to help users organize their tasks with basic CRUD operations and status tracking.

## Features

- **User Management**
  - Create user accounts
  - User authentication
  - User-specific task management

- **Task Management**
  - Add new tasks
  - Update existing tasks
  - Delete tasks
  - Change task status (todo, in_progress, done)
  
- **Task Views**
  - List all tasks
  - Filter tasks by status:
    - Todo tasks
    - In-progress tasks
    - Completed tasks

## Database Schema

The application uses two main tables:

### Users Table
| Column   | Type     | Description          |
|----------|----------|----------------------|
| id       | Integer  | Primary key          |
| name     | String   | User's full name     |
| email    | String   | User's email address |
| password | String   | Hashed password      |
| top      | Boolean  | Top user flag        |

### Tasks Table
| Column      | Type     | Description                          |
|-------------|----------|--------------------------------------|
| id          | Integer  | Primary key                          |
| user_id     | Integer  | Foreign key referencing users table  |
| description | String   | Task description                     |
| status      | Enum     | Task status (todo, in_progress, done)|

## API Endpoints

### User Endpoints
- `POST /users` - Create a new user
- `GET /users/:id` - Get user details
- `PUT /users/:id` - Update user information
- `DELETE /users/:id` - Delete user account

### Task Endpoints
- `POST /tasks` - Create a new task
- `GET /tasks` - List all tasks for current user
  - Query parameters:
    - `status=todo` - Filter by todo tasks
    - `status=in_progress` - Filter by in-progress tasks
    - `status=done` - Filter by completed tasks
- `GET /tasks/:id` - Get task details
- `PUT /tasks/:id` - Update task
- `DELETE /tasks/:id` - Delete task
- `PUT /tasks/:id/status` - Update task status

## Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/task_tracker.git
   cd task_tracker
