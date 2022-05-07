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

    <?php

   // adding a user functions
    function add_new_user($user_obj)
    {
        $conn = creat_conn();
        $prepare = $conn->prepare("INSERT INTO `user` (`first-name`,`last-name`, `password`,`phone-number`, `email`) VALUES (?,?,?,?,?)");

        try {
            $prepare->bind_param('sssss', $user_obj['firstname'], $user_obj["lastname"], $user_obj["password"], $user_obj["phonenumber"], $user_obj["email"]);

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

        if ($password == $repassword && $password != "") {

            $user_obj["email"] = $email;
            $user_obj["firstname"] = $firstname;
            $user_obj["lastname"] = $lastname;
            $user_obj["password"] = $password;
            $user_obj["repassword"] = $repassword;
            $user_obj["phonenumber"] = $phonenumber;

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


    function get_login_data()
    {
        $email = "";
        $password = "";
        if (isset($_POST["login-email"])) {
            $email = $_POST["login-email"];
        }
        if (isset($_POST["login-password"])) {
            $password = $_POST["login-password"];
        }

        $emailresult = check_login_email($email);


        if ($emailresult == "") {
            ?>

            <div class="alert alert-danger">
                <strong>no matched email or password!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php
        } else {
            $passwordresult = check_login_password($password);
            if($passwordresult == ""){
                ?>

                <div class="alert alert-danger">
                    <strong>no matched email or password!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php
            }
            else {
                ?>

                <div class="alert alert-success">
                    <strong>login successfully</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php
            }
        }
    }


    ?>





</head>
<body>
<header class="backGround ">
    <!--      phrase   -->
    <h2 class="phrase ">outdoors is where life happens</h2>
    <!--       /phrase -->

    <!--      navbar   -->
    <nav class="navbar navbar-expand-sm navbar-fixed-top myNavbar mt-5">
        <div class="container-fluid ">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Outdoors</a>
            </div>
            <ul class="nav navbar-nav">

                <li class="active"><a
                            href="http://localhost:63342/webProject/travel.html?_ijt=nfl8040gbfj027ian69dghumid&_ij_reload=RELOAD_ON_SAVE#">Home</a>
                </li>
                <li>
                    <a href="http://localhost:63342/webProject/Attraction.html?_ijt=cih8aga574s0ri0abhjqnerdt4&_ij_reload=RELOAD_ON_SAVE">Attraction</a>
                </li>

                <li class="active"><a href="http://localhost:63342/webProject/travel.html?_ijt=nfl8040gbfj027ian69dghumid&_ij_reload=RELOAD_ON_SAVE#">Home</a></li>
                <li><a href="http://localhost:63342/webProject/Attraction.html?_ijt=cih8aga574s0ri0abhjqnerdt4&_ij_reload=RELOAD_ON_SAVE">Attraction</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--                signup -->
                <li><a data-toggle="modal" data-target="#exampleModal" href="#"> <span

                                class=" glyphicon glyphicon-user "> </span>Sign Up</a></li>
                <!--                sign in-->
                <li><a data-toggle="modal" data-target="#exampleModalCenter" href="#"><span
                                class="glyphicon glyphicon-log-in"></span> Login</a></li>


            </ul>
        </div>
    </nav>
    <!--      /navbar   -->

    <!--      searchbar   -->
    <nav class="navbar navbar-expand-sm  searchBar">
        <div>
            <form class="navbar-form row clear" action="#">
                <div class="col-sm-5 align" style="margin-right: 15px">
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
                <!--               number of travellers-->
                <div style="display: inline-block; height: 34px; width: 180px; margin-left: 10px">
                    <div class="number">
                        <span>number of adults:</span>
                        <span class="minus">-</span>
                        <input type="text" value="1" style="width: 20px; border:1px solid #1e47f3;"/>
                        <span class="plus">+</span>
                    </div>

                </div>


            </form>
        </div>
    </nav>
    <!--     / searchbar   -->
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

                                <input type="text" class="form-control" name="phonenumber"
                                       placeholder="phone number" required="required">
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

                    <p>Please fill in all the data required to add a new trip</p>
                    <form action="/examples/actions/confirmation.php" method="post">
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
                        <div style="text-align: center">
                            <p>Trip description</p>
                            <textarea style="width: 100%; height: 150px"></textarea>
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
<!--/book flights-->

</body>



</html>
