<?php
    $servername = "localhost";
    $username = "user";
    $password = "123";
    $dbname = "project_tekweb";

    $con = new mysqli($servername, $username, $password, $dbname);

    if ($con->connect_error){
        die("connection failed : " . $con->connect_error);
    }


    $databaseTableName = "kategori";
    $sql = "SELECT id_kategori, nama_kategori from $databaseTableName";
    $result = $con->query($sql);

    $arr = [];
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            array_push($arr, $row);
        }
    }
    echo json_encode($arr);
    $con->close();
?>
