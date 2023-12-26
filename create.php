<?php session_start() ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php 
      include "./functions/_create_handle.php" ;
    
      $result = getData();  // get all require dropdown data

      function validate($field, $rules) {
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
        return '';
      }
      
      $validationRules = [
        'first_name' => [
            ['type' => 'required', 'message' => 'Firstname is required'],
            // Add more rules as needed
        ],
        'last_name' => [
            ['type' => 'required', 'message' => 'Lastname is required'],
            // Add more rules as needed
        ],
        'gender' => [
          ['type' => 'required', 'message' => 'Gender is required'],
          // Add more rules as needed
        ],
        'birth_date' => [
          ['type' => 'required', 'message' => 'Birth date is required'],
          // Add more rules as needed
        ],
        'grade_level' => [
          ['type' => 'required', 'message' => 'Select Grade'],
          // Add more rules as needed
        ],
        'class_id' => [
          ['type' => 'required', 'message' => 'Select Class'],
          // Add more rules as needed
        ],
        'address' => [
          ['type' => 'required', 'message' => 'Address is required'],
          // Add more rules as needed
        ],
        'city' => [
          ['type' => 'required', 'message' => 'City is required'],
          // Add more rules as needed
        ],
        'state' => [
          ['type' => 'required', 'message' => 'Select State'],
          // Add more rules as needed
        ],
        'zip_code' => [
          ['type' => 'required', 'message' => 'Zip-code is required'],
          // Add more rules as needed
        ],
        'parent_name' => [
          ['type' => 'required', 'message' => 'Parent name is required'],
          // Add more rules as needed
        ],
        'contact_number' => [
          ['type' => 'required', 'message' => 'Contact is required'],
          // Add more rules as needed
        ],
        'enrollDate' => [
          ['type' => 'required', 'message' => 'Enrollment Date is required'],
          // Add more rules as needed
        ],
        'classTeacher' => [
          ['type' => 'required', 'message' => 'Select Class Teacher'],
          // Add more rules as needed
        ],
      
      ];

      if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        
        foreach ($validationRules as $fieldName => $rules) {
          $fieldValue = $_POST[$fieldName];
          $error = validate($fieldValue, $rules);
    
          if (!empty($error)) {
              $errors[$fieldName] = $error;
          }
        }

        if (!empty($errors)) {
          // var_dump($errors);
          // Display errors 
            $_SESSION['createValidation'] = $errors;
            header('location: /pdo_crud/create.php');
              // return $error . "<br>";
          // }
        }else{
          // Perform form validation and database insertion here
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $gender = $_POST['gender'];
          $birth_date = $_POST['birth_date'];
          $grade_level = $_POST['grade_level'];
          $class_id = $_POST['class_id'];
          $address = $_POST['address'];
          $city = $_POST['city'];
          $state = $_POST['state'];
          $zip_code = $_POST['zip_code'];
          $parent_name = $_POST['parent_name'];
          $contact_number = $_POST['contact_number'];
          $enrollment_date = $_POST['enrollDate'];
          $class_teacher_id = $_POST['classTeacher'];
        
          // Perform form validation and database insertion
          $insertSuccess = create($first_name, $last_name, $gender, $birth_date, $grade_level, $class_id, $address, $city, $state, $zip_code, $parent_name, $contact_number, $enrollment_date, $class_teacher_id);
        
          if ($insertSuccess) {
            echo '<p class="success-message">Record added successfully!</p>';
            header("Location: http://localhost/pdo_crud/index.php");
          } else {
            echo '<p class="error-message">Error adding record. Please try again.</p>';
          }
        }

      }

    ?>
    <?php include "./initials/_header.php" ?>
    <?php
      if(isset($_SESSION['createValidation'])):
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Please!</strong>
        <?php 
            echo 'All Field Must Be Filled!';
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif ?>
    <div class="container" style="width:100%;">
      <h2 class="mb-5 mt-3">Add Student Record</h2>
      <form action="./create.php" method="POST" enctype="multipart/form-data">
        <div class="row g-3 mb-3">
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Student Firstname</label>
            <input type="text" class="form-control" name="first_name" placeholder="First name" aria-label="First name">
          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Student Lastname</label>
            <input type="text" class="form-control" name="last_name" placeholder="Last name" aria-label="Last name">
          </div>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label" for="gender">Gender</label>
            <select class="form-control" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Date of birth</label>
            <input type="date" class="form-control" name="birth_date" placeholder="date" aria-label="birth_date">
          </div>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label" for="gender">Grade Level</label>
            <select class="form-control" name="grade_level" required>
                <option value="A+">A+</option>
                <option value="A">A</option>
                <option value="B+">B+</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="F">F</option>
            </select>
          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Class</label>
            <select class="form-control" name="class_id" required>
              <?php
                foreach($result[0] as $key=>$value):
              ?>

                <option value=<?php echo $key; ?>><?php echo $value; ?></option>

              <?php endforeach; ?>
            </select>
            <!-- <input type="date" class="form-control" name="dob" placeholder="date" aria-label="dob"> -->
          </div>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label" for="gender">Address</label>
            <input type="text" class="form-control" name="address" placeholder="Enter Student address" aria-label="address">

          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">City</label>
            <input type="text" class="form-control" name="city" placeholder="Enter Student city" aria-label="city">
          </div>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label" for="gender">State</label>
            <select class="form-control" name="state" required>
              <?php
                foreach($result[2] as $key=>$value):
              ?>

                <option value=<?php echo $key; ?>><?php echo $value; ?></option>

              <?php endforeach; ?>
            </select>
          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Zip Code</label>
            <input type="text" class="form-control" name="zip_code" placeholder="Enter Zipcode" aria-label="zipCode">
          </div>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label" for="gender">Parent name</label>
            <input type="text" class="form-control" name="parent_name" placeholder="Enter Student Parent name" aria-label="parent_name">

          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" placeholder="Enter Contact Number" aria-label="contact_number">
          </div>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label" for="gender">Enrollment Date</label>
            <input type="date" class="form-control" name="enrollDate" placeholder="Enter Student Enroll Date" aria-label="enrollDate">
          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Class Teacher</label>
            <select class="form-control" name="classTeacher" required>
              <?php
                foreach($result[1] as $key=>$value):
              ?>
                <option value=<?php echo $key; ?>><?php echo $value; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>        
        <button type="submit" style="width: 100%;" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <?php include "./initials/_footer.php" ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>