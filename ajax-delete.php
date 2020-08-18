<?php
$id = $_POST['id'];
$con = mysqli_connect("localhost","root","","ajax") or die("Connection Failed");

$sql = "DELETE from student where id='{$id}'";
if(mysqli_query($con,$sql)){
    echo 1;
}else {
    echo 0;
}

?>