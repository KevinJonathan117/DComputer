<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true){
    header("location: login_admin.php");
    exit;
}

require_once "connect.php";
    $passerr = "";
    $beda = "";
    $username = $_SESSION["username"];
    $password = "";
    
    $newpassword = "";
    
    $renewpassword = "";

    $sukses = "";
   

    $data = mysqli_query($conn,"SELECT password FROM admin where username = '$username'");
    while($res = mysqli_fetch_assoc($data)){
        $cekpassword = $res["password"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = $_POST["password"];
        $newpassword = $_POST["newpassword"];
        $renewpassword = $_POST["renewpassword"];
   

    if(!password_verify($password, $cekpassword)){
        $passerr = "Password berbeda";
    }

    else{
        if(!empty($newpassword) && !empty($renewpassword)){
            if($newpassword != $renewpassword){
                $beda = "newpassword dan renewpassword berbeda";
            }
            else{
                    $newpassword=password_hash($newpassword, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE admin SET password=? where username = ?");
                    $stmt->bind_param("ss", $newpassword,$username);
                    $stmt->execute();
                    echo "<script type='text/javascript'>alert('SUKSES');window.location.href= 'index_admin.php';</script>";
                    
            }
        }
        else{
            $beda ="new password dan retype the new password tidak boleh kosong";
        }
    }
}
    

    

?>

<!DOCTYPE html>
<htmL>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
       
        <title>DCOMPUTER | Admin Change Password</title>

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
        <a class="navbar-brand" href="login_admin.php">DCOMPUTER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index_admin.php">Home <span class="sr-only">(current)</span> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin.php">Menu</a>
        </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
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
        <br><br>
    <div class="card text" style=" margin-left: auto; margin-right:auto;">
        <div class="card-header" style="text-align: center">
        Change Password
        </div>
             <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<div style="margin-left: 1rem; margin-right: 1rem;">
               Enter Your Old Password Here :
               <br>
               <input type="password" name="password" id="password" placeholder = "Enter your old password" class="form-control"/>
               <?php echo $passerr; ?>
               <br>
               Enter Your New Password :
               <br>
               <input type="password" name="newpassword" id="newpassword" placeholder = "Enter your new password" class="form-control"/>
               <br>
               Re-enter Your New Password :
               <br>
               <input type="password" name="renewpassword" id="renewpassword" placeholder = "Re-enter your new password" class="form-control"/>
               <?php echo $beda;?>
               <br>
               <button class="btn btn-dark form-control" name="changepass" type="submit">Change the password</button>
				</div>
                </form>
            </div>
        </form>
    </div>
    



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>


    </body>

</html>