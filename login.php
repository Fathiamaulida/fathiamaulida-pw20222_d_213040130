
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body id="login">
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="login" class="btn">
        </form>
        <?php 
        $conn = mysqli_connect("localhost" , "root" , "" , "tubes") or die ("Gagal terhubung ke database!");
        
            if(isset($_POST['submit'])){
                session_start();
                include 'koneksi.php';
                $user = mysqli_real_escape_string($conn,$_POST['user']);
                $pass = mysqli_real_escape_string($conn,$_POST['pass']);

                $cek = mysqli_query($conn,"SELECT * FROM admin WHERE username = '".$user."'");
                // cek password
                if(mysqli_num_rows($cek) > 0){
                    $d = mysqli_fetch_object($cek);
                    if (password_verify($pass,$d->password)) {
                        $_SESSION['status_login'] = true;
                        $_SESSION['admin_global'] = $d;
                        $_SESSION['id'] = $d->id_admin;
                        echo '<script>window.location="dashboard.php"</script>'; 
                       
                    }else{
                        echo '<scr◘ipt> alert("password Anda salah!")</scr◘ipt>';
                    }
                    }else{
                        echo '<script> alert("Username atau password Anda salah!")</script>';
                    }
                }
            
        ?>
    </div>
</body>
</html>