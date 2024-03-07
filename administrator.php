<html>
    <head>
        <title>Administrator Page</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                }
        </style>
    </head>
    <body>
        <?php session_start(); ?>
        <div id="admindiv">
            <h1>WELCOME 
                <?php 
                    $name = $_SESSION["Name"];
                    echo $name;
                ?>
            </h1>
            <form method="post">
                <button type="submit" name="Insert">Insert a car</button>
            </form>

            <form method="post">
                <button type="submit" name="Search">Search for a car</button>
            </form>
            <form method="post">
                <button type="submit" name="Change">Change the status of a car</button>
            </form>

            
            <?php
                include "classCar.php";
                include "connectDB.php";
                $car = new Car($conn);
                if (isset($_POST["Insert"])){
                    echo "<h2>Please enter the Car information you want to rent out</h2>";
                    echo '<table>
                    <form action="insertNewCar.php" method="post">
                        <tr>
                            <td>
                                <label for="CarNo">CarNo</label>
                            </td>
                            <td>
                                <input type="text" name="CarNo">    
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Plates">Plates</label>
                            </td>
                            <td>
                                <input type="text" name="Plates">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Model">Model</label>
                            </td>
                            <td>
                                <input type="text" name="Model">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Type">Type</label>
                            </td>
                            <td>
                                <input type="text" name="Type">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Status">Status</label>
                            </td>
                            <td>
                                <input type="text" name="Status">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="CostPerDay">Cost per Day</label>
                            </td>    
                            <td>
                                <input type="text" name="CostPerDay">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="enterInfoCar">
                            </td>
                        </tr>
                    </form>
                    </table>';
                };

                if (isset($_POST["Search"])){
                    echo "<h2>Please enter type of Car you want to search</h2>";
                    echo "<table>";
                    echo "<form action='searchCar.php' method='post'>";
                    echo 
                    '<tr>
                        <td>
                            <label for="Plates">Plates</label>
                        </td>
                        <td>
                            <input type="text" name="Plates">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Model">Model</label>
                        </td>
                        <td>
                            <input type="text" name="Model">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Status">Type</label>
                        </td>
                        <td>
                            <input type="text" name="Type">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="SearchInfoCar">
                        </td>
                    </tr>';
                    echo "</form>";
                    echo "</table>";
                };
                if (isset($_POST["Change"])){
                    echo "<table>";
                    echo "<form action='changeStatusOfCar.php' method='post'>";
                    
                    echo "<h2>Which car you want to change status</h2>";
                    
                    echo "<tr>";
                    echo 
                    '<td>
                        <label for="CarNo">Car Number</label>
                    </td>
                    <td>
                        <input type="text" name="CarNo">
                    </td>
                    <tr>
                    <td>
                        <label for="newStatus">New Status</label>
                    </td>
                    <td>
                        <input type="text" name="newStatus">
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="ChangeStatusCar">
                        </td>
                    </tr>';
                    echo "</tr>";
                    echo "</table>";
                };

                echo "<table>";
                echo "<tr>";
                echo "<th>CarNo</th>";
                echo "<th>Plates</th>";
                echo "<th>Model</th>";
                echo "<th>Type</th>";
                echo "<th>Status</th>";
                echo "<th>Cost per Day (unit: Dollar)</th>";

                echo "<h1>List of all rental car</h1>";
                foreach ($car->getAllCars() as $cars ){   
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
                echo "</br>";
                echo "<a href='logout.php'>Log Out</a>";
            ?>

        </div>
    </body>
</html>

