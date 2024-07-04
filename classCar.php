<?php
class Car {
    // Properties
    private $db;
    private $carNo;
    private $plates;
    private $model;
    private $type;
    private $status;
    private $costPerDay;

    // Constructor
    public function __construct($db) {
        $this->db = $db;
    }

    // Setter method for car details
    public function setCarDetails($carNo, $plates, $model, $type, $status, $costPerDay) {
        $this->carNo = $carNo;
        $this->plates = $plates;
        $this->model = $model;
        $this->type = $type;
        $this->status = $status;
        $this->costPerDay = $costPerDay;
    }

    // Helper method to escape input
    private function escapeInput($input) {
        return mysqli_real_escape_string($this->db, $input);
    }

    // Helper method to execute a query
    private function executeQuery($query) {
        $result = mysqli_query($this->db, $query);
        if ($result) {
            return $result;
        } else {
            throw new Exception("Database query failed: " . mysqli_error($this->db));
        }
    }

    // Method to insert a new car into the database
    public function insertCar() {
        $carNo = $this->escapeInput($this->carNo);
        $plates = $this->escapeInput($this->plates);
        $model = $this->escapeInput($this->model);
        $type = $this->escapeInput($this->type);
        $status = $this->escapeInput($this->status);
        $costPerDay = $this->escapeInput($this->costPerDay);

        $sql = "INSERT INTO Car (CarNO, Plates, Model, Type, Status, CostPerDay) 
                VALUES ('$carNo', '$plates', '$model', '$type', '$status', $costPerDay)";
        try {
            $this->executeQuery($sql);
            echo "<p>You have inserted a car</p>";
        } catch (Exception $e) {
            echo "<p>Your insertion has been rejected: " . $e->getMessage() . "</p>";
        }
    }

    // Method to get all cars from the database
    public function getAllCars() {
        $query = "SELECT * FROM Car";
        try {
            $result = $this->executeQuery($query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Method to search for a car by plates, model, and type
    public function searchCar($plates, $model, $type) {
        $plates = $this->escapeInput($plates);
        $model = $this->escapeInput($model);
        $type = $this->escapeInput($type);
        $sql = "SELECT * FROM Car WHERE Plates = '$plates' AND Model = '$model' AND Type = '$type'";
        try {
            $result = $this->executeQuery($sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Method to change the status of a car
    public function changeCarStatus($carId, $newStatus) {
        $carId = $this->escapeInput($carId);
        $newStatus = $this->escapeInput($newStatus);
        $query = "UPDATE Car SET Status = '$newStatus' WHERE CarNo = '$carId'";
        try {
            $this->executeQuery($query);
            if (mysqli_affected_rows($this->db) > 0) {
                echo "Car status updated successfully.";
            } else {
                echo "No matching car found.";
            }
        } catch (Exception $e) {
            echo "Error updating car status: " . $e->getMessage();
        }
    }

    // Method to list all available cars
    public function listAvailableCars() {
        $query = "SELECT * FROM Car WHERE Status = 'Available'";
        try {
            $result = $this->executeQuery($query);
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>CarNo</th>";
                echo "<th>Plates</th>";
                echo "<th>Model</th>";
                echo "<th>Type</th>";
                echo "<th>Status</th>";
                echo "<th>Cost per Day (unit: Dollar)</th>";
                echo "<th>Rent Car Button</th>";
                echo "</tr>";
                while ($car = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $car["CarNo"] . '</td>';
                    echo '<td>' . $car["Plates"] . '</td>';
                    echo '<td>' . $car["Model"] . '</td>';
                    echo '<td>' . $car["Type"] . '</td>';
                    echo '<td>' . $car["Status"] . '</td>';
                    echo '<td>' . $car["CostPerDay"] . '</td>';
                    echo '<td><form action="rentCarContractForm.php" method="post">
                    <input type="hidden" name="CarNo" value="' . $car['CarNo'] . '">
                    <input type="hidden" name="Price" value="' . $car['CostPerDay'] . '">
                    <button type="submit">Rent</button>
                    </form></td>';
                    echo '</tr>';
                }
                echo "</table>";
            } else {
                echo "No available cars found.";
            }
        } catch (Exception $e) {
            echo "Error executing the query: " . $e->getMessage();
        }
    }

    // Method to display rental cars for a given renter name
    public function displayRentalCar($name) {
        $name = $this->escapeInput($name);
        $query = "SELECT * FROM rentals WHERE renter_name = '$name'";
        try {
            $result = $this->executeQuery($query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
}
?>
