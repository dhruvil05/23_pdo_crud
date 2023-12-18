<?php  
  session_start();
  include "../configs/db_config.php";

  if($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(isset($_POST['remember'])) {
      setcookie('email', $email, time()*60*60*7);
      setcookie('password', $password, time()*60*60*7);
    }

    // $_SESSION['email'] = $email;

    $stmt = $db->prepare("SELECT email, password FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);

    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      if($password === $row['password']) {
        $_SESSION['email'] = $email;
      }
        
      header('location: /pdo_crud/index.php');
      exit;
    }
  }

?>