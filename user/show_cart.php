<?php
        require_once("connect.php");

        session_start();
        $id = $_SESSION["id_user"];
        $q = mysqli_query($conn, "SELECT * from `cart` JOIN `produk` ON `cart`.id_produk = `produk`.id_produk where `cart`.id_user=$id && `cart`.status_cart=0");

        $arr=[];
        while($res = mysqli_fetch_assoc($q)) {
            array_push($arr, $res);
        }
        echo json_encode($arr);
?>