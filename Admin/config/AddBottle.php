<?php
require '../../config/conn.php';
if (isset ($_POST['submit'])  ) {
    $littles = $_POST['littles'];
    $Amount = $_POST['Amount'];
    $Refill = $_POST['Refill'];
    $quantity = $_POST['quantity'];
    // Image Upload
    $Image=$_FILES['image']['name'];
    $temp_n=$_FILES['image']['tmp_name'];
    $store ="../../Images/" .basename($_FILES['image']['name']);
    move_uploaded_file($temp_n, $store);
    $sql = 'INSERT INTO `water_bottle`(`Littles`, `Amount`, `Refill`, `quantity`, `Image`) 
    VALUES (?, ?, ?, ?,?)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([$littles, $Amount,$Refill, $quantity, $Image])) {
        header("Location: ../Store.php?added");
    }

    }
    else {
        # code...
        header("Location: ../Store.php?error");
    }

 ?>