<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include necessary files
include_once '../../config/database.php';
include_once '../../models/books.php';

// Create a new Database object and connect to our database
$database = new Database();
$db = $database->getConnection();

// Create a new Book object
$book = new Book($db);

// Get the ISBN of the book to be deleted
$data = json_decode(file_get_contents("php://input"));

// Set ISBN to be deleted
$book->ISBN = $data->ISBN;

// Delete the book
if ($book->deleteBook()) {
    // HTTP Status Code 200 OK
    http_response_code(200);
    echo json_encode(array("message" => "Book was deleted."));
} else {
    // HTTP Status Code 404 Not Found
    http_response_code(404);
    echo json_encode(array("message" => "Book not found or unable to delete."));
}
?>
