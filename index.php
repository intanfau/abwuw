<?php
    error_reporting(0);
    session_start();
    require 'connect.php';

    $username   = $_SESSION['username'];
    $sql        = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $level      = mysqli_fetch_assoc($sql)['level'];

    $produk = mysqli_query($conn, "SELECT * FROM produk");

    if ($level == 'admin') {
        header('location: admin.php');
    }
    
    if (isset($_SESSION['username'])) {
        $username    = $_SESSION['username'];

        $query       = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        $namalengkap = mysqli_fetch_assoc($query)['namalengkap']; 
    } else {
        $username    = null;
        $namalengkap = null;
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .produk{
            padding: 27px 8%;
            align-items: center;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        nav{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;  
            padding: 27px 8%;         
        }

        li, a, button{
            text-decoration: none;
            margin: 0px 10px;
            display: inline-block;
        }

        li, a{
            font-size: 20px;
            font-family: sans-serif;
            color: black;
        }

        .depan{
            background-color: #44426e;
            padding: 200px 300px;
            align-items: center;
            box-shadow: 0px 0px 3px rgba(1,1,0.8,0.8); 
            border: 3px white;
        }

        h1{
            font-family: sans-serif;
            font-weight: bold;
            color: white;
        }
        
        p{
            font-family: sans-serif;
            color: white;
        }

        .hl{
            color: black;
            background: white;
            padding: 2px 5px;
            border-radius: 3px;
        }

        .printer{
            border: 3px dashed grey;
            box-shadow: 3px 3px 6px rgba(1,1,0.8,0.8);
            border-radius: 3px;
            border-width: 3px;
            border-style: none;
            display: grid;
            grid-template-columns: repeat;
            padding: 30px;
            margin: 70px 52px;
            align-items: center;
        }

        .gambar{
            width: 200px;
            height: 200px;
            align-items: center;
        }
        
        .nama{
            font-weight: bold;
            font-family: sans-serif;
            font-size: 20px;
        }

        .desc{
            font-size: 14px;
            font-family: sans-serif;
            font-style: italic;
            margin-bottom: 15px;
        }

        .harga{
            font-size: 15px;
            font-family: sans-serif;
            margin-bottom: 12px;
            color: green;
        }

        .stok{
            font-size: 15px;
            font-family: sans-serif;
            display: inline;
        }

        .stok button{
            float: right;
        }

        table{
            width: 50%;
        }
    </style>
</head>
<body>
    <nav>
        <div>
            <a href="">E-Commerce</a>
        </div>
        <div>
            <ul>
                <?php
                    if (isset($username)) {
                        echo '
                            <li>
                                <a href="myorders.php">Orders</a>
                            </li>
                            <li>
                                <a href="logout.php">Logout</a>
                            </li>
                        ';
                    } else {
                        echo '
                            <li>
                                <a href="login.php">Login</a>
                            </li>
                        ';
                    }
                ?>
            </ul>
        </div>
    </nav>
    <div class="depan">
        <h1>Halo, selamat datang!<br><?= $namalengkap; ?>.</h1>
        <p>Selamat berbelanja ya, <b class="hl">have a nice day!</b></p>
    </div>
    <div class="produk">
        <table>
            <tbody>
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM produk");
                    foreach ($produk as $data) {
                ?>
                    <div class="printer">
                        <form action="" method="POST">
                            <div>
                                <input type="hidden" name="produk" value="<?= $data['idproduk']; ?>">
                                <input type="hidden" name="user" value="<?= $username ?>">
                            </div>
                            <div class="gambar"><img src="img/<?= $data['gambarproduk']; ?>" alt="<?= $data['namaproduk']; ?>" width="200"></div>
                            <div class="nama"><?= $data['namaproduk']; ?></div>
                            <div class="desc"><?= $data['deskripsiproduk']; ?></div>
                            <div class="harga"><?= $data['hargaproduk']; ?></div>
                            <div class="stok">Stok: 
                                <?= $data['stokproduk']; ?>
                                <button><a href="form.php?id=<?= $data['idproduk']; ?>" style="font-size: 15px;">Buy Now</a></button>
                            </div>
                            
                        </form>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>