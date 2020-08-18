<?php 
$con = mysqli_connect("localhost","root","","ajax") or die("Connection Failed");

$sql = "SELECT * from student";
$result = mysqli_query($con,$sql) or die("Sql Query Failed");

$output = "";

if(mysqli_num_rows($result) > 0){
    $output = '<table border="1" width="100%">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Action</td>
            </tr>';

            while($row = mysqli_fetch_assoc($result)){
                $output .= "<tr><td>{$row["id"]}</td> <td>{$row["firstname"]} {$row["lastname"]}</td><td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
            }

            $output .= '</table>';

            mysqli_close($con);

            echo $output;

}else {
    echo "No Recode Found";

}

?>