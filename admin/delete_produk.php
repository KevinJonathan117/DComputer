<?php
    require_once ("connect.php");

    if (isset($_POST["name"])) {
        $name = $_POST["name"];
        echo $name;
        $sql = "delete from produk where nama = '$name'";
        if (mysqli_query($conn, $sql)) {
            echo "Success";
        }
        else {
            echo "Failed";
        }
    }

    mysqli_close($conn);
?>