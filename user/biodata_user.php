<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinuser"]) || $_SESSION["loggedinuser"] !== true){
    header("location: login_user.php");
    exit;
}
    require_once 'connect.php';
    $id = $_SESSION["id_user"];
    $data = mysqli_query($conn,"SELECT * FROM user where id_user=$id");
    while($res = mysqli_fetch_assoc($data)){
		$nama = $res["nama"];
        $username = $res["username"];
        $password = $res["password"];
        $email = $res["email"];
        $no_telp = $res["no_telp"];
	}

        
?>

<!DOCTYPE html>
<htmL>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>DCOMPUTER | Biodata</title>

        <style>
        @media (min-width: 768px) {
            .card{
                width:33%;
            }
        }
    </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="login_user.php">DCOMPUTER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index_user.php">Home <span class="sr-only">(current)</span> </a>
        </li>
        <li class="nav-item">
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
        <br><br>
    <div class="card text" style=" margin-left: auto; margin-right:auto;">
        <div class="card-header" style="text-align: center">
        Biodata
        </div>
            <div class="card-body">
               Nama : <?php echo $nama;?> <br><br>
               Username : <?php echo $username;?> <br><br>
               password :  **********   
               <a href="changepass.php"><button class="btn btn-dark button" name="changepass" type="submit">Change Password?</button></a> <br><br>
               email :  <?php echo $email;?> <br><br>
               phone number :  <?php echo $no_telp;?> <br><br>
            </div>
        </from>
    </div>
    



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </body>

</html>