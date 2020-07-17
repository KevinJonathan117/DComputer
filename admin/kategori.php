<?php
        require_once("connect.php");
        
        $id_kategori = 0;

        if(!isset($_GET["nama"]) || $_GET["nama"] == "all produk") {
            $q = mysqli_query($conn, "select * from produk");
        }else{
            $cariname = $_GET["nama"];
            $query = mysqli_query($conn, "select id_kategori from kategori where nama_kategori = '".$cariname."'");
            if ($res = mysqli_fetch_assoc($query)){
                $id_kategori = $res["id_kategori"];
            }

            $q=mysqli_query($conn, "select * from produk where id_kategori = ".$id_kategori."");
        }

        $arr=[];
        while($res = mysqli_fetch_assoc($q)) {
            array_push($arr, $res);
        }
        echo json_encode($arr);
?>