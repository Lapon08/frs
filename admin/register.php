<?php 

    include 'includes/db.php';
    include 'function.php';
    ob_start();
    session_start();

?>


<?php 
    if (isset($_SESSION['user_role'])) {
        $user_role = $_SESSION['user_role'];
        if ($user_role == 'admin') {
            header("Location: index.php");
        }else {
            header("Location: ../index.php");
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>


<?php 

    if (isset($_POST['register'])) {
        $user_username = $_POST['user_username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_password_repeat = $_POST['user_password_repeat'];

        $user_username = mysqli_real_escape_string($connection,$user_username);
        $user_firstname = mysqli_real_escape_string($connection,$user_firstname);
        $user_lastname = mysqli_real_escape_string($connection,$user_lastname);
        $user_email = mysqli_real_escape_string($connection,$user_email);
        $user_password= mysqli_real_escape_string($connection,$user_password);
        $user_password_repeat= mysqli_real_escape_string($connection,$user_password_repeat);
        
        
        $query = "SELECT user_username FROM users WHERE user_username = '$user_username'";
        $check_username = mysqli_query($connection,$query);
        confirm($check_username);

        $query = "SELECT user_email FROM users WHERE user_email = '$user_email'";
        $check_email = mysqli_query($connection,$query);
        confirm($check_email);
        //mengecek username dan email sudah digunakan atau belum
        if (!mysqli_num_rows($check_username)> 0 && !mysqli_num_rows($check_email)> 0) {
            //cek jumlah karakter password

            if(!empty($user_username) && !empty($user_firstname) && !empty($user_lastname) && !empty($user_email) &&
            !empty($user_password_repeat) && !empty($user_password)) {
            if (strlen($user_password) > 8) {
                if ($user_password_repeat !==$user_password) {
                    $message = "Passwords are not the same";
                }

         
                    $user_password =password_hash($user_password,PASSWORD_DEFAULT);
         
                    $query = " INSERT INTO `users`(`user_id`, `user_username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`)
                                VALUES ('','$user_username','$user_password','$user_firstname','$user_lastname','$user_email')";
                    $register_query = mysqli_query($connection,$query);
                    confirm($register_query);
                    $message = "User Resgitration Successful!";
                    }
                    else {
                        $message = "Password must be more than 8 characters long";
         
                    }
            }else {
                $message = "Fields cannot be empty!";
            }
            

        }else {
            $message = "Username / Email is already in use ";
        }



        }?>





<body class="bg-gradient-primary">

    <div class="container ">
    <div class="col-lg-8 mx-auto">
        <div class="card o-hidden border-0 shadow-lg my-5 ">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                <?php if(isset($message)){?>
                            <div class="alert alert-secondary text-center mx-auto" role="alert" style="margin-bottom:0px; margin-top:20px !important">
                                <?php echo $message?>
                            </div> 
                        <?php }?>
                    <div class="col-lg-10 mx-auto p-5">
                        <div class=col-lg-10">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" name="user_firstname">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" name="user_lastname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="user_email">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Username" name="user_username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="user_password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="user_password_repeat">
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-block btn-user" type="submit" name="register">Register</button>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>