<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="text" name="email" ><br><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" ><br><br>
            
            <input type="submit" value="submit" name="submit">
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
        <?php
            include "classUser.php";
            include "connectDB.php";
            if (isset($_POST["submit"])){ 
                $email_login = $_POST["email"];
                $password = $_POST["password"];
                $user = new User($conn);
                $user->checkPassword($email_login,$password);
            } 
        ?>
    </body>
</html>