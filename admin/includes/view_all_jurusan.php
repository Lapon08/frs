
<div class="col-lg-12">



<div  style="margin-top:15px; margin-bottom:20px">
        <a href="jurusan.php?source=add_jurusan" class="btn btn-primary">Add New Jurusan</a>
</div>

    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Jurusan</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="display:none;">Jurusan Id</th>
                                        <th>Nama Jurusan</th>
                                        <th>Kode Jurusan</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <?php 
                                        $query = "SELECT * FROM jurusan ORDER BY jurusan_id DESC";
                                        $select_jurusan = mysqli_query($connection,$query);
                                        $no = 1; //nomor
                                        while($row = mysqli_fetch_assoc($select_jurusan)):
                                            
                                            $jurusan_id = $row['jurusan_id'];
                                            $jurusan_nama = $row['jurusan_nama'];
                                            $jurusan_kode = $row['jurusan_kode'];
                                    ?>

                                    <tr>
                                        
                                        <td><?php echo $no; ?> </td>
                                        <td class="jurusan_id" style="display:none;"><?php echo $jurusan_id; ?> </td>
                                        <td><?php echo $jurusan_nama ?></td>
                                        <td><?php echo $jurusan_kode ?></td>
                                        <td><a href="jurusan.php?source=edit_jurusan&jurusan_id=<?php echo $jurusan_id ?>" class="badge badge-primary" style="padding: 10px;">Edit</a></td>
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
                                            <input type="hidden" name="jurusan_id" id="delete_id">
                                            do you want to delete this Post?
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

                                $jurusan_id = $_POST['jurusan_id'];
                                $jurusan_id = mysqli_real_escape_string($connection,$jurusan_id);
                                $query = "DELETE FROM jurusan WHERE jurusan_id = $jurusan_id";
                                $delete_query = mysqli_query($connection,$query);
                                if (!$delete_query) {
                                    confirm($delete_query);
                                }
                                $query = "DELETE FROM jurusan WHERE jurusan_id = ' $jurusan_id'";
                                $delete_jurusan = mysqli_query($connection,$query);
                                confirm($delete_jurusan);
                                header("Location: jurusan.php");
                            } 
                    
                        ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('.delete_btn').click(function(e){

                e.preventDefault();
                var stu_id = $(this).closest('tr').find('.jurusan_id').text();
                //console.log(stu_id);
                $('#delete_id').val(stu_id);
                $('#deleteStudentModal').modal('show');

            });



        });
    </script>
    