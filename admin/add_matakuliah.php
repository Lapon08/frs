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
                            if (isset($_POST['add_matakuliah'])) {
                                if (!empty($_POST['mk_sks']) && !empty($_POST['mk_semester']) &&
                                !empty($_POST['mk_kode'])  && !empty($_POST['jurusan_id']) && 
                                !empty($_POST['dosen_id']) && !empty($_POST['mk_nama']) )
                                {
                                $mk_sks = $_POST['mk_sks'];
                                $mk_semester = $_POST['mk_semester'];
                                $mk_kode = $_POST['mk_kode'];
                                $mk_nama = $_POST['mk_nama'];
                                $dosen_id = $_POST['dosen_id'];
                                $jurusan_id = $_POST['jurusan_id'];

                                $mk_sks = mysqli_real_escape_string($connection,$mk_sks);
                                $mk_semester = mysqli_real_escape_string($connection,$mk_semester);
                                $mk_kode = mysqli_real_escape_string($connection,$mk_kode);
                                $mk_nama = mysqli_real_escape_string($connection,$mk_nama);
                                $jurusan_id = mysqli_real_escape_string($connection,$jurusan_id);
                                $dosen_id = mysqli_real_escape_string($connection,$dosen_id);
                                    // tambah mahasiswa
                                $query = "INSERT INTO `mata_kuliah`( `mk_semester`, `mk_kode`, `mk_sks`, `mk_nama`, `dosen_id`, `jurusan_id`) 
                                VALUES ('$mk_semester','$mk_kode','$mk_sks','$mk_nama','$dosen_id','$jurusan_id')";
                            
                                $add_matakuliah = mysqli_query($connection,$query);
                                confirm($add_matakuliah);
                                ?>
                                
                                <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                                Matakuliah Added:
                                <a href="matakuliah.php"  class="alert-link">View All Matakuliah</a>
                                </div>        
                            <?php 
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
                                    <label for="mk_nama">Nama Matakuliah</label>
                                    <input type="text" class="form-control" name="mk_nama">
                                </div>
                                <div class="form-group">
                                    <label for="mk_sks">SKS Matakuliah</label>
                                    <input type="text" class="form-control" name="mk_sks">
                                </div>
                                <div class="form-group">
                                    <label for="mk_semester">Semester Matakuliah</label>
                                    <input type="text" class="form-control" name="mk_semester">
                                </div>
                                <div class="form-group">
                                    <label for="mk_kode">Kode Matakuliah</label>
                                    <input type="text" class="form-control" name="mk_kode">
                                </div>
                                <label for="jurusan_id">Jurusan Mahasiswa</label>
                                <div class="form-group">
                                <select name="jurusan_id" id="jurusan_id">
                                
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
                                <label for="dosen_id">Dosen Matakuliah</label>
                                <div class="form-group">
                                <select name="dosen_id" id="dosen_id">
                                
                                <?php 
                                    $query = "SELECT * FROM `dosen`";
                                    $select_dosen = mysqli_query($connection,$query);
                                    while ($row = mysqli_fetch_assoc($select_dosen)) {
                                        $dosen_id = $row['dosen_id'];
                                        $dosen_nama = $row['dosen_nama']; ?>
                                        <option value="<?php echo $dosen_id ?>"  > <?php echo $dosen_nama?> </option>
                                    <?php }                                
                                ?>
                                </select>
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add_matakuliah" value="Add Matakuliah">
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