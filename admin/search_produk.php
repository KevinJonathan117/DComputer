<?php
        require_once("connect.php");
        
        if(!isset($_GET["n"]) || $_GET["n"] == "") {
            $q = mysqli_query($conn, "select * from produk");
        }else{
            $cariname = $_GET["n"];
            $q=mysqli_query($conn, "select * from produk where nama like'%".$cariname."%'");
        }

        $arr=[];
        while($res = mysqli_fetch_assoc($q)) {
            array_push($arr, $res);
        }
        echo json_encode($arr);
?>