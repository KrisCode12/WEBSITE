<?php include ('partials/menu.php');?>
<body>
   
    <main>
        <section>
        <h2>Developer Information</h2>
            <?php
                $sql = "SELECT * FROM developers";
                $res = mysqli_query($conn,$sql);

                    if($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);

                        $sn=1;

                        if($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id=$rows['user_id'];
                                $first_name=$rows['first_name'];
                                $middle_initials=$rows['middle_initials'];
                                $last_name = $rows['last_name'];
                                $username = $rows['username'];
                                $email = $rows['email'];
                                $bio = $rows['bio'];
                                $profile_picture_url = $rows['profile_picture_url'];
            ?>

                <div class="dev-container">

                   <div class="profile-picture-container">
                    <?php
                            if (!empty($profile_picture_url)) {
                                echo '<img src="' . $profile_picture_url . '" alt="Profile Picture">';
                            } else {
                                // If profile picture is empty, use default image
                                echo '<img src="../assets/profile-pictures/default_profile.jpg" alt="Default Profile Picture" width="100" height="100">';
                            }
                    ?>

                   </div>
                   
                    <div class="information-container">
                        <p> <?php echo $first_name . ' ' . $middle_initials . ' ' . $last_name; ?></p>
                        <p>Username: <?php echo $username; ?></p>
                        <p>Email: <?php echo $email; ?></p>
                    </div>
                   
                  

                  
                </div>

            <?php
                    }
                } else {
                    echo 'No developers found.';
                }
            } else {
                echo 'Error in query: ' . mysqli_error($conn);
            }
            ?>
            
        </section>
    </main>

   

   
</body>
</html>
<?php include ('partials/footer.php');?>