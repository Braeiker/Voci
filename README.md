# VociREST PHP Project

This project implements a simple RESTful API for managing books using PHP and MySQL.

## Project Structure

- **config**: Contains the database configuration file.
- **models**: Contains PHP files defining the data model (e.g., `book.php`).
- **models/api**: Contains PHP files implementing the API functionality (e.g., `read.php`, `create.php`, `update.php`, `delete.php`).
- **migrations.sql**: SQL file for database migrations.

## Setup

1. Import the `migrations.sql` file into your MySQL database to set up the required tables.
2. Update the database configuration in `config/database.php` with your database credentials.

## API Endpoints

- **Read all books**: `GET /VociREST/models/api/read.php`
- **Create a book**: `POST /VociREST/models/api/create.php`
- **Update a book**: `PUT /VociREST/models/api/update.php`
- **Delete a book**: `DELETE /VociREST/models/api/delete.php`

## Usage

- Use a tool like Postman or cURL to interact with the API.
- Refer to the API endpoints mentioned above for each operation.

## Example API Response

```json
{
    "records": [
        {
            "ISBN": "123456789",
            "Author": "John Doe",
            "Title": "Sample Book"
        },
        {
            "ISBN": "987654321",
            "Author": "Jane Doe",
            "Title": "Another Book"
        }
    ]
}
