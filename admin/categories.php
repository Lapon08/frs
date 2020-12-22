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
                        <h1 class="h3 mb-0 text-gray-800">Categories</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    <?php       
                                // tambah category
                                if (isset($_POST['submit'])) {
                                    if (!empty($_POST['cat_title'])) {
                                    
                                    $cat_title = $_POST['cat_title'];
                                    // nama kategori harus kurang dari 13
                                    if (strlen($cat_title) <=13) {
                                        mysqli_real_escape_string($connection,$cat_title);
                                        $query = "INSERT INTO categories(`cat_title`)
                                                    VALUE('$cat_title')";
                                        
                                        $create_category_query = mysqli_query($connection,$query);
                                        if (!$create_category_query) {
                                            die("Query failed" . mysqli_error($connection));
                                        }?>
                                    <div class="col-12">
                                    <div class="alert alert-primary col-lg-7" role="alert" style="margin-left: 10px;">
                                    Categorie Added
                                    </div>
                                    </div>
                                <?php }
                                    else { ?>
                                        <div class="alert alert-danger col-lg-7" role="alert" style="margin-left: 25px;">
                                        Your category name should be no more than 13
                                        </div>  
                                    <?php }
                                    }  else { ?>
                                        <div class="alert alert-danger col-lg-7" role="alert" style="margin-left: 25px;">
                                        This Form cannot empty
                                        </div>  
                                    <?php }
                                } ?>
                        <?php 
                                        // update category
                                    if (isset($_POST['update_category'])) {
                                        if (!empty($_POST['cat_title'])) {
                                        $the_cat_title = $_POST['cat_title'];
                                        $cat_id = $_POST['cat_id'];
                                        // nama category harus kurang 13
                                        if (strlen($the_cat_title) <=13) {
                                            $the_cat_title = mysqli_real_escape_string($connection,$the_cat_title);
                                            $cat_id = mysqli_real_escape_string($connection,$cat_id);
                                            $query = "UPDATE categories SET cat_title = '$the_cat_title' WHERE cat_id = '$cat_id'";
    
                                            $update_category_query = mysqli_query($connection,$query);
                                            if (!$update_category_query) {
                                                die("Query Error" .mysqli_error($connection));
                                            }?>
                                        <div class="col-12">
                                        <div class="alert alert-primary col-lg-7" role="alert" style="margin-left: 10px;">
                                        Categorie Edited
                                        </div>
                                        </div>
                                        <?php }else { ?>
                                                <div class="alert alert-danger col-lg-7" role="alert" style="margin-left: 25px;">
                                                Your category name should be no more than 13
                                                </div>  
                                        <?php }
                                        

                                        } else { ?>
                                            <div class="alert alert-danger col-lg-7" role="alert" style="margin-left: 25px;">
                                            This Form cannot empty
                                            </div>  
                                <?php } } ?>
                        
                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4"> 
                                                        
                        
                        <form action="" method="post" style="margin-left: 15px;">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title" >
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                        </form>
                        
                                    <!-- Edit Category -->
                                    <?php 
                                    // tombol update kategori
                                        if (isset($_GET['edit'])) {
                                            $cat_id = $_GET['edit'];

                                            $cat_id = mysqli_real_escape_string($connection,$cat_id);
                                            $query = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
                                            $select_id_categories_query = mysqli_query($connection,$query);
                                            while ($row = mysqli_fetch_assoc($select_id_categories_query)) :
                                                $cat_title = $row['cat_title'];
                                                $cat_id = $row['cat_id'];       ?>  
                            <br>
                                                <!-- form edit category -->
                            <form action="" method="post" style="margin-left: 15px;">
                                <div class="form-group">
                                    <label for="cat_title">Edit Category</label>                                    
                                    <input type="text" class="form-control" name="cat_title" value="<?php echo $cat_title; ?>" >
                                    
                                    <input type="hidden"  name="cat_id" value="<?php echo $cat_id?>">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Edit Category">
                                </div>                                            
                            </form>                                        
                                        
                            <?php endwhile; } ?>    
                </div>


                        <div class="col-lg-12">
                        <?php 
                
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection,$query);
                                    
            ?>
            <div class="card shadow mb-4" style="margin-top: 20px; margin-bottom: 40px ">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                    </div>
                <div class="card-body">
                                <div class="table-responsive">
                                    <!-- menampilkan kategori -->
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>

                                </thead>
                                <tbody>
                                <?php 
                                    $no = 1;
                                ?>
                                <?php 
                                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) :
                                    $cat_title = $row['cat_title'];
                                    $cat_id = $row['cat_id'];                                       
                                
                                ?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td class="stu_id"><?php echo $cat_id?></td>
                                    <td class="cat_title"><?php echo $cat_title?></td>
                                    <td><a href="" class="badge badge-danger delete_btn" style="padding: 10px;">Delete</a></td>
                                    <td><a href="categories.php?edit=<?php echo "$cat_id"; ?>" class="badge badge-primary" style="padding: 10px;">Edit</a></td>
                                </tr>
                                <?php $no++; endwhile; ?>

                                <!-- Modal -->
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
                                            <input type="hidden" name="cat_id" id="delete_id">
                                            do you want to delete this category?
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

                                            <!-- Delete Categorie -->
                                            <?php 
                                    if (isset($_POST['delete'])) {
                                        if (isset($_SESSION['user_role'])) {
                                            if ($_SESSION['user_role'] == 'admin') {
                                                # code...
                                            
                                        $the_cat_id = $_POST['cat_id'];
                                        $the_cat_id = mysqli_real_escape_string($connection,$the_cat_id);
                                        $query = "DELETE FROM categories WHERE cat_id = '$the_cat_id'";

                                        $delete_category_query = mysqli_query($connection,$query);
                                        header("Location: categories.php");
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
                var cat_title = $(this).closest('tr').find('.cat_title').text();
                console.log(stu_id);
                console.log(cat_title);
                $('#delete_id').val(stu_id);
                $('#cat_title').html("cat_title");
                $('#deleteStudentModal').modal('show');

            });



        });



    </script>

    <?php include 'includes/admin_footer.php'; ?>