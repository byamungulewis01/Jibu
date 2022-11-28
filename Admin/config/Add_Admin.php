<?php
require '../../config/conn.php';
if (isset($_POST['submit'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  try {
    $sql = 'INSERT INTO `admin`(`fname`, `lname`, `username`, `password`) 
    VALUES (:fname, :lname,:username, :password)';
    $stmt = $connection->prepare($sql);
    if($stmt->execute([':fname' => $fname, ':lname' => $lname,
     ':username' => $username, ':password' => $username]))
    {
      	
        header("Location: ../Administration.php?registered");

  } 
}
catch (PDOException $e) {
 // echo $e->getMessage();
  header("Location: ../Administration.php?error");
  }  
 }
?>