<?php
session_start();

    if($_SESSION['ismember']==10)
    {



    echo "laith mohsen";

    }
    else{
        header("travelGuest.php");


    }

    if (isset($_POST['fnameform']) || isset($_POST['lnameform']) || isset($_POST['bioform']) || isset($_POST['countryform']) || isset($_POST['phonenumberform'])){
        $_SESSION['firstName'] = $_POST['fnameform'];
        $_SESSION['lastName'] = $_POST['lnameform'];
        $_SESSION['bio'] = $_POST['bioform'];
        $_SESSION['country'] = $_POST['countryform'];
        $_SESSION['phoneNumber'] = $_POST['phonenumberform'];
        $r =1;

        $db = new mysqli('localhost', 'root', '', 'web-project');
        $qry="UPDATE `user` SET firstName =?,lastName=?,phoneNumber=?,Bio=?,country=? WHERE email=?";
        $stmt = $db->prepare($qry);
        $stmt->bind_param('ssssss',$_SESSION['firstName'],$_SESSION['lastName'],$_SESSION['phoneNumber'],$_SESSION['bio'],$_SESSION['country'],$_SESSION['email']);
        $stmt->execute();
        $_SESSION['fullName']=strtoupper(" ".$_SESSION['firstName']." ".$_SESSION['lastName']);


    }

?>


<!DOCTYPE html>
<html lang="en">
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
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet"> <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="profile.css">
    <title></title>
</head>
<body style="background-color: #2825250a;">
<!--start navbar-->
<header>
    <nav class="navbar navbar-expand-md  navbar-fixed-top myNavbar ">
        <button class="navbar-toggler show-hided  fa fa-bars btn" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container-fluid collapse navbar-collapse" id="collapsibleNavbar">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Outdoors</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="travelUser.php">Home</a></li>
                <li><a href="AttractionUser.php" >Attraction</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span id="fullnamenav" class="glyphicon glyphicon-user"></span ></a></li>
                <li><a href="travelGuest.php"><span class="glyphicon glyphicon-log-in" onclick="endsession()"></span> Log Out</a></li>
            </ul>
            <script>
                document.getElementById('fullnamenav').innerText="<?php echo $_SESSION['fullName']?>";
            </script>
        </div>
    </nav>
</header>

