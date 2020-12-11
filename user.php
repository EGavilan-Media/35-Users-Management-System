<?php include('include/header.php'); ?>
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.php">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Manage Users</li>
  </ol>

  <!-- User DataTables -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> Users Table
      <div class="float-right">
        <button type="button" id="add_user" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Add New User</button>
        <a href="print_user.php" target="_blank" class="btn btn-secondary btn-sm">
          <i class="fas fa-print"></i> print
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered" id="user_table" width="100%">
          <thead class="p-3 mb-2 bg-light font-weight-bold">
            <tr>
              <th width="5%">ID</th>
              <th>Full Name</th>
              <th>Email</th>
              <th width="10%">Gender</th>
              <th width="10%">Role</th>
              <th width="10%">Status</th>
              <th width="10%">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- MODALS -->
  <!-- Add User Modal -->
  <div class="modal fade" id="form_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title"></h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="user_form">
            <div class="form-group">
              <label>Full Name <i class="text-danger">*</i></label>
              <input type="text" id="full_name" name="full_name" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter full name">
              <div id="full_name_error_message" class="text-danger"></div>
            </div>
            <div class="form-group">
              <label>E-mail <i class="text-danger">*</i></label>
              <input type="text" id="email" name="email" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter E-mail">
              <div id="email_error_message" class="text-danger"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Gender <i class="text-danger"> *</i></label>
                <select name="gender" id="gender" class="custom-select">
                  <option value="" hidden>Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
                <div id="gender_error_message" class="text-danger"></div>
              </div>
              <div class="form-group col-md-4">
                <label>Role <i class="text-danger"> *</i></label>
                <select name="role" id="role" class="custom-select">
                  <option value="" hidden>Role</option>
                  <option>Admin</option>
                  <option>User</option>
                </select>
                <div id="role_error_message" class="text-danger"></div>
              </div>
              <div class="form-group col-md-4">
                <label>Status <i class="text-danger"> *</i></label>
                <select name="status" id="status" class="custom-select">
                  <option value="" hidden>Status</option>
                  <option>Active</option>
                  <option>Inactive</option>
                </select>
                <div id="status_error_message" class="text-danger"></div>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password <i class="text-danger">*</i></label>
              <input type="password" class="form-control" id="password" name="password" maxlength="50" placeholder="Enter Password">
              <div id="title"></div>
              <div id="length"></div>
              <div id="capital"></div>
              <div id="letter"></div>
              <div id="number"></div>
              <div id="spaces_and_symbol"></div>
            </div>
            <div class="form-group">
              <label for="confirm-password">Confirm Password <i class="text-danger">*</i></label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" maxlength="50" placeholder="Enter confirm password">
              <div id="confirm_password_error_message" class="text-danger"></div>
            </div>
            <br>
            <div class="modal-footer">
              <button type="button" id="cancel_button" class="btn btn-light" data-dismiss="modal">Cancel</button>
              <input type="submit" name="button_action" id="button_action" class="btn btn-primary" value="Save" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Add User Modal -->

  <!-- Update User Modal -->
  <div class="modal fade" id="updateUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update User Information</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <br>
        <div class="container">
          <div class="card">
            <h5 class="card-header">Update User Profile</h5>
            <div class="modal-body">
              <form id="update_profile_form">
                <div class="form-group">
                  <label>Full Name <i class="text-danger">*</i></label>
                  <input type="text" id="update_full_name" name="update_full_name" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter full name">
                  <div id="update_full_name_error_message" class="text-danger"></div>
                </div>
                <div class="form-group">
                  <label>E-mail <i class="text-danger">*</i></label>
                  <input type="text" id="update_email" name="update_email" class="form-control" maxlength="100" autocomplete="off" placeholder="Enter E-mail">
                  <div id="update_email_error_message" class="text-danger"></div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Gender <i class="text-danger"> *</i></label>
                    <select name="update_gender" id="update_gender" class="custom-select">
                      <option value="" hidden>Gender</option>
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                    <div id="update_gender_error_message" class="text-danger"></div>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Role <i class="text-danger"> *</i></label>
                    <select name="update_role" id="update_role" class="custom-select">
                      <option value="" hidden>Role</option>
                      <option>Admin</option>
                      <option>User</option>
                    </select>
                    <div id="update_role_error_message" class="text-danger"></div>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Status <i class="text-danger"> *</i></label>
                    <select name="update_status" id="update_status" class="custom-select">
                      <option value="" hidden>Status</option>
                      <option>Active</option>
                      <option>Inactive</option>
                    </select>
                    <div id="update_status_error_message" class="text-danger"></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="update_profile_id" id="update_profile_id"/>
                  <button type="button" id="cancel_user_update_button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                  <input type="submit" name="button_update_profile" id="button_update_profile" class="btn btn-primary" value="Update" />
                </div>
              </form>
            </div>
          </div>
        </div>
        <br>
        <div class="container">
          <div class="card">
            <h5 class="card-header">Update User Password</h5>
            <div class="modal-body">
              <form id="user_password_form">
                <div class="form-group">
                  <label for="password">Password <i class="text-danger">*</i></label>
                  <input type="password" class="form-control" id="update_password" name="update_password" maxlength="50" placeholder="Enter new password">
                  <div id="password_update_title"></div>
                  <div id="password_update_length"></div>
                  <div id="password_update_capital"></div>
                  <div id="password_update_letter"></div>
                  <div id="password_update_number"></div>
                  <div id="password_update_spaces_and_symbol"></div>
                </div>
                <div class="form-group">
                  <label for="confirm-password">Confirm Password <i class="text-danger">*</i></label>
                  <input type="password" class="form-control" id="update_confirm_password" name="update_confirm_password" maxlength="50" placeholder="Enter confirm password">
                  <div id="update_confirm_password_error_message" class="text-danger"></div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="update_password_id" id="update_password_id"/>
                  <button type="button" id="cancel_passworld_update_button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                  <input type="submit" name="button_action" id="update_button_action" class="btn btn-primary" value="Update" />
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Update User Modal -->

  <!-- View User Modal-->
  <div class="modal fade" id="read_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">User Details</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-borderless">
            <tr>
              <th>ID</th>
              <td>
                <div id="view_id"></div>
              </td>
            </tr>
            <tr>
              <th>Full Name</th>
              <td>
                <div id="view_full_name"></div>
              </td>
            </tr>
            <tr>
              <th>E-Mail</th>
              <td>
                <div id="view_email"></div>
              </td>
            </tr>
            <tr>
              <th>Gender</th>
              <td>
                <div id="view_gender"></div>
              </td>
            </tr>
            <tr>
              <th>Role</th>
              <td>
                <div id="view_role"></div>
              </td>
            </tr>
            <tr>
              <th>Status</th>
              <td>
                <div id="view_status"></div>
              </td>
            </tr>
            <tr>
              <th>Created by</th>
              <td>
                <div id="view_created_by"></div>
              </td>
            </tr>            
            <tr>
              <th>Created</th>
              <td>
                <div id="view_created_at"></div>
              </td>
            </tr>
            <tr>
              <th>Last updated by</th>
              <td>
                <div id="view_last_update_by"></div>
              </td>
            </tr>
            <tr>
              <th>Last updated</th>
              <td>
                <div id="view_updated_at"></div>
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End View Expense Modal -->

  <!-- Footer -->
