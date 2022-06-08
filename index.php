<?php 
include 'koneksi.php';
$kontak = mysqli_query($conn, "SELECT telp_admin, email_admin, alamat_admin FROM admin WHERE id_admin = 1");
$a = mysqli_fetch_object($kontak);
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

<style>
    .box-item{
        display:inline-block;
        width:150px;
        margin-right:10px !important;
    }
</style>
</head>
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
              <input  type="text" name="search" placeholder="Cari Produk">
              <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>
    <!-- ----------------------------------------------------------------------->

    <!-- kategori -->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="row">

                <div class="box">
                    <?php 
                $kategori = mysqli_query($conn, "SELECT * FROM kategori_produk ORDER BY id_kategori_produk DESC");
                if(mysqli_num_rows($kategori) > 0){
                    while($k = mysqli_fetch_array($kategori)){
                ?>
                    <a href="produk.php>kat=<?php echo $k['id_kategori_produk']?>">
                        <div class=col-5>
                            <img src="img/icon gambar.png" width="50px" style="margin-bottom:5px;">
                            <p><?php echo $k['nama_kategori']?></p>
                        </div>
                    </a>
                
                    <?php 
                }} else{ ?>
                        <p>Kategori tidak ditemukan </p>                }
                        <?php }?>
                    </div>
                    </div>
        </div>
    </div>

    <!-- new produk-->
    <div class="section">
        <div class="container">
            <h3> Produk Terbaru</h3>
            <div class="box">
                <?php 
                        $produk = mysqli_query($conn, "SELECT * FROM produk WHERE status_produk = 1  ORDER BY id_kategori_produk DESC LIMIT 8");
                        if(mysqli_num_rows($produk) > 0){
                            while($p = mysqli_fetch_array($produk)){
                ?>
                <a href="detail-produk.php?id=<?php echo $p['id_produk']?>">
                <div class="col-4">
                    <img src="produk/<?php echo $p['gambar_produk']?>">
                    <p class="nama"><?php echo $p['nama_produk']?></p>
                    <p class="harga">Rp.<?php echo $p['harga_produk']?></p>
                </div>
                </a>
            <?php }}else{ ?>
                    <p>Produk tidak ditemukan</p>
                <?php } ?>
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