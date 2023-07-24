<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php

include("connection.php");

$id = $_GET['deleteid'];

$sql=" DELETE FROM `article_table` WHERE id=$id ";
$result=mysqli_query($con, $sql);
if($result){
    header("Location:view.php");
}
?>
