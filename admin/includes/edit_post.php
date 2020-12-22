<?php 
                if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];


                }
                // menampilkan isi post yang akan diedit
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                $select_posts_by_id = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_posts_by_id)):

                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];

                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                endwhile; ?>

        <?php 
            if (isset($_POST['edit_post'])) {
                // Mengedit post
                if (!empty($_POST['title']) && !empty($_POST['post_author_id']) &&
                !empty($_POST['post_category_id']) && !empty($_POST['post_status']) &&
                !empty($_POST['post_content']) && !empty($_POST['post_tags']) ) 
                {

                $post_title = $_POST['title'];
                $post_author = $_POST['post_author_id'];
                $post_category_id= $_POST['post_category_id'];
                $post_status = $_POST['post_status'];
                
                $post_image = $_FILES['image'] ['name'];
                $post_image_temp = $_FILES['image']['tmp_name'];
        
                $post_content = $_POST['post_content'];
                // $post_date = date('d-m-y');
                $post_tags = $_POST['post_tags'];       
                move_uploaded_file($post_image_temp,"../images/post/$post_image");
        
                    if (empty($post_image)) {
                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                            $select_image = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select_image)){
                                    $post_image = $row['post_image'];
                            }
                    }

                    $post_title = mysqli_real_escape_string($connection,$post_title);
                    $post_author = mysqli_real_escape_string($connection,$post_author);
                    $post_category_id = mysqli_real_escape_string($connection,$post_category_id);
                    $post_status = mysqli_real_escape_string($connection,$post_status);
                    $post_image = mysqli_real_escape_string($connection,$post_image);
                    $post_image_temp = mysqli_real_escape_string($connection,$post_image_temp);
                    $post_content = mysqli_real_escape_string($connection,$post_content);
                    $post_tags = mysqli_real_escape_string($connection,$post_tags);



                $query = "UPDATE `posts` SET `post_category_id`='$post_category_id',
                        `post_title`='$post_title',
                        `post_author`='$post_author',
                        `post_date`= now(),
                        `post_image`='$post_image',
                        `post_content`='$post_content',
                        `post_tags`='$post_tags',
                        `post_status`='$post_status' WHERE post_id = '$the_post_id'";
                $query_edit_post = mysqli_query($connection,$query);
                confirm($query_edit_post);
                ?>
                    <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                    Post Updated: <a href="../post.php?p_id=<?php echo $the_post_id ?>" target="blank" class="alert-link">View This Post</a> / 
                    <a href="posts.php"  class="alert-link">View All Post</a>
                    </div>
                <?php }
                    else { ?>
                        <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                        This Form cannot empty
                        </div>  
                    <?php }
            } ?> 
        
        
        


    <div class="col-lg-12">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $post_title ?>">
            </div>

            <div class="form-group">
            <!-- <label for="post_category">Post Category <br></label> -->
            <label for="post_category_id">Category</label>
            <br>
                <select name="post_category_id" id="">
                        <?php 
                            $query = "SELECT * FROM categories";
                            $select_id_categories_query = mysqli_query($connection,$query);
                            confirm($select_id_categories_query);
                            
                            while ($row = mysqli_fetch_assoc($select_id_categories_query)) :
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                                if ($post_category_id == $cat_id) { ?>
                                    <option selected value="<?php echo $cat_id ?>"  > <?php echo $cat_title?> </option>
                                <?php }else { ?>
                                    <option value="<?php echo $cat_id ?>"  > <?php echo $cat_title?> </option>
                                <?php }       ?>                      
                            
                            <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="post_author_id">Author</label>
                <br>
                <select name="post_author_id" id="">
                        <?php 
                            $query = "SELECT * FROM users WHERE user_role = 'admin'";
                            $select_id_user_query = mysqli_query($connection,$query);
                            confirm($select_id_user_query);
                            
                            while ($row = mysqli_fetch_assoc($select_id_user_query)) :
                                $user_id = $row['user_id'];
                                $user_username = $row['user_username'];       ?>                      
                            <option value="<?php echo $user_username ?>"  > <?php echo $user_username?> </option>
                            <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
            <label for="post_status">Status</label>
            <br>
            <select name="post_status" id="">
                <option value="<?php echo $post_status?>"><?php echo $post_status?></option>
                    <?php 
                        if ($post_status == 'publish') { ?>
                            <option value="draft">Draft</option>
                        <?php } else { ?>
                            <option value="publish">Publish</option>
                        <?php } ?>
                    
            </select>
            
            
            </div>


            </select>
            <!-- <div class="form-group">
                <label for="post_status">Post Status</label>
                <input type="text" class="form-control" name="post_status" value="<?php echo $post_status ?>">
            </div> -->

            <div class="form-group">
                    <label for="image">Post Image</label>
                    <br>
                    <img width="100" src="../images/post/<?php echo $post_image ?>" alt="Image">
                    <input type="file" name="image">
            </div>

            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
            </div>

            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10" ><?php echo $post_content ?>
                </textarea>
            </div>

            <script>
                    ClassicEditor
                            .create( document.querySelector( '#editor' ) )
                            .then( editor => {
                                    console.log( editor );
                            } )
                            .catch( error => {
                                    console.error( error );
                            } );
            </script>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post">
            </div>
        </form>
    </div>