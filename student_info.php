<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $id = $obj['id'];    
    $password = $obj['password'];
    $sql = "SELECT * FROM student where NS='$id' and password='$password'";
    $check = mysqli_fetch_array(mysqli_query($con,$sql));
    $result=mysqli_query($con,$sql);
    $number_of_rows = mysqli_num_rows($result);
     
    $temp_array  = array();
     
    if($number_of_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[] = $row;
        }
    }
  echo json_encode(array("data"=>$temp_array));
  mysqli_close($con);
?>
