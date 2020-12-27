<?php 
                if(isset($_GET['dosen_id'])){
                    $the_dosen_id = $_GET['dosen_id'];
                    

                }
                // menampilkan isi post yang akan diedit
                $query = "SELECT * FROM dosen LEFT JOIN jurusan ON dosen.jurusan_id = jurusan.jurusan_id WHERE dosen_id = '$the_dosen_id'";
                $select_dosen_by_id = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_dosen_by_id)):
                    $dosen_id = $row['dosen_id'];
                    $dosen_nama = $row['dosen_nama'];
                    $dosen_alamat = $row['dosen_alamat'];
                    $dosen_hp = $row['dosen_hp'];
                    $dosen_nidn = $row['dosen_nidn'];
                    $jurusan_id = $row['jurusan_id'];
                    $jurusan_nama = $row['jurusan_nama'];
                endwhile; ?>

        <?php 
            if (isset($_POST['edit_dosen'])) {
                // Mengedit post
                if (!empty($_POST['dosen_nama']) && !empty($_POST['dosen_alamat'])&& !empty($_POST['dosen_hp'])&& !empty($_POST['dosen_nidn'])
                && !empty($_POST['jurusan_id'])) 
                {

                    $dosen_nama = $_POST['dosen_nama'];
                    $dosen_alamat = $_POST['dosen_alamat'];
                    $dosen_hp = $_POST['dosen_hp'];
                    $dosen_nidn = $_POST['dosen_nidn'];
                    $jurusan_id = $_POST['jurusan_id'];

                $query = "UPDATE `dosen` SET `dosen_nama`='$dosen_nama',`dosen_nidn`='$dosen_nidn',`dosen_hp`='$dosen_hp',`dosen_alamat`='$dosen_alamat',`jurusan_id`='$jurusan_id' WHERE dosen_id = '$the_dosen_id'";
                $query_edit_dosen = mysqli_query($connection,$query);
                confirm($query_edit_dosen);
                ?>
                    <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                    dosen Updated:
                    <a href="dosen.php"  class="alert-link">View All dosen</a>
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
                <label for="title">Nama dosen</label>
                <input type="text" class="form-control" id="dosen_nama" name="dosen_nama" value="<?php echo $dosen_nama ?>">
            </div>

            <div class="form-group">
                <label for="dosen_nidn">NIDN dosen</label>
                <input type="text" class="form-control" name="dosen_nidn" value="<?php echo $dosen_nidn ?>">
            </div>

            <div class="form-group">
                <label for="dosen_alamat">Alamat dosen</label>
                <input type="text" class="form-control" name="dosen_alamat" value="<?php echo $dosen_alamat ?>">
            </div>

            <div class="form-group">
                <label for="dosen_hp">HP dosen</label>
                <input type="text" class="form-control" name="dosen_hp" value="<?php echo $dosen_hp ?>">
            </div>

            <label for="jurusan_id">Jurusan Dosen</label>
            <div class="form-group">
            <select name="jurusan_id" id="jurusan_id">
            
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

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit_dosen" value="Edit dosen">
            </div>
        </form>
    </div>