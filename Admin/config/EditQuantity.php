<?php
require '../../config/conn.php';
if (isset ($_POST['submit'])  ) {
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
   
    $sql = 'UPDATE `water_bottle` SET `quantity`=? WHERE id=?';
    $statement = $connection->prepare($sql);
    if ($statement->execute([$quantity,$id])) {
        header("Location: ../Store.php?updated");
    }

    }
    else {
        # code...
        header("Location: ../Store.php?error");
    }

 ?>