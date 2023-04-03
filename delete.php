<?php
    require 'connect.php';

    $id = $_GET['idproduk'];

    if (!$id) {
        header('location: logout.php');
    }

    $query = mysqli_query($conn, "DELETE FROM produk WHERE idproduk = $id");

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Produk berhasil dihapus!')
                document.location.href = 'admin.php'
            </script>
        ";
    }
?>