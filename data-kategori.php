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
    <title>kategori</title>
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
    td a {
        color:black !important;
    }
    .hapus {
        color: red !important;;
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
             <h3>Data Kategori</h3>
             <div class="box">
     <!-- tambah data kategori-->
                 <p><a href="tdk.php">Tambah Data Kategori</a></p>
             <table  border="1" cellspacing="0" class="table">
                 <thead>
                     <tr>
                         <th width="50px" style="color:black;">NO</th>
                         <th style='color:black;'> Kategori </th>
                         <th width="150px"> Aksi</th>
                     </tr>
                 </thead>
                <tbody>
                <?php 
                $no=1;
                    $kategori = mysqli_query($conn, "SELECT * FROM kategori_produk ORDER BY id_kategori_produk DESC");
                    if(mysqli_num_rows($kategori) > 0) {
                    while($row = mysqli_fetch_array($kategori)) {
                ?>
                 <tr>
                     <td><?php echo $no++?></td>
                     <td><?php echo $row['nama_kategori']?></td>
                     <td> 
                        <a href="edit-kategori.php?id=<?php echo $row['id_kategori_produk']?>"><b>Edit</b></a> || 
                        <a class="hapus" href="proses-hapus.php?idk=<?php echo $row['id_kategori_produk']?>"onclick="return confirm('Yakin ingin hapus?')"><b>Hapus</b></a>
                        </td>
                 </tr>
                 <?php }}else{ ?>
                     <tr>
                        <td colspan="3">Tidak ada data</td>
                     </tr>
                 <?php } ?>
                </tbody>
             </table>  
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