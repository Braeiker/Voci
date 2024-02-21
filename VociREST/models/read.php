<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database.php and book.php to use them
include_once '../config/database.php';
include_once '../models/books.php';

// Create a new Database object and connect to our database
$database = new Database();
$db = $database->getConnection();

// Create a new Book object
$book = new Book($db);

// Query books
$stmt = $book->getAllBooks(); 
$num = $stmt->rowCount();

// Check if books are found
if ($num > 0) {
    $books_arr = array();
    $books_arr["records"] = array();

    // Fetch and process each book
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $book_data = array(
            "ISBN" => $ISBN,
            "Author" => $Author,
            "Title" => $Title
        );

        array_push($books_arr["records"], $book_data);
    }

    // HTTP Status Code 200 OK
    http_response_code(200);
    echo json_encode($books_arr);
} else {
    // HTTP Status Code 404 Not Found
    http_response_code(404);
    echo json_encode(
        array("message" => "No Books Found.")
    );
}
?>
