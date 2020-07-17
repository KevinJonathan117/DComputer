<?php
    require_once 'connect.php';

    $id=0;
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passcon= $_POST["confirm_password"];
    $email = $_POST["email"];
    $no_telp = $_POST["no_telp"];

    $nameErr = $usernameErr = $passErr = $passconErr = $emailErr = $notelpErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            echo $nameErr;
            die();
          } else {
            $name = test_input($_POST["name"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed";
                    echo $nameErr;
                    die();
                    }
          }

          if (empty($_POST["username"])) {
            $usernameErr = "Username is required";
            echo $usernameErr;
            die();
          } else {
            $username = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username)) {
                $usernameErr = "Only letters and white space allowed";
                echo $usernameErr;
                die();
                }
          }

          if (empty($_POST["password"])) {
            $passErr = "password is required";
            echo $passErr;
            die();
          } else {
            $pass = test_input($_POST["password"]);
          }

          if (empty($_POST["confirm_password"])) {
            $passconErr = "password Confirm is required";
            echo $passconErr;
            die();
          } else {
            $passcon = test_input($_POST["confirm_password"]);
        }

          if($_POST["confirm_password"] != $_POST["password"]){
            $passconErr = "password and confirm password are different";
            echo $passconErr;
            die();
          }

          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            echo $emailErr;
            die();
          } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                echo $emailErr;
                die();
              }
          }

          if (empty($_POST["no_telp"])) {
            $notelpErr = "no telp is required";
            echo $notelpErr;
            die();
          } else {
            $notelp = test_input($_POST["no_telp"]);
            if (!preg_match("/^[0-9]*$/",$notelp)) {
                $notelpErr = "Only Number Allowed";
                echo $notelpErr;
                die();
                }
          }

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    
    if(empty($nameErr) && empty($usernameErr) && empty($passErr) && empty($passconErr) && empty($emailErr) && empty($notelpErr)){

        // Prepare a select statement
        $sql = "SELECT username FROM admin WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $username);
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                  echo "This username is already taken.";
                } else{
                    $sql = "INSERT INTO admin VALUES(?,?,?,?,?,?,?)";

                    $status = 0;
                    if($stmt=mysqli_prepare($conn,$sql)){
                        mysqli_stmt_bind_param($stmt,"isssssi",$id,$name,$username,$password,$email,$no_telp,$status);
                        $password = password_hash($password,PASSWORD_DEFAULT);
                        if(mysqli_stmt_execute($stmt)){
                            echo "SUKSES";
                        }
                        else{
                            echo "GAGAL";
                        }
                    }
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    else{
        echo "INVALID FORMAT / EMPTY";
    }
   
        
    
   
    // $sql = "INSERT INTO user VALUES(?,?,?,?,?,?)";


    // if($stmt=mysqli_prepare($conn,$sql)){
    //     mysqli_stmt_bind_param($stmt,"isssss",$id,$name,$username,$password,$email,$no_telp);
    //     $password = password_hash($password,PASSWORD_DEFAULT);
    //     if(mysqli_stmt_execute($stmt)){
    //         echo "SUKSES";
    //     }
    //     else{
    //         echo "GAGAL";
    //     }
    // }




    // if($sql){
    //     echo "SUCCESS SIGN UP";
    // }
    // else{
    //     echo "GAGAL SIGN UP";
    // }


    // $stmt = $conn->prepare("INSERT INTO user (id,name,username,password,email,no_telp)
    //     VALUES (:id, :name, :username, :password, :email, :no_telp)");
    // $stmt->bindParam(':id', 0);
    // $stmt->bindParam(':name', $name);
    // $stmt->bindParam(':username', $username);
    // $stmt->bindParam(':password', $password);
    // $stmt->bindParam(':email', $email);
    // $stmt->bindParam(':no_telp', $no_telp);
    // $stmt->execute();
?>