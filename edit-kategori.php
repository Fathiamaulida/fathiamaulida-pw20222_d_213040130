<?php
 session_start();
 include 'koneksi.php';
 if($_SESSION['status_login'] != true){
     echo '<script>window.location="login.php"</script>';
 }
 $kategori = mysqli_query($conn, "SELECT * FROM kategori_produk WHERE id_kategori_produk = '".$_GET['id']."' ");
 if(mysqli_num_rows($kategori)== 0){
     echo '<script>window.location="data-kategori.php"</script>';
 }
 $k = mysqli_fetch_object($kategori);
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
             <h3>Edit Data Kategori</h3>
             <div class="box">
                    <form action="" method="POST">
                        <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k-> nama_kategori ?>" required>
                        <input type="submit" name="Submit"  value="Submit" class="btn">
                    </form>
                <?php 
                if(isset($_POST['Submit'])){
                    $nama = ucwords($_POST['nama']);
                    $update = mysqli_query($conn,"UPDATE kategori_produk SET 
                                                nama_kategori = '".$nama."'
                                                WHERE id_kategori_produk ='".$k->id_kategori_produk."' ");
                if($update){
                    echo '<script>alert("Edit Berhasil Diubah!")</script>';
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
     <script>
            CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>