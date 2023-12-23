<?php include ('../connection/constants.php');?>


<body>
    <form action="" method="POST" name="register">
        <h1> Become a developer! </h1>
        <input type="text" name="firstname" placeholder="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>">
        <input type="text" name="middleinitials" placeholder="middle name" value="<?php echo isset($_POST['middleinitials']) ? $_POST['middleinitials'] : ''; ?>">
        <input type="text" name="lastname" placeholder="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>">
        <input type="text" name="username" placeholder="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
        <input type="email" name="email" placeholder="E-mail address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        <input type="password" name="password" id="password" class="password-input" placeholder="Password">
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
    $password = md5($_POST['password']); 

    $sql = "INSERT INTO developers (first_name, middle_initials, last_name, username, email, password)
    VALUES ('$firstname', '$middleinitials', '$lastname', '$username', '$email', '$password')";
    $res = mysqli_query($conn, $sql);
   
}

?>