<?php
    session_start();
    require 'connect.php';

    if (isset($_SESSION['username'])) {
        header('location: index.php');
    }

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
        $row = mysqli_fetch_assoc($sql);

        if (mysqli_num_rows($sql) > 0) {
            if ($row['level'] == 'member') {
                $_SESSION['username'] = $row['username'];
                echo '
                    <script>
                        alert("Login Berhasil!")
                        document.location.href = "index.php"
                    </script>
                ';
            } elseif ($row['level'] == 'admin') {
                $_SESSION['username'] = $row['username'];
                echo '
                    <script>
                        alert("Login Berhasil!")
                        document.location.href = "admin.php"
                    </script>
                ';
            } else {
                echo '
                    <script>
                        alert("Login Gagal!")
                        document.location.href = "login.php"
                    </script>
                ';
            }
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

        button{
            padding: 5px;
            width: 100px;
            border: #ede9e3;
            border-radius: 7px;
            background-color: gray;
            font-family: sans-serif;
            margin-top: 15px;
        }

        li, a{
            font-size: 20px;
            font-family: sans-serif;
            color: white;
        }

        .login{
            padding: 10px; 
            width: 300px; 
            border-radius:7px;
            font-family: sans-serif;
            border: solid 1px gray;
            margin: 100px;
        }

        input{
            padding: 5px;
            font-size: 13px;
            font-family: sans-serif;
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
            </ul>
        </div>
    </nav>
    <center>
        <div class="login">
            <form action="" method="POST">
                <h2>Login</h2>
                <div>
                    <input type="text" name="username" placeholder="Username"><br>
                    <input type="password" name="password" placeholder="Password"><br>
                    <button type="submit" name="submit">Login</button>
                </div>
            </form>
        </div>
    </center>
</body>
</html>