<?php
    include "classCar.php";
    include "connectDB.php";
    $car= new Car($conn);
    if (isset($_POST['ChangeStatusCar'])){
        $CarNo = $_POST["CarNo"];
        $newStatus = $_POST["newStatus"];
        $car->changeCarStatus($CarNo,$newStatus);
        header( "Location: administrator.php" );
    }
?>