<?php
require_once 'database.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsed">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <span class="navbar-brand">Log System</span>
        </div>
        <p class="navbar-text"></p>
        <div class="collapse navbar-collapse" id="collapsed">
            <ul class="nav navbar-nav">
                <li class="active"><a href="dashboard.php">Home</a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Task
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#myModal">Add New</a></li>
                        <li><a href="#">Show All</a></li>
                        <li><a href="#">Export as PDF</a></li>
                    </ul>
                </li>
                <li><a href="#">About</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username'];?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="singout.php">Log out</a></li>

                    </ul>
                </li>
            </ul>


        </div>

    </div>
</nav>


<?php
$query = "select task_id, task_added_by, task_title, task_desc, task_station, task_create_date, task_due_date, task_status from task where 1";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

?>


<div class="container" style='padding-top: 80px'>

    <?php

    while($row = $result ->fetch_assoc()) {

    echo "<div class='row' >";
        echo "<div class='col-md-12'>";

                echo "<div class='panel panel-info'>";
                    echo "<div class='panel-heading'>";

                            echo "<h3 class='panel-title' style='display: inline'><b>$row[task_title]</b> added by: </h3><p class='badge' style='display: inline'>$row[task_added_by]</p> <p style='display: inline'> Duty Station: $row[task_station]</p> </div>";

                            echo "<div class='panel-body'><p style='word-wrap: break-word;'>$row[task_desc]</p></div>";

                            echo "<div class='panel-footer panel-info'><p style='display: inline'>Created date: $row[task_create_date]</p> <p style='display: inline'> Due Date: $row[task_due_date]</p> <span><button class='btn btn-info btn-sm dialog' data-id=$row[task_id] data-toggle='modal' data-target='#myModal2' style='float: right; vertical-align: middle'>Edit</button></span></div>";


    echo "</div>";


    echo "</div>";
        echo "</div>";

    }
?>
</div>



<!-- modal for adding a task -->

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Task</h4>
            </div>
            <div class="modal-body">

                <form action="dashboard.php" method="post" >

                    <div class="form-group">
                        <label>Task Title:</label>
                        <input class="form-control" type="text" name="task_title">
                    </div>

                    <div class="form-group">
                        <label>Task Desc:</label><br>
                        <textarea id="taskTitle" rows="5" cols="75" name="task_desc"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Task Station:</label>
                        <input class="form-control" type="text" name="task_station"">
                    </div>

                    <div class="form-group">
                        <label>Due Date:</label>
                        <input class="form-control" type="text" name="task_due_date">
                    </div>

                    <input type="submit" name="add" class="btn btn-success" value="Add">

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>





<!-- modal for editing a task -->

<div id="myModal2" class="modal fade">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Task</h4>
            </div>
            <div class="modal-body">



                <input type="text" name="bookId" id="bookId" value=""/>
                <?php

                $account = $_get['account'];

                echo "asdsa";
                ?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<?php
if(isset($_POST['add'])) {

    $task_added_by = $_SESSION['member_id'];
    $date = date("Y/m/d");
    $task_title = $_POST['task_title'];
    $task_desc = $_POST['task_desc'];
    $task_station = $_POST['task_station'];
    $task_due_date = $_POST['task_due_date'];

    $query = "insert into task(task_added_by,task_title,task_desc,task_station,task_create_date,task_due_date,task_status) values ('$task_added_by','$task_title','$task_desc','$task_station','$date','$task_due_date','1')";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    header("location: redirect.php");
    exit;
}
?>
<div class="footer">

</div>
</body>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>
$(document).on("click", ".dialog", function () {
var myBookId = $(this).data('id');
$(".modal-body #bookId").val( myBookId );


    function displayVals() {
        var singleValues = $("#bookId").val();

        $.ajax({
            url: "dashboard.php",
            type: "GET",
            data: {bookId: singleValues},
            async: false
        });

        $("p").html("<b>Single:</b> " + singleValues);
    }


});
</script>






</html>


