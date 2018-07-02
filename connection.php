<?php

$connect = mysqli_connect("localhost","root","naik","project");

if($connect === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
?>