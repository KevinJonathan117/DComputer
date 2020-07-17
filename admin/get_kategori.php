<?php
    require_once("connect.php");

    $id = $_GET["id"];

    $databaseTableName = "kategori";
    $sql = "SELECT nama_kategori from $databaseTableName where id_kategori = '$id'";
    $result = $conn->query($sql);

    $arr = [];
    if ($result->num_rows > 0){
        if ($row = $result->fetch_assoc()){
            array_push($arr, $row);
        }
    }

    $sql1 = "SELECT nama_kategori from $databaseTableName where id_kategori != '$id'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0){
        while ($row = $result1->fetch_assoc()){
            array_push($arr, $row);
        }
    }

    echo json_encode($arr);
    $conn->close();
?>
