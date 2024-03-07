<html>
    <head>
        <title>writingRentalContract</title>
    </head>
    <body>
    <?php
        include "connectDB.php";
        if(isset($_POST["RentCar"])){
            $CarNo = $_POST["CarNo"];
            $name = $_POST["Name"];
            $rental_length = $_POST["rental_length"];
            $return_date = $_POST["return_date"];
            $price = $_POST["Price"];
            echo '<p>'. $CarNo.'</p>';
            echo '<p>'. $name.'</p>';
            echo '<p>'. $rental_length.'</p>';
            echo '<p>'. $return_date.'</p>';
            echo '<p>'. $price.'</p>';
            
    
            $query = "INSERT INTO rentals (car_id, renter_name, length_of_renting, return_date, Price)
                    VALUES ('".$CarNo."',
                            '".$name."',
                            ".$rental_length.",
                            '".$return_date."',
                            ".$price."
                    )";
            if (mysqli_query($conn, $query)){
                echo "<p>You have successfully rented a car</p>";
            } else {
                echo "<p>your have failed to rent a car. Please try again</p>";
            }
            
        }
        
    ?>
    <button onclick="window.location.href='renter.php';">
      Return to Homepage
    </button>
    </body>

