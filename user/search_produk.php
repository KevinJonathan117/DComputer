<?php
        require_once("connect.php");

        if(!isset($_GET["n"]) || $_GET["n"] == "") {
            if (isset($_GET["nama"])){
                $nama = $_GET["nama"];
                $id_kategori = 0;
            
                if ($nama == "All Product"){
                    $query = mysqli_query($conn, "select * from produk");
                }
                else {
                    $q = mysqli_query($conn, "select id_kategori from kategori where nama_kategori = '".$nama."'");
                    if ($res = mysqli_fetch_assoc($q)){
                        $id_kategori = $res["id_kategori"];
                    }
            
                    $query = mysqli_query($conn, "select * from produk where id_kategori = '$id_kategori'");
                }
            }
            //$q = mysqli_query($conn, "select * from produk");
        }else{
            $cariname = $_GET["n"];
            if (isset($_GET["nama"])){
                $nama = $_GET["nama"];
                $id_kategori = 0;
            
                if ($nama == "All Product"){
                    $query = mysqli_query($conn, "select * from produk where nama like'%".$cariname."%'");
                }
                else {
                    $q = mysqli_query($conn, "select id_kategori from kategori where nama_kategori = '".$nama."'");
                    if ($res = mysqli_fetch_assoc($q)){
                        $id_kategori = $res["id_kategori"];
                    }
            
                    $query = mysqli_query($conn, "select * from produk where id_kategori = '$id_kategori' and nama like'%".$cariname."%'");
                }
                //$query = mysqli_query($conn, "select * from produk where id_kategori = '$id_kategori' and nama like'%".$cariname."%'");
            }
            //$q=mysqli_query($conn, "select * from produk where nama like'%".$cariname."%'");
        }

        $folder = "upload";
        $arr=[];
        while($res = mysqli_fetch_assoc($query)) {
            array_push($arr, $res);
        }
        echo json_encode($arr);
?>