<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Method: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

  //initializing our api
  // include_once('../core/initialize.php');
  include_once('/xampp/htdocs/pdo_crud/core/initialize.php');

  // instantiate post
  $student = new Student($dbc);
  
  //get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  $student->student_id = $data->student_id;
  //create post
  if($student->delete()) {
      echo json_encode(
        array('message' => 'Student deleted.')
      );
     
  } else {
      echo json_encode(
        array('message' => 'Student not deleted.')
      );
  }
?>