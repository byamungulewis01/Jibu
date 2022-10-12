<?php require '../Config/Connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Jibu</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../Images/Logo.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!"><img src="../Images/Logo.png" style="width: 50px; height: 40px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="AddNew.php">Add Product</a></li>
                        <li class="nav-item"><a class="nav-link" href="Submitted.php">Submitted</a></li>
                        <li class="nav-item"><a class="nav-link" href="Order.php">Orders<span class="badge bg-dark text-white ms-1 rounded-pill">
                        <?php 
                                $sql = 'SELECT * FROM `order` WHERE status=0';
                                $statement = $connection->prepare($sql);
                                $statement->execute();
                                $row = $statement->rowCount();
                                echo $row;
                                ?>
                        </span></a>
                        
                    </li>
                     
                    </ul>
                    
                </div>
            </div>
        </nav>