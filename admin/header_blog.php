<?php 

include 'includes/admin_header.php';


?>


<?php 
// mengambil data header pada database
    $query = "SELECT * FROM header";
    $select_header = mysqli_query($connection,$query);
    confirm($select_header);
    while($row = mysqli_fetch_assoc($select_header)){
        $header_photo = $row['header_photo'];

    }

?>

<?php 
// mengambil data logo pada database
    $query = "SELECT * FROM logo";
    $select_logo = mysqli_query($connection,$query);
    confirm($select_logo);
    while($row = mysqli_fetch_assoc($select_logo)){
        $logo_image = $row['logo_image'];

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
                    <h1 class="h3 mb-0 text-gray-800">Header</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                <?php 
                // edit header
                    if (isset($_POST['edit_header'])) {
                        $header_image_new = $_FILES['image']['name'];
                        $header_image_temp = $_FILES['image']['tmp_name'];
                        $header_image_new = mysqli_real_escape_string($connection,$header_image_new);
                        if (empty($header_image_new) ) {
                            $header_image_new  = $header_photo ;
                        }
                        move_uploaded_file($header_image_temp,"../images/header/$header_image_new");
                            $query="UPDATE `header` SET `header_photo`='$header_image_new' WHERE 1";
                            $update_header = mysqli_query($connection,$query);
                            confirm($update_header);
                        ?>
                        <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                            Header Updated 
                        </div>  
                                
                <?php
                        header("Location: header_blog.php "); 
                    }
                ?>

                <?php 
                // edit logo
                    if (isset($_POST['edit_logo'])) {
                        $logo_image_new = $_FILES['image']['name'];
                        $logo_image_temp = $_FILES['image']['tmp_name'];
                        $logo_image_new = mysqli_real_escape_string($connection,$logo_image_new);
                        if ( empty($logo_image_new) ) {
                            $logo_image_new  = $logo_image ;
                        }

                        move_uploaded_file($logo_image_temp,"../images/logo/$logo_image_new");
                        $query="UPDATE `logo` SET `logo_image`='$logo_image_new' WHERE 1";
                        $update_logo = mysqli_query($connection,$query);
                        confirm($update_logo);
                        ?>
                        <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                            logo Updated 
                        </div>  
                        
                <?php
                        header("Location: header_blog.php "); 
                    }
                ?>

    <!-- menampilkan header dan logo -->
    <div class="col-lg-6">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Logo</label>
            <br>
                <img src="../images/logo/<?php echo $logo_image ?>" alt=""  height="auto" width="50%";>
                <br> <br>
                <input type="file" name="image">
            </div>
            <div class="form-group">
                <a href="includes/edit_about_text.php"><input class="btn btn-primary" type="submit" name="edit_logo" value="Edit Logo"></a>
                <td><a href="../index.php" class="badge badge-primary" style="padding: 14px;" target="blank">View Logo</a></td>
            </div>
        </form>
    </div>

    <div class="col-lg-6">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Header</label>
            <br>
                <img src="../images/header/<?php echo $header_photo ?>" alt=""  height="auto" width="50%";>
                <br> <br>
                <input type="file" name="image">
            </div>
            <div class="form-group">
                <a href="includes/edit_about_text.php"><input class="btn btn-primary" type="submit" name="edit_header" value="Edit Header"></a>
                <td><a href="../index.php" class="badge badge-primary" style="padding: 14px;" target="blank">View Header</a></td>
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