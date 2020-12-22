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
                        <h1 class="h3 mb-0 text-gray-800">Users</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <!-- <div class="col-lg-6 mb-4"> -->
                        <?php 
                        
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            }else {
                                $source = '';
                            }

                            switch ($source) {
                                case 'add_user':
                                    include 'includes/add_user.php';
                                    break;
                                case 'edit_user':
                                    include 'includes/edit_user.php';
                                    break;                                
                                default:
                                    include 'includes/view_all_user.php';
                                    break;
                            }
                    
                    
                    
                        ?>

                        <!-- </div> -->
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