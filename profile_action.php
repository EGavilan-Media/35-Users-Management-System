<?php
// Current user logged in action.
require_once "connection.php";
session_start();
$output = '';

if(isset($_POST["action"])){

    // Get current logged in user profile information.
    if($_POST["action"] == "profile_fetch"){

        $sql_profile = "SELECT user_full_name,
                            user_email,
                            user_gender
                        FROM tbl_users WHERE user_id = :user_id";

        $statement = $connect->prepare($sql_profile);
        $result = $statement->execute(['user_id'=>$_SESSION["user_id"]]);
        $row = $statement->fetch();

        $output = array(
            'user_full_name'      =>    $row[0],
            'user_email'          =>    $row[1],
            'user_gender'         =>    $row[2],
        );

        echo json_encode($output);
    }

    // Update current logged in user profile information.
    if($_POST["action"] == "update_profile"){
        $data = array(
            ':full_name'		=>	$_POST["full_name"],
            ':gender'           =>	$_POST["gender"]
        );

        $sql_profile = "UPDATE tbl_users SET user_full_name = :full_name,
                                        user_gender = :gender,
                                        user_last_update_by = '".$_SESSION["user_id"]."',
                                        user_updated_at = NOW()
                                    WHERE user_id = '".$_SESSION["user_id"]."'";

        $statement = $connect->prepare($sql_profile);
        if($statement->execute($data)) {
            $output = array(
                'type'            => 'success',
                'message'         => 'Your profile has been successfully updated.'
            );
        }
        echo json_encode($output);
    }

    // Update current logged in user password
    if($_POST["action"] == "update_password"){

        $data = array(
            ':new_password'         =>	sha1($_POST["new_password"])
        );

        $sql_profile = "SELECT * FROM tbl_users WHERE user_email = :email";
        $statement = $connect->prepare($sql_profile);
        $result = $statement->execute(['email'=>$_SESSION["user_email"]]);
        $profile_results = $statement->fetch();

        // Validate current password.
        if ($profile_results['user_password'] != sha1($_POST["current_password"])){
            $output = array(
                'type'        => 'warning',
                'message'     => 'Your current password does not match with our records.'
            );
        } else {
            $sql_user = "UPDATE tbl_users SET user_last_update_by = '".$_SESSION["user_id"]."',
                                            user_password = :new_password,
                                            user_updated_at = NOW()
                                        WHERE user_id = '".$_SESSION["user_id"]."'";

            $statement = $connect->prepare($sql_user);
            if($statement->execute($data)) {
                $output = array(
                    'type'            => 'success',
                    'message'         => 'Your password has been successfully updated.'
                );
            }
        }
        echo json_encode($output);
    }
}
?>