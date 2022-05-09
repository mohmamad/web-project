<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d2dd247174.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Attraction.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Rajdhani:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Outdoors</title>

    <?php
    function creat_conn(){
        $host="localhost";
        $name="root";
        $pass="";
        $dbname="web-project";
        $conn=new mysqli($host,$name,$pass,$dbname);

        if(mysqli_connect_errno()){
            echo "cant connect to data base";
        }
        else{
            return $conn;
        }
    }

    $action = isset($_GET['action']) ? $_GET['action'] : "";

    ?>

<!--    add flight function-->

    <?php

    function add_new_flight($user_obj){
        $conn=creat_conn();
        $prepare=$conn->prepare("INSERT INTO `flights` (`flightId`,`des`, `flightDate`,`flightTime`, `source`,`description`,`price`) VALUES (null,?,?,?,?,?,?)");
        try{

            $prepare->bind_param('ssssss',$user_obj["Destination"],$user_obj["start-date"],$user_obj["end-date"],$user_obj["from"],$user_obj["desc"],$user_obj["Price"]);

            $prepare->execute();

            return "success";

        }catch(Exception $e){
           return "wrong";
        }
    }


    function create_new_flight()
    {
        $des = "";
        $flightdate = "";
        $flighttime = "";
        $source = "";
        $description = "";
        $price = "";
        if (isset($_POST["Destination"])) {
            $des = $_POST["Destination"];
        }
        if (isset($_POST["start-date"])) {
            $flightdate = $_POST["start-date"];
        }
        if (isset($_POST["end-date"])) {
            $flighttime = $_POST["end-date"];
        }
        if (isset($_POST["from"])) {
            $source = $_POST["from"];
        }
        if (isset($_POST["desc"])) {
            $description = $_POST["desc"];
        }
        if (isset($_POST["Price"])) {
            $price = $_POST["Price"];
        }


            $user_obj["Destination"] = $des;
            $user_obj["start-date"] = $flightdate;
            $user_obj["end-date"] = $flighttime;
            $user_obj["from"] = $source;
            $user_obj["desc"] = $description;
            $user_obj["Price"] = $price;

            $result = add_new_flight($user_obj);

            if ($result == "success") {

                ?>

                <div class="alert alert-success" style="position: absolute; top: 10%; width: 100%; opacity: 0.8">
                    <strong>new flight added successfully!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php
            } else {
                ?>

                <div class="alert alert-danger">
                    <strong>flight already exists!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php
            }

    }

    ?>

<!--    editing flights functions-->
    <?php

    function edit_flight_database($user_obj){
        try{
            $conn=creat_conn();
            $prepare=$conn->prepare("update  `flights` set (`flight-id`,`des`, `flight-date`,`flight-time`, `source`,`description`) VALUES (null,?,?,?,?,?) where flightId=?");
            $prepare->bind_param('sssss',$user_obj["Destination"],$user_obj["start-date"],$user_obj["end-date"],$user_obj["from"],$user_obj["desc"]);

            $prepare->execute();

            return "success";

        }catch(Exception $e){
            return "wrong";
        }
    }







    function edit_flight()
    {
    $des = "";
    $flightdate = "";
    $flighttime = "";
    $source = "";
    $description = "";
    if (isset($_POST["Destination"])) {
    $des = $_POST["Destination"];
    }
    if (isset($_POST["start-date"])) {
    $flightdate = $_POST["start-date"];
    }
    if (isset($_POST["end-date"])) {
    $flighttime = $_POST["end-date"];
    }
    if (isset($_POST["from"])) {
    $source = $_POST["from"];
    }
    if (isset($_POST["desc"])) {
    $description = $_POST["desc"];
    }


    $user_obj["Destination"] = $des;
    $user_obj["start-date"] = $flightdate;
    $user_obj["end-date"] = $flighttime;
    $user_obj["from"] = $source;
    $user_obj["desc"] = $description;

    $result = edit_flight_database($user_obj);

    if ($result == "success") {

    ?>

    <div class="alert alert-success" style="position: absolute; top: 10%; width: 100%; opacity: 0.8">
        <strong>new flight added successfully!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php
            } else {
                ?>

    <div class="alert alert-danger">
        <strong>flight already exists!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php
    }

    }


//    delete functions
     function delete_from_database($user_obj){
         $conn=creat_conn();
         $prepare=$conn->prepare("delete from  `flights`  where flightId=?");
         try{

             $prepare->bind_param('s',$user_obj["Flight_id"]);

             $prepare->execute();

             return "success";

         }catch(Exception $e){
             return "wrong";
         }
    }
    function delete_flight(){
        $flightID = "";
        if (isset($_POST["Flight_id"])) {
           $flightID = $_POST["Flight_id"];
        }

        $user_obj["Flight_id"] = $flightID;

        $result = delete_from_database($user_obj);
        if ($result == "success") {

            ?>

            <div class="alert alert-success" style="position: absolute; top: 10%; width: 100%; opacity: 0.8">
                <strong>flight deleted</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php
        } else {
            ?>

            <div class="alert alert-danger" style="position: absolute; top: 10%; width: 100%; opacity: 0.8">
                <strong>failed to delete flight!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php
        }
    }

    ?>
