# Library Management System

## Overview
This is a RESTful API for a library management system built using PHP Laravel. The API manages books and authors, with features to create, retrieve, update, and delete records.

## Setup

### Prerequisites
- PHP 8.0 or higher
- Composer
- MySQL or another relational database

### Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/library-management-system.git
2. **Navigate to the Project Directory**
    ```bash
    cd library-management-system
3. **Install Dependencies**
    ```bash
    composer install
4. **Set Up Environment Variables**
    Copy the .env.example file to .env:
    ```bash
    cp .env.example .env
5. **Configure Database**
    Edit the .env file to set your database credentials.

6. **Generate Application Key**
    ```bash
    php artisan key:generate
7. **Run Migrations**
    ```bash
    php artisan migrate
8. **Seed the Database with Dummy Data**
    ```bash
    php artisan db:seed

### Running the Application

1. **Start the Development Server**
    ```bash
    php artisan serve
    The application will be available at http://localhost:8000.
2. **Running Tests**
    ```bash
    php artisan test


