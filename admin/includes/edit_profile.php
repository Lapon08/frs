<?php if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $query = "SELECT * FROM admin WHERE `admin_id` = '$admin_id'";
    $select_admin = mysqli_query($connection,$query);
    confirm($select_admin);

    while($row = mysqli_fetch_assoc($select_admin)){
        $admin_nama = $row['admin_nama'];
        $admin_email = $row['admin_email'];
        $admin_alamat = $row['admin_alamat'];
    }
} ?>


<?php 
if (isset($_POST['edit_profile'])) {
    if (!empty($_POST['admin_nama']) && !empty($_POST['admin_email']) &&
    !empty($_POST['admin_alamat']) ) {
        $admin_nama = $_POST['admin_nama'];
        $admin_email = $_POST['admin_email'];
        $admin_alamat = $_POST['admin_alamat'];

    $admin_email = mysqli_real_escape_string($connection,$admin_email);
    $admin_alamat = mysqli_real_escape_string($connection,$admin_alamat);
    $admin_nama = mysqli_real_escape_string($connection,$admin_nama);

    $query = "UPDATE `admin` SET admin_nama = '$admin_nama', 
                    admin_email = '$admin_email',
                    admin_alamat = '$admin_alamat', 
                    admin_nama = '$admin_nama' WHERE admin_id = '$admin_id'";
    $user_profile_update = mysqli_query($connection,$query);
    confirm($user_profile_update);
    $_SESSION['admin_nama'] = $admin_nama;
    $_SESSION['admin_email'] = $admin_email;
    $_SESSION['admin_alamat'] = $admin_alamat;
    
    
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
<form action="" method="post">

    <div class="form-group">
        <label for="author">Nama Admin</label>
        <input type="text" class="form-control" name="admin_nama" value="<?php echo $admin_nama ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Email Admin</label>
        <input type="text" class="form-control" name="admin_email" value="<?php echo $admin_email ?>">
    </div>


    <div class="form-group">
        <label for="post_tags">alamat Admin</label>
        <input type="text" class="form-control" name="admin_alamat" value="<?php echo $admin_alamat ?>">
    </div>

    <div class="form-group">
        <a href="profile.php?source=edit_profile"><input class="btn btn-primary" type="submit" name="edit_profile" value="Update Profile"></a>
    </div>


</form>
</div>