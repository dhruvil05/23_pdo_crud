<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Method: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

  //initializing our api
  include_once('../core/initialize.php');

  // instantiate post
  $post = new Category($db);
  
  //get raw posted data
  $data = json_decode (file_get_contents("php://input"));

  $post->name = $data->name;
  // $post->body = $data->body;
  // $post->author = $data->author;
  // $post->category_id = $data->category_id;
  //create post
  if($post->create()) {
      echo json_encode(
        array('message' => 'Category created.')
      );
     
  } else {
      echo json_encode(
        array('message' => 'Category not created.')
      );
  }
?>