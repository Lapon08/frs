
                        <?php 
                        // fungsi menambahkan post
                            if (isset($_POST['add_admin'])) {
                                if (!empty($_POST['admin_nama']) && !empty($_POST['admin_alamat']) && !empty($_POST['admin_email']))
                                {
                                $admin_nama = $_POST['admin_nama'];
                                $admin_alamat = $_POST['admin_alamat'];
                                $admin_email = $_POST['admin_email'];
                                $admin_nama = mysqli_real_escape_string($connection,$admin_nama);
                                $admin_alamat = mysqli_real_escape_string($connection,$admin_alamat);

                                $admin_password = password_hash($admin_email,PASSWORD_DEFAULT);
                                    // tambah admin
                                $query = "INSERT INTO `admin`(`admin_nama`, `admin_alamat`,`admin_email`,`admin_password`) 
                                        VALUES ('$admin_nama','$admin_alamat','$admin_email','$admin_password')";
                            
                                $add_admin = mysqli_query($connection,$query);
                                confirm($add_admin);
                                ?>
                                
                                <div class="alert alert-primary col-lg-8" role="alert" style="margin-left: 10px;">
                                admin Added:
                                <a href="admin.php"  class="alert-link">View All admin</a>
                                </div>        
                            <?php }
                                else { ?>
                                    <div class="alert alert-danger col-lg-8" role="alert" style="margin-left: 10px;">
                                    This Form cannot empty
                                    </div>  
                                <?php }
                            } ?>

                        <!-- Menampilkan seluruh post yang ada -->
                        <div class="col-lg-8">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="admin_nama">Nama Admin</label>
                                    <input type="text" class="form-control" name="admin_nama">
                                </div>
                                <div class="form-group">
                                    <label for="admin_alamat">Alamat Admin</label>
                                    <input type="text" class="form-control" name="admin_alamat">
                                </div>
                                <div class="form-group">
                                    <label for="admin_email">Email Admin</label>
                                    <input type="text" class="form-control" name="admin_email">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add_admin" value="Add Admin">
                                </div>
                            </form>
                        </div>
