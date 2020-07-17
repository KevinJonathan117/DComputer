<!DOCTYPE html>
<html>
    <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <title>DCOMPUTER | Admin Register</title>

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
        <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a class="nav-link" href="login_admin.php"><i class="fas fa-sign-in-alt"></i> Login </a>
            </li>
            <li class="nav-item active">
            <a class="nav-link" href="register_admin.php"><i class="fas fa-user-plus"></i> Register <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>-->
    </nav>
<br><br>

    <div class="card text" style= "margin-left: auto; margin-right:auto;">
        <div class="card-header" style="text-align: center">
        Admin's Register Form
        </div>
        
            <div class="card-body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                 Name
                <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control"/>
                
                </br>
                Username
                <input type="text" name="username" id="username" placeholder="Enter your username" class="form-control"/>
                
                </br>
                Password
                <input type="password" name="password" id="password" placeholder = "Enter your password" class="form-control"/>
               
                </br>
                Confirm Password
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Re-enter your password" class="form-control"/>
                
                </br>
                Email
                <input type="text" name="email" id="email" placeholder="Enter your email"  class="form-control"/>
               
                </br>
                Phone Number
                <input type="text" name="no_telp" id="no_telp" placeholder="Enter your phone number" class="form-control"/>
               
                </br>
           
            </div>
            <div class="card-footer">
                <button class="btn btn-dark form-control" name="sign_up" type="submit" id="sign_up" data-toggle="modal" data-target="#myModal">Sign Up</button>
                </br></br>
            </form>
            </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
    
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="validation" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
      
        </div>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
    <script type="text/javascript">
          $(document).ready(function(){
              var form = $("form");
            form.submit(function(event){
                event.preventDefault();
                var name = $("#name").val();
                var username = $("#username").val();
                var password = $("#password").val();
                var confirm_password = $("#confirm_password").val();
                var email = $("#email").val();
                var no_telp = $("#no_telp").val();
              
                $.ajax({
                    url:"add_admin.php",
                    type:"POST",
                    data:{
                        name:name,
                        username:username,
                        password:password,
                        confirm_password:confirm_password,
                        email:email,
                        no_telp:no_telp
                    },
                    success:function(result){
                       $("#validation").html(result);
                    }

                });

            });

          });
    </script>


    </body>

</html>