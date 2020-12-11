<?php
session_start();
if(isset($_SESSION["user_email"])){
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login - Users Management System</title>
        <!-- style.css -->
        <link rel="stylesheet" type="text/css" href="css/egm_login.css">
        <!-- Font-awesome -->
        <link href="vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" type="text/css"/>
        <!-- SweetAlert -->
        <script src="vendor/sweetalert/sweetalert.min.js"></script>
        <!-- favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    </head>
    <body translate="no">
        <div class="wrapper">
            <form id="user_form" class="login">
                <p class="title">Log in</p>
                <span class="text-center" id="error_message"></span>
                <input type="text" id="email" name="email" maxlength="50" placeholder="Email" autocomplete="off" value="<?php
                    if(isset($_COOKIE['email'])){
                        echo $_COOKIE['email'];
                    }
                ?>">
                <i class="fa fa-user"></i>
                <div id="email_error_message"></div>
                <input type="password" id="password" name="password" maxlength="50" placeholder="Password" value="<?php
                    if(isset($_COOKIE['password'])){
                        echo $_COOKIE['password'];
                    }
                ?>">
                <i class="fa fa-key"></i>
                <div id="password_error_message"></div>
                <div>
                    <input type="checkbox" id="custom_check" name="custom_check" <?php
                        if (isset($_COOKIE['email'])){
                            ?> checked <?php
                        }
                    ?>>
                    <label>Remember me</label>
                </div>
                <a href="#">Forgot your password?</a>
                <button type="submit" class="btn btn-primary" name="button_action" id="button_action"><div id="button_value">Login</div></button>
            </form>
        </div>
    </body>
    <!-- jQuery Library -->
    <script src="vendor/jquery/jquery-3.4.1.min.js"></script>
</html>

<script>

    $('#user_form').on('submit', function (event) {
        event.preventDefault();
        login();
    });

    $(document).keypress(function(e) {
      if(e.which == 13) {
        login();
      }
    });

    var error_email = false;
    var error_password = false;

    $("#email").focusout(function () {
        checkEmail();
    });

    $("#password").focusout(function () {
        checkPassword();
    });

    function checkEmail() {
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        var email_length = $("#email").val().length;

        if ($.trim($('#email').val()) == '') {
            $("#email_error_message").html("Email is a required field.");
            $("#email_error_message").show();
        } else if (!(pattern.test($("#email").val()))) {
            $("#email_error_message").html("Invalid email address.");
            $("#email_error_message").show();
            error_email = true;
        } else {
            $("#email_error_message").hide();
        }
    }

    function checkPassword() {
        var password_length = $("#password").val().length;
        if ($.trim($('#password').val()) == '') {
            $("#password_error_message").html("Password is a required field.");
            $("#password_error_message").show();
            error_password = true;
        }
        else {
            $("#password_error_message").hide();
        }
    }

    // Login request.
    function login() {
        error_email = false;
        error_password = false;

        checkEmail();
        checkPassword();

        if (error_email == false && error_password == false) {
            $.ajax({
                url:"check_login.php",
                type:"POST",
                data: $('#user_form').serialize()+'&action=login',
                beforeSend:function(){
                    $("#button_value").html('Authenticating...');
                    $('#button_action').attr('disabled', 'disabled');
                },success:function(data){
                    data = JSON.parse(data);
                    setTimeout(function(){
                        if (data.type === 'inactive') {
                            errorMessage();
                        } else if (data.type === 'warning'){
                            errorMessage();
                        } else if (data.type === 'error'){
                            errorMessage();
                        } else if (data.type === 'success'){
                            window.location = "index.php";
                        }
                    }, 1000);
                    function errorMessage () {
                        $('#error_message').html('<div class="alert alert-danger">'+data.message+'</div>');
                        $("#button_value").html('Login');
                        $('#button_action').attr('disabled', false);
                    }
                },error:function(){
                    swal("Oops..!", "Something went wrong.", "error");
                    $("#button_value").html('Login');
                    $('#button_action').attr('disabled', false);
                }
            });
        }
    }
</script>