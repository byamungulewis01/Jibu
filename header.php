<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jibu</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="Images/Logo.png" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- gLightbox gallery-->
    <link rel="stylesheet" href="vendor/glightbox/css/glightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
    <!-- Choices CSS-->
    <link rel="stylesheet" href="vendor/choices.js/public/assets/styles/choices.min.css">
    <!-- Swiper slider-->
    <link rel="stylesheet" href="vendor/swiper/swiper-bundle.min.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
  
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body>
    <div class="page-holder">
      <!-- navbar-->
      <header class="header" style="background-color: rgb(17, 164, 223);">
        <div class="container px-lg-3">
          <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.php"><span class="fw-bold text-uppercase text-white">Jibu Rwanda</span></a>
            <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <img src="Images/jibu.png" style="width: 120px; height: 40px;">
                </li>
              
              </ul>
              <ul class="navbar-nav ms-auto">               
                <li class="nav-item"><a class="nav-link text-white" href="cart.php"> <i class="fas fa-dolly-flatbed me-1 text-white"></i>Cart<small class="text-white fw-normal">
                <?php 
                                $ipAdrr =  $_SERVER['REMOTE_ADDR'];
                                $sql = 'SELECT * FROM `cart` WHERE Client_Host=:Client_Host';
                                $statement = $connection->prepare($sql);
                                $statement->execute([':Client_Host' =>  $ipAdrr]);
                                $row = $statement->rowCount();
                                echo '('.$row.')';
                                ?>
                </small></a></li>
                <li class="nav-item"><a class="nav-link text-white" href="Admin/" target="_blank"> <i class="fas fa-user me-1 text-white fw-normal"></i>Admin</a></li>
              </ul>
            </div>
          </nav>
        </div>
      </header> 