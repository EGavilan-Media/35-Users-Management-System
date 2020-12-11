<?php
include "connection.php";

  $output = '';
  if(isset($_POST["action"])){

    // Get dashboard information.
    if($_POST["action"] == "add_info"){

      $sql_users = "SELECT COUNT(*) FROM tbl_users
                  UNION
                  SELECT COUNT(*) FROM tbl_users WHERE user_status = 'Active'
                  UNION
                  SELECT COUNT(*) FROM tbl_users WHERE user_status = 'Inactive'
                  UNION
                  SELECT COUNT(*) FROM tbl_users WHERE MONTH(user_created_at) = MONTH(CURRENT_DATE()) AND YEAR(user_created_at) = YEAR(CURRENT_DATE())";

      $statement = $connect->prepare($sql_users);
      $statement->execute();
      $users_records = $statement->fetchAll();

      $output = array(
          'total_users'               => $users_records[0][0],
          'total_active_users'        => $users_records[1][0],
          'total_inactive_users'      => $users_records[2][0],
          'total_new_users'           => $users_records[3][0]
      );

      echo json_encode($output);
    }

    // Get total users created monthly.
    if($_POST["action"] == "monthly_total_users"){

      $sql_monthly_total_users = "SELECT DATE_FORMAT(user_created_at, '%Y-%m'), COUNT(DATE_FORMAT(user_created_at, '%Y-%m'))
      FROM tbl_users WHERE YEAR(`user_created_at`)=YEAR(CURRENT_DATE) GROUP BY DATE_FORMAT(user_created_at, '%m-%Y') ASC LIMIT 6";

      $statement = $connect->prepare($sql_monthly_total_users);
      $statement->execute();
      $user_records = $statement->fetchAll();
    
      foreach($user_records as $row){
        $valuesX[] = $row[0];
        $valuesY[] = $row[1];
      }

      $output=array(
        'date'        => $valuesX,
        'users'       => $valuesY,
      );
      echo json_encode($output);
    }

    // Get latest users
    if($_POST["action"] == "latest_users"){

      $sql_latest_users="SELECT user_id, 
                              user_full_name, 
                              user_email, 
                              user_gender, 
                              user_role, 
                              user_status 
                            FROM tbl_users ORDER BY user_id DESC LIMIT 5";

      $statement = $connect->prepare($sql_latest_users);
      $statement->execute();
      $user_records = $statement->fetchAll();

      $output = '
      <div>
        <table class="table table-hover table-condensed table-bordered" id="dataTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Gender</th>
              <th>Role</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>';
          foreach($user_records as $row) {
            $status = '';
            if($row["user_status"] == "Active"){
              $status = '<label class="badge badge-success">Active</label>';
            }else if($row["user_status"] == "Inactive"){
              $status = '<label class="badge badge-danger">Inactive</label>';
            }
            $output .= '
            <tr>
              <td style="text-align: left;">'.$row[0].'</td>
              <td style="text-align: left;">'.$row[1].'</td>
              <td style="text-align: left;">'.$row[2].'</td>
              <td style="text-align: left;">'.$row[3].'</td>
              <td style="text-align: left;">'.$row[4].'</td>
              <td style="text-align: left;">'.$status.'</td>
            </tr>
            ';
          }
          $output .= '
          </tbody>
        </table>
      </div>';
      echo $output;
    }

    // Get gender distribution
    if($_POST["action"] == "gender_info"){

      $sql_gender_distribution = "SELECT COUNT(*) FROM tbl_users WHERE user_gender = 'Male'
                                UNION
                                SELECT COUNT(*) FROM tbl_users WHERE user_gender = 'Female'";

      $statement = $connect->prepare($sql_gender_distribution);
      $statement->execute();
      $users_records = $statement->fetchAll();

      $output=array(
        'total_male'        => $users_records[0][0],
        'total_female'      => $users_records[1][0],
      );
      echo json_encode($output);
    }
  }
?>