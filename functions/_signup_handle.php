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
    'firstname' => [
      ['type' => 'required', 'message' => 'Firstname is required'],
      // Add more rules as needed
    ],
    'lastname' => [
      ['type' => 'required', 'message' => 'Lastname is required'],
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
      var_dump($errors);
      // Display errors
      // foreach ($errors as $fieldName => $error) {
        $_SESSION['loginValidation'] = $errors;
        header('location: /pdo_crud/index.php');
          // return $error . "<br>";
      // }
    }else{
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      
      if(isset($_POST['remember'])){
        setcookie('email', $email, time()*60*60*7);
        setcookie('password', $password, time()*60*60*7);
      }

      
      $stmt = $dbc->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)");
      
      $stmt->bindValue(':firstname', $firstname);
      $stmt->bindValue(':lastname', $lastname);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', $password);
      
      if($stmt->execute()){
        $last_id = $dbc->lastInsertId();
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $last_id;
        header('location: /pdo_crud/index.php');
        exit;
      }
    }
    
  }

?>