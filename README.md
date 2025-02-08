## Task Management System

This is a simple task management system that allows users to create, read, update, and delete tasks. The system is built
using Laravel.

## Installation

1. Clone the repository
2. Run `composer install`
3. Run `php artisan migrate`
4. Run `php artisan db:seed`
5. Run `php artisan serve`

## Todos

- [x] Task **CRUD** with **SoftDelete**
- [x] Assign a task to a user
- [x] **Reuseable** TaskForm
- [x] **Form Validation**
    - Ensure due time is not in the past
    - Ensure start time is before due time
    - Ensure end time is after start time
    - Ensure user exists in the database
- [x] **Enum** for **TaskStatus**, **TaskPriority**.
- [x] **HasDisplayAttributes Trait** for Enum to work with the label and color of the Task Status, Task Priority
- [x] Manage Label and Colors for Task Status, Task Priority mapping inside the Enum
- [x] Create **TaskObserver** to assign authenticated user id to assign_by_id field when creating a task 
