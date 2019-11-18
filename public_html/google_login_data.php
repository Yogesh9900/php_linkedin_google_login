<?php
session_start();
$first_name = $_POST['name'];
$last_name='';
$email = $_POST['email'];
$image = $_POST['image'];
$mobile = '';
$id= $_POST['token'];
//save values in to the database.

$_SESSION['name']= $first_name;
$_SESSION['email']= $email;

?>
