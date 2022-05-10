<?php
    session_start();
    if(isset($_SESSION['ismember']))
    {
        if($_SESSION['ismember']==1)
        {
            try {


                $db = new mysqli('localhost', 'root', '', 'web-project');
                $qry = "select * from user";
                $res = $db->query($qry);
                for ($i = 0; $i < $res->num_rows; $i++) {
                    $row = $res->fetch_object();

                    if ($row->email == $_SESSION['email']) {

                        $_SESSION['firstName'] = $row->firstName;
                        $_SESSION['lastName'] = $row->lastName;
                        $_SESSION['fullName'] = strtoupper(" " . $row->firstName . " " . $row->lastName);
                        $_SESSION['phoneNumber'] = $row->phoneNumber;
                        $_SESSION['country'] = $row->country;
                        $_SESSION['bio'] = $row->Bio;
                    }
                }
                $db->close();
            }
            catch (exception $ex){

            }

        }
        else{
            header("travelGuest.php");


        }

    }
    else{
        header("travelGuest.php");
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="traveling.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css"/>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>

    <script type="text/javascript" src="traveling.js"></script>

    <script src="https://kit.fontawesome.com/d2dd247174.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Rajdhani:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet"> <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Outdoors</title>


    <?php
    @session_start();
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

    <?php

   // adding a user functions
    function add_new_user($user_obj)
    {
        $conn = creat_conn();
        $prepare = $conn->prepare("INSERT INTO `user` (`firstName`,`lastName`, `password`,`phoneNumber`, `email`,`birthDate`,`Bio`,`country`) VALUES (?,?,?,?,?,?,null,?)");

        try {
            $prepare->bind_param('sssssss', $user_obj['firstname'], $user_obj["lastname"], $user_obj["password"], $user_obj["phonenumber"], $user_obj["email"], $user_obj["birthDate"], $user_obj["country"]);

            $prepare->execute();

            return "success";

        } catch (Exception $e) {

                return "wrong";

        }
    }


    function create_new_user()
    {
        $email = "";
        $firstname = "";
        $lastname = "";
        $password = "";
        $repassword = "";
        $phonenumber = "";
        $birthdate = "";
        $country = "";



        if (isset($_POST["email"])) {
            $email = $_POST["email"];
        }
        if (isset($_POST["firstname"])) {
            $firstname = $_POST["firstname"];
        }
        if (isset($_POST["lastname"])) {
            $lastname = $_POST["lastname"];
        }
        if (isset($_POST["password"])) {
            $password = $_POST["password"];
        }
        if (isset($_POST["repassword"])) {
            $repassword = $_POST["repassword"];
        }
        if (isset($_POST["phonenumber"])) {
            $phonenumber = $_POST["phonenumber"];
        }
        if (isset($_POST["birthDate"])) {
            $birthdate = $_POST["birthDate"];
        }
        if (isset($_POST["country"])) {
            $country = $_POST["country"];
        }

        if ($password == $repassword && $password != "") {

            $user_obj["email"] = $email;
            $user_obj["firstname"] = $firstname;
            $user_obj["lastname"] = $lastname;
            $user_obj["password"] = $password;
            $user_obj["repassword"] = $repassword;
            $user_obj["phonenumber"] = $phonenumber;
            $user_obj["birthDate"] = $birthdate;
            $user_obj["country"] = $country;


            $result = add_new_user($user_obj);

            if ($result == "success") {
                ?>

                <div class="alert alert-success">
                    <strong>Success you can login using this acount!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

               <?php
    } else {
                ?>

                <div class="alert alert-danger">
                    <strong>the email exists!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php
            }

        } else {
            ?>

            <div class="alert alert-danger">
                <strong>the password and confirmation password does not match!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php
        }

    }

    ?>

<!--    login functions-->
    <?php


    function check_login_email($email)
    {

        $item = "";
        $conn = creat_conn();
        try {
            $prepare = $conn->prepare("select * from `user` where email=?");
            $prepare->bind_param('s', $email);
            $prepare->execute();
            $result = $prepare->get_result();
            $item = $result->fetch_object();

            return $item;

        } catch (Exception $e) {
            return $item;
        }
    }

    function check_login_password($password)
    {
        $item = "";
        $conn = creat_conn();
        try {
            $prepare = $conn->prepare("select * from `user` where password=?");
            $prepare->bind_param('s', $password);
            $prepare->execute();
            $result = $prepare->get_result();
            $item = $result->fetch_object();

            return $item;
        } catch (Exception $e) {

            return $item;
        }
    }




    ?>

<!--    showing data from database-->




</head>
<body>
<header class="backGround ">
    <!--      phrase   -->
    <h2 class="phrase ">outdoors is where life happens</h2>
    <!--       /phrase -->

    <!--      navbar   -->
    <nav class="navbar navbar-expand-md navbar-fixed-top myNavbar">
        <button class="navbar-toggler show-hided  fa fa-bars btn" style="margin-top: 10px;margin-left: 10px;" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container-fluid collapse navbar-collapse" id="collapsibleNavbar">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Outdoors</a>
            </div>
            <ul class="nav navbar-nav">

                <li class="active"><a
                            href=""">Home</a>
                </li>
                <li>
                    <a href="AttractionUser.php">Attraction</a>
                </li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--                signup -->
                <li><a href="profile.php"> <span id = "fullname"

                                class=" glyphicon glyphicon-user "> </span></a></li>
                <!--                sign in-->
                <li><a data-toggle="modal" data-target="#exampleModalCenter" href="travelGuest.php"><span
                                class="glyphicon glyphicon-log-in"></span> Log Our</a></li>


            </ul>
        </div>
    </nav>
    <!--      /navbar   -->

    <!--      searchbar   -->
    <nav class="navbar navbar-expand-sm  searchBar" style="width: 36%;">
        <div style="width: 100%">
            <form class="navbar-form row clear" action="#" style="width: 100%;">
                <div class="col-sm-5 align" style="margin-right: 90px">
                    <input type="text" class="form-control input-style" placeholder="Search" name="search">
                </div>
                <!--      date picker   -->

                <div class="input-group-date input-group col-sm-4" style="margin-left: 10px">
                    <input type="text" class="pointer-cursor-date" name="daterange" value="01/01/2015 - 01/31/2015"/>

                    <script type="text/javascript">
                        $(function () {
                            $('input[name="daterange"]').daterangepicker();
                        });
                    </script>

                </div>
                <div class="col-sm-4 pull-right input-group" style="width: 8% !important;">
                    <button class="btn btn-primary pull-right " type="submit"> search</button>
                </div>

            </form>
        </div>
    </nav>
    <!--     / searchbar   -->
    <script type="text/javascript">
        document.getElementById('fullname').innerHTML="<?php echo $_SESSION['fullName']?>"
    </script>
    <!--      sign in   -->
    <div class="modal fade sign-in" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " style="display: inline-block" id="exampleModalLongTitle">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="shape">
                        <form method="POST" action="?action=sign-in">
<!--                            email input-->
                            <div class="form-outline mb-4 control-container">
                                <label class="form-label " for="form2Example1">Email address</label>
                                <input type="email" name="login-email" class="form-control"/>
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-4 control-container">
                                <label class="form-label" for="form2Example2">Password</label>
                                <input type="password" name="login-password" class="form-control"/>
                            </div>

<!--                            the php session-->




                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4 control-container">
                                <div class="col d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="form2Example31"
                                               checked/>
                                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <!-- forgetting password -->
                                    <a href="#!">Forgot password?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit"
                                    class="btn btn-primary btn-lg btn-block mb-4 control-container main-color">Sign
                                in
                            </button>
                        </form>




                        <!-- Register buttons -->
                        <div class="text-center">
                            <p>Not a member? <a class="btn" data-toggle="modal" data-target="#exampleModal"
                                                class="close" data-dismiss="modal" aria-label="Close"
                                                href="#">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--      /sign in   -->

    <!--      register   -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 style="display: inline-block">Sign Up</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="signup-form sign-up-design">
                        <p>Please fill in this form to create an account!</p>
                        <form method="POST" action="?action=newUser">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6"><input type="text" class="form-control" name="firstname"
                                                                 placeholder="First Name" required="required"></div>
                                    <div class="col-xs-6"><input type="text" class="form-control" name="lastname"
                                                                 placeholder="Last Name" required="required"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                       required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                       required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="repassword"
                                       placeholder="Confirm Password" required="required">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6"><input type="text" class="form-control" name="phonenumber"
                                                                 placeholder="phone number" required="required"></div>
                                    <div class="col-xs-6"><input type="text" class="form-control" name="country"
                                                                 placeholder="country" required="required"></div>
                                </div>
                                <input type="date" class="form-control" name="birthDate"
                                       required="required" style="margin-top: 10px">

                            </div>
                            <div class="form-group">

                                <label class="checkbox-inline"><input type="checkbox" required="required"> I accept the
                                    <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
                            </div>
                        </form>
                        <div class="hint-text">Already have an account? <a class="btn " data-toggle="modal"
                                                                           data-target="#exampleModalCenter"
                                                                           class="close" data-dismiss="modal" href="#">Login  here</a></div>

                           </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--      /register  -->
    <!--    controller -->
    <?php

    switch ($action) {
        case "newUser":
            create_new_user();
            break;
        case "sign-in":
            get_login_data();
            break;

        default:
    }

    ?>

</header>


</div>
<div style="position: absolute; top: 51%; width: 100%;">
    <h1 style="text-align: center; width: 100%;">Explore the world with us!</h1>
</div>

<!--adds -->

<div class="Destenation text-center" style="position: absolute; top: 62%">

    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-4 pointer-cursor-adds">

            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="London">

                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal"
                   data-target="#conform-flight" href="#"></a>
                <img src="pics/attraction/londn.jpeg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-4 pointer-cursor-adds">

            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Maldives">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal"
                   data-target="#conform-flight" href="#"></a>

                <img src="pics/attraction/maldives.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-4 pointer-cursor-adds">

            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Berlin">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal"
                   data-target="#conform-flight" href="#"></a>

                <img src="pics/attraction/berlin.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-6 pointer-cursor-adds">

            <div class="box bg-white" style="margin: 5px;padding-bottom: 0px;" data-work="Humburg">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal"
                   data-target="#conform-flight" href="#"></a>

                <img src="pics/attraction/humburg.jpg" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-6 pointer-cursor-adds">

            <div class="box bg-white " style="margin: 5px;padding-bottom: 0px;" data-work="Istanbul">
                <a style="width:100%; height: 100%; position: absolute " data-toggle="modal"
                   data-target="#conform-flight" href="#"></a>


                <img src="pics/attraction/istanbul.jpg" alt="" class="img-fluid ">
            </div>
        </div>


    </div>
</div>
<!--/adds -->

<!--book flights-->

<div class="modal fade" id="conform-flight" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="text-align: center; padding-bottom: 2px !important; " class="modal-header">

                <h2 style="display: inline-block; margin-top: 10px !important;">book flight</h2>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="text-align: center" class=" popup-design">
                    <div class="row">
                        <div class="col-xs-6"><input type="text" class="form-control" name="from"
                                                     placeholder="From" required="required"></div>
                        <div class="col-xs-6"><input type="text" class="form-control" name="Destination"
                                                     placeholder="Destination" required="required"></div>
                    </div>
                </div>
                <div style="margin-bottom:10px " class="row">
                    <div > <p style="display: inline-block; text-align: initial; width: 100px;margin-left: 100px">Flight Date</p>
                        <p style="display: inline-block; margin-left: 210px">Flight Time</p>
                    </div>
                    <div class="col-xs-6"><input type="date" class="form-control" name="start-date"
                                                 required="required"></div>
                    <div class="col-xs-6"><input type="time" class="form-control" name="end-date"
                                                 required="required"></div>
                </div>
                <div class="row">
                    <div class="col-xs-6"><input type="text" class="form-control" name="price"
                                                 placeholder="Price" required="required"></div>
                    <div class="col-xs-6"><input type="text" class="form-control" name="flightID"
                                                 placeholder="flight id" required="required"></div>
                </div>
                <div style="text-align: center">
                    <p>Trip description</p>
                    <input style="height: 80px; margin-bottom: 5px;" type="text" class="form-control" name="desc"
                           required="required">
                </div>

                    <p>Please fill in all the data required to book a new flight</p>
                    <form action="/examples/actions/confirmation.php" method="post">
                        <div class="form-group ">

                            <div><input type="text" class="form-control booking-popup-text" name="number-of-travellers"
                                        placeholder="number of travellers" required="required"></div>

                        </div>

                        <div><input style=" margin-bottom: 10px" type="text" class="form-control" name="start-date"
                                    placeholder="payment" required="required"></div>

                        <div style="text-align: center" class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">book flight</button>


                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--/book flights-->

</body>



</html>
