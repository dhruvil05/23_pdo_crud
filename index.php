<?php session_start() ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href=<?php echo __DIR__."/styles.css"; ?> > -->

    <title>Home</title>
  </head>
  <body>
    <?php 
      include "./functions/_create_handle.php" ;
    
      // Get all students data
      $records = getAllStudentData();  

      // Delete Student data
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['delete'];
        $result = deleteData($id);
      }
    ?>
    
    <?php include __DIR__."/initials/_header.php" ?>
    <h2>Students Data</h2>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Grade Level</th>
                <th>Class</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip Code</th>
                <th>Parent</th>
                <th>Contact</th>
                <th>Joining Date</th>
                <th>Class Teacher</th>
                <th>Feature</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <?php foreach($records as $record) : ?>
                <tr>
                    <td><?php echo $record['student_id'] ?></td>
                    <td><?php echo $record['first_name'] ?></td>
                    <td><?php echo $record['last_name'] ?></td>
                    <td><?php echo $record['gender'] ?></td>
                    <td><?php echo $record['birth_date'] ?></td>
                    <td><?php echo $record['grade_level'] ?></td>
                    <td><?php echo $record['class'] ?></td>
                    <td><?php echo $record['address'] ?></td>
                    <td><?php echo $record['city'] ?></td>
                    <td><?php echo $record['state'] ?></td>
                    <td><?php echo $record['zip_code'] ?></td>
                    <td><?php echo $record['parent_name'] ?></td>
                    <td><?php echo $record['contact_number'] ?></td>
                    <td><?php echo $record['enrollment_date'] ?></td>
                    <td><?php echo $record['class_teacher'] ?></td>
                   
                    <td class="btn_grp">
                        <form action="./index.php" method="post" onsubmit="return confirmDelete()">
                          <input type="hidden" name="delete" value="<?php echo $record['student_id'] ?>">
                          <button type="submit" class="btn btn-danger w-100 m-1">Delete</button>
                        </form>
                        <form action="./update.php" method="GET">
                            <button class="btn btn-primary w-100 m-1" name="update" value="<?php echo $record['student_id'] ?>">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
      function confirmDelete() {
        var result = confirm("Are you sure you want to delete this item?");
        return result; // If 'OK' is clicked, the form will be submitted; otherwise, it won't.
      }
    </script>
    <?php include __DIR__."/initials/_footer.php" ?>

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