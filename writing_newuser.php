<html>
    <head>
        <title>
            writing user
        </title>
    </head>
    <body>
        <?php 
            include "connectDB.php";
            include "classUser.php";
            if(isset($_POST["submit"])){
                $id = $_POST["idd"];
                $fName = $_POST["fName"];
                $surName = $_POST["surName"];
                $phone = $_POST["phone"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $userType = $_POST["userType"];
                $user1 = new User($conn);
                if ($user1->writingUser($id,$fName,$surName,$phone,$email,$password,$userType)) {
                    echo '<p>User created successfully.</p>';
                    echo '<a href="login.php">Return to Login page</a>';
                } else {
                    echo 'Error creating user.';
                }
            };
        ?>
    </body>
</html>


