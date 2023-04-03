<?php
    error_reporting(0);
    session_start();
    require 'connect.php';

    $username = $_SESSION['username'];
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    foreach ($sql as $usr) {
        $level = $usr['level'];
        $user = $usr['username'];
        $iduser = $usr['id'];
    }

    $idproduk = $_GET['id'];

    $produk = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk = '$idproduk'");

    if ($level == 'admin') {
        header('location: admin.php');
    }

    if (!$username) {
        echo "
            <script>
                alert('Harap login terlebih dahulu.')
                document.location.href = 'login.php'
            </script>
        ";
    }

    if (isset($_POST['co'])) {
        if (checkout($_POST) > 0) {
            echo "
                <script>
                    alert('Transaksi berhasil')
                    document.location.href = 'index.php'
                </script>
            ";
        }
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
            background-color: #44426e;     
        }

        li, a, button{
            text-decoration: none;
            margin: 0px 10px;
            display: inline-block;
        }

        li, a{
            font-size: 20px;
            font-family: sans-serif;
            color: white;
        }

        input{
            padding: 5px;
            font-size: 15px;
            font-family: sans-serif;
            border: solid 1px gray;
            border-radius: 3px;
            width: 400px;
            background-color: #ede9e3;
        }

        textarea{
            padding: 5px;
            font-size: 15px;
            font-family: sans-serif;
            border: solid 1px gray;
            border-radius: 3px;
            width: 400px;
            background-color: #ede9e3;
        }

        table {
            font-family: sans-serif;
            font-size: 15px;
            color: black;
            border-width: 1px;
            border-color: black;
            border-collapse: collapse;
            background-color: white;
            text-align: center;
        }

        table th {
            border-width: 1px;
            border-style: solid;
            border-color: black;
            background-color: white;
            color: black;
        }

        td, th{
            padding: 16px;
        }

        table td {
            border-width: 1px;
            border-style: solid;
            border-color: black;
            background-color: white;
        }
        .button{
            width: 75px;
            height: 20px;
            font-size: 10px;
        }

        .infop{
            margin: 50px;
        }

        .infoc{
            margin: 100px;
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
                                <a href="index.php">Home</a>
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
    <div class="produk" align="center">
        <div class="infop">
            <table>
                <thead>
                    <th colspan="6">
                        <center>Informasi Produk</center>
                    </th>
                </thead>
                <thead>
                    <th>No</th>
                    <th>Gambar Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Kuantitas</th>
                </thead>
                <form action="" method="POST">
                    <tbody>
                        <?php
                            $no = 1;
                            foreach ($produk as $data) {
                        ?>
                            <tr>
                                <td>
                                    <?= $no++; ?>
                                    <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                                </td>
                                <td><img src="img/<?= $data['gambarproduk']; ?>" alt="<?= $data['namaproduk']; ?>" width="200"></td>
                                <td><?= $data['namaproduk']; ?></td>
                                <td>Rp<?= $data['hargaproduk']; ?></td>
                                <td>
                                    <input type="number" name="kuantitas" value="1" min="1" max="<?= $data['stokproduk']; ?>" required>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                
            </table>
        </div>
        <div class="infoc">
            <table>
                <thead>
                    <th colspan="6">
                        <center>Informasi Customer</center>
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>Account Pembeli</td>
                        <td> : </td>
                        <td>
                            <input type="text" name="user" value="<?= $user; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                    <td>Alamat Pembeli</td>
                        <td> : </td>
                        <td>
                            <textarea name="alamat" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon Pembeli</td>
                        <td> : </td>
                        <td>
                            <input type="number" name="nomor">
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <th colspan="3">
                        <center><button type="submit" name="co">Checkout</button></center>
                    </th>
                </tfoot>
                </form>
            </table>
        </div>
    </div>
</body>
</html>