<?php 
                if(isset($_GET['mahasiswa_id'])){
                    $the_mahasiswa_id = $_GET['mahasiswa_id'];
                    

                }
                // menampilkan isi post yang akan diedit
                $query = "SELECT * FROM mahasiswa LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.jurusan_id LEFT JOIN dosen ON mahasiswa.dosen_id = dosen.dosen_id WHERE mahasiswa_id = '$the_mahasiswa_id'";
                $select_mahasiswa_by_id = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_mahasiswa_by_id)):
                    $mahasiswa_id = $row['mahasiswa_id'];
                    $mahasiswa_nama = $row['mahasiswa_nama'];
                    $mahasiswa_nrp = $row['mahasiswa_nrp'];
                    $mahasiswa_hp = $row['mahasiswa_hp'];
                    $mahasiswa_alamat = $row['mahasiswa_alamat'];
                    $mahasiswa_angkatan = $row['mahasiswa_angkatan'];
                    $jurusan_nama_db = $row['jurusan_nama'];
                    $dosen_nama_db = $row['dosen_nama'];
                endwhile; ?>

        <?php 
            if (isset($_POST['edit_mahasiswa'])) {
                // Mengedit post
                if (!empty($_POST['mahasiswa_nama']) && !empty($_POST['mahasiswa_nrp'])&& !empty($_POST['mahasiswa_alamat'])&& !empty($_POST['mahasiswa_hp'])
                && !empty($_POST['mahasiswa_angkatan'])&& !empty($_POST['dosen_id'])&& !empty($_POST['jurusan_id'])) 
                {

                    $mahasiswa_nama = $_POST['mahasiswa_nama'];
                    $mahasiswa_nrp = $_POST['mahasiswa_nrp'];
                    $mahasiswa_alamat = $_POST['mahasiswa_alamat'];
                    $mahasiswa_hp = $_POST['mahasiswa_hp'];
                    $mahasiswa_angkatan = $_POST['mahasiswa_angkatan'];
                    $dosen_id = $_POST['dosen_id'];
                    $jurusan_id = $_POST['jurusan_id'];

                $query = "UPDATE `mahasiswa` SET `mahasiswa_nrp`='$mahasiswa_nrp',`mahasiswa_nama`='$mahasiswa_nama',
                `mahasiswa_angkatan`='$mahasiswa_angkatan',`mahasiswa_alamat`='$mahasiswa_alamat',`mahasiswa_hp`='$mahasiswa_hp',
                `dosen_id`='$dosen_id',`jurusan_id`='$jurusan_id' WHERE mahasiswa_id = '$the_mahasiswa_id'";
                $query_edit_mahasiswa = mysqli_query($connection,$query);
                confirm($query_edit_mahasiswa);
                ?>
                    <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                    mahasiswa Updated:
                    <a href="mahasiswa.php"  class="alert-link">View All mahasiswa</a>
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
                                    <label for="mahasiswa_nama">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" name="mahasiswa_nama" value="<?php echo $mahasiswa_nama ?>">
                                </div>
                                <div class="form-group">
                                    <label for="mahasiswa_nrp">NRP Mahasiswa</label>
                                    <input type="text" class="form-control" name="mahasiswa_nrp" value="<?php echo $mahasiswa_nrp?>">
                                </div>
                                <div class="form-group">
                                    <label for="mahasiswa_alamat">Alamat Mahasiswa</label>
                                    <input type="text" class="form-control" name="mahasiswa_alamat" value="<?php echo $mahasiswa_alamat?>">
                                </div>
                                <div class="form-group">
                                    <label for="mahasiswa_hp">HP Mahasiswa</label>
                                    <input type="text" class="form-control" name="mahasiswa_hp" value="<?php echo $mahasiswa_hp ?>">
                                </div>
                                <label for="">Angkatan Mahasiswa</label>
                                <div class="form-group">
                                    <input type="number" id="quantity" min="2010" max="2035" name="mahasiswa_angkatan" value="<?php echo $mahasiswa_angkatan ?>">
                                </div>

                                <label for="jurusan_mahasiswa">Jurusan Mahasiswa</label>
                                <div class="form-group">
                                <select name="jurusan_id" id="jurusan_mahasiswa">
                                
                                <?php 
                                    $query = "SELECT * FROM `jurusan`";
                                    $select_jurusan = mysqli_query($connection,$query);
                                    while ($row = mysqli_fetch_assoc($select_jurusan)) {
                                        $jurusan_id = $row['jurusan_id'];
                                        $jurusan_nama = $row['jurusan_nama']; 
                                        if ($jurusan_nama_db == $jurusan_nama) { ?>
                                            <option value="<?php echo $jurusan_id ?>" selected > <?php echo $jurusan_nama?> </option>
                                        <?php }else {
                                        ?>
                                        <option value="<?php echo $jurusan_id ?>"  > <?php echo $jurusan_nama?> </option>
                                    
                                    <?php } }                               
                                ?>
                                </select>
                                </div>

                                <label for="dosen">Dosen Pembimbing</label>
                                <div class="form-group">
                                <select name="dosen_id" id="dosen">
                                <?php 
                                    $query = "SELECT * FROM `dosen`";
                                    $select_dosen = mysqli_query($connection,$query);
                                    while ($row = mysqli_fetch_assoc($select_dosen)) {
                                        $dosen_id = $row['dosen_id'];
                                        $dosen_nama = $row['dosen_nama']; 
                                        if ($dosen_nama == $dosen_nama_db) { ?>
                                            <option value="<?php echo $dosen_id ?>" selected > <?php echo $dosen_nama?> </option>
                                        <?php }else {
                                        ?>
                                        <option value="<?php echo $dosen_id ?>" > <?php echo $dosen_nama?> </option>
                                    <?php }}                                
                                ?>
                                </select>
                                </div>


                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="edit_mahasiswa" value="Edit Mahasiswa">
                                </div>
                            </form>
                        </div>