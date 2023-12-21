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

    ?>
    <?php include "./initials/_header.php" ?>
    <div class="container" style="width:100%;">
      <h2 class="mb-5 mt-3">Add Student Record</h2>
      <form action="/" method="POST" enctype="multipart/form-data">
        <div class="row g-3 mb-3">
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Student Firstname</label>
            <input type="text" class="form-control" name="firstname" placeholder="First name" aria-label="First name">
          </div>
          <div class="col">
            <label for="exampleInputEmail1" class="form-label">Student Lastname</label>
            <input type="text" class="form-control" name="lastname" placeholder="Last name" aria-label="Last name">
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
            <input type="date" class="form-control" name="dob" placeholder="date" aria-label="dob">
          </div>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label" for="gender">Grade Level</label>
            <select class="form-control" name="grade" required>
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
            <select class="form-control" name="class" required>
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
            <input type="text" class="form-control" name="zipCode" placeholder="Enter Zipcode" aria-label="zipCode">
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>