<?php 
include('include/header.php');
?>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-contact" aria-selected="false">Change Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Change Password</a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="card-body">
                    <div class="form-group">
                        <h4>Profile Details</h4>
                        <hr class="colorgraph">
                        <div class="row">
                            <div class="col-md-2">
                                <strong>Full Name</strong>
                            </div>
                            <div class="col-md-6" id="view_full_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <strong>E-mail</strong>
                            </div>
                            <div class="col-md-6" id="view_email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <strong>Gender</strong>
                            </div>
                            <div class="col-md-6" id="view_gender">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="card-body">
                    <div class="form-group">
                        <h4>Update Information</h4>
                        <hr class="colorgraph">
                        <form id="update_profile_form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Full Name <i class="text-danger">*</i></label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" maxlength="50" placeholder="Enter your full name">
                                        <div id="full_name_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail <i class="text-danger">*</i></label>
                                        <input type="text" class="form-control" id="email" name="email" maxlength="30" readonly>
                                        <div id="email_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender <i class="text-danger">*</i></label>
                                        <select name="gender" id="gender" class="form-control">
                                        <option value="" hidden>Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        </select>
                                        <div id="gender_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel_button"  class="btn btn-light">Cancel</button>
                                        <input type="submit" id="update_profile_button" name="update_profile_button" class="btn btn-primary" value="Update">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="card-body">
                    <div class="form-group">
                        <h4>Update Password</h4>
                        <hr class="colorgraph">
                        <form id="update_password_form">       
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <input type="text" hidden="" id="id_User" name="idUser">
                                    <div class="form-group">
                                        <label>Current Password <i class="text-danger">*</i></label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current Password">
                                        <div id="current_password_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password <i class="text-danger">*</i></label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" maxlength="50" placeholder="Enter password">
                                        <div id="new_password_error_message" class="text-danger"></div>
                                        <div id="password_update_title"></div>
                                        <div id="password_update_length"></div>
                                        <div id="password_update_capital"></div>
                                        <div id="password_update_letter"></div>
                                        <div id="password_update_number"></div>
                                        <div id="password_update_spaces_and_symbol"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password <i class="text-danger">*</i></label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" maxlength="50" placeholder="Enter confirm password">
                                        <div id="confirm_password_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel_update_password_button"  class="btn btn-light">Cancel</button>
                                        <input type="submit" id="update_password_button" name="update_password_button" class="btn btn-primary" value="Update">
                                    </div>
                                </div>
                            </div>                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php  
include 'include/footer.php';
?>

