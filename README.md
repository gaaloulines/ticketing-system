# Ticketing System

## About

This is a **Ticketing System** built with **Laravel**, **MySQL**, and **Laravel Breeze** for authentication. The system allows users to create, view, and manage customer support tickets. The system features multiple roles, including **Admin**, **Support Agent**, and **Client**, with each role having different permissions to interact with the tickets.

Key features of the ticketing system include:
- **Role-Based Authentication** using **Laravel Breeze**.
- **CRUD Operations** for tickets (create, read, update, delete).
- **Ticket Categories** (e.g., service or claims).
- **Ticket Priorities** (Low, Medium, High).
- **State Management** for tickets (Open, In Progress, Closed, On Hold).
- **Client Dashboard** to view and manage created tickets.
- **Support Agent Dashboard** to view and manage assigned tickets.
- **Admin Dashboard** to manage users, tickets, and agents.

---

## Description

The **Ticketing System** allows users to submit, track, and manage support tickets within an organization. Clients can create tickets and view their status, while support agents can manage and resolve these tickets. Admins have full control over users, tickets, and agents.

### Key Features:
- **Role-Based Access Control**:
  - **Clients**: Can create new tickets, view their tickets, and track the status of those tickets.
  - **Support Agents**: Can view all tickets, sort them by priority or status, and update the status of tickets they are assigned.
  - **Admins**: Have full control over the system, including managing users, agents, and viewing or editing all tickets.

- **Ticket Categories**: Tickets can be categorized (e.g., service or claims) for better organization.
  
- **Ticket Priorities**: Tickets are assigned a priority (Low, Medium, High) for better management.

- **State Management**: Each ticket has a status to track its progress (Open, In Progress, Closed, On Hold).

- **User Management**: Admin can manage the users of the system, including creating, updating, and deleting clients and support agents.

- **Dashboard Interface**: 
  - The **Admin Dashboard** displays all tickets and users with options for CRUD operations.
  - The **Support Agent Dashboard** allows agents to manage assigned tickets.
  - The **Client Dashboard** allows clients to view and create tickets.

---

## Installation

Follow these steps to run the ticketing system locally:

### Prerequisites:
- PHP 8.x or higher
- Composer
- MySQL or MariaDB

### Steps:
1. Clone the repository:
  
2. Navigate to the project directory:

3. Install the required dependencies using **Composer**:
    ```bash
    composer install
    ```
4. Create a `.env` file by duplicating `.env.example`:
    ```bash
    cp .env.example .env
    ```
5. Set up the **MySQL** database in your `.env` file:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ticketing_system
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Run the database migrations:
    ```bash
    php artisan migrate
    ```

7. Install npm dependencies:
    ```bash
    npm install
    ```
8. Build the frontend assets:
    ```bash
    npm run dev
    ```

9. Seed the database (optional):
    ```bash
    php artisan db:seed
    ```

10. Serve the application:
    ```bash
    php artisan serve
    ```

11. Open your browser and visit `http://127.0.0.1:8000` to access the application.

---


