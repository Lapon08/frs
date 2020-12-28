
<div class="col-lg-12">



<div  style="margin-top:15px; margin-bottom:20px">
        <a href="admin.php?source=add_admin" class="btn btn-primary">Add New Admin</a>
</div>

    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Admin</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="display:none;">Admin Id</th>
                                        <th>Nama Admin</th>
                                        <th>Email Admin</th>
                                        <th>Alamat Admin</th>
                                        <th>Delete</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <?php 
                                        $query = "SELECT * FROM `admin` ORDER BY admin_id DESC";
                                        $select_admin = mysqli_query($connection,$query);
                                        $no = 1; //nomor
                                        while($row = mysqli_fetch_assoc($select_admin)):
                                            
                                            $admin_id = $row['admin_id'];
                                            $admin_nama = $row['admin_nama'];
                                            $admin_email = $row['admin_email'];
                                            $admin_alamat = $row['admin_alamat'];
                                    ?>

                                    <tr>
                                        
                                        <td><?php echo $no; ?> </td>
                                        <td class="admin_id" style="display:none;"><?php echo $admin_id; ?> </td>
                                        <td><?php echo $admin_nama ?></td>
                                        <td><?php echo $admin_email ?></td>
                                        <td><?php echo $admin_alamat ?></td>
                                        <td><a href="" class="badge badge-danger delete_btn" style="padding: 10px;">Delete</a></td>
                                    </tr>
                                    
                                        <?php $no++; endwhile; ?>
                                </tbody>

                                <!-- Modal -->
                            <div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteStudentModalLabel">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                            <input type="hidden" name="admin_id" id="delete_id">
                                            do you want to delete this Admin?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <button type="submit" name="delete" class="btn btn-danger">Yes</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                </table>
                            </div>

    </div>
</div>
                        <?php 
                        
                            if (isset($_POST['delete'])) {

                                $admin_id = $_POST['admin_id'];
                                $admin_id = mysqli_real_escape_string($connection,$admin_id);
                                $query = "DELETE FROM `admin` WHERE admin_id = $admin_id";
                                $delete_query = mysqli_query($connection,$query);
                                if (!$delete_query) {
                                    confirm($delete_query);
                                }
                            } 
                    
                        ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('.delete_btn').click(function(e){

                e.preventDefault();
                var stu_id = $(this).closest('tr').find('.admin_id').text();
                //console.log(stu_id);
                $('#delete_id').val(stu_id);
                $('#deleteStudentModal').modal('show');

            });



        });
    </script>
    