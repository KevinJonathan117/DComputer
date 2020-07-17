<?php
    require_once("connect.php");

    $id_kategori = 0;
    $id = $_POST["hid"];
    $nama = $_POST["nama"];
    $merek = $_POST["merek"];
    $harga = $_POST["harga"];
    $stock = $_POST["stock"];
    $deskripsi = $_POST["deskripsi"];
    $namakategori = $_POST["nama_kategori"];
    $jumlah = 3;

    for ($i = 0;$i<$jumlah;$i++){
        $sourcePath = $_FILES['profilepic'.$i]['tmp_name']; // Storing source path of the file in a variable
        $targetPath = "upload/".$_FILES['profilepic'.$i]['name']; // Target path where file is to be stored
        move_uploaded_file($sourcePath,$targetPath); 
        ${"urlimages".$i} = $_FILES['profilepic'.$i]['name'];
    }
    
    if($urlimages0 == "") {
        $sql1 = "select gambar0 from produk where id_produk='$id'";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            if($baris = $result1->fetch_assoc()) {
                $urlimages0 = $baris["gambar0"];
            }
        }
    }
    if($urlimages1 == "") {
        $sql1 = "select gambar1 from produk where id_produk='$id'";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            if($baris = $result1->fetch_assoc()) {
                $urlimages1 = $baris["gambar1"];
            }
        }
    }
    if($urlimages2 == "") {
        $sql1 = "select gambar2 from produk where id_produk='$id'";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            if($baris = $result1->fetch_assoc()) {
                $urlimages2 = $baris["gambar2"];
            }
        }
    }
    
    $q = "select id_kategori from kategori where nama_kategori = '".$namakategori."'";
    $result1 = $conn->query($q);
    if ($result1->num_rows > 0){
        if ($row = $result1->fetch_assoc()){
            $id_kategori = $row["id_kategori"];
        }
    }  

    echo $id_kategori;

    $databaseTableName = "produk";
    
    $sql = "update $databaseTableName set nama='$nama', merek='$merek', harga='$harga', stock='$stock', gambar0='$urlimages0', gambar1='$urlimages1', gambar2='$urlimages2', deskripsi='$deskripsi', id_kategori='$id_kategori' where id_produk='$id'";
    
    $result = $conn->query($sql);
    $conn->close();
?>