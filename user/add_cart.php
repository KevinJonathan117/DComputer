<?php
        require_once("connect.php");

        session_start();
        $id = $_SESSION["id_user"];
        if(isset($_POST["cart_harga"]) && isset($_POST["status_cart"]) && isset($_POST["id_produk"]) && isset($_POST["kuantitas"]) && isset($_POST["stock"])) {
            $cart_harga = $_POST["cart_harga"];
            $status_cart = $_POST["status_cart"];
            $id_produk = $_POST["id_produk"];
            $kuantitas = $_POST["kuantitas"];
            $stock = $_POST["stock"];
            $sql = "SELECT * from cart where id_produk=$id_produk && id_user=$id && status_cart=0";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $cart_harga = $row["cart_harga"] + $cart_harga;
                    $kuantitas = $row["jumlah"] + $kuantitas;
                    if($kuantitas <= $stock && $kuantitas >= 1) {
                        $q = mysqli_query($conn, "UPDATE cart SET cart_harga=$cart_harga, jumlah=$kuantitas WHERE id_produk=$id_produk && id_user=$id && status_cart=0");
                        if($q) {
                            echo "Success";
                        }else {
                            echo "Failed";
                        }
                    }
                }
            }
            else {
                if($kuantitas <= $stock && $kuantitas >= 1) {
                    $q = mysqli_query($conn, "INSERT INTO cart (id_cart, cart_harga, status_cart, id_user, id_produk, jumlah) values (0, $cart_harga, $status_cart, $id, $id_produk, $kuantitas)");
                    if($q) {
                        echo "Success";
                    }else {
                        echo "Failed";
                    }
                }
            }
    }
    
?>