<?php 

include 'includes/admin_header.php';


?>


<?php 
    // mengambil data about pada database
    $query = "SELECT * FROM about";
    $select_about = mysqli_query($connection,$query);
    confirm($select_about);
    while($row = mysqli_fetch_assoc($select_about)){
        $about_name = $row['about_name'];
        $about_introduction = $row['about_introduction'];
        $about_description = $row['about_description'];
        $about_photo = $row['about_photo'];

    }

?>



<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
        <?php include 'includes/admin_sidebar.php';?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
                <?php include 'includes/admin_topbar.php'; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">About</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                <?php 
                    if (isset($_POST['edit_about'])) {
                        if (!empty($_POST['about_name']) && !empty($_POST['about_introduction']) &&
                        !empty($_POST['about_description']) ) {
                        // Fungsi edit about
                        $about_name = $_POST['about_name'];
                        $about_introduction = $_POST['about_introduction'];
                        $about_description = $_POST['about_description'];
                        $about_image_new = $_FILES['image']['name'];
                        $about_image_temp = $_FILES['image']['tmp_name'];
                            if (strlen($about_name) < 20) {
                                if (strlen($about_introduction) <188) {

                                $about_name = mysqli_real_escape_string($connection,$about_name);
                                $about_introduction = mysqli_real_escape_string($connection,$about_introduction);
                                $about_description = mysqli_real_escape_string($connection,$about_description);
                                
                                $about_image_new = mysqli_real_escape_string($connection,$about_image_new);
                                if ( empty($about_image_new) ) {
                                    $about_image_new  = $about_photo;
                                }
                                
                                move_uploaded_file($about_image_temp,"../images/about/$about_image_new");

                                $query = "UPDATE `about` SET 
                                                `about_name`='$about_name',
                                                `about_introduction`='$about_introduction',
                                                `about_description`='$about_description',
                                                `about_photo`='$about_image_new' WHERE about_id = 1";
                                $about_update = mysqli_query($connection,$query);
                                confirm($about_update); 
                                header("Location: about_text.php");
            ?>

            <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                About Updated 
            </div>  


            <?php 
            }else { ?>
                <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                the character you input is too long in the introduction form <?php echo strlen($about_introduction)?>/184
                </div>  
            <?php }
        }else { ?>
                <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                the character you input is too long in the introduction form <?php echo strlen($about_name)?>/19
                </div> 
        <?php }
    }            
            else {?>
                <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                This Form cannot empty 
                </div>  
            <?php }
}

?>
<div class="col-lg-12">
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="image">Header</label>
    <br>
        <img src="../images/about/<?php echo $about_photo ?>" alt=""  height="100px" width="auto";>
        <br> <br>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="about_name" value="<?php echo $about_name?>">
    </div>

    <div class="form-group">
        <label for="introduction">Introduction</label>
        <textarea name="about_introduction" class="form-control" id="introduction" cols="30" rows="5"  ><?php echo $about_introduction?></textarea>
    </div>

    <div class="form-group">
        <label for="post_status">Description</label>
        <textarea name="about_description" class="form-control" id="" cols="30" rows="5"><?php echo $about_description?></textarea>
    </div>





    <div class="form-group">
        <a href="includes/edit_about_text.php"><input class="btn btn-primary" type="submit" name="edit_about" value="Edit About"></a>
        <td><a href="../about.php" class="badge badge-primary" style="padding: 14px;" target="blank">View About</a></td>
    </div>


</form>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php 
include 'includes/admin_copyright.php';         
?>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<?php include 'logout_modal.php';?>


<?php include 'includes/admin_footer.php'; ?>