<?php  
  session_start();
  include "../configs/db_config.php";

  if($_SERVER['REQUEST_METHOD'] === "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(isset($_POST['remember'])){
      setcookie('email', $email, time()*60*60*7);
      setcookie('password', $password, time()*60*60*7);
    }


    $stmt = $db->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)");

    $stmt->bindValue(':firstname', $firstname);
    $stmt->bindValue(':lastname', $lastname);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);

    if($stmt->execute()){
      $last_id = $db->lastInsertId();
      $_SESSION['email'] = $email;
      $_SESSION['user_id'] = $last_id;
      header('location: /pdo_crud/index.php');
      exit;
    }
    
  }

?>