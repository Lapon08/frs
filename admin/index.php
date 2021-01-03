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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Users -->
        <?php 
        $query = "SELECT COUNT(admin_id) AS numAdmin FROM `admin`";
        $select_all_admin = mysqli_query($connection,$query);
        $admin_count = mysqli_fetch_assoc($select_all_admin);
        ?>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Admin</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $admin_count['numAdmin']?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

        <?php 
        $query = "SELECT COUNT(mahasiswa_id) AS numMahasiswa FROM `mahasiswa`";
        $select_all_mahasiswa = mysqli_query($connection,$query);
        $mahasiswa_count = mysqli_fetch_assoc($select_all_mahasiswa);
        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Mahasiswa</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mahasiswa_count['numMahasiswa'] ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comments -->
        <?php 
        $query = "SELECT COUNT(dosen_id) AS numDosen FROM `dosen`";
        $select_all_dosen = mysqli_query($connection,$query);
        $dosen_count = mysqli_fetch_assoc($select_all_dosen);
        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Dosen</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $dosen_count['numDosen'] ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories -->

        <?php 
        $query = "SELECT COUNT(jurusan_id) AS numJurusan FROM `jurusan`";
        $select_all_jurusan = mysqli_query($connection,$query);
        $jurusan_count = mysqli_fetch_assoc($select_all_jurusan);
        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Jurusan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jurusan_count['numJurusan'] ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bars fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Content Row -->
            </div>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tahun Ajaran</h1>
            </div>
            <div class="row m-4">
            <input type="submit" name="add_tahun_ajaran" class="btn btn-success ml-4" value="Apply">
            <input type="submit" name="edit_tahun_ajaran" class="btn btn-success ml-4" value="Apply">
            <form action="" method="post">
        <p style="display: inline;">Select Tahun Ajaran: </p>
        <select name="jurusan_id" id="">
            <?php 
                $query = "SELECT * FROM tahun_ajaran";
                $list_tahun_ajaran = mysqli_query($connection,$query);
                confirm($list_tahun_ajaran);
                while ($row = mysqli_fetch_assoc($list_tahun_ajaran) ) {
                    $tahun_ajaran_id = $row['tahun_ajaran_id'];
                    $tahun_ajaran_ke = $row['tahun_ajaran_nama'];?>
                <option value="<?php echo $tahun_ajaran_id ?>"><?php echo $tahun_ajaran_ke ?></option>
                <?php }
            ?>
        </select>
        <input type="submit" name="submit" class="btn btn-success ml-4" value="Apply">
        </form>
        </div>
        <div class="row m-4">
        <?php 
            if (isset($_POST['submit'])) {
                $query = "SELECT * FROM tahun_ajaran";
                $list_tahun_ajaran = mysqli_query($connection,$query);
                confirm($list_tahun_ajaran);
                while ($row = mysqli_fetch_assoc($list_tahun_ajaran) ) {
                    $tahun_ajaran_id = $row['tahun_ajaran_id'];
                    $tahun_ajaran_ke = $row['tahun_ajaran_nama'];
                    $tahun_ajaran_mulai = $row['tahun_ajaran_mulai'];
                    $tahun_ajaran_berakhir = $row['tahun_ajaran_berakhir'];
                }
            
            ?>
            <div class="form-group">
                <label for="tahun_ajaran_mulai">Mulai Tahun Ajaran</label>
                <input type="date" class="form-control" id="tahun_ajaran_mulai" name="tahun_ajaran_mulai" value="<?php echo $tahun_ajaran_mulai ?>">
            </div>

            <div class="form-group" style="margin-left: 5px;">
                <label for="dosen_nidn">Berakhir Tahun Ajaran</label>
                <input type="date" class="form-control" name="tahun_ajaran_berakhir" value="<?php echo $tahun_ajaran_berakhir ?>">
            </div>
            <input type="submit2" name="submit" class="btn btn-success ml-4" value="Apply">
            </div>

        <?php }
        ?>


            </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
        <?php 
        include 'includes/admin_copyright.php';         
        ?>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include 'includes/logout_modal.php';?>
    
    <?php include 'includes/admin_footer.php'; ?>