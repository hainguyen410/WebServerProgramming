<html>
    <head>
        <title>
            Register
        </title>
        <style>
            .register_div{
                margin: auto;
                width: 50%;
                border: 3px solid green;
                padding: 10px;
                color: white;
                font-size: large;
                background-color: #89927E;
            }
            #title{
                text-align: center;
                color: white;
            }
            body {
            background-image: url("rentCarImg.jpg");
            background-color: #cccccc;
            }
            #register{
                color: white;
                
            }
            
        </style>
    </head>
    <body>
        <div class="register_div">
            <h1 id="title">Welcome to My Rent Buddy Registration</h1>
            <table id="register">
                <form id="form" action="writing_newuser.php" method="post">
                    <tr>
                        Personal Information
                    </tr>
                    <tr>
                        <td>
                            <label for="fName">
                                First name
                            </label>
                        </td>
                        <td>
                            <input type="text" name="fName">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="surName">
                                Surname 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="surName">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="phone">
                                Phone
                            </label>
                        </td>
                        <td>
                            <input type="text" name="phone">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email</label>
                        </td>
                        <td>
                            <input type="text" name="email">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Password</label>
                        </td>
                        <td>
                            <input type="password" name="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Select user type:
                        </td>
                        <td>
                            <input type="radio" name="userType" value="admin"/>Administrator<br/>
                            <input type="radio" name="userType" value="renter"/>Renter
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <input type="submit" name="submit">
                        </td>
                        <td>
                            <a href="login.php">Return to Login page</a>
                        </td>
                    </tr>
                </form>
            </table>

        </div>        
            
    </body>
</html>