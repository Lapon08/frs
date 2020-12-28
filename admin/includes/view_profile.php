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

<div class="col-lg-12">
<form action="" method="post">
    <div class="form-group">
        <label for="author">Nama Admin</label>
        <input type="text" class="form-control" name="admin_nama" value="<?php echo $admin_nama ?>" readonly>
    </div>

    <div class="form-group">
        <label for="post_status">Email Admin</label>
        <input type="text" class="form-control" name="admin_email" value="<?php echo $admin_email ?>" readonly>
    </div>


    <div class="form-group">
        <label for="post_tags">alamat Admin</label>
        <input type="text" class="form-control" name="admin_alamat" value="<?php echo $admin_alamat ?>" readonly>
    </div>

    <div class="form-group">
        <a href="profile.php?source=edit_profile" class="badge badge-primary" style="padding: 15px;">Edit Profile</a>
    </div>

    <div class="form-group">
    <a href="profile.php?source=change_password" class="badge badge-danger" style="padding: 15px;">Change Password</a>
    </div>
</form>
</div>