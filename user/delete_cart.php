<?php
        require_once("connect.php");

        session_start();
        $id_user = $_SESSION["id_user"];
        $id = $_GET["id"];
        if($id == "All") {
            $q = mysqli_query($conn, "DELETE from `cart` where id_user=$id_user && status_cart=0");
        }
        else {
            $q = mysqli_query($conn, "DELETE from `cart` where id_user=$id_user && id_produk=$id && status_cart=0");
        }
        if($q) {
            echo "Success";
        }
        else {
            echo "Failed";
        }
?>