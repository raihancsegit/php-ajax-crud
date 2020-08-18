<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$con = mysqli_connect("localhost","root","","ajax") or die("Connection Failed");

$sql = "INSERT INTO student(firstname,lastname) VALUES ('${first_name}','${last_name}')";
//$result = mysqli_query($con,$sql) or die("Sql Query Failed");
if(mysqli_query($con,$sql)){
    echo 1;
}else {
    echo 0;
}

?>