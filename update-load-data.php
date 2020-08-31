<?php 
$id = $_POST['id'];
$con = mysqli_connect("localhost","root","","ajax") or die("Connection Failed");

$sql = "SELECT * from student where id = {$id}";
$result = mysqli_query($con,$sql) or die("Sql Query Failed");

$output = "";

if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_assoc($result)){
                $output .= "<tr>
                <td>First Name</td>
                <td><input class='form-control' type='text' id='edit-fname' value='{$row["firstname"]}'><input class='form-control' type='text' id='edit-id' value='{$row["id"]}' hidden></td>
              </tr>
              <tr>
                <td>Last Name</td>
                <td><input class='form-control' type='text' id='edit-lname' value='{$row["lastname"]}'> <td>
              </tr>
              <tr>
                <td></td>
                <td><input type='submit' id='edit-submit' value='Update'></td>
              </tr>";
            }
            
            mysqli_close($con);

            echo $output;

}else {
    echo "No Recode Found";

}

?>