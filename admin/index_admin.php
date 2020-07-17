<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true){
    header("location: login_admin.php");
    exit;
}
    $servername = "localhost";
    $username = "user";
    $password = "123";
    $dbname = "project_tekweb";
    $db_status = "Failed";
    $user_count = 0;
    $admin_count = 0;

    $con = new mysqli($servername, $username, $password, $dbname);

    if ($con->connect_error){
        $db_status = "Failed";
    }
    else {
        $db_status = "Success!";
        $sql = "select * from user";
        $result = $con->query($sql);
        $user_count = $result->num_rows;
        $sql1 = "select * from admin";
        $result1 = $con->query($sql1);
        $admin_count = $result1->num_rows;
    }
    $con->close();
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>DCOMPUTER | Admin Home</title>
    <style>
        .fa-users, .fa-users-cog, .fa-database {
            font-size: 3rem;
            margin: auto;
        }
    </style>
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DCOMPUTER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="index_admin.php">Home <span class="sr-only">(current)</span> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin.php">Menu</a>
        </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="biodata_admin.php" class="dropdown-item">Biodata</a>
                        <a href="logout_admin.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </li>
        </ul>
    </div>
    </nav>

    <div class="container">
        <br>
        <h2>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
        <br><hr>
        <h3 class="text-center"><u>Dashboard</u></h3><br>
        <div class="row">
            <div class="col-sm-4">
                <div class="card text-center">
                    <br>
                    <i class="fas fa-users"></i>
                    <div class="card-body">
                        <h4 class="card-title">User Count</h4>
                        <p class="card-text"><?php echo $user_count ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                <br>
                <i class="fas fa-users-cog"></i>
                        <div class="card-body">
                            <h4 class="card-title">Admin Count</h4>
                            <p class="card-text"><?php echo $admin_count ?></p>
                        </div>
                    </div>
                </div>
            <div class="col-sm-4">
                <div class="card text-center">
                <br>
                <i class="fas fa-database"></i>
                    <div class="card-body">
                        <h4 class="card-title">Database Connection</h4>
                        <p class="card-text"><?php echo $db_status ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </body>
</html>