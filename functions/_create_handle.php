<?php

require "./configs/db_config.php";


function getData() {
    global $dbc;
    $query = "SELECT * FROM classrooms";
    $stmt = $dbc->query($query);
    $classes = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $teacher = "SELECT id,CONCAT(firstname,' ', lastname) AS teacher_name FROM users";
    $stmt = $dbc->prepare($teacher);
    $stmt->execute();
    $teachers = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $state = "SELECT id, name FROM states";
    $stmt = $dbc->query($state);
    $states = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    return [$classes, $teachers, $states];

}

function create($first_name, $last_name, $gender, $birth_date, $grade_level, $class_id, $address, $city, $state, $zip_code, $parent_name, $contact_number, $enrollment_date, $class_teacher_id) {
  global $dbc;

  $query = 'INSERT INTO students SET first_name = :first_name, last_name = :last_name, gender = :gender, 
      birth_date = :birth_date, grade_level= :grade_level, class_id = :class_id, address = :address, city = :city, state = :state, zip_code = :zip_code, parent_name = :parent_name, contact_number = :contact_number, enrollment_date = :enrollment_date, class_teacher_id= :class_teacher_id';
      // prepare statement
      $stmt = $dbc->prepare($query);
      // clean data
      $first_name = htmlspecialchars(strip_tags($first_name));
      $last_name = htmlspecialchars(strip_tags($last_name));
      $gender = htmlspecialchars(strip_tags($gender));
      $birth_date = htmlspecialchars(strip_tags($birth_date));
      $grade_level = htmlspecialchars(strip_tags($grade_level));
      $class_id = htmlspecialchars(strip_tags($class_id));
      $address = htmlspecialchars(strip_tags($address));
      $city = htmlspecialchars(strip_tags($city));
      $state = htmlspecialchars(strip_tags($state));
      $zip_code = htmlspecialchars(strip_tags($zip_code));
      $parent_name = htmlspecialchars(strip_tags($parent_name));
      $contact_number = htmlspecialchars(strip_tags($contact_number));
      $enrollment_date = htmlspecialchars(strip_tags($enrollment_date));
      $class_teacher_id = htmlspecialchars(strip_tags($class_teacher_id));

      // bind the data
      $stmt->bindParam(':first_name', $first_name);
      $stmt->bindParam(':last_name', $last_name);
      $stmt->bindParam(':gender', $gender);
      $stmt->bindParam(':birth_date', $birth_date);
      $stmt->bindParam(':grade_level', $grade_level);
      $stmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':city', $city);
      $stmt->bindParam(':state', $state);
      $stmt->bindParam(':zip_code', $zip_code);
      $stmt->bindParam(':parent_name', $parent_name);
      $stmt->bindParam(':contact_number', $contact_number);
      $stmt->bindParam(':enrollment_date', $enrollment_date);
      $stmt->bindParam(':class_teacher_id', $class_teacher_id, PDO::PARAM_INT);
      // execute query
      if($stmt->execute()) {
        return true;
      }

      return false; 
  
  
}

function getAllStudentData() {
  // session_start();
  global $dbc;
  $user_id = $_SESSION['user_id']??'0';

  $query = "SELECT s.*, c.class_name as class, st.name as state, CONCAT(u.firstname, ' ', u.lastname) as class_teacher FROM students s 
              LEFT JOIN classrooms c ON s.class_id = c.class_id
              LEFT JOIN states st ON s.state = st.id
              LEFT JOIN users u ON s.class_teacher_id = u.id
              WHERE s.class_teacher_id = $user_id";    
              
  $stmt = $dbc->query($query);
  $students = [];

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $students[] = $row;
  }

  return $students;

}

function getSingleData($id) {
  global $dbc;

  $query = "SELECT * FROM students WHERE student_id = $id";

  $result = $dbc->query($query);

  $records = [];

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $records[] = $row;
  }

  // $result->free();

  return $records;


}

function update($first_name, $last_name, $gender, $birth_date, $grade_level, $class_id, $address, $city, $state, $zip_code, $parent_name, $contact_number, $enrollment_date, $class_teacher_id, $student_id) 
{
  global $dbc;

  $student = [
    'student_id' => $student_id,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'gender' => $gender,
    'birth_date' => $birth_date,
    'grade_level' => $grade_level,
    'class_id' => $class_id,
    'address' => $address,
    'city' => $city,
    'state' => $state,
    'zip_code' => $zip_code,
    'parent_name' => $parent_name,
    'contact_number' => $contact_number,
    'enrollment_date' => $enrollment_date,
    'class_teacher_id' => $class_teacher_id
  ];

  $query = "UPDATE students SET first_name = :first_name, last_name = :last_name, gender = :gender, 
  birth_date = :birth_date, grade_level= :grade_level, class_id = :class_id, address = :address, city = :city, state = :state, zip_code = :zip_code, parent_name = :parent_name, contact_number = :contact_number, enrollment_date = :enrollment_date, class_teacher_id= :class_teacher_id WHERE student_id = :student_id";

  $stmt = $dbc->prepare($query);

  // bind the data
  $stmt->bindParam(':student_id', $student['student_id'], PDO::PARAM_INT);
  $stmt->bindParam(':first_name', $student['first_name']);
  $stmt->bindParam(':last_name', $student['last_name']);
  $stmt->bindParam(':gender', $student['gender']);
  $stmt->bindParam(':birth_date', $student['birth_date']);
  $stmt->bindParam(':grade_level', $student['grade_level']);
  $stmt->bindParam(':class_id', $student['class_id'], PDO::PARAM_INT);
  $stmt->bindParam(':address', $student['address']);
  $stmt->bindParam(':city', $student['city']);
  $stmt->bindParam(':state', $student['state']);
  $stmt->bindParam(':zip_code', $student['zip_code']);
  $stmt->bindParam(':parent_name', $student['parent_name']);
  $stmt->bindParam(':contact_number', $student['contact_number']);
  $stmt->bindParam(':enrollment_date', $student['enrollment_date']);
  $stmt->bindParam(':class_teacher_id', $student['class_teacher_id'], PDO::PARAM_INT);
  // execute query
  if($stmt->execute()) {
    return true;
  }

  return false;

}

function deleteData($id) {
  global $dbc;

  $query = "DELETE FROM students where student_id = ?";

  $stmt = $dbc->prepare($query);

  $stmt->bindParam(1, $id);

  if($stmt->execute()){
    header('Location: http://localhost/pdo_crud/index.php');
  }else{
    echo 'Data not delete.';
  }

}

?>