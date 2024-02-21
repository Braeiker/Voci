<?php
class Book
{
    private $conn;
    private $table_name = "books";

    // Properties of a book
    public $ISBN;
    public $Author;
    public $Title;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // READ all books
    public function getAllBooks()
    {
        $query = "SELECT
                    ISBN, Author, Title
                FROM
                    {$this->table_name}";
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        return $stmt;
    }

    // CREATE a book
    public function createBook()
    {
        $query = "INSERT INTO {$this->table_name} (ISBN, Author, Title) VALUES (:isbn, :author, :title)";
        $stmt = $this->conn->prepare($query);

        // Sanitize input data
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->Author = htmlspecialchars(strip_tags($this->Author));
        $this->Title = htmlspecialchars(strip_tags($this->Title));

        // Bind parameters
        $stmt->bindParam(":isbn", $this->ISBN);
        $stmt->bindParam(":author", $this->Author);
        $stmt->bindParam(":title", $this->Title);

        // Execute the query
        if ($stmt->execute()) {
            return true; // Insertion successful
        }

        return false; // Insertion failed
    }

    // UPDATE a book
    public function updateBook()
    {
        $query = "UPDATE {$this->table_name} SET Title = :title, Author = :author WHERE ISBN = :isbn";
        $stmt = $this->conn->prepare($query);

        // Sanitize input data
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->Author = htmlspecialchars(strip_tags($this->Author));
        $this->Title = htmlspecialchars(strip_tags($this->Title));

        // Bind parameters
        $stmt->bindParam(":isbn", $this->ISBN);
        $stmt->bindParam(":author", $this->Author);
        $stmt->bindParam(":title", $this->Title);

        // Execute the query
        if ($stmt->execute()) {
            return true; // Update successful
        }

        return false; // Update failed
    }

    // DELETE a book
    public function deleteBook()
    {
        $query = "DELETE FROM {$this->table_name} WHERE ISBN = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitize input data
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));

        // Bind parameter
        $stmt->bindParam(1, $this->ISBN);

        // Execute query
        if ($stmt->execute()) {
            return true; // Deletion successful
        }

        return false; // Deletion failed
    }
}
?>
