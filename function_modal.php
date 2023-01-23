<?php 
    require "db/koneksi.php";

    if($_GET["act"] == "tambahdata"){
        $nrp = htmlspecialchars($_POST["nrp"]); 
        $nama = htmlspecialchars($_POST["nama"]);
        $email = htmlspecialchars($_POST["email"]);
        $jurusan = htmlspecialchars($_POST["jurusan"]);
        $gambar = upload();

        if(!$gambar ){
            return false;
        }

        $db = mysqli_query($conn, "INSERT INTO mahasiswa VALUES (null,'$nrp', '$nama', '$email', '$jurusan', '$gambar')");

        if ($db) {
            header("Location: index.php?tambah=berhasil");
        } else {
            echo "gagal menambahkan data" .mysqli_error($conn);
        }
    } elseif($_GET["act"] == "hapusdata"){
        $id_mhs = $_GET['id']; 
        // var_dump($_GET);die;

        $delete = mysqli_query($conn, "DELETE FROM mahasiswa WHERE Id = '$id_mhs'");
        if ($delete) {
            header("Location: index.php?hapus=berhasil");
        } else {
            echo "hapus data gagal".mysqli_error($conn);
        }
    } elseif($_GET["act"] == "editdata"){
        $id_mhs = htmlspecialchars($_POST["Id"]);
        $nrp = htmlspecialchars($_POST["nrp"]); 
        $nama = htmlspecialchars($_POST["nama"]);
        $email = htmlspecialchars($_POST["email"]);
        $jurusan = htmlspecialchars($_POST["jurusan"]);
        $gambarLama = htmlspecialchars($_POST["gblama"]);
        
        // cek apakah gambar diganti atau tidak
        if($_FILES['gambar']['error'] == 4){
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }

        $update = mysqli_query($conn, "UPDATE mahasiswa SET nrp='$nrp', nama='$nama', email='$email', jurusan='$jurusan', gambar='$gambar' WHERE Id='$id_mhs'");

        if ($update) {
            header("Location: index.php?edit=berhasil");
        } else {
            echo "edit data gagal".mysqli_error($conn);
        }
    }

    function upload(){
        $nameGb = $_FILES['gambar']['name'];
        $sizeFile = $_FILES['gambar']['size']; 
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        if($error == 4){
            header('Location: index.php?gagal=notice');
            return false;
        }

        // cek ekstensi gambar yang diupload
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $nameGb);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        // cek apakah ekstensi gambar seusai
        if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script> alert('yang anda upload bukan gambar!');
                           window.location.href= 'index.php';
                  </script>";
            return false;
        }

        // cek ukuran file foto diatas 2 mb
        if($sizeFile > 2000000){
            echo "<script> alert('ukuran gambar terlalu besar');
                           window.location.href= 'index.php';
                  </script>";
            return false;
        }

        // mengubah nama gambar agar tidak sama
        $nameGbBaru = uniqid();
        $nameGbBaru .= ".";
        $nameGbBaru .= $ekstensiGambar;

        // upload gambar jika lulus pengecekan
        move_uploaded_file($tmpName, 'img/' . $nameGbBaru);
        return $nameGbBaru;
    }
