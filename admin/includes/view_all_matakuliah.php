
<div class="col-lg-12">



<div  style="margin-top:15px; margin-bottom:20px">
        <a href="matakuliah.php?source=add_matakuliah" class="btn btn-primary">Add New Matakuliah</a>
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
                                        <th style="display:none;">Matakuliah Id</th>
                                        <th>Nama Matakuliah</th>
                                        <th>SKS Matakuliah</th>
                                        <th>Semester Matakuliah</th>
                                        <th>Kode Matakuliah</th>
                                        <th>Jurusan Matakuliah</th>
                                        <th>Dosen Matakuliah</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <?php 
                                        $query = "SELECT * FROM mata_kuliah LEFT JOIN jurusan ON mata_kuliah.jurusan_id = jurusan.jurusan_id LEFT JOIN dosen ON mata_kuliah.dosen_id = dosen.dosen_id  ORDER BY mata_kuliah.mk_id DESC";
                                        $select_mata_kuliah = mysqli_query($connection,$query);
                                        $no = 1; //nomor
                                        while($row = mysqli_fetch_assoc($select_mata_kuliah)):
                                            $mata_kuliah_id = $row['mk_id'];
                                            $mata_kuliah_nama = $row['mk_nama'];
                                            $mata_kuliah_sks = $row['mk_sks'];
                                            $mata_kuliah_semester = $row['mk_semester'];
                                            $mata_kuliah_kode = $row['mk_kode'];
                                            $jurusan_nama = $row['jurusan_nama'];
                                            $dosen_nama = $row['dosen_nama'];
                                    ?>

                                    <tr>
                                        
                                        <td><?php echo $no; ?> </td>
                                        <td class="mata_kuliah_id" style="display:none;"><?php echo $mata_kuliah_id; ?> </td>
                                        <td><?php echo $mata_kuliah_nama ?></td>
                                        <td><?php echo $mata_kuliah_sks ?></td>
                                        
                                        <td><?php echo $mata_kuliah_semester ?></td>
                                        <td><?php echo $mata_kuliah_kode ?></td>
                                        <td><?php echo $jurusan_nama ?></td>
                                        <td><?php echo $dosen_nama ?></td>
                                        <td><a href="matakuliah.php?source=edit_matakuliah&mk_id=<?php echo $mata_kuliah_id ?>" class="badge badge-primary" style="padding: 10px;">Edit</a></td>
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
                                            <input type="hidden" name="mata_kuliah_id" id="delete_id">
                                            do you want to delete this Matakuliah?
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

                                $mata_kuliah_id = $_POST['mata_kuliah_id'];
                                $mata_kuliah_id = mysqli_real_escape_string($connection,$mata_kuliah_id);
                                $query = "DELETE FROM mata_kuliah WHERE mk_id = $mata_kuliah_id";
                                $delete_query = mysqli_query($connection,$query);
                                if (!$delete_query) {
                                    confirm($delete_query);
                                }
                                header("Location: matakuliah.php");
                            } 
                    
                        ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('.delete_btn').click(function(e){

                e.preventDefault();
                var stu_id = $(this).closest('tr').find('.mata_kuliah_id').text();
                //console.log(stu_id);
                $('#delete_id').val(stu_id);
                $('#deleteStudentModal').modal('show');

            });



        });
    </script>
    