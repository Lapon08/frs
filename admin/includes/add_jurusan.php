
                        <?php 
                        // fungsi menambahkan post
                            if (isset($_POST['add_mahasiswa'])) {
                                if (!empty($_POST['jurusan_nama']) && !empty($_POST['jurusan_kode']))
                                {
                                $jurusan_nama = $_POST['jurusan_nama'];
                                $jurusan_kode = $_POST['jurusan_kode'];
                                $jurusan_nama = mysqli_real_escape_string($connection,$jurusan_nama);
                                $jurusan_kode = mysqli_real_escape_string($connection,$jurusan_kode);
                                    // tambah post
                                $query = "INSERT INTO `jurusan`(`jurusan_nama`, `jurusan_kode`) 
                                        VALUES ('$jurusan_nama','$jurusan_kode')";
                            
                                $add_mahasiswa = mysqli_query($connection,$query);
                                confirm($add_mahasiswa);
                                ?>
                                
                                <div class="alert alert-primary" role="alert" style="margin-left: 10px;">
                                jurusan Added:
                                <a href="jurusan.php"  class="alert-link">View All Jurusan</a>
                                </div>        
                            <?php }
                                else { ?>
                                    <div class="alert alert-danger" role="alert" style="margin-left: 10px;">
                                    This Form cannot empty
                                    </div>  
                                <?php }
                            } ?>

                        <!-- Menampilkan seluruh post yang ada -->
                        <div class="col-lg-8">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="jurusan_nama">Nama Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan_nama">
                                </div>
                                <div class="form-group">
                                    <label for="jurusan_kode">Kode Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan_kode">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add_mahasiswa" value="Add Jurusan">
                                </div>
                            </form>
                        </div>
