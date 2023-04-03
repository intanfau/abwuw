<?php

require 'connect.php';

$id = $_GET['id'];

if (!$id) {
    header('location: logout.php');
}

$data = mysqli_query($conn, "SELECT * FROM transaksi WHERE idtransaksi = '$id'");
foreach ($data as $row) {
    $jmlh = $row['jumlah'];
    $idproduk = $row['produk'];
}

$prdk = mysqli_query($conn, "UPDATE produk SET
                                stokproduk = stokproduk + $jmlh
                                WHERE idproduk = '$idproduk'");

$query = mysqli_query($conn, "UPDATE transaksi SET
                                status = 'reject'
                                WHERE idtransaksi = '$id'");

if (mysqli_affected_rows($conn) > 0) {
    echo "
        <script>
            alert('Transaksi Rejected')
            document.location.href = 'orders.php'
        </script>
    ";
}
