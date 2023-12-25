<?php
  session_start();
  // header('Access-Control-Allow-Origin: *');
  // header('Content-Type: application/json');
  
  //initializing our api
  include_once('/xampp/htdocs/pdo_crud/core/initialize.php');
  // include_once('../core/initialize.php');
// print_r($_SESSION);
  $user_id = $_SESSION['user_id'] ?? $_REQUEST['user_id'];

  // instantiate post
  $post = new Student($dbc);
  // blog post query
  $result = $post->read($user_id);

  // get the row count
  $num = $result->rowCount();
  if($num > 0) {
    $post_arr = array();
    $post_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $post_item = array(
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
        'class_teacher_id' => $class_teacher_id,
        'class' => $class,
        'class_teacher' => $class_teacher,
      );
      array_push($post_arr['data'], $post_item);
    }
    // convert to JSON
    echo json_encode($post_arr);
  }else{
    echo json_encode(array('message' => 'No posts found.'));
  }

?>