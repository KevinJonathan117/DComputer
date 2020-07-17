<?php
    require_once("connect.php");

    session_start();
    $id_user = $_SESSION["id_user"];
    $date = date('D, d M Y h:i:s A');
    $q = mysqli_query($conn, "SELECT * from `cart` JOIN `produk` ON `cart`.id_produk = `produk`.id_produk WHERE `cart`.status_cart=0 && `cart`.id_user=$id_user");
    $arr=[];
    while($res = mysqli_fetch_assoc($q)) {
        $total_harga = $res["cart_harga"];
        $id_cart = $res["id_cart"];
        $qty = $res["jumlah"];
        $stock = $res["stock"];
        $id_produk = $res["id_produk"];
        $qty = $stock - $qty;
        $query = mysqli_query($conn, "INSERT INTO transaksi (id_transaksi, tgl_transaksi, total_harga, id_user, id_cart) values (0, '$date', $total_harga, $id_user, $id_cart)");
        $query1 = mysqli_query($conn, "UPDATE produk SET stock=$qty WHERE id_produk=$id_produk");
    }
    $q1 = mysqli_query($conn, "UPDATE cart SET status_cart=1 WHERE status_cart=0 && id_user=$id_user;");
    if($q1) {
        echo "Success";
    }
    else {
        echo "Failed";
    }
?>