<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database.php and book.php to use them
include_once '../../config/database.php';
include_once '../../models/books.php';

// Create a new Database object and connect to our database
$database = new Database();
$db = $database->getConnection();

// Create a new Book object
$book = new Book($db);

// Get the data sent in the request
$data = json_decode(file_get_contents("php://input"));

// Check if data is present
if (
    !empty($data->ISBN) &&
    !empty($data->Author) &&
    !empty($data->Title)
) {
    // Set the values of the Book object properties
    $book->ISBN = $data->ISBN;
    $book->Author = $data->Author;
    $book->Title = $data->Title;

    // Try to execute the book creation
    if ($book->createBook()) {
        // Set response code 201 Created
        http_response_code(201);

        // Return a success message
        echo json_encode(array("message" => "Book created successfully."));
    } else {
        // Set response code 503 Service Unavailable
        http_response_code(503);

        // Return an error message
        echo json_encode(array("message" => "Unable to create the book."));
    }
} else {
    // Set response code 400 Bad Request
    http_response_code(400);

    // Return an error message if data is incomplete
    echo json_encode(array("message" => "Unable to create the book. Incomplete data."));
}
?>
