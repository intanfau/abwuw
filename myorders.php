<?php
    error_reporting(0);
    session_start();
    require 'connect.php';

    $username = $_SESSION['username'];
    $sql =mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $level = mysqli_fetch_assoc($sql)['level'];

    $produk = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN produk ON transaksi.produk = produk.idproduk INNER JOIN user ON transaksi.user = user.username WHERE status NOT LIKE 'K' AND user = '$username'");

    if(!$username){
        echo "
            <script>
                alert('Harap login terlebih dahulu')
                document.location.href = 'login.php'
            </script>
        ";
    }

    if($level == 'admin'){
        header('location: admin.php');
    }

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];

        $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        $namalengkap = mysqli_fetch_assoc($query)['namalengkap'];
    } else {
        $username = null;
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
            width: 75px;
            height: 20px;
            font-size: 10px;
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
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            
        </div>
    </nav>

    <div class="produk" align="center">
        <table border="1px">
            <thead>
                <th>No</th>
                <th>Gambar Produk</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Kuantitas</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($produk as $data) {
                ?>
                    <form action="" method="post">
                        <tr>
                            <td>
                                <?= $no++; ?>.
                                <input type="hidden" name="idtransaksi[]" value="<?= $data['idtransaksi']; ?>">
                                <input type="hidden" name="produk" value="<?= $data['idproduk']; ?>">
                                <input type="hidden" name="user" value="<?= $username; ?>">
                            </td>
                            <td><img src="img/<?= $data['gambarproduk']; ?>" alt="<?= $data['namaproduk']; ?>" width="200px"></td>
                            <td><?= $data['namaproduk']; ?></td>
                            <td>Rp<?= $data['hargaproduk']; ?></td>
                            <td><input type="number" name="kuantitas" value="<?= $data['jumlah']; ?>" readonly></td>
                            <td><?= $data['hargaproduk'] * $data['jumlah']; ?></td>
                            <td>
                                <?php
                                if ($data['status'] === 'acc') {
                                    echo "<h3 style='color: green; font-size: 14px;'>Accepted</h3>";
                                } elseif ($data['status'] === 'reject') {
                                    echo "<h3 style='color: red; font-size: 14px;'>Rejected</h3>";
                                } else {
                                    echo "<h3 style='color: black; font-size: 14px;'>Pending</h3>";
                                }
                                ?>
                            </td>
                        </tr>
                <?php } ?>
            </tbody>
                    </form>
        </table>
    </div>
</body>
</html>