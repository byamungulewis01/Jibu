<?php
require '../../config/conn.php';
if (isset($_POST['submit'])) {
  $id = $_POST['admin_id'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  try {
    $sql = 'UPDATE `admin` SET `fname`=:fname, `lname`=:lname,
     `username`=:username, `password`=:password WHERE id=:id';
    $stmt = $connection->prepare($sql);
    if($stmt->execute([':fname' => $fname, ':lname' => $lname,
     ':username' => $username, ':password' => $password,':id' => $id ]))
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