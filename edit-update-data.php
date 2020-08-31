<?php
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$con = mysqli_connect("localhost","root","","ajax") or die("Connection Failed");

$sql = "UPDATE student SET firstname = '{$fname}',lastname = '{$lname}' Where id='{$id}'";

if(mysqli_query($con,$sql)){
    echo 1;
}else {
    echo 0;
}

?>