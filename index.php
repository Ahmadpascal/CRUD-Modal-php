<?php
require_once "db/koneksi.php";

//ambil data dari tabel
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%'");
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin-Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <?php
        if (isset($_GET['tambah']) == 'berhasil') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <a href=""></a><button type="button" class="close" onclick="refreshPage()" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>berhasil menambahkan data mahasiswa</strong>
            </div>
        <?php } elseif (isset($_GET['hapus']) == 'berhasil') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" onclick="refreshPage()" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Data berhasil dihapus</strong>
            </div>
        <?php } elseif (isset($_GET['edit']) == 'berhasil') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" onclick="refreshPage()" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Data berhasil diedit</strong>
            </div>
        <?php } elseif (isset($_GET['gagal']) == 'notice') { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" onclick="refreshPage()" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Upload gambar terlebih dahulu!</strong>
            </div>
        <?php } ?>
        <div class="table-responsive">
            <a href="#" data-toggle="modal" data-target="#tambahdata" class="btn btn-info mb-2">Tambah Data</a>
            <form action="" method="post">
                <div class="row">
                    <div class="form-group col-md-4 pb-1">
                        <input type="text" name="keyword" class="form-control">
                    </div>
                    <div class="form-group">
                        <button name="cari" class="btn btn-primary">Cari</button>
                    </div>
                </div>

            </form>
            <table class="table table-striped table-hover border text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">NRP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) :
                    ?>
                        <tr>
                            <td scope="row"><?= $i++ ?></td>
                            <td hidden><?= $row['Id'] ?></td>
                            <td><img src="img/<?= $row['gambar'] ?>" width="80" height="60" alt=""></td>
                            <td><?= $row['nrp'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['jurusan'] ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#editdata<?= $i ?>" class="btn btn-warning m-1">Edit</a>
                                <a href="#" data-toggle="modal" data-target="#hapusdata<?= $i ?>" class="btn btn-danger m-1">Hapus</a>
                            </td>
                        </tr>
                        <!-- modal hapus data -->
                        <div class="modal fade" id="hapusdata<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title" id="exampleModalLabel"><strong>Hapus Data Mahasiswa</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="text-center">Apakah anda yakin ingin menghapus data <strong><?= $row['nama'] ?></strong>?</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="function_modal.php?act=hapusdata&id=<?= $row['Id'] ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal hapus data -->

                        <!-- modal edit data -->
                        <div class="modal fade" id="editdata<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title" id="exampleModalLabel"><strong>Edit Data Mahasiswa</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="function_modal.php?act=editdata" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="Id" value="<?= $row['Id'] ?>">
                                        <input type="hidden" name="gblama" value="<?= $row['gambar'] ?>">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nrp">NRP</label>
                                                <input type="text" name="nrp" id="nrp" class="form-control" placeholder="masukkan nrp anda" value="<?= $row['nrp'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap</label>
                                                <input type="text" name="nama" id="nama" class="form-control" placeholder="masukkan nama anda" value="<?= $row['nama'] ?>" aria-describedby="helpId" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="masukkan nrp" value="<?= $row['email'] ?>" aria-describedby="helpId" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan</label>
                                                <input type="text" name="jurusan" id="jurusan" class="form-control" placeholder="masukkan Jurusan" value="<?= $row['jurusan'] ?>" aria-describedby="helpId" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputGroupFile02">Gambar</label><br />
                                                <img src="img/<?= $row['gambar'] ?>" width="100px" height="80px" alt="image">
                                                <div class="custom-file mt-1">
                                                    <input type="file" name="gambar" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label col-8" for="inputGroupFile02">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-info">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal edit data -->
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- modal tambah data -->
            <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Tambah Data Mahasiswa</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="function_modal.php?act=tambahdata" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nrp">NRP</label>
                                    <input type="text" name="nrp" id="nrp" class="form-control" placeholder="masukkan nrp anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="masukkan nama anda" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="masukkan nrp" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" name="jurusan" id="jurusan" class="form-control" placeholder="masukkan Jurusan" aria-describedby="helpId" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputGroupFile">Upload</label>
                                    <div class="custom-file">
                                        <input type="file" name="gambar" class="custom-file-input" id="inputGroupFile" />
                                        <label class="custom-file-label" for="inputGroupFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal tambah data -->
        </div>
    </div>



    <!-- Optional JavaScript -->
    <script type="application/javascript">
        function refreshPage() {
            window.location.href = "index.php";
        }

        // menampilkan nama file upload
        $('#inputGroupFile').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })

        $('#inputGroupFile02').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>