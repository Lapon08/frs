<?php 
                if(isset($_GET['jurusan_id'])){
                    $the_jurusan_id = $_GET['jurusan_id'];
                    echo $the_jurusan_id;

                }
                // menampilkan isi post yang akan diedit
                $query = "SELECT * FROM jurusan WHERE jurusan_id = $the_jurusan_id";
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
                if (!empty($_POST['jurusan_nama']) && !empty($_POST['jurusan_kode'])) 
                {

                $jurusan_nama = $_POST['title'];
                $jurusan_kode = $_POST['jurusan_kode'];


                    $jurusan_nama = mysqli_real_escape_string($connection,$jurusan_nama);
                    $jurusan_kode = mysqli_real_escape_string($connection,$jurusan_kode);



                $query = "UPDATE `jurusan` SET `jurusan_id`='$jurusan_id',
                        `jurusan_nama`='$jurusan_nama',
                        `jurusan_kode`='$jurusan_kode' WHERE jurusan_id = '$the_jurusan_id'";
                $query_edit_dosen = mysqli_query($connection,$query);
                confirm($query_edit_dosen);
                ?>
                    <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                    Jurusan Updated:
                    <a href="jurusan.php"  class="alert-link">View All Jurusan</a>
                    </div>
                <?php }
                    else { ?>
                        <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                        This Form cannot empty
                        </div>  
                    <?php }
            } ?> 
        
        
        


    <div class="col-lg-12">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Nama Jurusan</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $jurusan_nama ?>">
            </div>

            <div class="form-group">
                <label for="jurusan_kode">Kode Jurusan</label>
                <input type="text" class="form-control" name="jurusan_kode" value="<?php echo $jurusan_kode ?>">
            </div>


            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit_dosen" value="Edit Jurusan">
            </div>
        </form>
    </div>