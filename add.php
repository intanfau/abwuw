<?php
    require 'connect.php';
    session_start();

    $user = $_SESSION['username'];

    if (!$user) {
        echo "
            <srcipt>
                alert('Harap login terlebih dahulu')
                document.location.href = 'login.php'
        ";
    }

    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
    $level = mysqli_fetch_assoc($sql)['level'];

    if ($level == 'member') {
        echo "
            <script>
                alert('Anda tidak dapat mengakses halaman ini.')
                document.location.href = 'index.php'
            </script>
        ";
    }

    if (isset($_POST['submit'])) {
        if (addproduk($_POST) > 0) {
            echo "
                <script>
                    alert('Produk berhasil ditambah')
                    document.location.href = 'add.php'
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Produk gagal ditambahkan')
                    document.location.href = 'add.php'
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

        table{
            font-size: 15px;
            font-family: sans-serif;
            margin-top: 40px;
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
        <table>
            <tbody>
                <form action="" method="POST" enctype="multipart/form-data">
                    <tr>
                        <td>Gambar Produk</td>
                        <td><input type="file" name="gambar"></td>
                    </tr>
                    <tr>
                        <td>Nama Produk</td>
                        <td><input type="text" name="namaproduk"></td>
                    </tr>
                    <tr>
                        <td>Stok Produk</td>
                        <td><input type="number" name="stokproduk"></td>
                    </tr>
                    <tr>
                        <td>Harga Produk</td>
                        <td><input type="number" name="hargaproduk"></td>
                    </tr>
                    <tr>
                        <td>Deskripsi Produk</td>
                        <td><textarea name="deskripsi" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <button type="submit" name="submit" style="padding: 5px; margin: 20px;">ADD</button>
                            </center>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
</body>
</html>