<!--end navbar-->
<form action="profile.php" method="POST">
<div class="container rounded bg-white"style="margin-top: 5px;margin-bottom: 5px;">
    <div class="row bigestrow"style="background-color: white;border: .4px solid #ff757c;">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center"style="margin-top: 29px;border-radius:5px; ">
                <img src="pics/icons/topDest.png" style="padding-right: 20px;">
                <h4 style="display: inline;color: #15bdb1;">Outdoors</h4>
                <img style="margin: 5px;display: block;margin-left: 51px;" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="text-black-50"style="font-weight: bolder" id="fullnamelabel"> </span></div>
        <script>
            document.getElementById('fullnamelabel').innerText="<?php echo $_SESSION['fullName'];?>";
        </script>
        </div>
        <div class="col-md-5 border-right"style="margin-top: 3px;border-right: .1px solid #13b9ae57;border-left: .1px solid #13b9ae57 ;margin-bottom: 20px;margin-top: 20px;">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-center fontlight"style="padding-top: 2px;">Profile Settings</h4>
                </div>

                <div class="row">
                    <div class="col-lg-12"><label class="labels">First Name</label><input name="fnameform" id="fnametxt"type="text" class="form-control"  value=""></div>
                    <div class="col-lg-12"><label class="labels">Last Name</label><input name="lnameform" id="lnametxt"type="text" class="form-control" value="" ></div>
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input name="phonenumberform" id="phonenumbertxt"type="text" class="form-control" value=""></div>
                    <div class="col-md-12"><label class="labels">Email ID</label><input name="emailform" id="emailidtxt"type="text" class="form-control"  value=""></div>
                    <div class="col-md-12"><label class="labels">Country</label><input name="countryform"id="countrytxt"type="text" class="form-control" value=""></div>
                    <div class="col-md-12 text-center"><button class="btn-primary profile-button"id="editprofilebtn"style="margin-bottom: 10px;margin-top: 10px;width: 100%;height: 49px;border-radius: 5px;background: rgb(21 189 177 / 77%);" type="button" onclick="editprofile()">Edit Profile</button></div>
                    <div class="col-md-12 text-center"><input type="submit"value="Save Profile" name="saveprofileform" id="saveprofilebtn"style="display:none;margin-bottom: 10px;margin-top: 10px;width: 100%;height: 49px;border-radius: 5px;background: rgb(21 189 177 / 77%);" type="button" onclick=""></div>
                    <script type="text/javascript">
                        document.getElementById('fnametxt').readOnly=true;
                        document.getElementById('lnametxt').readOnly=true;
                        document.getElementById('emailidtxt').readOnly=true;
                        document.getElementById('countrytxt').readOnly=true;
                        document.getElementById('phonenumbertxt').readOnly=true;

                        document.getElementById('fnametxt').value="<?php echo $_SESSION['firstName'];?>";
                        document.getElementById('lnametxt').value="<?php echo $_SESSION['lastName'];?>";
                        document.getElementById('emailidtxt').value="<?php echo $_SESSION['email'];?>";
                        document.getElementById('countrytxt').value="<?php echo $_SESSION['country'];?>";
                        document.getElementById('phonenumbertxt').value="<?php echo $_SESSION['phoneNumber'];?>";



                    </script>


                </div>

            </div>
        </div>
        <div class="col-md-4"style="margin-top: 23px;">
            <div class>
                <div class="col-md-12"style="padding-left: 1px;"><label class="labels"style="margin-top: 43px;">Bio</label><input name="bioform" id="biotxt" type="text"style="height: 153px;" class="form-control"  value=""></div> <br>
                <script type="text/javascript">
                    document.getElementById('biotxt').readOnly=true;
                    document.getElementById('biotxt').value="<?php echo $_SESSION['bio']?>"



                </script>
                <div class="col-md-12 labels" style="padding-left: 1px;"> <span style="display: block;padding-top: 8px;padding-bottom: 8px;">Payment Method</span>
                            <div class="card">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 > <button class="btn btn-light btn-block text-left collapsed border-bottom-custom" style="background-color: white; border: 0.2px solid #ff757c;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <div class="d-flex   justify-content-between"> <span style="float: left;padding: 4px;">Paypal</span> <img style="float: right;" src="https://i.imgur.com/7kQEsHU.png" width="30"> </div>
                                            </button> </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body"> <input type="text" class="form-control" placeholder="Paypal email"> </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h2> <button class="btn btn-light btn-block collapsed text-left border-bottom-custom" style="background-color: white;border : 0.2px solid #ff757c;" data-toggle="collapse" type="button"data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <div class="d-flex align-items-center justify-content-between"> <span style="float: left;padding: 4px;">Credit card</span>
                                                    <div class="icons"style="display: inline;float: right;"> <img src="https://i.imgur.com/2ISgYja.png" width="30"> <img src="https://i.imgur.com/W1vtnOV.png" width="30"> <img src="https://i.imgur.com/35tC99g.png" width="30"> <img src="https://i.imgur.com/2ISgYja.png" width="30"> </div>
                                                </div>
                                            </button> </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body payment-card-body"> <span class="font-weight-normal card-text">Card Number</span>
                                                <div class="input"> <i class="fa fa-credit-card"></i> <input type="text" class="form-control" placeholder="0000 0000 0000 0000"> </div>
                                                <div class="row">
                                                    <div class="col-md-6"> <span class="font-weight-normal card-text">Expiry Date</span>
                                                        <div class="input"> <i class="fa fa-calendar"></i> <input type="text" class="form-control" placeholder="MM/YY"> </div>
                                                    </div>
                                                    <div class="col-md-6"> <span class="font-weight-normal card-text">CVC/CVV</span>
                                                        <div class="input"> <i class="fa fa-lock"></i> <input type="text" class="form-control" placeholder="000"> </div>
                                                    </div>
                                                </div> <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="text-center"><button class="col-lg-12 btn btn-primary profile-button"style="margin-bottom: 10px;margin-top: 10px;display: none " type="button">Save Profile</button></div>



            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    function editprofile() {
        document.getElementById('fnametxt').readOnly = false;
        document.getElementById('lnametxt').readOnly = false;
        document.getElementById('countrytxt').readOnly = false;
        document.getElementById('phonenumbertxt').readOnly = false;
        document.getElementById('biotxt').readOnly = false;
        document.getElementById('editprofilebtn').style="display:none;";
        document.getElementById('saveprofilebtn').style="display:inline-block;margin-bottom: 10px;margin-top: 10px;width: 100%;height: 49px;border-radius: 5px;background: rgb(21 189 177 / 77%);"
    }
    function saveprofile() {

        document.getElementsByName('fnametxt').readOnly = true;
        document.getElementsByName('lnametxt').readOnly = true;
        document.getElementsByName('countrytxt').readOnly = true;
        document.getElementsByName('phonenumbertxt').readOnly = true;
        document.getElementsByName('biotxt').readOnly = true;
        document.getElementsByName('saveprofilebtn').style="display:none;";
        document.getElementById('editprofilebtn').style="display:inline-block;margin-bottom: 10px;margin-top: 10px;width: 100%;height: 49px;border-radius: 5px;background: rgb(21 189 177 / 77%);"

        var fname =document.getElementById('fnametxt').value;
        var lname =document.getElementById('lnametxt').value;
        var bio =document.getElementById('biotxt').value;
        var country =document.getElementById('countrytxt').value;
        var phonenumber = document.getElementById('phonenumbertxt').value;


        alert(fname);

    }
    function endsession(){
        <?php
        $_SESSION['ismember']=0;
        ?>
    }

</script>


</body>
</html>
