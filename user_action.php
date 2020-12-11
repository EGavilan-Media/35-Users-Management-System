<?php
require_once 'connection.php';
session_start();
$output = '';

if(isset($_POST["action"])){

  // Fetch all users
  if($_POST["action"] == "user_fetch"){

    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $row_per_page = $_POST['length']; // Rows display per page
    $column_index = $_POST['order'][0]['column']; // Column index
    $column_name = $_POST['columns'][$column_index]['data']; // Column name
    $column_sort_order = $_POST['order'][0]['dir']; // asc or desc
    $search_value = $_POST['search']['value']; // Search value

    $search_array = array();

    ## Search 
    $search_query = " ";
    if($search_value != ''){
      $search_query = " AND (user_id LIKE :user_id or 
            user_full_name LIKE :user_full_name OR
            user_email LIKE :user_email OR
            user_gender LIKE :user_gender OR
            user_status LIKE :user_status OR
            user_role LIKE :user_role ) ";

        $search_array = array( 
            'user_id'        =>   "%$search_value%", 
            'user_full_name' =>   "%$search_value%",
            'user_email'     =>   "%$search_value%",
            'user_gender'    =>   "%$search_value%",
            'user_status'    =>   "%$search_value%",
            'user_role'      =>   "%$search_value%"
        );
    }

    ## Total number of records without filtering
    $statement = $connect->prepare("SELECT COUNT(*) AS allcount FROM tbl_users");
    $statement->execute();
    $records = $statement->fetch();
    $total_records = $records['allcount'];

    ## Total number of records with filtering
    $statement = $connect->prepare("SELECT COUNT(*) AS allcount FROM tbl_users WHERE 1 ".$search_query);
    $statement->execute($search_array);
    $records = $statement->fetch();
    $total_record_with_filter = $records['allcount'];

    ## Fetch records
    $statement = $connect->prepare("SELECT * FROM tbl_users WHERE 1 ".$search_query." ORDER BY ".$column_name." ".$column_sort_order." LIMIT :limit,:offset");

    ## Bind values
    foreach($search_array as $key=>$search){
        $statement->bindValue(':'.$key, $search,PDO::PARAM_STR);
    }

    $statement->bindValue(':limit', (int)$row, PDO::PARAM_INT);
    $statement->bindValue(':offset', (int)$row_per_page, PDO::PARAM_INT);
    $statement->execute();
    $user_records = $statement->fetchAll();

    $data = array();

    foreach($user_records as $row){

      $status = '';
      if($row["user_status"] == "Active"){
        $status = '<label class="badge badge-success">Active</label>';
      }else if($row["user_status"] == "Inactive"){
        $status = '<label class="badge badge-danger">Inactive</label>';
      }

      $data[] = array(
          "user_id"          =>    $row['user_id'],
          "user_full_name"   =>    $row['user_full_name'],
          "user_email"       =>    $row['user_email'],
          "user_gender"      =>    $row['user_gender'],
          "user_role"        =>    $row['user_role'],
          "user_status"      =>    $status,
          "action"           =>    '<button type="button" class="btn btn-secondary view_user btn-sm" data-toggle="modal" data-target="#read_modal" id="'.$row['user_id'].'"><i class="fas fa-eye"></i></button>
                                    <button type="button" class="btn btn-success update_user btn-sm" id="'.$row['user_id'].'"><i class="fas fa-edit"></i></button>'
      );
    }

    ## Response
    $response = array(
      "draw"                   => intval($draw),
      "iTotalRecords"          => $total_records,
      "iTotalDisplayRecords"   => $total_record_with_filter,
      "aaData"                 => $data
    );

    echo json_encode($response);
  }

  if($_POST["action"] == "add_user"){

    $data = array(
      ':full_name'		       	=>	$_POST["full_name"],
      ':email'	            	=>	$_POST["email"],
      ':gender'		            =>	$_POST["gender"],
      ':status'	        	    =>	$_POST["status"],
      ':role'	                =>	$_POST["role"],
      ':password'	          	=>	sha1($_POST["password"])
    );

    // Validate if the email adresss exists.
    $sql_email = "SELECT user_email FROM tbl_users WHERE user_email = :email";
    $statement = $connect->prepare($sql_email);
    $statement->execute(['email'=>$_POST["email"]]);

    if($statement->fetchAll()){
      $output = array(
        'type'            => 'warning',
        'message'         => 'This E-mail is already registered!'
      );
    } else {
      $sql_user = "INSERT INTO tbl_users(user_created_by,
                                  user_full_name, 
                                  user_email, 
                                  user_gender, 
                                  user_status, 
                                  user_role, 
                                  user_password,
                                  user_created_at) 
                              VALUES('".$_SESSION["user_id"]."',
                                  :full_name,
                                  :email, 
                                  :gender, 
                                  :status, 
                                  :role, 
                                  :password,
                                  NOW())";
    
      $statement = $connect->prepare($sql_user);    
      if($statement->execute($data)) {
        $output = array(
          'type'            => 'success',
          'message'         => 'New user has been successfully registered.'
        );
      // Send a email letting the new user know that a new username has been created under his/her email account.
      } 
    }
    echo json_encode($output);
  }

  // Single fetch
  if($_POST["action"] == "single_fetch"){

    $sql_user = "SELECT u1.user_id,
                    u1.user_full_name,
                    u1.user_email,
                    u1.user_gender,
                    u1.user_status,
                    u1.user_role,
                    u2.user_full_name,
                    u1.user_created_at,
                    u1.user_updated_at,
                    u3.user_full_name
                  FROM tbl_users AS u1 
                  INNER JOIN tbl_users AS u2
                  ON u1.user_created_by=u2.user_id 
                  LEFT JOIN tbl_users AS u3
                  ON u1.user_last_update_by=u3.user_id 
                  WHERE u1.user_id = :user_id";

    $statement = $connect->prepare($sql_user);
    $result = $statement->execute(['user_id'=>$_POST["user_id"]]);
    $row = $statement->fetch();

    $output = array(
      "user_id"                  =>  $row[0],
      "user_full_name"           =>  $row[1],
      "user_email"               =>  $row[2],
      "user_gender"              =>  $row[3],
      "user_status"              =>  $row[4],
      "user_role"                =>  $row[5],
      "user_created_by"          =>  $row[6],
      "user_created_at"          =>  $row[7],
      "user_updated_at"          =>  $row[8],
      "user_last_update_by"      =>  $row[9]
    );
    echo json_encode($output);
  }

  // Update User Profile
  if($_POST["action"] == "update_user_profile"){

    $data = array(
      ':full_name'		       	=>	$_POST["update_full_name"],
      ':email'	            	=>	$_POST["update_email"],
      ':gender'		            =>	$_POST["update_gender"],
      ':role'	                =>	$_POST["update_role"],
      ':status'	        	    =>	$_POST["update_status"]
    );

    // Validate if the email adresss exists.
    $sql_email = "SELECT user_email FROM tbl_users WHERE user_email = :email AND user_id != '".$_POST["update_profile_id"]."'";
    $statement = $connect->prepare($sql_email);
    $statement->execute(['email'=>$_POST["update_email"]]);

    if($statement->fetchAll()){
      $output = array(
        'type'            => 'warning',
        'message'         => 'This E-mail is already registered!'
      );
    } else {
      $sql_user = "UPDATE tbl_users SET user_last_update_by = '".$_SESSION["user_id"]."',
                                    user_full_name = :full_name,
                                    user_email = :email,
                                    user_gender = :gender,
                                    user_role = :role,
                                    user_status = :status,
                                    user_updated_at = NOW()
                                    WHERE user_id = '".$_POST["update_profile_id"]."'";
                        
      $statement = $connect->prepare($sql_user);
      if($statement->execute($data)) {
        $output = array(
          'type'            => 'success',
          'message'         => 'User profile has been successfully updated.'
        );
      }
    }    
    echo json_encode($output);
  }

  // Update User Password
  if($_POST["action"] == "update_user_password"){
    $data = array(
      ':update_password'		  	=>	sha1($_POST["update_password"])
    );

    $sql_user = "UPDATE tbl_users SET user_last_update_by = '".$_SESSION["user_id"]."',
                                    user_password = :update_password,
                                    user_updated_at = NOW()
                                  WHERE user_id = '".$_POST["update_password_id"]."'";

    $statement = $connect->prepare($sql_user);
    if($statement->execute($data)) {
      $output = array(
        'type'            => 'success',
        'message'         => 'User profile has been successfully updated.'
      );
    }
    echo json_encode($output);
  }
}

?>