<?php
include "./db.php";
$id=$_GET["id"];
$deleteQuery="DELETE FROM `notes` WHERE `sno`='$id'";
$res=mysqli_query($conn,$deleteQuery);
header("location:./index.php");
?>