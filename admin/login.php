<?php
include('../connection/constants.php');
?>

<html>

<head>
    <title>Login - Admin Web Squad Technology</title>

    <link rel="stylesheet" href="../css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-GLhlTQ8iZSL+poG6eA6q8QDH7g3uKEO/4F+sl5LU6I5LdQDO/1u2wnf50pdPw1x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['login_error'])) {
        echo '<script>
                    alertify.error("' . $_SESSION['login_error'] . '");
                </script>';
        unset($_SESSION['login_error']);
    }
    ?>

    <div class="login">
        <h1 class="login">Login</h1>
        <br><br>

        <form action="" method="POST" class="text-center">
            Username:
            <input type="text" name="username" placeholder="Enter Username"> <br><br>
            Password: 
            <input type="password" name="password" placeholder="Enter Password"> <br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
    </div>

</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $hashedPassword = $row['password_hash'];

        if (password_verify($_POST['password'], $hashedPassword)) {
            $_SESSION['user'] = $username;
            header('location:' . SITEURL . 'admin/');
            exit();
        } else {
            $_SESSION['login_error'] = "Username or Password did not match";
            header('location:' . SITEURL . 'admin/login.php');
            exit();
        }
    } else {
        echo "Error in SQL query: " . mysqli_error($conn);
    }
}
?>
