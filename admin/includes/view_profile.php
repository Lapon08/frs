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

<div class="col-lg-12">
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <img class="img-profile2" src="../images/profile/<?php echo $user_image ?>" alt="">
    </div>

    <div class="form-group">
        <label for="author">Username</label>
        <input type="text" class="form-control" name="user_username" value="<?php echo $user_username ?>" readonly>
    </div>



    <div class="form-group">
        <label for="post_status">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>" readonly>
    </div>


    <div class="form-group">
        <label for="post_tags">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>" readonly>
    </div>

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>" readonly>
    </div>


    <!-- <div class="form-group">
        <label for="image">Lastname</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="post_tags">User Role</label>
        <input type="text" class="form-control" name="user_password" value="<?php echo $user_role?>" readonly>
    </div>



    <div class="form-group">
        <a href="profile.php?source=edit_profile" class="badge badge-primary" style="padding: 15px;">Edit Profile</a>
    </div>

    <div class="form-group">
    <a href="profile.php?source=change_password" class="badge badge-danger" style="padding: 15px;">Change Password</a>
    </div>
</form>
</div>