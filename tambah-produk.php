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
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
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
             <h3>Tambah Data Produk</h3>
             <div class="box">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <select class="input-control" name="kategori" required>
                            <option value="">--pilih--</option>
                            <?php 
                                $kategori = mysqli_query($conn, "SELECT * FROM kategori_produk ORDER BY id_kategori_produk DESC");
                                while($r = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $r['id_kategori_produk']?>"><?php echo $r['nama_kategori']?></option>
                            <?php }?>
                        </select>
                        <input type="text" name="nama" placeholder="Nama produk" class="input-control"  required>
                        <input type="text" name="harga" placeholder="Harga " class="input-control"  required>
                        <input type="file" name="gambar"  class="input-control"  required>
                        <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br> 
                        <select class="input_control" name="status">
                            <option value="">--Pilih--</option>
                            <option value="1">--Aktif--</option> <!-- kalo aktif akan tampil-->
                            <option value="0">--Tidak Aktif--</option><!-- tidak aktif data tidak akan tampil-->
                        </select>
                        <input type="submit" name="Submit"  value="Submit" class="btn">
                    </form>
                <?php 
                if(isset($_POST['Submit'])){
                    //print_r($_FILES['gambar']);
                    // menampung dari form
                    $kategori = $_POST['kategori'];
                    $nama = $_POST['nama'];
                    $harga = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    // menampung data file
                    $filename = $_FILES ['gambar']['name']; // name = nama file
                    $tmp_name = $_FILES['gambar']['tmp_name']; // tipe file
                    
                    $type1 = explode('.',$filename); //tanda titik sbg pemisah
                    $type2 = $type1[1]; //format file
                    
                    $newname = 'produk'.time().'.'.$type2;
                    //menampung data ke format file yang diizinkan
                    $tipe_file= array('jpg','jpeg','jfif','gif','png');
                    //validasi format file
                    if(!in_array($type2, $tipe_file)){
                        echo '<script>alert("format file tidak diizinkan")</script>';
                    }else{
                        // proses uploud file dan insert db
                        move_uploaded_file($tmp_name,'./produk/'. $newname);

                        //insertDB
                        $insert = mysqli_query($conn, "INSERT INTO produk VALUES(
                                    null,
                                   '".$kategori."',
                                   '".$nama."',
                                   '".$harga."',
                                   '".$deskripsi."',
                                   '".$newname."',
                                   '".$status."',
                                   null                          
                                       ) ");
                        if($insert){
                            echo '<script>alert("Tambah data berhasil!")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        }else{
                            echo 'gagal '.mysqli_error($conn);
                        }
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