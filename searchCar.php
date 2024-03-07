<html>
    <head>
        <title>Searching car</title>
    </head>
    <body>
        <?php  
            include "connectDB.php";
            include "classCar.php";
            $car= new Car($conn);
            if (isset($_POST['SearchInfoCar'])){
                $Plates = $_POST["Plates"];
                $Model = $_POST["Model"];
                $Type = $_POST["Type"];
                echo "<table>";
                echo "<tr>";
                echo "<th>CarNo</th>";
                echo "<th>Plates</th>";
                echo "<th>Model</th>";
                echo "<th>Type</th>";
                echo "<th>Status</th>";
                echo "<th>Cost per Day (unit: Dollar)</th>";
                echo "</tr>";
                foreach ($car->searchCar($Plates,$Model,$Type) as $cars ){     
                    echo '<tr>';
                    echo '<td>'. $cars["CarNo"].'</td>';
                    echo '<td>'. $cars["Plates"].'</td>';
                    echo '<td>'. $cars["Model"].'</td>';
                    echo '<td>'. $cars["Type"].'</td>';
                    echo '<td>'. $cars["Status"].'</td>';
                    echo '<td>'. $cars["CostPerDay"].'</td>';
                    echo '</tr>';
                }
                echo "</table>";
                echo '<a href="administrator.php">Return to homepage</a>';
            }
        ?>
    </body>
</html>
    