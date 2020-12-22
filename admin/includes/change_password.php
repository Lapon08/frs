<?php if (isset($_POST['change_password'])) {
    // function change password
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }else {
        header("Location: login.php");
    }
    // password lebih dari 8
    if (strlen($new_password) > 8) {
        $query = "SELECT user_password FROM users WHERE `user_id` = '$user_id'";
        $select_user = mysqli_query($connection,$query);
        confirm($select_user);
    
        while($row = mysqli_fetch_assoc($select_user)){
            $user_password = $row['user_password'];
    
        }
        // apakah current password sama atau tidak
        $db_user_password = password_verify($current_password,$user_password);
        
        if ($new_password === $confirm_password) {
        
            if ($current_password == $db_user_password ) {
                $new_password = password_hash($new_password,PASSWORD_DEFAULT);
                $query = "UPDATE users SET user_password = '$new_password' WHERE `user_id` = '$user_id' ";
                $change_password = mysqli_query($connection,$query);
                confirm($change_password); ?>
                    <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                            Passwrod Changed
                    </div> 
    
            <?php }else { ?>
                    <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                            Your Current Password is Wrong
                    </div> 
            <?php }
    
        }else { ?>
                <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                Your Password Did Not Match
                </div> 
        <?php }
    }else { ?>
                <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                Your Password Too Short
                </div> 
    <?php }
    }else { ?>
        <div class="alert alert-danger " role="alert" style="margin-left: 10px;">
        This Form can not empty!
        </div> 
    <?php }

} ?>

<div class="col-lg-12">
<form action="" method="post">

    <div class="form-group">
        <label for="author">Current Password</label>
        <input type="password" class="form-control" name="current_password" ">
    </div>

    <div class="form-group">
        <label for="post_status">New Password</label>
        <input type="password" class="form-control" name="new_password" ">
    </div>


    <div class="form-group">
        <label for="post_tags">Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password" ">
    </div>


    <div class="form-group">
        <a href="profile.php?source=change_password"><input class="btn btn-primary" type="submit" name="change_password" value="Change Password"></a>
    </div>
</form>
</div>