<?php
    require 'connect.php';

    $id = $_GET['id'];

    if (!$id) {
        header('location: logout.php');
    }

    $query = mysqli_query($conn, "UPDATE transaksi SET
                                    status = 'acc'
                                    WHERE idtransaksi = '$id'");

    if (mysqli_affected_rows($conn) > 0) {
        echo '
            <script>
                alert("Transaksi Accepted")
                document.location.href = "orders.php"
            </script>
        ';
    }
?>