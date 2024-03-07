<?php
    include "classCar.php";
    include "connectDB.php";
    $car = new Car($conn);
    if (isset($_POST["enterInfoCar"])){
        $CarNo = $_POST["CarNo"];
        $Plates = $_POST["Plates"];
        $Model = $_POST["Model"];
        $Type = $_POST["Type"];
        $Status = $_POST["Status"];
        $CostPerDay = $_POST["CostPerDay"];
        $car->insertCar($CarNo,$Plates,$Model,$Type,$Status,$CostPerDay); 
        header( "Location: administrator.php" );
    } 
?>