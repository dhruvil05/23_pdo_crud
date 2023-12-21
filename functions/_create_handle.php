<?php

require "./configs/db_config.php";


function getData() {
    global $db;
    $query = "SELECT * FROM classrooms";
    $stmt = $db->query($query);
    $classes = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $teacher = "SELECT id,CONCAT(firstname,' ', lastname) AS teacher_name FROM users";
    $stmt = $db->prepare($teacher);
    $stmt->execute();
    $teachers = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $state = "SELECT id, name FROM states";
    $stmt = $db->query($state);
    $states = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    return [$classes, $teachers, $states];

}

function create() {
  global $db;
  
  
}

function getAllStudentData() {
  session_start();
  global $db;
  $user_id = $_SESSION['user_id']??'0';

  $query = "SELECT s.*, c.class_name as class, st.name as state, CONCAT(u.firstname, ' ', u.lastname) as class_teacher FROM students s 
              LEFT JOIN classrooms c ON s.class_id = c.class_id
              LEFT JOIN states st ON s.state = st.id
              LEFT JOIN users u ON s.class_teacher_id = u.id
              WHERE s.class_teacher_id = $user_id";    
              
  $stmt = $db->query($query);
  $students = [];

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $students[] = $row;
  }

  return $students;

}

function deleteData($id) {
  global $db;

  $query = "DELETE FROM students where student_id = ?";

  $stmt = $db->prepare($query);

  $stmt->bindParam(1, $id);

  if($stmt->execute()){
    header('Location: http://localhost/pdo_crud/index.php');
  }else{
    echo 'Data not delete.';
  }

}

?>