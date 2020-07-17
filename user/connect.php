<?php
    $conn = mysqli_connect("localhost","user","123", "project_tekweb");
    if($conn ===false){
        die("ERROR:could not connect" . mysqli_connect_error());
    }
    
    // echo "connect sukses. Host info : " . mysqli_get_host_info($conn);
    

?>