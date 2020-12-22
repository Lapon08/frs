<?php 

include 'includes/admin_header.php';


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
                                // menambahkan activity
                                if (isset($_POST['submit'])) {
                                    if (!empty($_POST['activity_title']) && !empty($_POST['activity_information']) 
                                    && !empty($_FILES['image'])) {
                                    
                                    $activity_title = $_POST['activity_title'];
                                    $activity_information = $_POST['activity_information'];
                                    $activity_image = $_FILES['image']['name'];
                                    $activity_image_temp = $_FILES['image']['tmp_name'];
                                    
                                    $query = "SELECT * FROM activity";
                                    $count_activity = mysqli_query($connection,$query);
                                    confirm($count_activity);
                                    $count_activity = mysqli_num_rows($count_activity);
                                    // activity hanya boleh 3
                                    if ($count_activity < 3) {
                                        
                                    // judul activity hanya boleh sampai 14
                                    if (strlen($activity_title) <=14) {
                                        $activity_title = mysqli_real_escape_string($connection,$activity_title);
                                        $activity_information = mysqli_real_escape_string($connection,$activity_information);
                                        move_uploaded_file($activity_image_temp,"../images/about/activity/$activity_image");
                                        // insert activity
                                        $query = "INSERT INTO `activity`(`activity_id`, `activity_title`, `activity_photo`, `activity_information`) 
                                                VALUES ('','$activity_title','$activity_image','$activity_information')";
                                        
                                        $create_activity_query = mysqli_query($connection,$query);
                                        if (!$create_activity_query) {
                                            die("Query failed" . mysqli_error($connection));
                                        }?>
                                    <div class="col-12">
                                    <div class="alert alert-primary" role="alert">
                                    Activity Added
                                    </div>
                                    </div>
                                <?php }else { ?>
                                        <div class="col-12">
                                            <div class="alert alert-danger" role="alert" >
                                            Your Activity title should be no more than 14
                                            </div>  
                                        </div>
                                <?php }
                                }
                                    else { ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert" >
                                        your activity should not be more than 3
                                        </div>  
                                    </div>
                                    <?php }
                                    }  else { ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert" >
                                        This Form cannot empty
                                        </div>  
                                    </div>
                                    <?php }
                                } ?>
                        <?php 
                                    // Update activity
                                    if (isset($_POST['update_activity'])) {
                                        if (!empty($_POST['activity_title']) && !empty($_POST['activity_information']) 
                                    ) {
                                    
                                    $activity_title = $_POST['activity_title'];
                                    $activity_information = $_POST['activity_information'];
                                    $activity_image = $_FILES['image']['name'];
                                    $activity_image_temp = $_FILES['image']['tmp_name'];
                                    $the_activity_id = $_POST['activity_id'];

                                    if (strlen($activity_title) <=14) {
                                        $activity_title = mysqli_real_escape_string($connection,$activity_title);
                                        $activity_information = mysqli_real_escape_string($connection,$activity_information);
                                        if (empty($activity_image)) {
                                            $query = "SELECT * FROM activity WHERE activity_id = $the_activity_id";
                                                $select_image = mysqli_query($connection,$query);
                                                while($row = mysqli_fetch_assoc($select_image)){
                                                        $activity_image = $row['activity_photo'];
                                                }
                                        }


                                        move_uploaded_file($activity_image_temp,"../images/about/activity/$activity_image");
                                        $query = "UPDATE `activity` SET 
                                        `activity_title`='$activity_title',`activity_photo`='$activity_image',
                                        `activity_information`='$activity_information' WHERE `activity_id` = '$the_activity_id'";
                                        
                                        $create_activity_query = mysqli_query($connection,$query);
                                        if (!$create_activity_query) {
                                            die("Query failed" . mysqli_error($connection));
                                        }?>
                                    <div class="col-12">
                                    <div class="alert alert-primary" role="alert">
                                    Activity Updated
                                    </div>
                                    </div>
                                <?php }
                                    else { ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert" style="margin-left: 15px;">
                                        Your Activity title should be no more than 14
                                        </div>  
                                    </div>
                                    <?php }
                                    }  else { ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert" style="margin-left: 15px;">
                                        This Form cannot empty
                                        </div>  
                                    </div>
                                    <?php } }?>
                        
                        <!-- Content Column -->
                <div class="col-lg-6 mb-4"> 
                                                        
                        
                            <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="activity_title">Add Activity Title</label>
                                        <input placeholder="Activity Title" type="text" class="form-control" name="activity_title" >
                                        
                                    </div>

                                    <div class="form-group">
                                    <label for="activity_title">Add Activity Information</label>
                                    <input placeholder="Activity Information" type="text" class="form-control" name="activity_information" >
                                    </div>

                                    <div class="form-group">
                                    <input type="file" name="image" >
                                    </div>

                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Add Activity">
                                    </div>
                            </form>
                        


                                    <!-- Edit Category -->
                                    <?php 
                                    // Edit activity berdasarkan id
                                        if (isset($_GET['edit'])) {
                                            $activity_id = $_GET['edit'];

                                            $activity_id = mysqli_real_escape_string($connection,$activity_id);
                                            $query = "SELECT * FROM activity WHERE activity_id = '$activity_id'";
                                            $select_id_activity_query = mysqli_query($connection,$query);
                                            while ($row = mysqli_fetch_assoc($select_id_activity_query)) :
                                                $activity_title = $row['activity_title'];
                                                $activity_id = $row['activity_id'];
                                                $activity_information = $row['activity_information'];
                                                $activity_photo = $row['activity_photo'];        
                                                ?>  
                            <br>

                            <form action="" method="post"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cat_activity">Edit Activity</label>                                    
                                    <input placeholder="Activity Title" type="text" class="form-control" name="activity_title" value="<?php echo $activity_title?>">
                                    
                                </div>

                                <div class="form-group">
                                <input placeholder="Activity Information" type="text" class="form-control" name="activity_information" value="<?php echo $activity_information?>">
                                </div>

                                <div class="form-group">
                                <input type="hidden" name="activity_id" value="<?php echo $activity_id?>" >
                                </div>

                                <div class="form-group">
                                <input type="file" name="image" >
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_activity" value="Edit Activity">
                                </div>                                         
                            </form>                                        
                                        
                            <?php endwhile; } ?>    
                </div>
        
                        <div class="col-lg-12">
                        <?php 
                // menampilkan seluruh activity
                $query = "SELECT * FROM activity";
                $select_all_activity_query = mysqli_query($connection,$query);
            ?>
            <div class="card shadow mb-4" style="margin-top: 20px; margin-bottom: 40px ">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                    </div>
                <div class="card-body">
                                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>photo</th>
                                        <th>Information</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>

                                </thead>
                                <tbody>
                                <?php 
                                    $no = 1;
                                ?>
                                <?php 
                                    while ($row = mysqli_fetch_assoc($select_all_activity_query)) :
                                    $activity_photo = $row['activity_photo'];
                                    $activity_information = $row['activity_information'];  
                                    $activity_id = $row['activity_id'];    
                                    $activity_title = $row['activity_title'];                                      
                                
                                ?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td class="stu_id"><?php echo $activity_id?></td>
                                    <td><?php echo $activity_title ?></td>
                                    
                                    
                                    <td ><img src="../images/about/activity/<?php echo $activity_photo?>" width="100px" alt=""></td>
                                    <td class="about_information"><?php echo $activity_information?></td>
                                    <td><a href="" class="badge badge-danger delete_btn" style="padding: 10px;">Delete</a></td>
                                    <td ><a href="about_photo.php?edit=<?php echo "$activity_id"; ?>" class="badge badge-primary" style="padding: 10px;">Edit</a></td>
                                </tr>
                                <?php $no++; endwhile; ?>

                                <!-- Modal Delete Activity -->
                    <div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteStudentModalLabel">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                            <input type="hidden" name="activity_id" id="delete_id">
                                            do you want to delete this activity?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <button type="submit" name="delete" class="btn btn-danger">Yes</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>

                                </tbody>
                        </table>
                        </div>

                </div>
                
            </div>
            <div class="form-group">
                <td><a href="../about.php" class="badge badge-primary" style="padding: 14px;" target="blank">View About</a></td>
            </div>
                                            <!-- Delete Activity -->
                                <?php 
                                if (isset($_POST['delete'])) {
                                        if (isset($_SESSION['user_role'])) {
                                            if ($_SESSION['user_role'] == 'admin') {
                                                # code...
                                            
                                        $the_activity_id = $_POST['activity_id'];
                                        $the_activity_id = mysqli_real_escape_string($connection,$the_activity_id);
                                        $query = "DELETE FROM activity WHERE activity_id = '$the_activity_id'";
                                        $delete_activity_query = mysqli_query($connection,$query);
                                        header("Location: about_photo.php");
                                    }
                                    }else {
                                        header("Location: login.php");
                                    }
                                }
                                ?>

                        <!-- </div> -->
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){

            $('.delete_btn').click(function(e){

                e.preventDefault();
                var stu_id = $(this).closest('tr').find('.stu_id').text();
                
                console.log(stu_id);
                
                $('#delete_id').val(stu_id);
                
                $('#deleteStudentModal').modal('show');

            });



        });



    </script>

    <?php include 'includes/admin_footer.php'; ?>