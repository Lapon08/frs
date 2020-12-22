<?php 
    include 'includes/db.php';
    include 'function.php';
    // include 'includes/header.php';
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

    <title>Blog - Naufal Aprilian Marsa Mahendra</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center mt-5">

            <div class="col-xl-8 col-lg-8 col-md-9">
            <?php 

if (isset($_POST['login'])) {

    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    if (!empty($user_email) && !empty($user_password)) {
        
    

    $user_email = mysqli_real_escape_string($connection,$user_email);
    $user_password = mysqli_real_escape_string($connection,$user_password);

    $query = "SELECT * FROM users WHERE user_email = '$user_email'";
    $select_user_query = mysqli_query($connection,$query);
    $count = mysqli_num_rows($select_user_query);
    confirm($select_user_query);
    if ($count < 1) { ?>
                            <div class="col-md-8 col-lg-7 text-center align-content-center mx-auto ">
                <div class="alert alert-danger" role="alert">
                    Login Failed ! <strong> username/password</strong> Incorrect
                </div>  
                </div>
    <?php }else {
        
    

    while($row = mysqli_fetch_assoc($select_user_query)){
        $db_user_id = $row['user_id'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_username = $row['user_username'];
        $db_user_role = $row['user_role'];
        $db_user_email = $row['user_email'];
        $db_user_password = $row['user_password'];

    }

    $db_user_password = password_verify($user_password,$db_user_password);
    if ($user_email != $db_user_email) { ?>
                <div class="col-md-8 col-lg-7 text-center align-content-center mx-auto ">
                <div class="alert alert-danger" role="alert">
                    Login Failed ! <strong> username/password</strong> Incorrect
                </div>  
                </div>
    <?php }
    else if ($user_email == $db_user_email) {
        if ($user_password != $db_user_password) { ?>
                <div class="col-md-8 col-lg-7 text-center align-content-center mx-auto ">
                <div class="alert alert-danger" role="alert">
                    Login Failed ! <strong> username/password</strong> Incorrect
                </div>  
                </div>
        <?php }else {
        
        $_SESSION['user_username'] = $db_user_username;
        $_SESSION['user_email'] = $db_user_email;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;
        header("Location: index.php");
        }
    }
}}
    else { ?>
                <div class="col-md-8 col-lg-7 text-center align-content-center mx-auto ">
                <div class="alert alert-danger" role="alert">
                    Login Failed ! <strong> username/password</strong> Incorrect
                </div>  
                </div>
    <?php }

}

?>




                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center mt-2 mb-2">

                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <!-- <a href="index.html"  class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a> -->
                                        <button class="btn btn-primary btn-block btn-user" type="submit" name="login">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
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