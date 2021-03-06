<?php
  class Category {
    // DB  
    private $conn;
    private $table = 'categories';

    // Properties
    public $id;
    public $category;
     
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT id, category 
                FROM categories
                ORDER By id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Category
    public function read_single(){
      // Create query
      $query = 'SELECT id, category 
                FROM categories
                WHERE id = ?
                LIMIT 0, 1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->category = $row['category'];
    }

    // Create Category
    public function create() {
      // Create query
      $query = 'INSERT INTO categories SET category = :category';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->category = htmlspecialchars(strip_tags($this->category));

      // Bind data
      $stmt->bindParam(':category', $this->category);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Category
    public function update() {
      // Create query
      $query = 'UPDATE categories
                SET category = :category
                WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->category = htmlspecialchars(strip_tags($this->category));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':category', $this->category);
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Delete category
    public function delete() {
      // Create query
      $query = 'DELETE FROM categories WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }







}