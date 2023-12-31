
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php

use function PHPSTORM_META\type;

 include "./initials/_header.php" ?>
    <?php
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
    <div class="container">
      <?php 
        $results = json_decode($response);
        foreach ($results->data as $card):
      ?>
      
      <div class="card m-3">
        <div class="card-header">
          <?php echo $card->title; ?>
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p> <?php echo $card->body; ?> </p>
            <footer class="blockquote-footer">Written By : <cite title="Source Title"> <?php echo $card->author; ?> </cite></footer>
          </blockquote>
        </div>
      </div>

      <?php endforeach; ?>
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
