<html>
    <head>
        <title>Rental Car Details</title>
    </head>
    <body>
        <table>
            <?php 
              session_start();  
              $name = $_SESSION["Name"];
            ?>
            <form action="writingRentalCarContract.php" method="post">
            <tr>
                <th>The Car you want to rent</th>
                <th>
                    <?php 
                        if (isset($_POST["CarNo"])){
                            $CarNo = $_POST["CarNo"];
                            echo "<p>".$CarNo."</p>";
                        }   
                    ?>

                </th>
            </tr>
          <tr>
            <td>
              <label for="rental_length">Length of Renting (in days):</label>
            </td>
            <td>
              <input type="number" id="rental_length" name="rental_length" required>
            </td>
          </tr>
          <tr>
            <td>
              <label for="return_date">Return Date:</label>
            </td>
            <td>
              <input type="date" id="return_date" name="return_date" required>
            </td>
          </tr>
          <tr>
            <td>
              Overall Cost:
            </td>
            <td>
                    <?php 
                        if (isset($_POST["Price"])){
                            $price = $_POST["Price"];
                            echo "<p>".$price."$/day</p>";
                        }
                         
                    ?>
            </td>
          </tr>
          <tr>
            <td>
              <input type="hidden" name="CarNo" value="<?php echo $CarNo; ?>">
              <input type="hidden" name="Price" value="<?php echo $price; ?>">
              <input type="hidden" name="Name" value="<?php echo $name; ?>">
              <input type="submit" name="RentCar">
            </td>
          </tr>
        </form>
            <tr>
              <td>
                <a href='logout.php'>Log Out</a></br>
              </td>
              <td>
                <a href='renter.php'>Return to homepage</a>
              </td>
            </tr>
        </table>
        </br>
        
    </body>
</html>