<?php
    session_start();
    $_SESSION['ismember']=1;
//    try{
//        $db = new mysqli('localhost','root','','web-project');
//        $qry= 'select * from user';
//        $res=$db->query($qry);
//        for($i=0;$i<$res->num_rows;$i++)
//        {
//            $row = $res->fetch_object();
//            if()
//        }
//
//    }catch (){
//
//    }
    $_SESSION['fullName']='Laith Atari';
    $_SESSION['email']='laithatari01@gmail.com';
    $_SESSION['phonenumber']='0595208174';
    $_SESSION['country']= 'Palestine';
    $_SESSION['bio']='';
    $_SESSION['firstName']= 'laith';
    $_SESSION['lastName']='Atari';
    header('Location:AttractionUser.php');

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Sign-in.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Sign in</title>
</head>
<body class = "backGround">
<div class="shape">
<div class="form-outline mb-4">
    <input type="email" id="form2Example1" class="form-control"/>
    <label class="form-label" for="form2Example1">Email address</label>
</div>
<!-- Password input -->
<div class="form-outline mb-4">
    <input type="password" id="form2Example2" class="form-control"/>
    <label class="form-label" for="form2Example2">Password</label>
</div>

<!-- 2 column grid layout for inline styling -->
<div class="row mb-4">
    <div class="col d-flex justify-content-center">
        <!-- Checkbox -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked/>
            <label class="form-check-label" for="form2Example31"> Remember me </label>
        </div>
    </div>

    <div class="col">
        <!-- forgetting password -->
        <a href="#!">Forgot password?</a>
    </div>
</div>

<!-- Submit button -->
<button type="button" class="btn btn-primary btn-block mb-4">Sign in</button>

<!-- Register buttons -->
<div class="text-center">
    <p>Not a member? <a href="#!">Register</a></p>
    <p>or sign up with:</p>
    <button type="button" class="btn btn-link btn-floating mx-1">
        <i class="fab fa-facebook-f"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
        <i class="fab fa-google"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
        <i class="fab fa-twitter"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
        <i class="fab fa-github"></i>
    </button>
</div>
</div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>