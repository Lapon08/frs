<?php 
                if(isset($_GET['mk_id'])){
                    $the_mk_id = $_GET['mk_id'];
                    

                }
                // menampilkan isi post yang akan diedit
                $query = "SELECT * FROM mata_kuliah LEFT JOIN jurusan ON mata_kuliah.jurusan_id = jurusan.jurusan_id LEFT JOIN dosen ON mata_kuliah.dosen_id = dosen.dosen_id WHERE mk_id = '$the_mk_id'";
                $select_matakuliah = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_matakuliah)):
                    $mk_sks = $row['mk_sks'];
                    $mk_semester = $row['mk_semester'];
                    $mk_kode = $row['mk_kode'];
                    $mk_nama = $row['mk_nama'];
                    $dosen_id = $row['dosen_id'];
                    $jurusan_id = $row['jurusan_id'];
                endwhile; ?>

        <?php 
            if (isset($_POST['edit_mahasiswa'])) {
                // Mengedit post
                if (!empty($_POST['mk_nama']) && !empty($_POST['mk_kode'])&& !empty($_POST['mk_sks'])&& !empty($_POST['mk_semester'])
                && !empty($_POST['dosen_id'])&& !empty($_POST['jurusan_id'])) 
                {

                    $mk_nama = $_POST['mk_nama'];
                    $mk_kode = $_POST['mk_kode'];
                    $mk_sks = $_POST['mk_sks'];
                    $mk_semester = $_POST['mk_semester'];
                    $dosen_id = $_POST['dosen_id'];
                    $jurusan_id = $_POST['jurusan_id'];

                $query = "UPDATE `mata_kuliah` SET `mk_kode`='$mk_kode',`mk_nama`='$mk_nama',
                `mk_sks`='$mk_sks',`mk_semester`='$mk_semester',`dosen_id`='$dosen_id',`jurusan_id`='$jurusan_id' WHERE mk_id = '$the_mk_id'";
                $query_edit_mahasiswa = mysqli_query($connection,$query);
                confirm($query_edit_mahasiswa);
                ?>
                    <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                    Matakuliah Updated:
                    <a href="matakuliah.php"  class="alert-link">View All Matakuliah</a>
                    </div>
                <?php }
                    else { ?>
                        <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                        This Form cannot empty
                        </div>  
                    <?php }
            } ?> 
        
        
        


        <div class="col-lg-12">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="mk_nama">Nama Matakuliah</label>
                                    <input type="text" class="form-control" name="mk_nama" value="<?php echo $mk_nama ?>">
                                </div>
                                <div class="form-group">
                                    <label for="mk_kode">Kode Matakuliah</label>
                                    <input type="text" class="form-control" name="mk_kode" value="<?php echo $mk_kode?>">
                                </div>
                                <div class="form-group">
                                    <label for="mk_sks">SKS Matakuliah</label>
                                    <input type="text" class="form-control" name="mk_sks" value="<?php echo $mk_sks?>">
                                </div>
                                <div class="form-group">
                                    <label for="mk_semester">Semester Matakuliah</label>
                                    <input type="text" class="form-control" name="mk_semester" value="<?php echo $mk_semester ?>">
                                </div>

                                <label for="jurusan_mahasiswa">Jurusan Matakuliah</label>
                                <div class="form-group">
                                <select name="jurusan_id" id="jurusan_mahasiswa">
                                
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

                                <label for="dosen">Dosen Matakuliah</label>
                                <div class="form-group">
                                <select name="dosen_id" id="dosen">
                                <?php 
                                    $query = "SELECT * FROM `dosen`";
                                    $select_dosen = mysqli_query($connection,$query);
                                    while ($row = mysqli_fetch_assoc($select_dosen)) {
                                        $dosen_id = $row['dosen_id'];
                                        $dosen_nama = $row['dosen_nama']; ?>
                                        <option value="<?php echo $dosen_id ?>" > <?php echo $dosen_nama?> </option>
                                    
                                    <?php }                                
                                ?>
                                </select>
                                </div>


                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="edit_mahasiswa" value="Edit Matakuliah">
                                </div>
                            </form>
                        </div>