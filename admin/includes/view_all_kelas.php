
<div class="col-lg-12">



<div  style="margin-top:15px; margin-bottom:20px">
        <a href="kelas.php?source=add_kelas" class="btn btn-primary">Add New Kelas</a>
</div>

    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Kelas</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="display:none;">Kelas Id</th>
                                        <th>Hari Matakuliah</th>
                                        <th>Jam Matakuliah</th>
                                        <th>Kode Ruangan</th>
                                        <th>Dosen Matakuliah</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <?php 
                                        $query = "SELECT * FROM kelas LEFT JOIN dosen ON kelas.dosen_id = dosen.dosen_id LEFT JOIN mata_kuliah ON mata_kuliah.mk_id = kelas.mk_id  ORDER BY kelas.kelas_id DESC";
                                        $select_kelas = mysqli_query($connection,$query);
                                        confirm($select_kelas);
                                        $no = 1; //nomor
                                        while($row = mysqli_fetch_assoc($select_kelas)):
                                            $kelas_hari = $row['kelas_hari'];
                                            $kelas_id = $row['kelas_id'];
                                            $kelas_jam = $row['kelas_jam'];
                                            $kode_ruangan = $row['kode_ruangan'];
                                            $dosen_id = $row['dosen_id'];
                                            $dosen_nama = $row['dosen_nama'];
                                            $mk_id = $row['mk_id'];
                                            $mk_nama = $row['mk_nama'];
                                    ?>

                                    <tr>
                                        
                                        <td><?php echo $no; ?> </td>
                                        <td class="kelas_id" style="display:none;"><?php echo $kelas_id; ?> </td>
                                        <td><?php echo $kelas_hari ?></td>
                                        <td><?php echo $kelas_jam ?></td>
                                        <td><?php echo $kode_ruangan ?></td>
                                        <td><?php echo $dosen_nama ?></td>
                                        <td><a href="kelas.php?source=edit_kelas&kelas_id=<?php echo $kelas_id ?>" class="badge badge-primary" style="padding: 10px;">Edit</a></td>
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
                                            <input type="hidden" name="kelas_id" id="delete_id">
                                            do you want to delete this kelas?
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

                                $kelas_id = $_POST['kelas_id'];
                                $kelas_id = mysqli_real_escape_string($connection,$kelas_id);
                                $query = "DELETE FROM kelas WHERE kelas_id = $kelas_id";
                                $delete_query = mysqli_query($connection,$query);
                                if (!$delete_query) {
                                    confirm($delete_query);
                                }
                                header("Location: kelas.php");
                            } 
                    
                        ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('.delete_btn').click(function(e){

                e.preventDefault();
                var stu_id = $(this).closest('tr').find('.kelas_id').text();
                //console.log(stu_id);
                $('#delete_id').val(stu_id);
                $('#deleteStudentModal').modal('show');

            });



        });
    </script>
    