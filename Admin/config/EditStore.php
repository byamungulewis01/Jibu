<?php
require '../../config/conn.php';
if (isset ($_POST['submit'])  ) {
    $littles = $_POST['littles'];
    $Amount = $_POST['Amount'];
    $Refill = $_POST['Refill'];
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    // Image Upload
    $Image=$_FILES['image']['name'];
    $temp_n=$_FILES['image']['tmp_name'];
    $store ="../../Images/" .basename($_FILES['image']['name']);
    move_uploaded_file($temp_n, $store);
    $sql = 'UPDATE `water_bottle` SET `Littles`=?, `Amount`=?, `Refill`=?, `quantity`=?,`Image`=? WHERE id=?';
    $statement = $connection->prepare($sql);
    if ($statement->execute([$littles, $Amount,$Refill,$quantity,$Image,$id])) {
        header("Location: ../Store.php?updated");
    }

    }
    else {
        # code...
        header("Location: ../Store.php?error");
    }

 ?>