</head>

<body style="margin-top: 60px;">
<header>
    <!--    navbar-->
    <nav class="navbar navbar-expand-sm navbar-fixed-top myNavbar mt-5">
        <div class="container-fluid ">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Outdoors</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a data-toggle="modal" data-target="#NewTrip" href="#">Add new trip</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--                manager profile name -->
                <li><a><span> <img class=" img-fluid " src=" "> </span>Manager Name</a></li>
            </ul>
        </div>
    </nav>
    <!--    /navbar-->


</header>

<div class="attraction text-center mt-4" style="margin-top: 50px">
    <div class="container mt-4">
        <div class="main-title position-relative">
            <img src="pics/icons/topDest.png">
            <h2 class="mt-4 pt-4 d-block">Top Destination</h2>
            <p>Some text</p>
        </div>

    </div>

</div>
<div class="Destenation text-center">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="London">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/londn.jpeg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Maldives">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/maldives.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Berlin">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/berlin.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Humburg">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/humburg.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Istanbul">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/istanbul.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Oslo">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/oslo.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Palermo">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/palermo.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Paris">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/paris.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Pula">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/pula.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Rome">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/rome.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Sofia">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/sofia.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Stockholm">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/stockholm.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Vienna">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal" data-target="#edit-delete" href="#"></a>
                <img src="pics/attraction/veina.jpg" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

</body>

<!--    add new trip popup window-->

<div class="modal fade" id="NewTrip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="text-align: center; padding-bottom: 2px !important; " class="modal-header">
                <h2 style="display: inline-block; margin-top: 10px !important;">ADD flight</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="text-align: center" class=" popup-design">
                    <p>please fill all the required data to add a new Flight</p>
                    <form method="POST" action="?action=add-flight">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6"><input type="text" class="form-control" name="from"
                                                             placeholder="From" required="required"></div>
                                <div class="col-xs-6"><input type="text" class="form-control" name="Destination"
                                                             placeholder="Destination" required="required"></div>
                            </div>
                        </div>
                        <div style="margin-bottom:10px " class="row" >
                            <div > <p style="display: inline-block; text-align: initial; width: 200px;height: 15px;">Flight Date</p>
                                <p style="display: inline-block; margin-left: 20px; height: 15px">Flight Time</p>
                            </div>
                            <div class="col-xs-6"><input type="date" class="form-control" name="start-date"
                                                         required="required"></div>
                            <div class="col-xs-6"><input type="time" class="form-control" name="end-date"
                                                         required="required"></div>
                        </div>

                            <div style="margin-bottom: 10px; width: 100%;"><input type="text" class="form-control" name="Price"
                                                         placeholder="Price" required="required"></div>

                        <div style="text-align: center">
                            <p>Trip description</p>
                            <input style="height: 80px; margin-bottom: 5px;" type="text" class="form-control" name="desc"
                                   required="required">
                        </div>
                        <div style="text-align: center" class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Add Trip</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--    /add new trip popup window-->

<?php

switch ($action) {
    case "add-flight":
        create_new_flight();
        break;

    default:
}

?>

<!--edit and delete flights-->

<div class="modal fade" id="edit-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="text-align: center; padding-bottom: 2px !important; " class="modal-header">
                <h2 style="display: inline-block; margin-top: 10px !important;">Edit Flight</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="text-align: center" class=" popup-design">
                    <form method="POST" action="?action=delete-flight" >
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6"><input type="text" class="form-control" name="From"
                                                             placeholder="From" required="required"></div>
                                <div class="col-xs-6"><input type="text" class="form-control" name="Destination"
                                                             placeholder="Destination" required="required"></div>
                            </div>
                        </div>
                        <div style="margin-bottom:10px " class="row">
                            <div > <p style="display: inline-block; text-align: initial; width: 200px;">Flight Date</p>
                                <p style="display: inline-block; margin-left: 20px">Flight Time</p>
                            </div>
                            <div class="col-xs-6"><input type="date" class="form-control" name="start-date"
                                                         required="required"></div>
                            <div class="col-xs-6"><input type="time" class="form-control" name="end-date"
                                                         required="required"></div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6"><input type="text" class="form-control" name="Price"
                                                         placeholder="Price" required="required"></div>
                            <div class="col-xs-6"><input type="text" class="form-control" name="Flight_id"
                                                         placeholder="Flight id" required="required"></div>
                        </div>

                        <div style="text-align: center">
                            <p>Trip description</p>
                            <textarea style="width: 100%; height: 150px"></textarea>
                        </div>
                        <div style="text-align: center" class="form-group">
                            <button  style="margin-right: 92px; width: 150px; height: 50px" type="submit" class="btn btn-primary btn-lg">delete flight</button>

                            <button style="width: 150px; height: 50px" type="submit" class="btn btn-primary btn-lg" formaction="?action=edit-flight">edit flight</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php

switch ($action) {
    case "add-flight":
        create_new_flight();
        break;
    case "edit-flight":

        edit_flight();
        break;
    case "delete-flight":

        delete_flight();
        break;
    default:
}

?>
<!--/edit and delete flights-->

</html>