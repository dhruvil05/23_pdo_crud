<!-- <?php session_start(); ?> -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/pdo_crud/index.php">PDO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/pdo_crud/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pdo_crud/create.php">Create</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pdo_crud/api.php">API</a>
        </li>
      </ul>
      <span class="navbar-text">
        <?php
          if(isset($_SESSION['email'])) {
            echo "Welcome, ". $_SESSION['email'];
          }
        ?>
      </span>
      <span class="" style="margin-left: 10px;">
      <?php
        if (isset($_GET["logout"])) {
          session_unset();
      
          session_destroy();
      
          header('location: http://localhost/pdo_crud/index.php');

          exit();
        }

        if(!isset($_SESSION["email"])){

      ?>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSignUp">
        Signup
      </button>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Login
      </button>
      <?php

      }else{ 
        
      ?>
        <a href='?logout=true' name class='btn btn-danger'>Logout</a href='?logout=true'>

      <?php 
        }  

        function sessionDes(){
          session_start();
          session_destroy();
        }
      ?>
      
      <?php include "./initials/_loginmodal.php"; ?>
      <?php include "./initials/_signupmodal.php"; ?>
        <!-- <button class="btn btn-success">Login</button> -->
    
      <!-- <button class="btn btn-danger">Logout</button> -->
      </span>
      
    </div>
  </div>
</nav>