<?php

  class Category {
    // db stuff
    private $conn;
    private $table = "categories";

    // post properties
    public $id;
    public $name;
    public $created_at;

    // constructor with db connection 
    public function __construct($db){
      $this->conn = $db;

    }
    
    // getting posts from database
    public function read(){
      // create query
      $query = 'SELECT * FROM '. $this->table;
      // prepare statement
      $stmt = $this->conn->prepare($query);

      $stmt -> execute();

      return $stmt;
    }

    // public function read_single(){

    //   $query = 'SELECT
    //     c.name as category_name,
    //     p.id,
    //     p.category_id,
    //     p.title,
    //     p.body,
    //     p.author,
    //     p.created_at 
    //     FROM
    //     ' . $this->table. ' p
    //     LEFT JOIN
    //       categories c ON p.category_id = c.id
    //       WHERE p.id = ? LIMIT 1';

    //   // prepare statement
    //   $stmt = $this->conn->prepare($query);
    //   // Bind values
    //   $stmt->bindParam(1, $this->id);
    //   // Execute the query
    //   $stmt->execute();

    //   $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //   $this->title = $row['title'];
    //   $this->body = $row['body'];
    //   $this->author = $row['author'];
    //   $this->category_id = $row['category_id'];
    //   $this->category_name = $row['category_name'];
    // }

    public function create() {
      // create query
      $query = 'INSERT INTO '. $this->table.' SET name = :name';
      // prepare statement
      $stmt = $this->conn->prepare($query);
      // clean data
      $this->name = htmlspecialchars(strip_tags($this->name));
      // bind the data
      $stmt->bindParam(':name', $this->name);
      // execute query
      if($stmt->execute()) {
        return true;
      }

      // print if something goes wrong
      printf("Error %s. \n", $stmt->error);
      return false; 

    }

    public function update() {
      // create query
      $query = 'UPDATE '. $this->table.' 
        SET name = :name 
        WHERE id = :id';
      // prepare statement
      $stmt = $this->conn->prepare($query);
      // clean data
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->id = htmlspecialchars(strip_tags($this->id));
      // bind the data
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':id', $this->id);
      // execute query
      if($stmt->execute()) {
        return json_encode($stmt->fetch());
      }

      // print if something goes wrong
      printf("Error %s. \n", $stmt->error);
      return false; 

    }

    public function delete() {
      // create query
      $query = 'DELETE FROM '. $this->table.' WHERE id = :id';
      // prepare statement
      $stmt = $this->conn->prepare($query);
      // clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      // bind data
      $stmt->bindParam(':id', $this->id);
      // execute query
      if($stmt->execute()) {
        return true;
      }

      // print error if somthing goes wrong
      printf("Error %s  \n", $stmt->error);
      return false;
    }
  }
?>