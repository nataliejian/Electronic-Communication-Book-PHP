<?php
    include 'connection.php';
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);

    $phone = $obj['phone'];

    $sql = "SELECT student.NS, student.name, student.class FROM `student`
    INNER JOIN parent ON student.parent_phone = parent.phone
    WHERE parent.phone = '$phone'";
    $result=mysqli_query($con,$sql);

    $number_of_rows = mysqli_num_rows($result);
     
    $temp_array  = array();
    
    if($number_of_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $temp_array[] = $row;
        }
    }

  echo json_encode($temp_array);
  mysqli_close($con);
?>
