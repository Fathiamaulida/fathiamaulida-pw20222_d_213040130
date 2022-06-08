<?php
 session_start();
 include 'koneksi.php';
 if($_SESSION['status_login'] != true){
     echo '<script>window.location="login.php"</script>';
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<style>
    h3 {
        color:white;
        font-size:20px;
    }
    small {
        color:white;
    }
</style>
<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="dashboard.php">BPShop</a></h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="data-kategori.php">Data Kategori</a></li>
            <li><a href="data-produk.php">Data produk</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>   
</div>
    </header>
     <!-- konten -->
     <div class="section">
         <div class="container">
             <h3>Tambah Data Kategori</h3>
             <div class="box">
                    <form action="" method="POST">
                        <input type="text" name="nama" placeholder="Nama Kategori" class="input-control"  required>
                        <input type="submit" name="Submit"  value="Submit" class="btn">
                    </form>
                <?php 
                if(isset($_POST['Submit'])){
                    $nama = ucwords($_POST['nama']);
                   
                    $insert = mysqli_query($conn,"INSERT INTO kategori_produk VALUES (
                        null,
                        '".$nama."')");
                if($insert){
                    echo '<script>alert("Data Berhasil Ditambah!")</script>';
                    echo '<script>window.location="data-kategori.php"</script>';
                }else{
                    echo 'Gagal!' .mysqli_error($conn);
                }
                }
                ?>
                </div>
            </div>  
     </div>

     <!-- footer -->
     <footer>
         <div class="container">
             <small>Copyright &copy BPShop</small>
         </div>
     </footer>
</body>
</html>