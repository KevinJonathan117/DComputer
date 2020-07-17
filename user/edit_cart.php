<?php
        require_once("connect.php");

        session_start();
        $id = $_SESSION["id_user"];
        if(isset($_POST["id"]) && isset($_POST["qty"])) {
            $id_produk = $_POST["id"];
            $qty = $_POST["qty"];
            $sql = "SELECT * from cart where id_produk=$id_produk && id_user=$id && status_cart=0";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $cart_harga = ($row["cart_harga"] / $row["jumlah"]) * $qty;
                    $sql1 = "SELECT * from produk where id_produk=$id_produk";
                    $result1 = $conn->query($sql1);
                    $row1 = $result1->fetch_assoc();
                    $stock = $row1["stock"];
                    if($qty <= $stock && $qty >= 1) {
                        $q = mysqli_query($conn, "UPDATE cart SET cart_harga=$cart_harga, jumlah=$qty WHERE id_produk=$id_produk && id_user=$id && status_cart=0");
                        if($q) {
                            echo "Success";
                        }else {
                            echo "Failed";
                        }
                    }
                }
            }
            else {
                echo "Nein";
            }
        }
        else {
            echo "Parameter not set";
        }
    
?>