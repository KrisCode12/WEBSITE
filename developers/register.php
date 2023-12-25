<?php include ('../connection/constants.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
<head>
    <title>Register Acount</title>
</head>
<body>
    <form action="" method="POST" name="register">
        <h1> Become a developer! </h1>
        <input type="text" name="firstname" placeholder="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>">
        <input type="text" name="middleinitials" placeholder="middle name" value="<?php echo isset($_POST['middleinitials']) ? $_POST['middleinitials'] : ''; ?>">
        <input type="text" name="lastname" placeholder="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>">
        <input type="text" name="username" placeholder="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
        <input type="email" name="email" placeholder="E-mail address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        <input type="password" name="password" id="password" class="password-input" placeholder="Password">
        <input type="password" name="confirm_password" id="confirm_password" class="password-input" placeholder="Confirm Password">

        <input type="checkbox" name="terms" id="terms"> <label for="terms">I accept the <a href="terms_and_agreement.php" target="_blank">Terms and Conditions</a></label>
        <input type="submit" name="submit" value="Submit" name="register">
    </form>
</body>

<?php
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $middleinitials = $_POST['middleinitials'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if (!isset($_POST['terms'])) {
        echo '<script>
                alertify.error("Please accept the Terms and Conditions.");
              </script>';
    } else {
        $errors = array();

        if (!preg_match("/^[a-zA-Z]+$/", $firstname)) {
            $errors[] = "Invalid characters in first name. Please use only letters.";
        }

        if (!empty($middleinitials) && !preg_match("/^[a-zA-Z]$/", $middleinitials)) {
            $errors[] = "Invalid middle initials. Please use a single letter.";
        }

        if (!preg_match("/^[a-zA-Z]+$/", $lastname)) {
            $errors[] = "Invalid characters in last name. Please use only letters.";
        }

        $checkEmailQuery = "SELECT * FROM developers WHERE email = '$email'";
        $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

        $checkUsernameQuery = "SELECT * FROM developers WHERE username = '$username'";
        $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

        if (mysqli_num_rows($checkEmailResult) > 0) {
            $errors[] = "Email already exists. Please use a different email.";
        }

        if (mysqli_num_rows($checkUsernameResult) > 0) {
            $errors[] = "Username already exists. Please choose a different username.";
        }

        if (empty($_POST['firstname'])) {
            $errors[] = "Firstname cannot be empty.";
        }

        if (empty($_POST['lastname'])) {
            $errors[] = "Lastname cannot be empty.";
        }

        if (empty($_POST['username'])) {
            $errors[] = "Username cannot be empty.";
        }

        if (empty($_POST['email'])) {
            $errors[] = "Email cannot be empty.";
        }

        if (empty($_POST['password'])) {
            $errors[] = "Password cannot be empty.";
        }

    
        if (!password_verify($confirmPassword, $password)) {
            $errors[] = "Password and Confirm Password do not match.";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<script>
                        alertify.error("' . $error . '");
                      </script>';
            }
        } else {
            $sql = "INSERT INTO developers (first_name, middle_initials, last_name, username, email, password)
            VALUES ('$firstname', '$middleinitials', '$lastname', '$username', '$email', '$password')";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                echo '<script>
                        alertify.success("Registration complete!");
                      </script>';
            } else {
                echo '<script>
                        alertify.error("Registration failed. Please try again.");
                      </script>';
            }
        }
    }
}
?>