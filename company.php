<?php include('include/header.php'); ?>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Company-info</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-company" role="tab" aria-controls="nav-home" aria-selected="true">Company-info</a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-company" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="card-body">
                    <div class="form-group">
                    <h4>Company Information</h4>
                        <hr class="colorgraph">
                        <form id="update_company_form">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Company Name <i class="text-danger">*</i></label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" maxlength="100" placeholder="Enter company name">
                                        <div id="company_name_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" class="form-control" id="website" name="website" maxlength="100" placeholder="Enter website url">
                                        <div id="website_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" id="email" name="email" maxlength="100" placeholder="Enter email">
                                        <div id="email_error_message" class="text-danger"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea id="address" name="address" class="form-control" rows="2" maxlength="500" autocomplete="off" placeholder="Enter address"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>City</label>
                                            <input type="text" class="form-control" id="city" name="city" maxlength="100" placeholder="Enter city">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Country</label>
                                            <input type="text" class="form-control" id="country" name="country" maxlength="100" placeholder="Enter country">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Postal/Zip Code</label>
                                            <input type="text" class="form-control" id="zip_code" name="zip_code" maxlength="100" placeholder="Enter zip code">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" maxlength="100" placeholder="Enter phone">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fax</label>
                                            <input type="text" class="form-control" id="fax" name="fax" maxlength="100" placeholder="Enter fax">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Vat Number</label>
                                            <input type="text" class="form-control" id="vat_number" name="vat_number" maxlength="100" placeholder="Enter vat number">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Company Number</label>
                                            <input type="text" class="form-control" id="company_number" name="company_number" maxlength="100" placeholder="Enter company number">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="cancel_button"  class="btn btn-light">Cancel</button>
                                        <input type="submit" id="update_profile_button" name="update_profile_button" class="btn btn-primary" value="Update" />
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="container">
                                        <br/>
                                        <label>Company Logo</label>
                                        <div class="panel panel-default">                                            
                                            <div class="panel-body">
                                                <div id="uploaded_image"></div>
                                                <br>
                                                <label class="btn btn-primary">
                                                    Upload Company Logo<input type="file" name="upload_image" id="upload_image" style="display: none;" accept="image/*">
                                                </label>
                                                <br/>  					
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload company logo -->
    <div id="upload_image_modal" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop and Upload Company Logo</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" id="update_logo_button" name="update_logo_button" class="btn btn-primary update_logo_button" value="Update" /> 
                    <!-- <input type="submit" id="update_profile_button" name="update_profile_button" class="btn btn-primary" value="Update" /> -->
                </div>
            </div>
        </div>
    </div>
    <!--./ Upload company logo -->


<?php include 'include/footer.php'; ?>

<script>

    $(document).ready(function () {

        getCompany();
        bringCompanyLogo();

        var error_company_name = false;
        var error_email = false;
        var error_website = false;

        $("#company_name").keyup(function() {
            check_company_name();
        });

        $("#email").keyup(function () {
            check_email();
        });

        $("#website").keyup(function() {
            check_website();
        });

        // Validate company name.
        function check_company_name() {

            if( $.trim( $('#company_name').val() ) == '' ){
                $("#company_name_error_message").html("Company name is a required field.");
                $("#company_name_error_message").show();
                $("#company_name").addClass("is-invalid");
                error_company_name = true;
            } else {
                $("#company_name_error_message").hide();
                $("#company_name").removeClass("is-invalid");
            }
        }

        // Validate email
        function check_email() {

            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            var email_length = $("#email").val().length;

            if ($.trim($('#email').val()) == ''){
                $("#email_error_message").hide();
                $("#email").removeClass("is-invalid");
            }else if (!(pattern.test($("#email").val()))){
                $("#email_error_message").html("Invalid email address.");
                $("#email_error_message").show();
                $("#email").addClass("is-invalid");
                error_email = true;
            }else{
                error_email = false;
                $("#email_error_message").hide();
                $("#email").removeClass("is-invalid");
            }
        }

        // Validate URL
        function check_website() {

            var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            var website = $("#website").val();

            if( $.trim( $('#website').val() ) == '' ){
                $("#website_error_message").hide();
                $("#website").removeClass("is-invalid");
            }else if(!website.match(pattern)) {
                $("#website_error_message").html("Enter a valid URL.");
                $("#website_error_message").show();
                $("#website").addClass("is-invalid");
                error_website = true;
            } else{
                $("#website_error_message").hide();
                $("#website").removeClass("is-invalid");
            }
        }

        $('#cancel_button').click(function(){
            swal({
                title: "Are you sure?",
                text: "",
                icon: "warning",
                buttons: ["No", "Yes, cancel!"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    location.reload();
                }
            });
        });

        // Bring company information.
        function getCompany() {
            $.ajax({
                url: "company_action.php",
                type: "POST",
                data: {action: 'fetch_company'},
                success: function (data) {
                    data = JSON.parse(data);
                    $('#company_name').val(data.company_name);
                    $('#website').val(data.company_website);
                    $('#email').val(data.company_email);
                    $('#address').val(data.company_address);
                    $('#city').val(data.company_city);
                    $('#country').val(data.company_country);
                    $('#zip_code').val(data.company_zip_code);
                    $('#phone').val(data.company_phone);
                    $('#fax').val(data.company_fax);
                    $('#vat_number').val(data.company_vat_number);
                    $('#company_number').val(data.company_number);
                }
            });
        }

        // Update company information
        $('#update_company_form').on('submit', function (event) {
            event.preventDefault();
            error_company_name = false;
            error_email = false;
            error_website = false;

            check_company_name();
            check_email();
            check_website();

            if (error_company_name == false && error_email == false && error_website == false) {
                $.ajax({
                    url:"company_action.php",
                    type:"POST",
                    data: $('#update_company_form').serialize()+'&action=update_company',
                    beforeSend:function(){
                        $('#update_profile_button').val('Please wait...');
                        $('#update_profile_button').attr('disabled', 'disabled');
                        $('#cancel_button').attr('disabled', 'disabled');
                    },success:function(data){
                        data = JSON.parse(data);
                        swal("Success!", data.message, "success");
                        getCompany();
                        $('#update_profile_button').val('Update');
                        $('#update_profile_button').attr('disabled', false);
                        $('#cancel_button').attr('disabled', false);
                    },error:function(){
                        swal("Oops..!", "Something went wrong.", "error");
                        $('#update_profile_button').val('Save');
                        $('#update_profile_button').attr('disabled', false);
                        $('#cancel_button').attr('disabled', false);
                    }
                });
            }
        });

        // Upload company logo
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width:200,
                height:200,
                type:'square'
            },
            boundary:{
                width:300,
                height:300
            }
        });

        $('#upload_image').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                })
            }
            reader.readAsDataURL(this.files[0]);
            $('#upload_image_modal').modal('show');
        });

        $('.update_logo_button').click(function(event){
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response){
                $.ajax({
                    url:"company_action.php",
                    type:"POST",
                    data: {"image": response, action: 'update_company_logo'},
                    success:function(data) {
                        console.log(data);
                        $('#upload_image_modal').modal('hide');
                        location.reload();
                    },error:function(){
                        swal("Oops..!", "Something went wrong.", "error");
                    }
                });
            })
        });

        // Bring Company Logo
        function bringCompanyLogo(){
            $('#uploaded_image').html('<img src="images/company_logo.png" class="img-thumbnail" />');
        }
    });

</script>