<?php

require_once 'database.php';

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Log System - Login Page</title>



    </head>

    <body class="login-page">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="h1">
                    <div class="well-sm">
                    <h1 class="text-center" ><i>UNHCR ICT LOG PORTAL</i></h1>
                        <h1 class="text-center small" id="header-text-style">The unofficial UNHCR log portal</h1>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form action="login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input  placeholder="E-mail" name="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input  placeholder="Password" name="password" type="text" value="">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Login" class="btn btn-lg btn-info btn-block" />
                                <br>
                            </fieldset>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->





<?php
if(isset($_POST['submit'])){


    //Need to validate the username and password here!


    $username = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);

    $query ="select * from user where user_username = '$username' AND user_password = '$password'";
//Get results
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    $row = $result->fetch_assoc();
    $total = $result->num_rows;

    $name = $row['user_name'];
    $id = $row['user_id'];


    if($username == $row['user_username'] && $password == $row['user_password']){
        echo 'You are logged into system';

        session_start();
        $_SESSION['login'] = $username;
        $_SESSION['username'] = $name;
        $_SESSION['member_id'] = $id;
        $_SESSION['user_type'] = $row['user_status'];
        $_SESSION['field'] = $row['field_id'];

        echo $_SESSION['user_type'];

        if($_SESSION['user_type'] == 1){

            header('Location: dashboard.php');
        }

        elseif($_SESSION['user_type'] == 2){
            header('Location: teacher/index.php');
        }

        elseif($_SESSION['user_type'] == 3){
            header('Location: student/index.php');
        }

    }




}
?>

</body>
<script src="assets/js/bootstrap.min.js"></script>

</html>