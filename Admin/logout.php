<?php 
session_start();
	session_destroy();
	if ($_SESSION['admin']) {
	header("location: index.php");
}
 ?>