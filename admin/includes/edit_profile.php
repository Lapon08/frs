<?php if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE `user_id` = '$user_id'";
    $select_user = mysqli_query($connection,$query);
    confirm($select_user);

    while($row = mysqli_fetch_assoc($select_user)){
        $user_username = $row['user_username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];

    }


} ?>


<?php 
if (isset($_POST['edit_profile'])) {
    if (!empty($_POST['user_username']) && !empty($_POST['user_firstname']) &&
    !empty($_POST['user_lastname']) && !empty($_POST['user_email']) ) {
        # code...
    

    $user_username = $_POST['user_username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_image_new = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    if ( empty($user_image_new) ) {
        $user_image_new = $user_image;
    }

    $user_firstname = mysqli_real_escape_string($connection,$user_firstname);
    $user_lastname = mysqli_real_escape_string($connection,$user_lastname);
    $user_username = mysqli_real_escape_string($connection,$user_username);
    $user_email = mysqli_real_escape_string($connection,$user_email);
    $user_image_new = mysqli_real_escape_string($connection,$user_image_new);
    
    move_uploaded_file($user_image_temp,"../images/profile/$user_image_new");
    $query = "UPDATE users SET user_username = '$user_username', 
                    user_firstname = '$user_firstname',
                    user_lastname = '$user_lastname', 
                    user_email = '$user_email', 
                    user_image = '$user_image_new' 
                    WHERE `user_id` = $user_id";
    $user_profile_update = mysqli_query($connection,$query);
    confirm($user_profile_update);
    $_SESSION['user_username'] = $user_username;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_firstname'] = $user_firstname;
    $_SESSION['user_lastname'] = $user_lastname;
    
    
    ?>

    <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
        Profile Updated <a href="profile.php"  class="alert-link">View Profile</a>
        </div>  


    <?php 
    }else {?>
        <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
        This Form cannot empty 
        </div>  
    <?php }
}

?>

<div class="col-lg-12">
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <img class="img-profile2" src="../images/profile/<?php echo $user_image ?>" alt="">
        <input type="file" name="image" >
    </div>

    <div class="form-group">
        <label for="author">Username</label>
        <input type="text" class="form-control" name="user_username" value="<?php echo $user_username ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
    </div>


    <div class="form-group">
        <label for="post_tags">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
    </div>

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
    </div>


    <!-- <div class="form-group">
        <label for="image">Lastname</label>
        <input type="file" name="image">
    </div> -->


    <div class="form-group">
        <a href="profile.php?source=edit_profile"><input class="btn btn-primary" type="submit" name="edit_profile" value="Update Profile"></a>
    </div>


</form>
</div>