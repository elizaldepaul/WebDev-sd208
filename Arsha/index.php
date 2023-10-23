<?php
include_once('header.php');


?>







<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->

    <link rel="stylesheet" href="../css/log in.css">
    <link rel="stylesheet" href="../css/sb-admin-2.css">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>

    </style>


</head>


<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Your login modal content here -->
            <div class="modal-body modal-content">
                <div class="row justify-content-center">
                    <div class="card-body p-5">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-header" style="border:none;">
                            <h5 class="modal-title" id="loginModalLabel">Welcome Back!</h5>
                        </div>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block login-image">
                                <!-- Your login image content goes here -->
                            </div>
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <!-- <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1> -->
                                </div>
                                <form action="../php/authenticate.php" method="post" class="user">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                            placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            placeholder="Password">
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $row["ID"]; ?>">
                                    <input class="btn btn-primary btn-user mb-2 btn-block custom-input" name="login"
                                        type="submit" value="Log in">
                                </form>
                                <div class="text-center mb-2">
                                    <a class="small" href="#" data-dismiss="modal" data-toggle="modal"
                                        data-target="#registrationModal">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registration Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Your registration modal content here -->
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Create an Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Registration form -->
                <form action="../php/register.php" method="post" name="registrationForm" class="user"
                    onsubmit="return validateForm()" style="height: 500px; overflow: auto;  overflow-x: hidden;">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="firstname"
                            placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="lastname"
                            placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control form-control-user" id="age" name="age"
                            placeholder="Age" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="NickName" name="nickname"
                            placeholder="Nick Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="Email" name="email"
                            placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="Address" name="address"
                            placeholder="Address" required>
                    </div>
                    <div class="radio-group"
                        style=" width: 30px!important; background-position: center; background-repeat: no-repeat;background-size: 350px 500px; display: flex; flex-direction: row; /* Display items horizontally */ align-items: center; /* Vertically align items */ gap: 2px;">
                        <p>Gender:</p>
                        <input type="radio" id="Male" name="gender" value="Male"
                            style=" margin-left: 20px;padding-bottom: 10px; margin-bottom: 10px;" required>
                        <label for="Male">Male</label>
                        <input type="radio" id="Female" name="gender" value="Female"
                            style=" margin-left: 20px;padding-bottom: 10px; margin-bottom: 10px;" required>
                        <label for="Female">Female</label>
                        <input type="radio" id="Other" name="gender" value="Other"
                            style=" margin-left: 20px;padding-bottom: 10px; margin-bottom: 10px;" required>
                        <label for="Other" style=" margin-bottom: 10px;padding-top: 0;">Other</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" name="password" id="password"
                                placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" name="cpassword"
                                id="cpassword" placeholder="Repeat Password">
                        </div>
                        <input type="hidden" name="role" value="User">
                        <input type="hidden" name="status" value="Active">
                    </div>
                    <input class="btn btn-primary  mb-2 btn-user  btn-block" type="submit" class="custom-input"
                        value="Register Account">
                    <div class="text-center  mb-4 ">
                        <a class="small" href="#" data-dismiss="modal" data-toggle="modal"
                            data-target="#loginModal">Already have an account? Login!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script>
    function validateForm() {
        var password = document.forms["registrationForm"]["password"].value;
        var confirmPassword = document.forms["registrationForm"]["cpassword"].value;

        if (confirmPassword === "") {
            alert("Confirm Password must be filled out");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match");
            return false;
        }

        return true;
    }



    // Function to show the registration modal with animation
    function showRegistration() {
        $('#registrationModal').addClass('fade');
        $('#registrationModal').modal('show');
        $('#loginModal').modal('hide');
    }

    // Function to show the login modal with animation
    function showLogin() {
        $('#loginModal').addClass('fade');
        $('#loginModal').modal('show');
        $('#registrationModal').modal('hide');
    }
</script>
</div>



</body>

</html>

<?php include_once('footer.php'); ?>