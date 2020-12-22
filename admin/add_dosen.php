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
                        <h1 class="h3 mb-0 text-gray-800">Dosen</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <?php 
                        // fungsi menambahkan post
                            if (isset($_POST['add_dosen'])) {
                                if (!empty($_POST['dosen_nama']) && !empty($_POST['dosen_nidn']) &&
                                !empty($_POST['dosen_alamat']) && !empty($_POST['dosen_hp']) && !empty($_POST['jurusan_id']))
                                {
                                $dosen_nama = $_POST['dosen_nama'];
                                $dosen_nidn = $_POST['dosen_nidn'];
                                $dosen_alamat = $_POST['dosen_alamat'];
                                $dosen_hp = $_POST['dosen_hp'];
                                $jurusan_id = $_POST['jurusan_id'];

                                $dosen_password = password_hash($dosen_nidn,PASSWORD_DEFAULT);
                                $dosen_nama = mysqli_real_escape_string($connection,$dosen_nama);
                                $dosen_nidn = mysqli_real_escape_string($connection,$dosen_nidn);
                                $dosen_alamat = mysqli_real_escape_string($connection,$dosen_alamat);
                                $dosen_hp = mysqli_real_escape_string($connection,$dosen_hp);
                                $jurusan_id = mysqli_real_escape_string($connection,$jurusan_id);
                                $query="SELECT * FROM dosen WHERE dosen_nidn = '$dosen_nidn'";
                                $check_dosen = mysqli_query($connection,$query);
                                $count = mysqli_num_rows($check_dosen);
                                if (!$count) {
                                    
                                

                                    // tambah post
                                $query = "INSERT INTO `dosen`(`dosen_nama`, `dosen_nidn`, `dosen_password`, `dosen_hp`, `dosen_alamat`, `jurusan_id`) 
                                VALUES ('$dosen_nama','$dosen_nidn','$dosen_password','$dosen_hp','$dosen_alamat','$jurusan_id')";
                            
                                $add_dosen = mysqli_query($connection,$query);
                                confirm($add_dosen);
                                ?>
                                
                                <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                                Dosen Added:
                                <a href="dosen.php"  class="alert-link">View All Dosen</a>
                                </div>        
                            <?php }else {?>
                                <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                                    nidn already used
                                </div>  
                            <?php }
                            }
                                else { ?>
                                    <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                                    This Form cannot empty
                                    </div>  
                                <?php }
                            } ?>

                        <!-- Menampilkan seluruh post yang ada -->
                        <div class="col-lg-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="dosen_nama">Nama Dosen</label>
                                    <input type="text" class="form-control" name="dosen_nama">
                                </div>
                                <div class="form-group">
                                    <label for="dosen_nidn">NIDN Dosen</label>
                                    <input type="text" class="form-control" name="dosen_nidn">
                                </div>
                                <div class="form-group">
                                    <label for="dosen_alamat">Alamat Dosen</label>
                                    <input type="text" class="form-control" name="dosen_alamat">
                                </div>
                                <div class="form-group">
                                    <label for="dosen_hp">HP Dosen</label>
                                    <input type="text" class="form-control" name="dosen_hp">
                                </div>


                                <label for="jurusan_dosen">Jurusan Dosen</label>
                                <div class="form-group">
                                <select name="jurusan_id" id="jurusan_dosen">
                                
                                <?php 
                                    $query = "SELECT * FROM `jurusan`";
                                    $select_jurusan = mysqli_query($connection,$query);
                                    while ($row = mysqli_fetch_assoc($select_jurusan)) {
                                        $jurusan_id = $row['jurusan_id'];
                                        $jurusan_nama = $row['jurusan_nama']; ?>
                                        <option value="<?php echo $jurusan_id ?>"  > <?php echo $jurusan_nama?> </option>
                                    
                                    <?php }                                
                                ?>
                                </select>
                                </div>


                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add_dosen" value="Add Dosen">
                                </div>
                            </form>
                        </div>


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


<?php include 'includes/admin_footer.php'; ?>