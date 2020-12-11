<?php
require_once 'connection.php';
session_start();
$output = '';

$email = $_POST["email"];
$password = sha1($_POST["password"]);

$sql_email = "SELECT * FROM tbl_users WHERE user_email = :email";
$statement = $connect->prepare($sql_email);
$result = $statement->execute(['email'=>$_POST["email"]]);
$logged_in_user = $statement->fetch();

if($logged_in_user != null){
  if ($logged_in_user['user_status'] == 'Inactive') {
    $output = array(
      'type'         => 'inactive',
      'message'      => 'This user has been set as inactive. Please contact your administrator.'
    );
  } elseif ($password == $logged_in_user['user_password']){
    if(!empty($_POST['custom_check'])){
      setcookie("email", $email, time()+(30*24*60*60), '/');
      setcookie("password", $_POST["password"], time()+(30*24*60*60), '/');
    } else {
      setcookie("email","",1,'/');
      setcookie("password","",1,'/');
    }
    $output = array(
      'type'            => 'success'
    );
    $_SESSION['user_id']         = $logged_in_user['user_id'];
    $_SESSION['user_full_name']  = $logged_in_user['user_full_name'];
    $_SESSION['user_email']      = $logged_in_user['user_email'];
    $_SESSION['user_role']       = $logged_in_user['user_role'];
  } else {
    $output = array(
      'type'         => 'warning',
      'message'      => 'Incorrect email or password.'
    );
  }
} else {
  $output = array(
    'type'           => 'error',
    'message'        => 'No account found with that email address.'
  );
}
echo json_encode($output);
?>