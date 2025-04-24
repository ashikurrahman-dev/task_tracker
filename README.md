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
| otp      | Integer  | Use forget password  |

### Tasks Table
| Column      | Type     | Description                          |
|-------------|----------|--------------------------------------|
| id          | Integer  | Primary key                          |
| user_id     | Integer  | Foreign key referencing users table  |
| description | String   | Task description                     |
| status      | Enum     | Task status (todo, in_progress, done)|

## Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/task_tracker.git
   cd task_tracker
