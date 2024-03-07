<?php
    class User {
        // Properties and methods go here
        private $db;
        public function __construct($db){
            $this->db = $db;

        }
        
        public function writingUser($Id, $firstName, $lastName, $phone, $email, $password, $userType){
            $Id = mysqli_real_escape_string($this->db, $Id);
            $firstName = mysqli_real_escape_string($this->db, $firstName);
            $lastName = mysqli_real_escape_string($this->db, $lastName);
            $phone = mysqli_real_escape_string($this->db, $phone);
            $email = mysqli_real_escape_string($this->db, $email);
            $password = mysqli_real_escape_string($this->db, $password);
            $userType = mysqli_real_escape_string($this->db, $userType);
            $hash_password = md5($password);
            
            $query = "INSERT INTO User(ID, Name, Surname, Phone, Email, Password, Type)
                    VALUES ('$Id','$firstName','$lastName','$phone','$email','$hash_password','$userType')";
            // Execute the query
            if (mysqli_query($this->db, $query)) {
                return true; // User created successfully
            } else {
                return false; // Error creating user
            }
        }
        public function checkPassword($email, $password){
        // Sanitize input data to prevent SQL injection
            $email = mysqli_real_escape_string($this->db, $email);
            $password = md5($password);

            // Prepare the SQL query to fetch the user's hashed password
            $query = "SELECT * FROM User WHERE Email = '$email'";

            // Execute the query
            $result = mysqli_query($this->db, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $storedPassword = $row['Password'];
                $firstName = $row['Name'];

                // Check if the provided password matches the stored hashed password
                if ($password==$storedPassword) {
                    session_start();
                    $_SESSION['logged_in'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['Name'] = $firstName;
                    $query = "SELECT Type FROM User WHERE Email = '$email'";
                    $result = mysqli_query($this->db, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $userRole = $row['Type'];

                        // Check the user's role and redirect accordingly
                        if ($userRole == 'admin') {
                            header("Location: administrator.php"); // Redirect to the admin homepage
                            exit();
                        } elseif ($userRole == 'renter') {
                            header("Location: renter.php"); // Redirect to the renter homepage
                            exit();
                        } 
                    }
                } else {
                    echo "<p> Your password is wrong, please enter again </p>";
                }
            }
            
           
        }
        
    }           
            ?>