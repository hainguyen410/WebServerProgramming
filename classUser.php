<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    private function escapeInput($input) {
        return mysqli_real_escape_string($this->db, $input);
    }

    private function executeQuery($query) {
        $result = mysqli_query($this->db, $query);
        if ($result) {
            return $result;
        } else {
            throw new Exception("Database query failed: " . mysqli_error($this->db));
        }
    }

    // Method to insert a new user into the database
    public function writingUser($firstName, $lastName, $phone, $email, $password, $userType) {
        $firstName = $this->escapeInput($firstName);
        $lastName = $this->escapeInput($lastName);
        $phone = $this->escapeInput($phone);
        $email = $this->escapeInput($email);
        $password = md5($this->escapeInput($password));
        $userType = $this->escapeInput($userType);

        $query = "INSERT INTO User (Name, Surname, Phone, Email, Password, Type)
                  VALUES ('$firstName', '$lastName', '$phone', '$email', '$password', '$userType')";
        try {
            $this->executeQuery($query);
            return true; // User created successfully
        } catch (Exception $e) {
            return false; // Error creating user
        }
    }

    // Method to check user password and handle login
    public function checkPassword($email, $password) {
        $email = $this->escapeInput($email);
        $password = md5($this->escapeInput($password));

        $query = "SELECT * FROM User WHERE Email = '$email'";
        try {
            $result = $this->executeQuery($query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if ($password == $row['Password']) {
                    $this->startUserSession($row);
                    $this->redirectUser($email);
                } else {
                    echo "<p>Your password is wrong, please enter again</p>";
                }
            }
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }

    // Helper method to start a user session
    private function startUserSession($userData) {
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $userData['Email'];
        $_SESSION['Name'] = $userData['Name'];
    }

    // Helper method to redirect user based on their role
    private function redirectUser($email) {
        $query = "SELECT Type FROM User WHERE Email = '$email'";
        $result = $this->executeQuery($query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userRole = $row['Type'];

            if ($userRole == 'admin') {
                header("Location: administrator.php");
                exit();
            } elseif ($userRole == 'renter') {
                header("Location: renter.php");
                exit();
            }
        }
    }
}
?>
