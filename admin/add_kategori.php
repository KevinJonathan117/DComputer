<?php
    require_once("connect.php");
    
    $nama = $_POST["nama"];
    $id_kategori = 0;

    $sql = "select nama_kategori from kategori where nama_kategori = '".$nama."'";

    if (isset($_POST["nama"])){
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) == 0){
            $q = mysqli_query($conn, "insert into kategori values(".$id_kategori.",'".$nama."')");
            if($q) {
                echo "Success";
            }else {
                echo "Failed";
            }
        } 
    }
    mysqli_close($conn);
?>