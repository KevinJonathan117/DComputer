<?php
    $servername = "localhost";
    $username = "user";
    $password = "123";
    $dbname = "project_tekweb";

    $con = new mysqli($servername, $username, $password, $dbname);

    if ($con->connect_error){
        die("connection failed : " . $con->connect_error);
    }
    $id = 0;
    $nama = $_POST["nama"];

    if($nama != "All Product") {
        $sql1 = "SELECT * FROM `kategori` JOIN `produk` ON `kategori`.id_kategori = `produk`.id_kategori WHERE `kategori`.nama_kategori = '$nama'";
        $result1 = $con->query($sql1);
        if(!empty($result1)){
            while($row = mysqli_fetch_assoc($result1)){
                $id = $row["id_kategori"];
            }
            $sql2 = "DELETE from `produk` where id_kategori = $id";
            $result2 = $con->query($sql2);
            $sql = "DELETE from `kategori` where nama_kategori = '$nama'";
            $result = $con->query($sql);
        }
    }


    $con->close();
?>
