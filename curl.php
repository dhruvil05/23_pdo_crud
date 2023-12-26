<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CURL</title>
  </head>
  <body>
    <?php include "./initials/_header.php" ?>
    <?php
      use function PHPSTORM_META\type;
      // API endpoint URL
      $apiUrl = 'http://localhost/pdo_crud/api/posts/read.php';

      // Initialize cURL session
      $ch = curl_init($apiUrl);

      // Set cURL options
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
      // Add more options as needed, such as headers, authentication, etc.

      // Execute cURL session and get the response
      $response = curl_exec($ch);

      // Check for cURL errors
      if (curl_errno($ch)) {
          echo 'Error: ' . curl_error($ch);
      }

      // Close cURL session
      curl_close($ch);

    ?>

    <?php 
      $page = $_GET['page']??1;
      $url = "https://reqres.in/api/users?page=$page";

      $newCurl = curl_init();

      curl_setopt($newCurl, CURLOPT_URL, $url);

      curl_setopt($newCurl, CURLOPT_RETURNTRANSFER, true);
      
      $output = curl_exec($newCurl);

      $records = json_decode($output);
      
    ?>
    <div class="container">
      <h1>Client URL Data</h1>
      
      <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>EMAIL</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>AVATAR</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($records->data as $record): ?>
                <tr>
                    <td><?php echo $record->id ?></td>
                    <td><?php echo $record->email ?></td>
                    <td><?php echo $record->first_name ?></td>
                    <td><?php echo $record->last_name ?></td>
                    <td><img src="<?php echo $record->avatar ?>" alt="" srcset="" style="width: 100px;"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="?page=1" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item">
            <a class="page-link" href="?page=2" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <?php include "./initials/_footer.php" ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
