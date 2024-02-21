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

// Get data from the request
$data = json_decode(file_get_contents("php://input"));

// Set book property values
$book->ISBN = $data->ISBN;
$book->Author = $data->Author;
$book->Title = $data->Title;

// Update the book
if ($book->updateBook()) {
    // HTTP Status Code 200 OK
    http_response_code(200);
    echo json_encode(array("message" => "Book was updated."));
} else {
    // HTTP Status Code 503 Service Unavailable
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update book."));
}
?>
