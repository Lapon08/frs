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
                        <h1 class="h3 mb-0 text-gray-800">Jurusan</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <?php 
                        // fungsi menambahkan post
                            if (isset($_POST['add_mahasiswa'])) {
                                if (!empty($_POST['jurusan_nama']) && !empty($_POST['jurusan_kode']))
                                {
                                $jurusan_nama = $_POST['jurusan_nama'];
                                $jurusan_kode = $_POST['jurusan_kode'];
                                $jurusan_nama = mysqli_real_escape_string($connection,$jurusan_nama);
                                $jurusan_kode = mysqli_real_escape_string($connection,$jurusan_kode);
                                    // tambah post
                                $query = "INSERT INTO `jurusan`(`jurusan_nama`, `jurusan_kode`) 
                                        VALUES ('$jurusan_nama','$jurusan_kode')";
                            
                                $add_mahasiswa = mysqli_query($connection,$query);
                                confirm($add_mahasiswa);
                                ?>
                                
                                <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                                jurusan Added:
                                <a href="jurusan.php"  class="alert-link">View All Jurusan</a>
                                </div>        
                            <?php }
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
                                    <label for="jurusan_nama">Nama Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan_nama">
                                </div>
                                <div class="form-group">
                                    <label for="jurusan_kode">Kode Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan_kode">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add_mahasiswa" value="Add Jurusan">
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