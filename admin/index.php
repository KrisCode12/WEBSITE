<?php include ('partials/menu.php');?>
<body>
   

    <main>
        <section>
            <?php
            
            if (isset($_SESSION['user'])) {
                $username = $_SESSION['user'];
              ?> <h1>Welcome <?php echo $username ?></h1> <?php
            } else {
               
                header('location:' . SITEURL . 'admin/login.php');
                exit();
            }
            ?>
           
            <h2> Dashboard of Web Squad Technology</h2>
            
        </section>
    </main>

   

   
</body>
</html>
<?php include ('partials/footer.php');?>