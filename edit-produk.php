<?php
 session_start();
 include 'koneksi.php';
 if($_SESSION['status_login'] != true){
     echo '<script>window.location="login.php"</script>';
 }
 $produk = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk ='".$_GET['id']."'" );
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
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
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
             <h3>Edit Data Produk</h3>
             <div class="box">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <select class="input-control" name="kategori" required>
                            <option value="">--pilih--</option>
                            <?php 
                                $kategori = mysqli_query($conn, "SELECT * FROM kategori_produk ORDER BY id_kategori_produk DESC");
                                while($r = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $r['id_kategori_produk']?>" <?php echo($r['id_kategori_produk'] == $p->id_kategori_produk)? 'selected':''; ?>><?php echo $r['nama_kategori']?></option>
                            <?php }?>
                        </select>
                        <input type="text" name="nama" placeholder="Nama produk" class="input-control" value="<?php echo $p->nama_produk?>" required>
                        <input type="text" name="harga" placeholder="Harga " class="input-control" value="<?php echo $p->harga_produk?>" required>
                        <img src="produk/<?php echo $p->gambar_produk?>"width="100px">
                        <input type="hidden" name="foto" value="<?php echo $p->gambar_produk ?>">
                        <input type="file" name="gambar"  class="input-control">
                        <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->deskripsi_produk?></textarea><br> 
                        <select class="input_control" name="status">
                            <option value="">--Pilih--</option>
                            <option value="1" <?php echo($p->status_produk == 1)? 'selected':''; ?>>--Aktif--</option> <!-- kalo aktif akan tampil-->
                            <option value="0" <?php echo($p->status_produk == 0)? 'selected':''; ?>>--Tidak Aktif--</option><!-- tidak aktif data tidak akan tampil-->
                        </select>
                        <input type="submit" name="Submit"  value="Submit" class="btn">
                    </form>
                <?php 
                if(isset($_POST['Submit'])){
                    // data inputan dr form
                    $kategori = $_POST['kategori'];
                    $nama = $_POST['nama'];
                    $harga = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    $foto = $_POST['foto'];
                    // tampung data gambar
                    $filename = $_FILES ['gambar']['name']; 
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    // admin ganti gambar
                    if($filename != ''){
                        $type1=explode('.', $filename); 
                         $type2 = $type1[1];

                    $newname = 'produk'.time().'.'.$type2;

                    //menampung data ke format file yang diizinkan
                    $tipe_file= array('jpg','jpeg','jfif','gif','png');
                        
                    if(!in_array($type2, $tipe_file)){
                            echo '<script>alert("format file tidak diizinkan")</script>';
                        }else{
                            unlink('./produk/' .$foto);
                            move_uploaded_file($tmp_name, './produk/' .$newname);
                            $namagambar = $newname;
                        }
                    }else{
                        // admin tidak ganti gambar
                        $namagambar = $foto;

                    }
                    //queri update data produk
                    $update = mysqli_query($conn, "UPDATE produk SET
                                id_kategori_produk           = '".$kategori."',
                                nama_produk         = '".$nama."',
                                harga_produk        = '".$harga."',
                                deskripsi_produk    = '".$deskripsi."',
                                gambar_produk       = '".$namagambar."',
                                status_produk       = '".$status."' 
                                    WHERE id_produk = '".$p->id_produk."' ");
                  
                     if($update){
                         echo '<script>alert("ubah data berhasil!")</script>';
                        echo '<script>window.location="data-produk.php"</script>';
                            }else{
                                echo 'gagal '.mysqli_error($conn);
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