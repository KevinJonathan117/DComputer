<!DOCTYPE html>
<html>
<?php
    require_once "connect.php";
    // Initialize the session
    session_start();
    
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedinuser"]) || $_SESSION["loggedinuser"] !== true){
        header("location: login_user.php");
        exit;
    }
?>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>DCOMPUTER | History Transaksi</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DCOMPUTER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index_user.php">Home <span class="sr-only">(current)</span> </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="histori_transaksi.php">Transaksi</a>
        </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="biodata_user.php" class="dropdown-item">Biodata</a>
                        <a href="logout_user.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </li>
        </ul>
    </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col">
                <br>
                <h1>History Transaksi</h1>
                <br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Harga</th>
                                <th>Nama</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody id="transaksiContainer">

                        </tbody>
                    </table>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        var ajaxcall2;
        function getHistoryTransaksi() {
            if(ajaxcall2 != null) {
                ajaxcall2.abort();
            }
            ajaxcall2 = $.ajax({
                url: "show_transaksi.php",
                type: "get",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    var dataShow = $("#transaksiContainer");
                    dataShow.html("");
                    for (var i = 0; i<data.length; i++){
                        var dataShow = $("#transaksiContainer");
                        dataShow.append("<tr>" +
                        "<td>" + data[i].tgl_transaksi + "</td>" +
                        "<td>Rp. " + data[i].cart_harga + "</td>" +
                        "<td>" + data[i].nama + "</td>" +
                        "<td>" + data[i].jumlah + "</td>" +
                        "</tr>");
                    }
                },
                error: function(data) {
                    console.log(data);
                    alert("show ERROR");
                }
            });
        }
        window.onload = function() {
            getHistoryTransaksi();
        }
    </script>
</body>
</html>

