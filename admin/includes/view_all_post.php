
<div class="col-lg-12">

<?php 
    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $post_id) {
            $bulk_options = $_POST['bulk_options'];
            switch ($bulk_options) {
                case 'publish':
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$post_id'";
                    $update_to_published = mysqli_query($connection,$query);
                    confirm($update_to_published);
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$post_id'";
                    $update_to_draft = mysqli_query($connection,$query);
                    confirm($update_to_draft);
                    break;                
            }
        }
    }


?>

<form action="" method="post">
    <table> 
        <div class="bulkOptionContainer" class="col-xs-4" style="width: 200" >
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Option</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
            </select>
        </div>

    </table>


<div  style="margin-top:15px; margin-bottom:20px">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New Post</a>
</div>




    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Post</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><Input type='checkbox' id='selectAllBoxes'></Input></th>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>View Post</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <?php 
                                        $query = "SELECT * FROM posts ORDER BY post_id DESC";
                                        $select_posts = mysqli_query($connection,$query);
                                        $no = 1; //nomor
                                        while($row = mysqli_fetch_assoc($select_posts)):
                                            
                                            $post_id = $row['post_id'];
                                            $post_author = $row['post_author'];
                                            $post_title = $row['post_title'];
                                            $post_category_id = $row['post_category_id'];
                                            $post_status = $row['post_status'];
                                            $post_image = $row['post_image'];
                                            $post_tags = $row['post_tags'];
                                            $post_date = $row['post_date'];
                                    ?>

                                    <tr>
                                        
                                        <td><Input type='checkbox' class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id;?>"></Input></td>
                                        <td><?php echo $no; ?> </td>
                                        <td class="stu_id"><?php echo $post_id ?></td>
                                        <td><?php echo $post_author ?></td>
                                        <td><?php echo $post_title ?></td>

                                        <?php 
                                            $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                                            $select_id_categories_query = mysqli_query($connection,$query);
                                            confirm($select_id_categories_query);
                                            
                                            while ($row = mysqli_fetch_assoc($select_id_categories_query)) :
                                                $cat_title = $row['cat_title'];
                                                $cat_id = $row['cat_id'];       ?>                      
                                                <td><?php echo $cat_title?></td>
                                            <?php endwhile; ?>

                                        <td><?php echo $post_status ?></td>
                                        <td><img src="../images/post/<?php echo $post_image?>" alt="image" class="img-responsive" width="100"></td>
                                        <td><?php echo $post_tags ?></td>
                                        <?php 
                                            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                                            $send_comment_query = mysqli_query($connection,$query);
                                            confirm($send_comment_query);
                                            $post_comment_count = mysqli_num_rows($send_comment_query);
                                        ?>


                                        <td><?php echo $post_comment_count ?></td>
                                        <td><?php echo $post_date ?></td>
                                        <td><a href="../post.php?p_id=<?php echo $post_id ?>" class="badge badge-primary" style="padding: 10px;" target="blank">View</a></td>
                                        <td><a href="posts.php?source=edit_post&p_id=<?php echo $post_id ?>" class="badge badge-primary" style="padding: 10px;">Edit</a></td>
                                        <td><a href="" class="badge badge-danger delete_btn" style="padding: 10px;">Delete</a></td>
                                    </tr>
                                    
                                        <?php $no++; endwhile; ?>
                                </tbody>

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
                                            <input type="hidden" name="post_id" id="delete_id">
                                            do you want to delete this Post?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <button type="submit" name="delete" class="btn btn-danger">Yes</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                </table>
                            </div>
                            </form>
    </div>
</div>
                        <?php 
                        
                            if (isset($_POST['delete'])) {
                                if (isset($_SESSION['user_role'])) {
                                    if ($_SESSION['user_role'] == 'admin') {
                                        # code...
                                    
                                
                                $post_id_delete = $_POST['post_id'];
                                $post_id_delete = mysqli_real_escape_string($connection,$post_id_delete);
                                $query = "DELETE FROM posts WHERE post_id = $post_id_delete";
                                $delete_query = mysqli_query($connection,$query);
                                if (!$delete_query) {
                                    confirm($delete_query);
                                }
                                $query = "DELETE FROM comments WHERE comment_post_id = ' $post_id_delete'";
                                $delete_comment_post = mysqli_query($connection,$query);
                                confirm($delete_comment_post);
                                header("Location: posts.php");
                            } }
                                else {
                                    header("Location: login.php");
                                }
                    }
                        ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('.delete_btn').click(function(e){

                e.preventDefault();
                var stu_id = $(this).closest('tr').find('.stu_id').text();
                //console.log(stu_id);
                $('#delete_id').val(stu_id);
                $('#deleteStudentModal').modal('show');

            });



        });
    </script>
    