<script>

    $(document).ready(function () {

        getProfile();

        function clearField() {
            $('#update_password_form')[0].reset();      
            // Validating password requirement.
            $("#password_update_title").hide();
            $('#password_update_length').hide();
            $('#password_update_capital').hide();  
            $('#password_update_letter').hide();  
            $('#password_update_number').hide();  
            $('#password_update_spaces_and_symbol').hide();
        }

        var error_full_name = false;
        var error_current_password = false;
        var error_new_password = false;
        var error_confirm_password = false;

        $("#full_name").focusout(function() {
            check_full_name();
        });

        $("#current_password").keyup(function() {
            check_current_password();
        });

        $("#new_password").focus(function() {
            passwordValidationRules();
        });

        $("#new_password").keyup(function() {
            check_new_password();
        });

        $("#confirm_password").keyup(function() {
            check_confirm_password();
        });

        function check_full_name() {

            if( $.trim( $('#full_name').val() ) == '' ){
                $("#full_name_error_message").html("Full name is a required field.");
                $("#full_name_error_message").show();
                $("#full_name").addClass("is-invalid");
                error_full_name = true;
            } else {
                $("#full_name_error_message").hide();
                $("#full_name").removeClass("is-invalid");
            }

        }

        function check_current_password() {

            var current_password_length = $("#current_password").val().length;

            if( $.trim( $('#current_password').val() ) == '' ){
                $("#current_password_error_message").html("Current password is a required field.");
                $("#current_password_error_message").show();
                $("#current_password").addClass("is-invalid");
                error_current_password = true;
            }else if(current_password_length < 8) {
                $("#current_password_error_message").html("At least 8 characters.");
                $("#current_password_error_message").show();
                $("#current_password").addClass("is-invalid");
                error_current_password = true;
            } else {
                $("#current_password_error_message").hide();
                $("#current_password").removeClass("is-invalid");
            }
        }

        // Check password requirement.
        function passwordValidationRules() {
            if (new_password.value.length == 0) {
                $("#password_update_title").show();
                $('#password_update_length').show();
                $('#password_update_capital').show();
                $('#password_update_letter').show();
                $('#password_update_number').show();
                $("#password_update_title").html('<div><b>Password must contain the following:</b></div>');
                $('#password_update_length').html('<div class="text-danger"><i class="fas fa-times"></i> Between <b>8 and 50 characters.</b></div>');
                $('#password_update_capital').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>uppercase</b> letter.</div>');
                $('#password_update_letter').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>lowercase</b> letter.</b></div>');
                $('#password_update_number').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>number.</b></div>');
            }
        }

        // Validate password update
        function check_new_password() {            
            var current_password = $("#current_password").val();
            var new_password = $("#new_password").val();
            var password_length = $("#new_password").val().length;
            var password = $("#new_password").val();
            var upper_case_letters = /[A-Z]/g;
            var lower_case_letters = /[a-z]/g;
            var numbers = /[0-9]/g;

            // Validate confirm password update.
            if ($.trim($('#confirm_password').val()) != '') {
                check_confirm_password();
            }

            // Validate length
            if (password_length < 8) {
                $('#password_update_length').html('<div class="text-danger"><i class="fas fa-times"></i> Between <b>8 and 50 characters.</b></div>');
                $("#new_password").addClass("is-invalid");
                error_new_password = true;
            } else {
                $('#password_update_length').html('<div class="text-success"><i class="fas fa-check"></i> Between <b>8 and 50 characters.</b></div>');
                $("#new_password").removeClass("is-invalid");
            }

            // Validate capital letters
            if (!password.match(upper_case_letters)) {
                $('#password_update_capital').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>uppercase</b> letter.</b></div>');
                $("#new_password").addClass("is-invalid");
                error_new_password = true;
            } else {
                $('#password_update_capital').html('<div class="text-success"><i class="fas fa-check"></i> At least 1 <b>uppercase</b> letter.</b></div>');
                $("#new_password").removeClass("is-invalid");
            }

            // Validate lowercase letters
            if (!password.match(lower_case_letters)) {
                $('#password_update_letter').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>lowercase</b> letter.</b></div>');
                $("#new_password").addClass("is-invalid");
                error_new_password = true;
            } else {
                $('#password_update_letter').html('<div class="text-success"><i class="fas fa-check"></i> At least 1 <b>lowercase</b> letter.</b></div>');
                $("#new_password").removeClass("is-invalid");
            }

            // Validate numbers
            if (!password.match(numbers)) {
                $('#password_update_number').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>number.</b></div>');
                $("#new_password").addClass("is-invalid");
                error_new_password = true;
            } else {
                $('#password_update_number').html('<div class="text-success"><i class="fas fa-check"></i> At least 1 <b>number.</b></div>');
                $("#new_password").removeClass("is-invalid");
            }

            // Validate that the current profile password does not match the new profile password.
            if ($.trim($('#new_password').val()) != '') {
                if(new_password == current_password) {
                    $("#new_password_error_message").html("New password cannot be same as your current password.");
                    $("#new_password_error_message").show();
                    $("#new_password").addClass("is-invalid");
                    error_confirm_password = true;
                } else {
                    $("#new_password_error_message").hide();
                    $("#new_password").removeClass("is-invalid");
                }
            }
        }

        function check_confirm_password() {

            var new_password = $("#new_password").val();
            var confirm_password = $("#confirm_password").val();

            if( $.trim( $('#confirm_password').val() ) == '' ){
                $("#confirm_password_error_message").html("Confirm password is a required field.");
                $("#confirm_password_error_message").show();
                $("#confirm_password").addClass("is-invalid");
                error_confirm_password = true;
            }else if(new_password !=  confirm_password) {
                $("#confirm_password_error_message").html("Passwords do not match.");
                $("#confirm_password_error_message").show();
                $("#confirm_password").addClass("is-invalid");
                error_confirm_password = true;
            } else {
                $("#confirm_password_error_message").hide();
                $("#confirm_password").removeClass("is-invalid");
            }
        }

        // Fetch profile information
        function getProfile() {
            $.ajax({
                url: "profile_action.php",
                type: "POST",
                data: {action: 'profile_fetch'},
                success: function (data) {
                    data = JSON.parse(data);
                    // Populate view profile details area.
                    $('#view_full_name').text(data['user_full_name']);
                    $('#view_email').text(data['user_email']);
                    $('#view_gender').text(data['user_gender']);
                    // Populate update profile form.
                    $('#full_name').val(data.user_full_name);
                    $('#email').val(data.user_email);
                    $('#gender').val(data.user_gender);
                }
            });
        }

        // Update profile information.
        $('#update_profile_form').on('submit', function (event) {
            event.preventDefault();
            error_full_name = false;

            check_full_name();
            if (error_full_name == false) {
                $.ajax({
                    url: "profile_action.php",
                    type: "POST",
                    data: $('#update_profile_form').serialize()+'&action=update_profile',
                    beforeSend:function(){
                        $('#update_password_button').val('Please wait...');
                        $('#update_password_button').attr('disabled', 'disabled');
                        $('#cancel_update_password_button').attr('disabled', 'disabled');
                    },success: function (data) {
                        data = JSON.parse(data);
                        swal("Success!", data.message, "success");
                        getProfile();
                        $('#update_password_button').val('Update');
                        $('#update_password_button').attr('disabled', false);
                        $('#cancel_update_password_button').attr('disabled', false);
                    }, error: function () {
                        swal("Oops..!", "Something went wrong.", "error");
                        $('#update_password_button').val('Update');
                        $('#update_password_button').attr('disabled', false);
                        $('#cancel_update_password_button').attr('disabled', false);
                    }
                });
            }
        });

        $('#cancel_button').click(function(){
            cancelUpdate();
        });

        $('#cancel_update_password_button').click(function(){
            cancelUpdate();
        });

        // Reload the page.
        function cancelUpdate(){
            swal({
                title: "Are you sure?",
                text: "",
                icon: "warning",
                buttons: ["No", "Yes, cancel!"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    location.reload();
                }
            });
        }

        // Update profile password
        $('#update_password_form').on('submit', function (event) {
            event.preventDefault();
            
            error_current_password = false;
            error_new_password = false;
            error_confirm_password = false;

            check_current_password();
            check_new_password();
            check_confirm_password();
            passwordValidationRules();

            if(error_current_password == false && error_new_password == false && error_confirm_password == false) {
                $.ajax({
                    type:"POST",
                    url:"profile_action.php",
                    data: $('#update_password_form').serialize()+'&action=update_password',
                    beforeSend:function(){
                        $('#update_profile_button').val('Please wait...');
                        $('#update_profile_button').attr('disabled', 'disabled');
                        $('#cancel_button').attr('disabled', 'disabled');
                    },success:function(data){
                        data = JSON.parse(data);
                        if (data.type == 'success') {
                            swal("Success!", data.message, "success");
                            clearField();
                        } else if (data.type=='warning') {
                            $("#current_password_error_message").html(data.message);
                            $("#current_password_error_message").show();
                            $("#current_password").addClass("is-invalid");
                        }
                        $('#update_profile_button').val('Update');
                        $('#update_profile_button').attr('disabled', false);
                        $('#cancel_button').attr('disabled', false);
                    },error:function(){
                        swal("Oops..!", "Something went wrong.", "error");
                        $('#update_profile_button').val('Update');
                        $('#update_profile_button').attr('disabled', false);
                        $('#cancel_button').attr('disabled', false);
                    }
                });
            }
        });
    });

</script>