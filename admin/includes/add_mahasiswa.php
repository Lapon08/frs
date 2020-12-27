
                        
                        <?php 
                        // fungsi menambahkan post
                            if (isset($_POST['add_mahasiswa'])) {
                                if (!empty($_POST['mahasiswa_nama']) && !empty($_POST['mahasiswa_nrp']) &&
                                !empty($_POST['mahasiswa_alamat']) && !empty($_POST['mahasiswa_hp']) && !empty($_POST['jurusan_id']) && 
                                !empty($_POST['mahasiswa_angkatan']) && !empty($_POST['dosen_id']))
                                {
                                $mahasiswa_nama = $_POST['mahasiswa_nama'];
                                $mahasiswa_nrp = $_POST['mahasiswa_nrp'];
                                $mahasiswa_alamat = $_POST['mahasiswa_alamat'];
                                $mahasiswa_hp = $_POST['mahasiswa_hp'];
                                $mahasiswa_angkatan = $_POST['mahasiswa_angkatan'];
                                $dosen_id = $_POST['dosen_id'];
                                $jurusan_id = $_POST['jurusan_id'];

                                $mahasiswa_password = password_hash($mahasiswa_nrp,PASSWORD_DEFAULT);
                                $mahasiswa_nama = mysqli_real_escape_string($connection,$mahasiswa_nama);
                                $mahasiswa_nrp = mysqli_real_escape_string($connection,$mahasiswa_nrp);
                                $mahasiswa_alamat = mysqli_real_escape_string($connection,$mahasiswa_alamat);
                                $mahasiswa_hp = mysqli_real_escape_string($connection,$mahasiswa_hp);
                                $jurusan_id = mysqli_real_escape_string($connection,$jurusan_id);
                                $dosen_id = mysqli_real_escape_string($connection,$dosen_id);
                                $query="SELECT * FROM mahasiswa WHERE mahasiswa_nrp = '$mahasiswa_nrp'";
                                $check_mahasiswa = mysqli_query($connection,$query);
                                $count = mysqli_num_rows($check_mahasiswa);
                                if (!$count) {
                                    
                                    // tambah mahasiswa
                                $query = "INSERT INTO `mahasiswa`( `mahasiswa_nrp`, `mahasiswa_nama`, `mahasiswa_angkatan`, `mahasiswa_alamat`, `mahasiswa_password`, `mahasiswa_hp`, `dosen_id`, `jurusan_id`) 
                                VALUES ('$mahasiswa_nrp','$mahasiswa_nama','$mahasiswa_angkatan','$mahasiswa_alamat','$mahasiswa_password','$mahasiswa_hp','$dosen_id','$jurusan_id')";
                            
                                $add_mahasiswa = mysqli_query($connection,$query);
                                confirm($add_mahasiswa);
                                ?>
                                
                                <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                                Mahasiswa Added:
                                <a href="mahasiswa.php"  class="alert-link">View All Mahasiswa</a>
                                </div>        
                            <?php }else {?>
                                <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                                    nidn already used
                                </div>  
                            <?php }
                            }
                                else { ?>
                                    <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                                    This Form cannot empty
                                    </div>  
                                <?php }
                            } ?>

                        <!-- Menampilkan seluruh post yang ada -->
                        <div class="col-lg-12">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="mahasiswa_nama">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" name="mahasiswa_nama">
                                </div>
                                <div class="form-group">
                                    <label for="mahasiswa_nrp">NRP Mahasiswa</label>
                                    <input type="text" class="form-control" name="mahasiswa_nrp">
                                </div>
                                <div class="form-group">
                                    <label for="mahasiswa_alamat">Alamat Mahasiswa</label>
                                    <input type="text" class="form-control" name="mahasiswa_alamat">
                                </div>
                                <div class="form-group">
                                    <label for="mahasiswa_hp">HP Mahasiswa</label>
                                    <input type="text" class="form-control" name="mahasiswa_hp">
                                </div>
                                <label for="">Angkatan Mahasiswa</label>
                                <div class="form-group">
                                    <input type="number" id="quantity" min="2010" max="2035" name="mahasiswa_angkatan">
                                </div>

                                <label for="jurusan_mahasiswa">Jurusan Mahasiswa</label>
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

                                <label for="jurusan_mahasiswa">Dosen Pembimbing</label>
                                <div class="form-group">
                                <select name="dosen_id" id="jurusan_mahasiswa">
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
                                    <input class="btn btn-primary" type="submit" name="add_mahasiswa" value="Add Mahasiswa">
                                </div>
                            </form>
                        </div>