<?php include("include/footer.php"); ?>

<script>

  $(document).ready(function(){
    var datatable = $('#user_table').DataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
          url:'user_action.php',
          type: 'POST',
          data: {action:'user_fetch'}
      },
      'columns': [
          { data: 'user_id'},
          { data: 'user_full_name'},
          { data: 'user_email'},
          { data: 'user_gender'},
          { data: 'user_role'},
          { data: 'user_status'},
          { data: 'action',"orderable":false}
      ]
    });

    $('#add_user').click(function(){
      $('#modal_title').text('Add User');
      $('#button_action').val('Save');
      $('#action').val('add_user');
      $('#form_modal').modal('show');
      clearField();
    });

    function clearField() {
      $('#user_form')[0].reset();      
      $("#full_name_error_message").hide();
      $("#full_name").removeClass("is-invalid");
      $("#email_error_message").hide();
      $("#email").removeClass("is-invalid");
      $("#gender_error_message").hide();
      $("#gender").removeClass("is-invalid");
      $("#role_error_message").hide();
      $("#role").removeClass("is-invalid");
      $("#status_error_message").hide();
      $("#status").removeClass("is-invalid");
      $("#password_error_message").hide();
      $("#password").removeClass("is-invalid");
      $("#confirm_password_error_message").hide();
      $("#confirm_password").removeClass("is-invalid");
      $("#alert_error_message").hide();
      // Validating password requirement.
      $("#title").hide();
      $('#length').hide();
      $('#capital').hide();  
      $('#letter').hide();  
      $('#number').hide();  
      $('#spaces_and_symbol').hide();
    }

    function clearUpdateField() {
      $('#update_profile_form')[0].reset();
      $('#user_password_form')[0].reset();
      $("#update_full_name_error_message").hide();
      $("#update_full_name").removeClass("is-invalid");
      $("#update_email_error_message").hide();
      $("#update_email").removeClass("is-invalid");
      $("#update_password_error_message").hide();
      $("#update_password").removeClass("is-invalid");
      $("#update_confirm_password_error_message").hide();
      $("#update_confirm_password").removeClass("is-invalid");
      $("#update_password_alert_error_message").hide();
      hidePasswordUpdateValidationRules();

    }

    // Validate password update requirement.
    function hidePasswordUpdateValidationRules(){
      $("#password_update_title").hide();
      $('#password_update_length').hide();
      $('#password_update_capital').hide();  
      $('#password_update_letter').hide();  
      $('#password_update_number').hide();  
      $('#password_update_spaces_and_symbol').hide();
    }

    $('#update_profile_form').on('submit', function(event){
      event.preventDefault();
      updateProfile();      
    });

    $('#user_password_form').on('submit', function(event){
      event.preventDefault();
      updatePassword();
    });

    var error_full_name = false;
    var error_email = false;
    var error_gender = false;
    var error_role = false;
    var error_status = false;
    var error_password = false;
    var error_confirm_password = false;
    var error_update_full_name = false;
    var error_update_email = false;
    var error_update_gender = false;
    var error_update_role = false;
    var error_update_status = false;
    var error_update_password = false;
    var error_update_confirm_password = false;

    $("#full_name").keyup(function() {
      checkFullName();
    });

    $("#email").keyup(function() {
      checkEmail();
    });

    $("#gender").change(function() {
      checkGender();
    });

    $("#role").change(function() {
      checkRole();
    });

    $("#status").change(function() {
      checkStatus();
    });

    $("#password").keyup(function() {
      checkPassword();
    });

    $("#password").focus(function() {
      passwordValidationRules();
    });

    $("#confirm_password").keyup(function() {
      checkConfirmPassword();
    });

    $("#update_full_name").focusout(function() {
      checkUpdateFullName();
    });

    $("#update_email").focusout(function() {
      checkUpdateEmail();
    });

    $("#update_password").keyup(function() {
      checkPasswordUpdate();
    });

    $("#update_password").focus(function() {
      passwordUpdateValidationRules();
    });

    $("#update_confirm_password").keyup(function() {
      checkUpdateConfirmPassword();
    });

    // Validate full name.
    function checkFullName() {

      if( $.trim( $('#full_name').val() ) == '' ){
        $("#full_name_error_message").html("Full name is a required field.");
        $("#full_name_error_message").show();
        $("#full_name").addClass("is-invalid");
        error_full_name = true;
      }
      else{
        $("#full_name_error_message").hide();
        $("#full_name").removeClass("is-invalid");
      }

    }

    // Validate update full name.
    function checkUpdateFullName() {

      if( $.trim( $('#update_full_name').val() ) == '' ){
        $("#update_full_name_error_message").html("Full name is a required field.");
        $("#update_full_name_error_message").show();
        $("#update_full_name").addClass("is-invalid");
        error_update_full_name = true;
      }
      else{
        $("#update_full_name_error_message").hide();
        $("#update_full_name").removeClass("is-invalid");
      }

    }

    // Validate email.
    function checkEmail() {
      var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

      if ($.trim($('#email').val()) == '') {
        $("#email_error_message").html("Email is a required field.");
        $("#email_error_message").show();
        $("#email").addClass("is-invalid");
      } else if (!(pattern.test($("#email").val()))) {
        $("#email_error_message").html("Invalid email address");
        $("#email_error_message").show();
        error_email = true;
        $("#email").addClass("is-invalid");
      } else {
        $("#email_error_message").hide();
        $("#email").removeClass("is-invalid");
      }
    }

    // Validate update email.
    function checkUpdateEmail() {
      var update_pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

      if ($.trim($('#update_email').val()) == '') {
        $("#update_email_error_message").html("Email is a required field.");
        $("#update_email_error_message").show();
        $("#update_email").addClass("is-invalid");
      } else if (!(update_pattern.test($("#update_email").val()))) {
        $("#update_email_error_message").html("Invalid email address");
        $("#update_email_error_message").show();
        error_email = true;
        $("#update_email").addClass("is-invalid");
      } else {
        $("#update_email_error_message").hide();
        $("#update_email").removeClass("is-invalid");
      }
    }

    // Validate status.
    function checkStatus() {
      if( $.trim( $('#status').val() ) == '' ){
        $("#status_error_message").html("Status is a required field.");
        $("#status_error_message").show();
        $("#status").addClass("is-invalid");
        error_status = true;
      } else {
        $("#status_error_message").hide();
        $("#status").removeClass("is-invalid");
      }
    }

    // Validate role.
    function checkRole() {
      if( $.trim( $('#role').val() ) == '' ){
        $("#role_error_message").html("Role is a required field.");
        $("#role_error_message").show();
        $("#role").addClass("is-invalid");
        error_role = true;
      } else {
        $("#role_error_message").hide();
        $("#role").removeClass("is-invalid");
      }
    }

    // Validate gender.
    function checkGender() {
      if( $.trim( $('#gender').val() ) == '' ){
        $("#gender_error_message").html("Gender is a required field.");
        $("#gender_error_message").show();
        $("#gender").addClass("is-invalid");
        error_gender = true;
      } else {
        $("#gender_error_message").hide();
        $("#gender").removeClass("is-invalid");
      }
    }

    // Check password requirement.
    function passwordValidationRules() {
      if (password.value.length == 0) {
        $("#title").show();
        $('#length').show();
        $('#capital').show();
        $('#letter').show();
        $('#number').show();
        $("#title").html('<div><b>Password must contain the following:</b></div>');
        $('#length').html('<div class="text-danger"><i class="fas fa-times"></i> Between <b>8 and 50 characters.</b></div>');
        $('#capital').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>uppercase</b> letter.</div>');
        $('#letter').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>lowercase</b> letter.</b></div>');
        $('#number').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>number.</b></div>');
      }
    }

    // Validate password
    function checkPassword() {
      var password_length = $("#password").val().length;
      var password = $("#password").val();
      var upper_case_letters = /[A-Z]/g;
      var lower_case_letters = /[a-z]/g;
      var numbers = /[0-9]/g;

      // Validate confirm password.
      if ($.trim($('#confirm_password').val()) != '') {
        checkConfirmPassword();
      }

       // Validate length
      if (password_length < 8) {
        $('#length').html('<div class="text-danger"><i class="fas fa-times"></i> Between <b>8 and 50 characters.</b></div>');
        $("#password").addClass("is-invalid");
        error_password = true;
      } else {
        $('#length').html('<div class="text-success"><i class="fas fa-check"></i> Between <b>8 and 50 characters.</b></div>');
        $("#password").removeClass("is-invalid");
      }

      // Validate capital letters
      if (!password.match(upper_case_letters)) {
        $('#capital').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>uppercase</b> letter.</b></div>');
        $("#password").addClass("is-invalid");
        error_password = true;
      } else {
        $('#capital').html('<div class="text-success"><i class="fas fa-check"></i> At least 1 <b>uppercase</b> letter.</b></div>');
        $("#password").removeClass("is-invalid");
      }

      // Validate lowercase letters
      if (!password.match(lower_case_letters)) {
        $('#letter').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>lowercase</b> letter.</b></div>');
        $("#password").addClass("is-invalid");
        error_password = true;
      } else {
        $('#letter').html('<div class="text-success"><i class="fas fa-check"></i> At least 1 <b>lowercase</b> letter.</b></div>');
        $("#password").removeClass("is-invalid");
      }

      // Validate numbers
      if (!password.match(numbers)) {
        $('#number').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>number.</b></div>');
        $("#password").addClass("is-invalid");
        error_password = true;
      } else {
        $('#number').html('<div class="text-success"><i class="fas fa-check"></i> At least 1 <b>number.</b></div>');
        $("#password").removeClass("is-invalid");
      }
    }

    // Validate confirm password.
    function checkConfirmPassword() {
      var password = $("#password").val();
      var confirm_password = $("#confirm_password").val();

      if ($.trim($('#confirm_password').val()) == '') {
        $("#confirm_password_error_message").html("Confirm password is a required field.");
        $("#confirm_password_error_message").show();
        $("#confirm_password").addClass("is-invalid");
        error_confirm_password = true;
      } else if (password != confirm_password) {
        $("#confirm_password_error_message").html("Passwords do not match!");
        $("#confirm_password_error_message").show();
        error_confirm_password = true;
        $("#confirm_password").addClass("is-invalid");
      } else {
        $("#confirm_password_error_message").hide();
        $("#confirm_password").removeClass("is-invalid");
      }
    }
  
    // Check password update requirement.
    function passwordUpdateValidationRules() { 
      if (update_password.value.length == 0) {
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
    function checkPasswordUpdate() {
      var password_length = $("#update_password").val().length;
      var password = $("#update_password").val();
      var upper_case_letters = /[A-Z]/g;
      var lower_case_letters = /[a-z]/g;
      var numbers = /[0-9]/g;

      // Validate confirm password update.
      if ($.trim($('#confirm_password').val()) != '') {
        checkUpdateConfirmPassword();
      }

       // Validate length
      if (password_length < 8) {
        $('#password_update_length').html('<div class="text-danger"><i class="fas fa-times"></i> Between <b>8 and 50 characters.</b></div>');
        $("#update_password").addClass("is-invalid");
        error_update_password = true;
      } else {
        $('#password_update_length').html('<div class="text-success"><i class="fas fa-check"></i> Between <b>8 and 50 characters.</b></div>');
        $("#update_password").removeClass("is-invalid");
      }

      // Validate capital letters
      if (!password.match(upper_case_letters)) {
        $('#password_update_capital').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>uppercase</b> letter.</b></div>');
        $("#update_password").addClass("is-invalid");
        error_update_password = true;
      } else {
        $('#password_update_capital').html('<div class="text-success"><i class="fas fa-check"></i> At least 1 <b>uppercase</b> letter.</b></div>');
        $("#update_password").removeClass("is-invalid");
      }

      // Validate lowercase letters
      if (!password.match(lower_case_letters)) {
        $('#password_update_letter').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>lowercase</b> letter.</b></div>');
        $("#update_password").addClass("is-invalid");
        error_update_password = true;
      } else {
        $('#password_update_letter').html('<div class="text-success"><i class="fas fa-check"></i> At least 1 <b>lowercase</b> letter.</b></div>');
        $("#update_password").removeClass("is-invalid");
      }

      // Validate numbers
      if (!password.match(numbers)) {
        $('#password_update_number').html('<div class="text-danger"><i class="fas fa-times"></i> At least 1 <b>number.</b></div>');
        $("#update_password").addClass("is-invalid");
        error_update_password = true;
      } else {
        $('#password_update_number').html('<div class="text-success"><i class="fas fa-check"></i> At least 1 <b>number.</b></div>');
        $("#update_password").removeClass("is-invalid");
      }
    }

    // Validate update confirme Password.
    function checkUpdateConfirmPassword() {
      var update_password = $("#update_password").val();
      var update_confirm_password = $("#update_confirm_password").val();

      if ($.trim($('#update_confirm_password').val()) == '') {
        $("#update_confirm_password_error_message").html("Confirm password is a required field.");
        $("#update_confirm_password_error_message").show();
        $("#update_confirm_password").addClass("is-invalid");
        error_update_confirm_password = true;
      } else if (update_password != update_confirm_password) {
        $("#update_confirm_password_error_message").html("Passwords do not match!");
        $("#update_confirm_password_error_message").show();
        error_update_confirm_password = true;
        $("#update_confirm_password").addClass("is-invalid");
      } else {
        $("#update_confirm_password_error_message").hide();
        $("#update_confirm_password").removeClass("is-invalid");
      }
    }

    // Register new user
    $('#user_form').on('submit', function(event){
      event.preventDefault();

      error_full_name = false;
      error_email = false;
      error_gender = false;
      error_role = false;
      error_status = false;
      error_password = false;
      error_confirm_password = false;

      checkFullName();
      checkEmail();
      checkGender();
      checkRole();
      checkStatus();
      checkPassword();
      checkConfirmPassword();
      passwordValidationRules();

      if(error_full_name == false && error_email == false && error_gender == false && error_role == false && error_password == false && error_confirm_password == false) {
        $.ajax({
          url:"user_action.php",
          type:"POST",
          data: $('#user_form').serialize()+'&action=add_user',
          beforeSend:function(){
            $('#button_action').val('Please wait...');
            $('#button_action').attr('disabled', 'disabled');
            $('#cancel_button').attr('disabled', 'disabled');
          },success:function(data){
            data = JSON.parse(data);
            if(data.type === 'success'){
              $('#form_modal').modal('hide');
              clearField();
              datatable.ajax.reload();
              swal("Success!", data.message, data.type);
            } else if (data.type === 'warning'){
              $("#email_error_message").html(data.message);
              $("#email_error_message").show();
              $("#email").addClass("is-invalid");
            }
            $('#button_action').val('Save');
            $('#button_action').attr('disabled', false);
            $('#cancel_button').attr('disabled', false);
          },error:function(){
            swal("Oops..!", "Something went wrong.", "error");
            $('#button_action').val('Save');
            $('#button_action').attr('disabled', false);
            $('#cancel_button').attr('disabled', false);
          }
        });
      }
    });

    // Fetch single user information
    $(document).on('click', '.view_user', function(){
      user_id = $(this).attr('id');
      $.ajax({
        url:"user_action.php",
        type:"POST",
        data: {action:'single_fetch', user_id:user_id},
        success:function(data){
          data = JSON.parse(data);
          $('#view_id').text(data['user_id']);
          $('#view_full_name').text(data['user_full_name']);
          $('#view_email').text(data['user_email']);
          $('#view_gender').text(data['user_gender']);
          $('#view_role').text(data['user_role']);          
          $('#view_status').text(data['user_status']);
          $('#view_created_by').text(data['user_created_by']);
          $('#view_last_update_by').text(data['user_last_update_by']);
          $('#view_created_at').text(data['user_created_at']);
          $('#view_updated_at').text(data['user_updated_at']);
        }
      });
    });

    // Fetch single user information
    $(document).on('click', '.update_user', function(){
      user_id = $(this).attr('id');
      clearUpdateField();
      $('#updateUserModal').modal('show');
      $.ajax({
        url:"user_action.php",
        type:"POST",
        data: {action:'single_fetch', user_id:user_id},
        success:function(data){
          data = JSON.parse(data);
          $('#update_profile_id').val(data.user_id);
          $('#update_password_id').val(data.user_id);
          $('#update_full_name').val(data.user_full_name);
          $('#update_email').val(data.user_email);
          $('#update_gender').val(data.user_gender);
          $('#update_role').val(data.user_role);
          $('#update_status').val(data.user_status);
        }
      });
    });

    function updateProfile(){

      error_update_full_name = false;
      error_update_email = false;

      checkUpdateFullName();
      checkUpdateEmail();

      if(error_update_full_name == false && error_update_email == false) {
        $.ajax({
          url:"user_action.php",
          type:"POST",
          data: $('#update_profile_form').serialize()+'&action=update_user_profile',
          beforeSend:function(){
            $('#button_update_profile').val('Please wait...');
            $('#button_update_profile').attr('disabled', 'disabled');
            $('#cancel_user_update_button').attr('disabled', 'disabled');
          },success:function(data){
            data = JSON.parse(data);
            if(data.type === 'success'){
              $('#form_modal').modal('hide');
              clearField();
              datatable.ajax.reload();
              swal("Success!", data.message, data.type);
            } else if (data.type === 'warning'){
              $("#update_email_error_message").html("Email already exists.");
              $("#update_email_error_message").show();
              $("#update_email").addClass("is-invalid");
            }
            $('#button_update_profile').val('Update');
            $('#button_update_profile').attr('disabled', false);
            $('#cancel_user_update_button').attr('disabled', false);
          },error:function(){
            swal("Oops..!", "Something went wrong.", "error");
            $('#button_update_profile').val('Save');
            $('#button_update_profile').attr('disabled', false);
            $('#cancel_user_update_button').attr('disabled', false);
          }
        });
      }
    }

    // Update user password
    function updatePassword(){

      error_update_password = false;
      error_update_confirm_password = false;

      checkPasswordUpdate();
      checkUpdateConfirmPassword();
      passwordUpdateValidationRules();

      if(error_update_password == false && error_update_confirm_password == false) {
        $.ajax({
          url:"user_action.php",
          type:"POST",
          data: $('#user_password_form').serialize()+'&action=update_user_password',
          beforeSend:function(){
            $('#update_button_action').val('Please wait...');
            $('#update_button_action').attr('disabled', 'disabled');
            $('#cancel_passworld_update_button').attr('disabled', 'disabled');
          },success:function(data){
              data = JSON.parse(data);
              $('#user_password_form')[0].reset();
              hidePasswordUpdateValidationRules();
              swal("Success!", data.message, data.type);
              $('#update_button_action').val('Update');
              $('#update_button_action').attr('disabled', false);
              $('#cancel_passworld_update_button').attr('disabled', false);
          },error:function(){
            swal("Oops..!", "Something went wrong.", "error");
            $('#update_button_action').val('Save');
            $('#update_button_action').attr('disabled', false);
            $('#cancel_passworld_update_button').attr('disabled', false);
          }
        });
      }
    }
  });
</script>