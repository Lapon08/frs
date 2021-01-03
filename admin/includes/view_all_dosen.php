
<div class="col-lg-12">


<div  style="margin-top:15px; margin-bottom:20px">
<form action="" method="post">
        <p style="display: inline;">Select Jurusan: </p>
        <select name="jurusan_id" id="">
            <?php 
                $query = "SELECT * FROM jurusan";
                $list_jurusan = mysqli_query($connection,$query);
                confirm($list_jurusan);
                while ($row = mysqli_fetch_assoc($list_jurusan) ) {
                    $jurusan_id = $row['jurusan_id'];
                    $jurusan_nama = $row['jurusan_nama'];?>
                <option value="<?php echo $jurusan_id ?>"><?php echo $jurusan_nama ?></option>
                <?php }
            ?>
        </select>
        <input type="submit" name="submit" class="btn btn-success ml-4" value="Apply">
        </form>
</div>
<div  style="margin-top:15px; margin-bottom:20px">
        
        <a href="dosen.php?source=add_dosen" class="btn btn-primary">Add New dosen</a>
</div>

    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">dosen</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="display:none;">Dosen Id</th>
                                        <th>Nama Dosen</th>
                                        <th>NIDN Dosen</th>
                                        <th>Alamat Dosen</th>
                                        <th>HP Dosen</th>
                                        <th>Jurusan Dosen</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <?php 
                                    if (isset($_POST['submit'])) {
                                        $jurusan_id_filter = $_POST['jurusan_id'];
                                        $query = "CALL select_dosen_by_jurusan($jurusan_id_filter)";
                                    }else {
                                        $query = "SELECT * FROM dosen LEFT JOIN jurusan ON dosen.jurusan_id = jurusan.jurusan_id ORDER BY dosen_id DESC";
                                    }
                                        
                                        $select_dosen = mysqli_query($connection,$query);
                                        $no = 1; //nomor
                                        while($row = mysqli_fetch_assoc($select_dosen)):
                                            
                                            $dosen_id = $row['dosen_id'];
                                            $dosen_nama = $row['dosen_nama'];
                                            $dosen_alamat = $row['dosen_alamat'];
                                            $dosen_hp = $row['dosen_hp'];
                                            $dosen_nidn = $row['dosen_nidn'];
                                            $jurusan_id = $row['jurusan_id'];
                                            $jurusan_nama = $row['jurusan_nama'];
                                            
                                    ?>

                                    <tr>
                                        
                                        <td><?php echo $no; ?> </td>
                                        <td class="dosen_id" style="display:none;"><?php echo $dosen_id; ?> </td>
                                        <td><?php echo $dosen_nama ?></td>
                                        <td><?php echo $dosen_nidn ?></td>
                                        <td><?php echo $dosen_alamat ?></td>
                                        <td><?php echo $dosen_hp ?></td>
                                        <td><?php echo $jurusan_nama ?></td>
                                        <td><a href="dosen.php?source=edit_dosen&dosen_id=<?php echo $dosen_id ?>" class="badge badge-primary" style="padding: 10px;">Edit</a></td>
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
                                            <input type="hidden" name="dosen_id" id="delete_id">
                                            do you want to delete this Dosen?
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

                                $dosen_id = $_POST['dosen_id'];
                                $dosen_id = mysqli_real_escape_string($connection,$dosen_id);
                                $query = "DELETE FROM dosen WHERE dosen_id = $dosen_id";
                                $delete_query = mysqli_query($connection,$query);

                                confirm($delete_query);
                                header("Location: dosen.php");
                            } 
                    
                        ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('.delete_btn').click(function(e){

                e.preventDefault();
                var stu_id = $(this).closest('tr').find('.dosen_id').text();
                //console.log(stu_id);
                $('#delete_id').val(stu_id);
                $('#deleteStudentModal').modal('show');

            });



        });
    </script>
    