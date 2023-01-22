<?php 
    require "db/koneksi.php";

    if($_GET["act"] == "tambahdata"){
        $nrp = $_POST["nrp"];
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $jurusan = $_POST["jurusan"];
        $nameGb = $_FILES['gambar']['name'];
        $sizeFile = $_FILES['gambar']['size']; 
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        if($error == 4){
            header('Location: index.php?gagal=notice');
            return false;
        }

        if($sizeFile > 2000000){
            echo "<script> alert('ukuran gambar terlalu besar');
                           window.location.href= 'index.php';
                  </script>";

            return false;
        }

        $db = mysqli_query($conn, "INSERT INTO mahasiswa(Id, nrp, nama, email, jurusan, gambar) VALUES (null,'$nrp', '$nama', '$email', '$jurusan', '$gambar')");

        if ($db) {
            header("Location: index.php?tambah=berhasil");
        } else {
            echo "gagal menambahkan data" .mysqli_error($conn);
        }
    } elseif($_GET["act"] == "hapusdata"){
        $id_mhs = $_GET["Id"];

        $delete = mysqli_query($conn, "DELETE FROM mahasiswa WHERE Id = '$id_mhs'");
        if ($delete) {
            header("Location: index.php?hapus=berhasil");
        } else {
            echo "hapus data gagal".mysqli_error($conn);
        }
    } elseif($_GET["act"] == "editdata"){
        $id_mhs = $_POST["Id"];
        $nrp = $_POST["nrp"];
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $jurusan = $_POST["jurusan"];
        $gambar = $_POST["gambar"];

        $update = mysqli_query($conn, "UPDATE mahasiswa SET nrp='$nrp', nama='$nama', email='$email', jurusan='$jurusan', gambar='$gambar' WHERE Id='$id_mhs'");

        if ($update) {
            header("Location: index.php?edit=berhasil");
        } else {
            echo "edit data gagal".mysqli_error($conn);
        }
    }

    // function upload(){ 
    //     // $nama = $_FILES['gambar']['name'];
    //     // $ukuranfile = $_FILES['gambar']['size'];
    //     $error = $_FILES['gambar']['error'];
    //     // $tmpName = $_FILES['gambar']['tmp_name'];

    //     // cek gambar apakah tidak ada gambar yang diupload
    //     if ($error == 4){ 
    //     echo "<script>
    //             alert(<b>'Pilih gambar untuk diupload'</b>);
    //          </script>";
    //     }   
    // }
