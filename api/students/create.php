<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Method: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

  //initializing our api
  // include_once('../core/initialize.php');
  include_once('/xampp/htdocs/pdo_crud/core/initialize.php');

  // instantiate post
  $student = new Student($dbc);
  
  //get raw posted data
  $data = json_decode (file_get_contents("php://input"));

  $student->first_name = $data->first_name;
  $student->last_name = $data->last_name;
  $student->gender = $data->gender;
  $student->birth_date = $data->birth_date;
  $student->grade_level = $data->grade_level;
  $student->class_id = $data->class_id;
  $student->address = $data->address;
  $student->city = $data->city;
  $student->state = $data->state;
  $student->zip_code = $data->zip_code;
  $student->parent_name = $data->parent_name;
  $student->contact_number = $data->contact_number;
  $student->enrollment_date = $data->enrollment_date;
  $student->class_teacher_id = $data->class_teacher_id;
  // print(json_encode($student));
  //create student
  if($student->create()) {
      echo json_encode(
        array('message' => 'Student created.')
      );
     
  } else {
      echo json_encode(
        array('message' => 'Student not created.')
      );
  }
?>