<?php 
    class Car {
        // Properties and methods go here
        private $db;
        private $carNo;
        private $plates;
        private $model;
        private $type;
        private $status;
        private $costPerDay;
        public function __construct($db){
            $this->db = $db;
        }
        public function setCarDetails($carNo, $plates, $model, $type, $status, $costPerDay) {
            $this->carNo = $carNo;
            $this->plates = $plates;
            $this->model = $model;
            $this->type = $type;
            $this->status = $status;
            $this->costPerDay = $costPerDay;
        }
        public function insertCar ($CarNo, $Plates, $Model, $Type, $Status, $CostPerDay){
            $CarNo = mysqli_real_escape_string($this->db,$CarNo);
            $Plates = mysqli_real_escape_string($this->db,$Plates);
            $Model = mysqli_real_escape_string($this->db,$Model);
            $Type = mysqli_real_escape_string($this->db,$Type);
            $Status = mysqli_real_escape_string($this->db,$Status);
            $CostPerDay = mysqli_real_escape_string($this->db,$CostPerDay);

            $sql = "INSERT INTO Car(CarNO, Plates, Model, Type, Status, CostPerDay) 
                    Values ('$CarNo','$Plates','$Model','$Type','$Status',$CostPerDay)";
            if (mysqli_query($this->db,$sql)){
                echo "<p>you have inserted a car</p>";
            } else {
                echo "<p>your insertion has been rejected</p>";
            }
        }
        public function getAllCars(){
            // Prepare the SQL query
            $query = "SELECT * FROM Car";

            // Execute the query
            $result = mysqli_query($this->db, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                return mysqli_fetch_all($result, MYSQLI_ASSOC); // Return array of cars
            } else {
                return []; // No cars found
            }
        }
        
        public function searchCar($plates, $model, $type){
            $plates = mysqli_real_escape_string($this->db,$plates);
            $model = mysqli_real_escape_string($this->db,$model);
            $type = mysqli_real_escape_string($this->db,$type);
            $sql = "SELECT * FROM Car WHERE Plates = '".$plates."' AND Model = '".$model."' AND Type='".$type."'";
            $result = mysqli_query($this->db, $sql);
            if ($result && mysqli_num_rows($result)>0){
                return mysqli_fetch_all($result,MYSQLI_ASSOC);
            } else {
                return []; 
            }
        }
        function changeCarStatus($carId, $newStatus) {
            
            // Sanitize the input to prevent SQL injection
            $carId = mysqli_real_escape_string($this->db, $carId);
            $newStatus = mysqli_real_escape_string($this->db, $newStatus);
        
            // Update the status of the car
            $query = "UPDATE Car SET Status = '$newStatus' WHERE CarNo = '$carId'";
            $result = mysqli_query($this->db, $query);
        
            if ($result) {
                if (mysqli_affected_rows($this->db) > 0) {
                    echo "Car status updated successfully.";
                } else {
                    echo "No matching car found.";
                }
            } else {
                echo "Error updating car status: " . mysqli_error($this->db);
            }
        
            // Close the database connection
            mysqli_close($this->db);
        }
        function listAvailableCars() {
            global $connection; // Assuming $connection is your database connection object
        
            // Query to retrieve cars with status = 'available'
            $query = "SELECT * FROM Car WHERE Status = 'Available'";
            $result = mysqli_query($this->db, $query);
        
            // Check if query execution was successful
            if ($result) {
                // Check if there are any available cars
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
                    // Loop through the result set and display car details
                    while ($cars = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $cars["CarNo"].'</td>';
                        echo '<td>'. $cars["Plates"].'</td>';
                        echo '<td>'. $cars["Model"].'</td>';
                        echo '<td>'. $cars["Type"].'</td>';
                        echo '<td>'. $cars["Status"].'</td>';
                        echo '<td>'. $cars["CostPerDay"].'</td>';
                        echo '<td><form action="rentCarContractForm.php" method="post">
                        <input type="hidden" name="CarNo" value="'.$cars['CarNo'].'">
                        <input type="hidden" name="Price" value="'.$cars['CostPerDay'].'">
                        <button type="submit">Rent</button>
                        </form></td>';
                        echo '</tr>';
                    }
        
                    echo "</table>";
                } else {
                    echo "No available cars found.";
                }
            } else {
                echo "Error executing the query: " . mysqli_error($this->db);
            }
        
            // Free the result set
            mysqli_free_result($result);
        }
            public function displayRentalCar ($name){
                $name = mysqli_real_escape_string($this->db,$name);
                $query = "SELECT * FROM rentals WHERE renter_name = '".$name."'";

                // Execute the query
                $result = mysqli_query($this->db, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    return mysqli_fetch_all($result, MYSQLI_ASSOC); // Return array of cars
                } else {
                    return []; // No cars found
                }
            }
        }
        
        
    
?>