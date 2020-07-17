<?php
    require_once("connect.php");

    $id_kategori = 0;
    $id = 0;
    $nama = $_POST["nama"];
    $merek = $_POST["merek"];
    $harga = $_POST["harga"];
    $stock = $_POST["stock"];
    $deskripsi = $_POST["deskripsi"];
    $namakategori = $_POST["nama_kategori"];

    $q = "select id_kategori from kategori where nama_kategori = '".$namakategori."'";
    $result1 = $conn->query($q);
    if ($result1->num_rows > 0){
        if ($row = $result1->fetch_assoc()){
            $id_kategori = $row["id_kategori"];
        }
    }  
    $databaseTableName = "produk";
    
    $jumlah = 3;
    $counterCheck = 0;

    for ($i = 0;$i<$jumlah;$i++){
        $sourcePath = $_FILES['profilepic'.$i]['tmp_name']; // Storing source path of the file in a variable
        $targetPath = "upload/".$_FILES['profilepic'.$i]['name']; // Target path where file is to be stored
        move_uploaded_file($sourcePath,$targetPath); 
        ${"urlimages".$i} = $_FILES['profilepic'.$i]['name'];
        if($sourcePath != "") {
            $counterCheck++;
        }
    }

    if($counterCheck == 3) {
        $sql = "select * from produk where nama = '".$nama."'";
        $result2 = $conn->query($sql);
        if ($result2->num_rows > 0){
            if ($row = $result2->fetch_assoc()){
                $jumlah = $row["stock"];
                $jumlah += $stock;
                $sql2 = "update produk set stock='$jumlah' where nama = '".$nama."'";
                $result = $conn->query($sql2); 
                if($result) {
                    echo "Sukses";
                }
            }
        }  
        else {
            $sql1 = "insert into $databaseTableName values(".$id.",'".$nama."','".$merek."',".$harga.",".$stock.",'".$urlimages0."','".$urlimages1."','".$urlimages2."','".$deskripsi."',".$id_kategori.")";
            $result3 = $conn->query($sql1);
            if($result3) {
                echo "Sukses";
            }
        }
    }

    $conn->close();
?>