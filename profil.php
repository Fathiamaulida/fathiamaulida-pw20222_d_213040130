<?php
 session_start();
 include 'koneksi.php';
 if($_SESSION['status_login'] != true){
     echo '<script>window.location="login.php"</script>';
 }
 $conn = mysqli_connect("localhost" , "root" , "" , "tubes") or die ("Gagal terhubung ke database!");
 $query = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '".$_SESSION['id']."' ");
 $d = mysqli_fetch_object($query);
 
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

    body{
        background-image:url('./images/bg.jpg');
        background-size: cover; background-position:center;
    }
    h1{
        color: white !important;;
        text-align: center;
        font-family:Quicksand;
    }
</style>
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
</div>
    </header>
     <!-- konten -->
     <div class="section">
         <div class="container">
             <h1>Profil</h1>
             <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->nama_admin?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username?>" required>
                    <input type="text" name="hp" placeholder="No hp" class="input-control" value="<?php echo $d-> telp_admin?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->email_admin?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->alamat_admin?>"  required>
                    <input type="submit" name="submit" placeholder="Submit" value="Ubah Profil" class="btn">
                </form>
                <?php
            if(isset($_POST['submit'])){
                $nama   = ucwords ($_POST['nama']);     
                $user   = $_POST['user'];   
                $hp     = $_POST['hp'];   
                $email  = $_POST['email'];   
                $alamat = ucwords($_POST['alamat']);
             
                $update = mysqli_query($conn, " UPDATE admin SET
                                        nama_admin      = '".$nama."',
                                        username        = '".$user."',
                                        telp_admin      = '".$hp."',
                                        email_admin     = '".$email."',
                                        alamat_admin    = '".$alamat."'
                                WHERE   id_admin        = '".$d->id_admin."' ");
                if($update){
                    echo '<script>alert("Data berhasil diubah!")</script>';
                    echo '<script>window.location="profil.php"</script>';
                }else{
                    echo 'gagal' .mysqli_error($conn);
                }
            }
                ?>
             </div>
             
             <h1 >Ubah password</h1>
             <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control"  required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                <?php
            if(isset($_POST['ubah_password'])){
                $pass1       = password_hash($_POST['pass1'],PASSWORD_BCRYPT);   
                $pass2       = $_POST['pass2'];   
            if($pass2 != $_POST['pass1'] ){
                echo '<script>alert("Konfirmasi password baru tidak sesuai")</script>';
            } else{
                
                $u_pass = mysqli_query($conn, " UPDATE admin SET
                                        password         = '".$pass1."' 
                                WHERE   id_admin        = '".$d->id_admin."' ");
                                if($u_pass){
                                    echo '<script>alert("Data berhasil diubah!")</script>';
                                    echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'gagal' .mysqli_error($conn);
                            }
            }
        }
            ?>
         </div>
     </div>

     <!-- footer -->
     <footer>
         <div class="container">
             <small>Copyright bp &copy TokoTia</small>
         </div>
     </footer>
</body>
</html>