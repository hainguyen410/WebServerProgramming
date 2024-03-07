<html>
    <head>
        <title>Administrator Page</title>
    </head>
    <body>
            <h1>WELCOME 
                <?php 
                    session_start();
                    $name = $_SESSION["Name"];
                    echo $name;
                ?>
            </h1>
            
        <form method="post">
            <button type="submit" name="listAllAvailableCar">List All Available Car</button>
        </form>

        <?php
            include "classCar.php";
            include "connectDB.php";
            $car = new Car($conn);
            if(isset($_POST["listAllAvailableCar"])){
                $car->listAvailableCars();
            }

            echo "<table>";
                echo "<tr>";
                echo "<th>Rental ID</th>";
                echo "<th>Car ID</th>";
                echo "<th>Renter Name</th>";
                echo "<th>Length of Renting</th>";
                echo "<th>Return Date</th>";
                echo "<th>Price</th>";

                echo "<h1>List of all of your rented and renting car</h1>";
                foreach ($car->displayRentalCar($name) as $cars ){   
                    echo '<tr>';
                    echo '<td>'. $cars["rental_id"].'</td>';
                    echo '<td>'. $cars["car_id"].'</td>';
                    echo '<td>'. $cars["renter_name"].'</td>';
                    echo '<td>'. $cars["length_of_renting"].'</td>';
                    echo '<td>'. $cars["return_date"].'</td>';
                    echo '<td>'. $cars["Price"].'</td>';
                    echo '</tr>';
                }
            echo "</table>";
            echo "</br>";
            echo "<a href='logout.php'>Log Out</a>";
            
        ?>
    </body>
</html>