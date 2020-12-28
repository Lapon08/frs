<?php 
                if(isset($_GET['kelas_id'])){
                    $the_kelas_id = $_GET['kelas_id'];
                    

                }
                // menampilkan isi post yang akan diedit
                $query = "SELECT * FROM kelas LEFT JOIN dosen ON kelas.dosen_id = dosen.dosen_id LEFT JOIN mata_kuliah ON mata_kuliah.mk_id = kelas.mk_id WHERE kelas_id = '$the_kelas_id'";
                $select_kelas_by_id = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_kelas_by_id)):
                    $kelas_hari = $row['kelas_hari'];
                    $kelas_id = $row['kelas_id'];
                    $kelas_jam = $row['kelas_jam'];
                    $kode_ruangan = $row['kode_ruangan'];
                    $dosen_id = $row['dosen_id'];
                    $dosen_nama_db = $row['dosen_nama'];
                    $mk_id = $row['mk_id'];
                    $mk_nama_db = $row['mk_nama'];
                endwhile; ?>

        <?php 
            if (isset($_POST['edit_kelas'])) {
                // Mengedit post
                if (!empty($_POST['kelas_hari']) && !empty($_POST['kode_ruangan']) &&
                !empty($_POST['kelas_jam']) && !empty($_POST['dosen_id']) && !empty($_POST['mk_id'])) 
                {

                    $kelas_hari = $_POST['kelas_hari'];
                    $kelas_jam = $_POST['kelas_jam'];
                    $kode_ruangan = $_POST['kode_ruangan'];
                    $dosen_id = $_POST['dosen_id'];
                    $mk_id = $_POST['mk_id'];


                $query = "UPDATE `kelas` SET `kelas_hari`='$kelas_hari',`kelas_jam`='$kelas_jam',
                        `kode_ruangan`='$kode_ruangan',`dosen_id`='$dosen_id',`mk_id`='$mk_id' WHERE kelas_id = '$the_kelas_id'";
                $query_edit_kelas = mysqli_query($connection,$query);
                confirm($query_edit_kelas);
                ?>
                    <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                    kelas Updated:
                    <a href="kelas.php"  class="alert-link">View All kelas</a>
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
        <label for="jurusan_dosen">Hari Matakuliah</label>
                                <div class="form-group">
                                    <?php $haris= ['senin','selasa','rabu','kamis',"jum'at",'sabtu']; ?>
                                <select name="kelas_hari" id="jurusan_dosen">
                                    <?php 
                                        foreach ($haris as $hari) { 
                                            if ($kelas_hari == $hari) { ?>
                                                <option value="<?php echo $hari ?>" selected><?php echo $hari ?></option>
                                            <?php } else {
                                            ?>
                                            <option value="<?php echo $hari ?>"><?php echo $hari ?></option>
                                        <?php }}
                                    
                                    ?>

                                </select>
                                </div>
                                <label for="kelas_jam">Jam Matakuliah</label>
                                <div class="form-group">
                                    <input type="time" class="" name="kelas_jam" value="<?php echo $kelas_jam ?>">
                                </div>
                                <div class="form-group">
                                    <label for="kode_ruangan">Kode Ruangan</label>
                                    <input type="text" class="form-control" name="kode_ruangan" value="<?php echo $kode_ruangan ?>">
                                </div>

                                <label for="jurusan_dosen">Dosen Matakuliah</label>
                                <div class="form-group">
                                <select name="dosen_id" id="jurusan_dosen">
                                
                                <?php 
                                    $query = "SELECT * FROM `dosen`";
                                    $select_dosen = mysqli_query($connection,$query);
                                    while ($row = mysqli_fetch_assoc($select_dosen)) {
                                        $dosen_id = $row['dosen_id'];
                                        $dosen_nama = $row['dosen_nama'];
                                        if ($dosen_nama==$dosen_nama_db) { ?>
                                            <option value="<?php echo $dosen_id ?>" selected > <?php echo $dosen_nama?> </option>
                                        <?php }else {
                                        ?>
                                        <option value="<?php echo $dosen_id ?>"  > <?php echo $dosen_nama?> </option>
                                    
                                    <?php }    }                            
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
                                        $mk_nama = $row['mk_nama']; 
                                        if ($mk_nama == $mk_nama_db) { ?>
                                            <option value="<?php echo $mk_id ?>" selected > <?php echo $mk_nama?> </option>
                                        <?php }else {
                                            
                                        ?>
                                        <option value="<?php echo $mk_id ?>"  > <?php echo $mk_nama?> </option>
                                    
                                    <?php }}                            
                                ?>
                                </select>
                                </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit_kelas" value="Edit kelas">
            </div>
        </form>
    </div>