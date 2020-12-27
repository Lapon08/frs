
                                                <?php 
                        // fungsi menambahkan post
                            if (isset($_POST['add_jadwal'])) {
                                if (!empty($_POST['kelas_hari']) && !empty($_POST['kelas_jam']) &&
                                !empty($_POST['kode_ruangan']) && !empty($_POST['dosen_id']) && !empty($_POST['mk_id']))
                                {
                                $kelas_hari = $_POST['kelas_hari'];
                                $kelas_jam = $_POST['kelas_jam'];
                                $kode_ruangan = $_POST['kode_ruangan'];
                                $dosen_id = $_POST['dosen_id'];
                                $mk_id = $_POST['mk_id'];

                                $kelas_hari = mysqli_real_escape_string($connection,$kelas_hari);
                                $kelas_jam = mysqli_real_escape_string($connection,$kelas_jam);
                                $kode_ruangan = mysqli_real_escape_string($connection,$kode_ruangan);
                                $dosen_id = mysqli_real_escape_string($connection,$dosen_id);
                                $mk_id = mysqli_real_escape_string($connection,$mk_id);

                                    
                                

                                    // tambah post
                                $query = "INSERT INTO `jadwal`(`kelas_hari`, `kelas_jam`, `dosen_id`, `kode_ruangan`, `mk_id`) 
                                VALUES ('$kelas_hari','$kelas_jam','$dosen_id','$kode_ruangan','$mk_id')";
                            
                                $add_jadwal = mysqli_query($connection,$query);
                                confirm($add_jadwal);
                                ?>
                                
                                <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                                Jadwal Added:
                                <a href="dosen.php"  class="alert-link">View All Jadwal</a>
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
                            <label for="jurusan_dosen">Hari Matakuliah</label>
                                <div class="form-group">
                                <select name="jurusan_id" id="jurusan_dosen">
                                    <option value="senin">senin</option>
                                    <option value="selasa">selasa</option>
                                    <option value="rabu">rabu</option>
                                    <option value="kamis">kamis</option>
                                    <option value="jumat">jumat</option>
                                    <option value="sabtu">sabtu</option>
                                    

                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_jam">Jam Matakuliah</label>
                                    <input type="text" class="form-control" name="kelas_jam">
                                </div>
                                <div class="form-group">
                                    <label for="kode_ruangan">Kode Ruangan</label>
                                    <input type="text" class="form-control" name="kode_ruangan">
                                </div>

                                <label for="jurusan_dosen">Dosen Matakuliah</label>
                                <div class="form-group">
                                <select name="dosen_id" id="jurusan_dosen">
                                
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

                                <label for="matakuliah">Matakuliah</label>
                                <div class="form-group">
                                <select name="mk_id" id="matakuliah">
                                
                                <?php 
                                    $query = "SELECT * FROM `mata_kuliah`";
                                    $mata_kuliah = mysqli_query($connection,$query);
                                    while ($row = mysqli_fetch_assoc($mata_kuliah)) {
                                        $mk_id = $row['mk_id'];
                                        $mk_nama = $row['mk_nama']; ?>
                                        <option value="<?php echo $mk_id ?>"  > <?php echo $mk_nama?> </option>
                                    
                                    <?php }                                
                                ?>
                                </select>
                                </div>


                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add_jadwal" value="Add Dosen">
                                </div>
                            </form>
                        </div>
