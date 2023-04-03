<?php
    session_start();
    require 'connect.php';

    $username   = $_SESSION['username'];
    $sql        = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $level      = mysqli_fetch_assoc($sql)['level'];

    if (!$username) {
        echo '
            <script>
                alert("Harap login terlebih dahulu.")
                document.location.href = "login.php"
            </script>
        ';
    }

    if ($level == 'member') {
        echo "
            <script>
                alert('Maaf anda bukan admin!')
                document.location.href = 'index.php'
            </script>
        ";
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
            margin-top: 40px;
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
    <div class="produk">
        <table align="center">
            <thead>
                <th>No</th>
                <th>Gambar Produk</th>
                <th>Nama Produk</th>
                <th>Stok Produk</th>
                <th>Harga Produk</th>
                <th>Deskripsi Produk</th>
                <th>Aksi</th>
            </thead>
            <?php
                $no = 1;
                $sql = mysqli_query($conn, "SELECT * FROM produk");
            ?>
                <tbody>
                    <?php foreach ($sql as $data) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><img src="img/<?= $data['gambarproduk']; ?>" alt="<?= $data['namaproduk']; ?>" width="200"></td>
                            <td><?= $data['namaproduk']; ?></td>
                            <td><?= $data['stokproduk']; ?></td>
                            <td>Rp. <?= $data['hargaproduk']; ?></td>
                            <td><?= $data['deskripsiproduk']; ?></td>
                            <td>
                                <button><a class="button" href="edit.php?idproduk=<?= $data['idproduk']; ?>">Edit</a></button>
                                <button><a class="button" href="delete.php?idproduk=<?= $data['idproduk']; ?>">Delete</a></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
        </table>
    </div>
</body>
</html>