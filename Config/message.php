<?php
session_start();
require "conn.php";

    $message = $_POST['message'];
    $Nemes = $_POST['names'];
    $phone = $_POST['mobileno'];   
    $sql = 'INSERT INTO `customer_ideas`(`names`, `message`, `phone`) VALUES (?,?,?)';
    $statement = $connection->prepare($sql);
    if($statement->execute([$Nemes,$message,$phone]))
    {  
       $_SESSION['msg'] = '<script>swal("Good job", "Thank For your idea will be considered","success");</script>';
       header('location: ../');
    }
      
