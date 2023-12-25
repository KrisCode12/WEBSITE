<?php include ('../connection/constants.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
<head>
    <title>Login Acount</title>
</head>
<body>

    <div class="login-container">
        <div class="loginpage">
           
            <form action="" method="POST" name="login">
                <div class="loginimage">
                    <a> 
                        <video style="width: 400px" autoplay muted loop>
                            <source src="../assets/videos/introVid.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </a>
                </div>
                
                <input type="text" name="username" placeholder="Username" >
                <input type="password" name="password" placeholder="Password">
                <div class="logsignbuttons">
                    <input type="submit" name="submit" value="Login" name="login">
                </div>
                <div class="register-link-container">
                    <a href="register.php" class="register-link">Don't have an account? Register here</a>
                </div>
            </form>
        </div>
        
    </div>
    
</body>
