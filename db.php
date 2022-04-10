<?php  
$server="localhost:3308";
$user="root";
$password="";
$database="notes_data";
$conn=mysqli_connect($server,$user,$password,$database);
if(!$conn){
    echo"Database Error";
}

?>