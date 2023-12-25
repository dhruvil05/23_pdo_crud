<?php  
  session_start();
  include "../configs/db_config.php";

  function validateField($field, $rules) {
    foreach ($rules as $rule) {
        switch ($rule['type']) {
            case 'required':
                if (empty($field)) {
                    return $rule['message'];
                }
                break;
            // Add more validation types as needed
            // Example: case 'min_length':
            // ...

            default:
                // Default case if no validation rule matches
                break;
        }
    }
    return ''; // No validation errors
  }

  $validationRules = [
      'email' => [
          ['type' => 'required', 'message' => 'Email is required'],
          // Add more rules as needed
      ],
      'password' => [
          ['type' => 'required', 'message' => 'Password is required'],
          // Add more rules as needed
      ],
  ];

  if($_SERVER['REQUEST_METHOD'] === "POST") {
    $errors = [];

    foreach ($validationRules as $fieldName => $rules) {
      $fieldValue = $_POST[$fieldName];
      $error = validateField($fieldValue, $rules);

      if (!empty($error)) {
          $errors[$fieldName] = $error;
      }
    }

    if (!empty($errors)) {
      // Display errors
      foreach ($errors as $fieldName => $error) {
          echo $error . "<br>";
      }
    } else {
       
      $email = $_POST['email'];
      $password = $_POST['password'];
  
      if(isset($_POST['remember'])) {
        setcookie('email', $email, time()*60*60*7);
        setcookie('password', $password, time()*60*60*7);
      }
  
      // $_SESSION['email'] = $email;
  
      $stmt = $dbc->prepare("SELECT id, email, password FROM users WHERE email = :email");
      $stmt->bindValue(':email', $email);
  
      $stmt->execute();
  
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  
        if($password === $row['password']) {
          $_SESSION['email'] = $row['email'];
          $_SESSION['user_id'] = $row['id'];
        }
          
        header('location: /pdo_crud/index.php');
        exit;
      }
    }
  }

?>