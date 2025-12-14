<?php

$host = "localhost";   
$user = "root";        
$password = "";            
$db = "attendance"; 

$con = mysqli_connect($host, $user, $password, $db);

$studentid = $_GET["studentid"] ;
$password  = $_GET["password"] ;

$sql = "select * from student_details where studentid='$studentid' and password='$password'";

$result = mysqli_query($con, $sql);


if(mysqli_num_rows($result) < 1){
    $status = "failed";
    echo json_encode(array("response" => $status));

}
 else {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username']; 
    $status = "ok";
    
    echo json_encode(array("studentid" => $studentid,"username" => $username
    ));
}

mysqli_close($con);
?>
