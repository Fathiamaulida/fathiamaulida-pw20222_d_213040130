<?php
error_reporting(0); 
include 'koneksi.php';
$kontak = mysqli_query($conn, "SELECT telp_admin, email_admin, alamat_admin FROM admin WHERE id_admin = 1");
$a = mysqli_fetch_object($kontak);
$produk = mysqli_query($conn, "SELECT * FROM produk  WHERE id_produk ='".$_GET['id']."' ");
$p = mysqli_fetch_object($produk);
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
 p {
    color :white !important;
    font-size 20px;
    text-align: center;
    font-family:Quicksand;
 }
 h4 {
    color :white !important;
    text-align: center;
    font-family:Quicksand;
 }
 h5 {
     color :white !important;
        text-align: center;
        font-family:Quicksand;
 }
</style>
<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="index.php">BPShop</a></h1>
        <ul>
            <li><a href="produk.php">Produk</a></li>
         </ul>
</div>
    </header>
    <!-- bagian search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
              <input  type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search']?>">
              <input type="hidden" name="kat" value="<?php echo $_GET['kat']?>">
              <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>
    <!-- ----------------------------------------------------------------------->

    <!-- detail produk-->
    <div class="section">
        <div class="container">
            Detail Produk
            <div class="box">
            <div class="col-2">
                <img src="produk/<?php echo $p->gambar_produk?>">
            </div>
            <div class="col-2">
            <h4><?php echo $p->nama_produk?></h4>
            <h5>Rp. <?php echo number_format($p-> harga_produk)?></h5>
            <p> Deskripsi :<br>
                <?php echo $p->deskripsi_produk?>
            </p>
            <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->telp_admin?>&text=Hai!,saya tertarik dengan produk anda!" target="_blank">
            Hubungi via Whatsapps</a>
            <img src="img/download.png" width="50px">
            </p>
            </div>
            </div>
        </div>
    </div>

    
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p> <?php echo $a->alamat_admin?></p>
            <h4>Email</h4>
            <p><?php echo $a->email_admin?></p>
            <h4>NO.HP</h4>
            <p> <?php echo $a->telp_admin?></p>
            <small>Copyright &copy; 2021 - BPshop.</small>
        </div>
    </div>
</body>
</html>