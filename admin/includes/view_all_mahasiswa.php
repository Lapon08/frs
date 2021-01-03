
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
        <a href="mahasiswa.php?source=add_mahasiswa" class="btn btn-primary">Add New Mahasiswa</a>
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
                                        <th style="display:none;">Mahasiswa Id</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Mahasiswa NRP</th>
                                        <th>Mahasiswa Alamat</th>
                                        <th>Mahasiswa HP</th>
                                        <th>Mahasiswa Angkatan</th>
                                        <th>Jurusan Mahasiswa</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $jurusan_id_filter = $_POST['jurusan_id'];
                                        $query = "CALL select_mahasiswa_by_jurusan($jurusan_id_filter)";
                                    }else {                                        
                                        $query = "SELECT * FROM mahasiswa LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.jurusan_id LEFT JOIN dosen ON mahasiswa.dosen_id = dosen.dosen_id  ORDER BY mahasiswa.mahasiswa_id DESC";
                                    }$select_mahasiswa = mysqli_query($connection,$query);
                                        $no = 1; //nomor
                                        while($row = mysqli_fetch_assoc($select_mahasiswa)):
                                            $mahasiswa_id = $row['mahasiswa_id'];
                                            $mahasiswa_nama = $row['mahasiswa_nama'];
                                            $mahasiswa_nrp = $row['mahasiswa_nrp'];
                                            $mahasiswa_hp = $row['mahasiswa_hp'];
                                            $mahasiswa_alamat = $row['mahasiswa_alamat'];
                                            $mahasiswa_angkatan = $row['mahasiswa_angkatan'];
                                            $jurusan_nama = $row['jurusan_nama'];
                                            $dosen_nama = $row['dosen_nama'];
                                    ?>

                                    <tr>
                                        
                                        <td><?php echo $no; ?> </td>
                                        <td class="mahasiswa_id" style="display:none;"><?php echo $mahasiswa_id; ?> </td>
                                        <td><?php echo $mahasiswa_nama ?></td>
                                        <td><?php echo $mahasiswa_nrp ?></td>
                                        <td><?php echo $mahasiswa_alamat ?></td>
                                        <td><?php echo $mahasiswa_hp ?></td>
                                        <td><?php echo $mahasiswa_angkatan ?></td>
                                        <td><?php echo $jurusan_nama ?></td>
                                        <td><?php echo $dosen_nama ?></td>
                                        <td><a href="mahasiswa.php?source=edit_mahasiswa&mahasiswa_id=<?php echo $mahasiswa_id ?>" class="badge badge-primary" style="padding: 10px;">Edit</a></td>
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
                                            <input type="hidden" name="mahasiswa_id" id="delete_id">
                                            do you want to delete this Mahasiswa?
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

                                $mahasiswa_id = $_POST['mahasiswa_id'];
                                $mahasiswa_id = mysqli_real_escape_string($connection,$mahasiswa_id);
                                $query = "DELETE FROM mahasiswa WHERE mahasiswa_id = $mahasiswa_id";
                                $delete_query = mysqli_query($connection,$query);
                                if (!$delete_query) {
                                    confirm($delete_query);
                                }
                                $query = "DELETE FROM mahasiswa WHERE mahasiswa_id = ' $mahasiswa_id'";
                                $delete_mahasiswa = mysqli_query($connection,$query);
                                confirm($delete_mahasiswa);
                                header("Location: mahasiswa.php");
                            } 
                    
                        ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('.delete_btn').click(function(e){

                e.preventDefault();
                var stu_id = $(this).closest('tr').find('.mahasiswa_id').text();
                //console.log(stu_id);
                $('#delete_id').val(stu_id);
                $('#deleteStudentModal').modal('show');

            });



        });
    </script>
    