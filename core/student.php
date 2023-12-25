<?php
  // session_start();
  class Student {
    // db stuff
    private $conn;
    // private $user_id;
    private $table = "students";

    // post properties
    public $student_id;
    public $first_name;
    public $last_name;
    public $gender;
    public $birth_date;
    public $grade_level;
    public $class_id;
    public $address;
    public $city;
    public $state;
    public $zip_code;
    public $parent_name;
    public $contact_number;
    public $enrollment_date;
    public $class_teacher_id;

    // constructor with db connection 
    public function __construct($dbc){
      $this->conn = $dbc;
      // $this->user_id = $user_id;

    }
    
    // getting posts from database
    public function read($user_id){
      
      // create query
      $query = "SELECT s.*, c.class_name as class, st.name as state, CONCAT(u.firstname, ' ', u.lastname) as class_teacher FROM ".
      $this->table ." s 
      LEFT JOIN classrooms c ON s.class_id = c.class_id
      LEFT JOIN states st ON s.state = st.id
      LEFT JOIN users u ON s.class_teacher_id = u.id
      WHERE s.class_teacher_id = ?";

      // prepare statement
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
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
      $query = 'INSERT INTO '. $this->table.' SET first_name = :first_name, last_name = :last_name, gender = :gender, 
      birth_date = :birth_date, grade_level= :grade_level, class_id = :class_id, address = :address, city = :city, state = :state, zip_code = :zip_code, parent_name = :parent_name, contact_number = :contact_number, enrollment_date = :enrollment_date, class_teacher_id= :class_teacher_id';
      // prepare statement
      $stmt = $this->conn->prepare($query);
      // clean data
      $this->first_name = htmlspecialchars(strip_tags($this->first_name));
      $this->last_name = htmlspecialchars(strip_tags($this->last_name));
      $this->gender = htmlspecialchars(strip_tags($this->gender));
      $this->birth_date = htmlspecialchars(strip_tags($this->birth_date));
      $this->grade_level = htmlspecialchars(strip_tags($this->grade_level));
      $this->class_id = htmlspecialchars(strip_tags($this->class_id));
      $this->address = htmlspecialchars(strip_tags($this->address));
      $this->city = htmlspecialchars(strip_tags($this->city));
      $this->state = htmlspecialchars(strip_tags($this->state));
      $this->zip_code = htmlspecialchars(strip_tags($this->zip_code));
      $this->parent_name = htmlspecialchars(strip_tags($this->parent_name));
      $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
      $this->enrollment_date = htmlspecialchars(strip_tags($this->enrollment_date));
      $this->class_teacher_id = htmlspecialchars(strip_tags($this->class_teacher_id));

      // bind the data
      $stmt->bindParam(':first_name', $this->first_name);
      $stmt->bindParam(':last_name', $this->last_name);
      $stmt->bindParam(':gender', $this->gender);
      $stmt->bindParam(':birth_date', $this->birth_date);
      $stmt->bindParam(':grade_level', $this->grade_level);
      $stmt->bindParam(':class_id', $this->class_id, PDO::PARAM_INT);
      $stmt->bindParam(':address', $this->address);
      $stmt->bindParam(':city', $this->city);
      $stmt->bindParam(':state', $this->state);
      $stmt->bindParam(':zip_code', $this->zip_code);
      $stmt->bindParam(':parent_name', $this->parent_name);
      $stmt->bindParam(':contact_number', $this->contact_number);
      $stmt->bindParam(':enrollment_date', $this->enrollment_date);
      $stmt->bindParam(':class_teacher_id', $this->class_teacher_id, PDO::PARAM_INT);
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
        SET first_name = :first_name, last_name = :last_name, gender = :gender, 
        birth_date = :birth_date, grade_level= :grade_level, class_id = :class_id, address = :address, city = :city, state = :state, zip_code = :zip_code, parent_name = :parent_name, contact_number = :contact_number, enrollment_date = :enrollment_date, class_teacher_id= :class_teacher_id
        WHERE student_id = :student_id';
      // prepare statement
      $stmt = $this->conn->prepare($query);
      // clean data
      $this->student_id = htmlspecialchars(strip_tags($this->student_id));
      $this->first_name = htmlspecialchars(strip_tags($this->first_name));
      $this->last_name = htmlspecialchars(strip_tags($this->last_name));
      $this->gender = htmlspecialchars(strip_tags($this->gender));
      $this->birth_date = htmlspecialchars(strip_tags($this->birth_date));
      $this->grade_level = htmlspecialchars(strip_tags($this->grade_level));
      $this->class_id = htmlspecialchars(strip_tags($this->class_id));
      $this->address = htmlspecialchars(strip_tags($this->address));
      $this->city = htmlspecialchars(strip_tags($this->city));
      $this->state = htmlspecialchars(strip_tags($this->state));
      $this->zip_code = htmlspecialchars(strip_tags($this->zip_code));
      $this->parent_name = htmlspecialchars(strip_tags($this->parent_name));
      $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
      $this->enrollment_date = htmlspecialchars(strip_tags($this->enrollment_date));
      $this->class_teacher_id = htmlspecialchars(strip_tags($this->class_teacher_id));

      // bind the data
      $stmt->bindParam(':student_id', $this->student_id);
      $stmt->bindParam(':first_name', $this->first_name);
      $stmt->bindParam(':last_name', $this->last_name);
      $stmt->bindParam(':gender', $this->gender);
      $stmt->bindParam(':birth_date', $this->birth_date);
      $stmt->bindParam(':grade_level', $this->grade_level);
      $stmt->bindParam(':class_id', $this->class_id, PDO::PARAM_INT);
      $stmt->bindParam(':address', $this->address);
      $stmt->bindParam(':city', $this->city);
      $stmt->bindParam(':state', $this->state);
      $stmt->bindParam(':zip_code', $this->zip_code);
      $stmt->bindParam(':parent_name', $this->parent_name);
      $stmt->bindParam(':contact_number', $this->contact_number);
      $stmt->bindParam(':enrollment_date', $this->enrollment_date);
      $stmt->bindParam(':class_teacher_id', $this->class_teacher_id, PDO::PARAM_INT);
      // execute query
      if($stmt->execute()) {
        // echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
        return json_encode($stmt->fetch());
      }

      // print if something goes wrong
      printf("Error %s. \n", $stmt->error);
      return false; 

    }

    public function delete() {

      // create query
      $query = 'DELETE FROM '. $this->table.' WHERE student_id = :student_id';
      // prepare statement
      $stmt = $this->conn->prepare($query);
      // clean data
      $this->student_id = htmlspecialchars(strip_tags($this->student_id));
      // bind data
      $stmt->bindParam(':student_id', $this->student_id);
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