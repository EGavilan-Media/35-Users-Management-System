<?php include('include/header.php'); ?>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview </li>
    </ol>
    <?php if($_SESSION['user_role']=="Admin"){ ?>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-users"></i>
                </div>
                <h4><b id="view_total_users"></b> Total Users</h4>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="user.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <h4><b id="view_total_active_users"></b> Active Users</h4>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="user.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-user-minus"></i>
                </div>
                <h4><b id="view_total_inactive_users">13</b> Inactive Users</h4>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="user.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                <i class="fas fa-plus"></i>
                </div>
                <h4><b id="view_total_new_users"></b> New Users This Month</h4>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="user.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Monthly Created Users</div>
          <div class="card-body">
            <canvas id="monthly_created_users_chart" width="100%" height="20"></canvas>
          </div>
        </div>

        <!-- Area Charts -->
        <div class="row" style="margin-bottom: 247px;">
          <div class="col-lg-8">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                Latest Created Users</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <div id="latest_users"></div>
                  </div>
                </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-pie"></i>
                Gender Distribution</div>
              <div class="card-body">
                <canvas id="gender_distribution" width="100%" height="70"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- ./Area Charts -->

        <?php } else { ?>

        <!-- User welcome section -->
        <section class="py-5 text-center container">
          <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
              <h1 class="fw-light">Welcome!</h1>
                <p class="lead text-muted"><?php echo $_SESSION['user_full_name']; ?><p>
                <a href="profile.php" class="btn btn-primary my-2">Profile</a>
                <a href="logout.php" class="btn btn-secondary my-2">Logout</a>
              </p>
            </div>
          </div>
        </section>
        <!-- ./User welcome section -->

<?php } include('include/footer.php'); ?>

<script>
  // Display users information
  $.ajax({
    url:"admin_action.php",
    method:"POST",
    data:{action:'add_info'},
    dataType: "json",
    success:function(data){
      $('#view_total_users').text(data['total_users']);
      $('#view_total_active_users').text(data['total_active_users']);
      $('#view_total_inactive_users').text(data['total_inactive_users']);
      $('#view_total_new_users').text(data['total_new_users']);
    }
  });

  // Monthly Created Users
  $.ajax({
    url:"admin_action.php",
    method:"POST",
    data:{action:'monthly_total_users'},
    dataType: "json",
    success:function(data){

      // Set new default font family and font color to mimic Bootstrap's default styling
      Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#292b2c';

      // Line Chart Created Users
      var monthly_created_users_chart = document.getElementById("monthly_created_users_chart");
      var myLineChart = new Chart(monthly_created_users_chart, {
        type: 'line',
        data: {
          labels: data.date,
          datasets: [{
            label: "Users Created",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: data.users,
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'date'
              },
              gridLines: {
                display: false
              },
              ticks: {
                maxTicksLimit: 7
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 100,
                maxTicksLimit: 5
              },
              gridLines: {
                color: "rgba(0, 0, 0, .125)",
              }
            }],
          },
          legend: {
            display: false
          }
        }
      });
    }
  });

  // Latest Users
  $.ajax({
    url:"admin_action.php",
    method:"POST",
    data:{action:'latest_users'},
    success:function(data){
      $('#latest_users').html(data);
    }
  });

  // Display Gender Distribution
  $.ajax({
    url:"admin_action.php",
    method:"POST",
    data:{action:'gender_info'},
    dataType: "json",
    success:function(data){
      // Set new default font family and font color to mimic Bootstrap's default styling
      Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#292b2c';

      // Pie Chart of Gender Distribution
      var gender_distribution = document.getElementById("gender_distribution");
      var gender_distribution = new Chart(gender_distribution, {
        type: 'doughnut',
        data: {
          labels: ["Male", "Female"],
          datasets: [{
            data: [data.total_male, data.total_female],
            backgroundColor: ['#007bff', '#dc3545'],
          }],
        },
      });
    }
  });
</script>