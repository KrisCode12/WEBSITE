<?php
include ('partials/menu.php');


$user = $_SESSION['user'];
$sql = "SELECT * FROM admins WHERE username='$user'";
$res = mysqli_query($conn, $sql);

if ($res) {
    $row = mysqli_fetch_assoc($res);
    $currentUsername = $row['username'];
   
} else {
    echo "Error in SQL query: " . mysqli_error($conn);
}
?>

<body>
    <main>
        <section>
            <h2>Edit Account</h2>

            <form action="" method="POST" name="editAccount">
                <label for="currentUsername">Current Username:</label>
                <input type="text" name="currentUsername" value="<?php echo $currentUsername; ?>" readonly>

                <label for="newUsername">New Username:</label>
                <input type="text" name="newUsername" placeholder="Enter New Username">

                <label for="newPassword">New Password:</label>
                <input type="password" name="newPassword" placeholder="Enter New Password">

                <label for="confirmPassword">Confirm New Password:</label>
                <input type="password" name="confirmPassword" placeholder="Confirm New Password">

                <input type="submit" name="submit" value="Update Account">
            </form>
        </section>
    </main>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $currentUsername = $_POST['currentUsername'];
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        echo '<script>alertify.error("New Password and Confirm Password do not match.");</script>';
    } else {
        
        $updateSql = "UPDATE admins SET ";
        
        if (!empty($newUsername)) {
            $updateSql .= "username='$newUsername', ";
        }
        
        $updateSql .= "password_hash='" . password_hash($newPassword, PASSWORD_DEFAULT) . "' WHERE username='$currentUsername'";

        $updateRes = mysqli_query($conn, $updateSql);

        if ($updateRes) {
            echo '<script>alertify.success("Account updated successfully.");</script>';
        } else {
            echo '<script>alertify.error("Failed to update account. Please try again.");</script>';
        }
    }
}
?>

<?php include ('partials/footer.php'); ?>
