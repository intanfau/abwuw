<?php
    require 'connect.php';
    session_start();

    $id = $_GET['idproduk'];

    if (!$id) {
        header('location: logout.php');
    }

    $user = $_SESSION['username'];

    if (!$user) {
        echo "
            <script>
                alert('Harap login terlebih dahulu.')
                document.location.href = 'login.php'
            </script>
        ";
    }

    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
    $level = mysqli_fetch_assoc($sql)['level'];

    if ($level == 'member') {
        echo "
            <script>
                alert('Anda tidak dapat mengakses halaman ini!')
                document.location.href = 'index.php'
            </script>
        ";
    }

    $query = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk = '$id'");
    foreach ($query as $data) {
        $id = $data['idproduk'];
        $gambar = $data['gambarproduk'];
        $nama = $data['namaproduk'];
        $stok = $data['stokproduk'];
        $harga = $data['hargaproduk'];
        $deskripsi =  $data['deskripsiproduk'];
    }

    if (isset($_POST['submit'])) {
        if (edit($_POST) > 0) {
            echo "
                <script>
                    alert('Produk berhasil diubah')
                    document.location.href = 'admin.php'
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Produk gagal diubah')
                    document.location.href = 'admin.php'
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
            width: 50px;
            color: black;
            font-size: 15px;
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
                    <li>
                        <a href="admin.php">Home</a>
                    </li>
                    <li>
                        <a href="add.php">Add Products</a>
                    </li>
                    <li>
                        <a href="orders.php">Orders</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            
        </div>
    </nav>
    <div class="produk" align="center">
        <table border="3">
            <thead>
                <th colspan="2">
                    <center>
                        <img src="img/<?= $gambar; ?>" alt="<?= $nama; ?>" style="width: 200px;">
                    </center>
                </th>
            </thead>
            <tbody>
                <form action="" method="POST" enctype="multipart/form-data">
                    <tr>
                        <td>Gambar Produk</td>
                        <td>
                            <input type="file" name="gambar">
                            <input type="hidden" name="gambarlama" value="<?= $gambar; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Produk</td>
                        <td>
                            <input type="hidden" name="idproduk" value="<?= $id; ?>">
                            <input type="text" name="namaproduk" value="<?= $nama ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Stok Produk</td>
                        <td><input type="text" name="stokproduk" value="<?= $stok ?>"></td>
                    </tr>
                    <tr>
                        <td>Harga Produk</td>
                        <td><input type="number" name="hargaproduk" value="<?= $harga ?>"></td>
                    </tr>
                    <tr>
                        <td>Deskripsi Produk</td>
                        <td><textarea name="deskripsi" rows="3"><?= $deskripsi; ?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <button type="submit" name="submit">Edit</button>
                            </center>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
</body>
</html>