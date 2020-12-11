<?php
// Company action.
require_once "connection.php";
session_start();
$output = '';

if(isset($_POST["action"])){

    // Get company information.
    if($_POST["action"] == "fetch_company"){
        $sql_company = "SELECT company_name,
                            company_website,
                            company_email,
                            company_address,
                            company_city,
                            company_country,
                            company_zip_code,
                            company_phone,
                            company_fax,
                            company_vat_number,
                            company_number
                        FROM tbl_company
                        WHERE company_id = '1'";

        $statement = $connect->prepare($sql_company);
        $result = $statement->execute();
        $row = $statement->fetch();

        $output = array(
            'company_name'             =>    $row[0],
            'company_website'          =>    $row[1],
            'company_email'            =>    $row[2],
            'company_address'          =>    $row[3],
            'company_city'             =>    $row[4],
            'company_country'          =>    $row[5],
            'company_zip_code'         =>    $row[6],
            'company_phone'            =>    $row[7],
            'company_fax'              =>    $row[8],
            'company_vat_number'       =>    $row[9],
            'company_number'           =>    $row[10]
        );
        echo json_encode($output);
    }

    // Update company information.
    if($_POST["action"] == "update_company"){
        $data = array(
            ':company_name'                 =>	$_POST["company_name"],
            ':company_website'              =>	$_POST["website"],
            ':company_email'                =>	$_POST["email"],
            ':company_address'              =>	$_POST["address"],
            ':company_city'                 =>	$_POST["city"],
            ':company_country'              =>	$_POST["country"],
            ':company_zip_code'             =>	$_POST["zip_code"],
            ':company_phone'                =>	$_POST["phone"],
            ':company_fax'                  =>	$_POST["fax"],
            ':company_vat_number'           =>	$_POST["vat_number"],
            ':company_number'               =>	$_POST["company_number"]
        );

        $sql_company = "UPDATE tbl_company SET company_last_update_by = '".$_SESSION["user_id"]."',
                                            company_name = :company_name,
                                            company_website = :company_website,
                                            company_email = :company_email,
                                            company_address = :company_address,
                                            company_city = :company_city,
                                            company_country = :company_country,
                                            company_zip_code = :company_zip_code,
                                            company_phone = :company_phone,
                                            company_fax = :company_fax,
                                            company_vat_number = :company_vat_number,
                                            company_number = :company_number,
                                            company_updated_at = NOW()
                                        WHERE company_id = '1'";

        $statement = $connect->prepare($sql_company);
        if($statement->execute($data)) {
            $output = array(
                'type'            => 'success',
                'message'         => 'Company information has been updated successfully.'
            );
        }
        echo json_encode($output);
    }

    // Update Company Logo
    if($_POST["action"] == "update_company_logo"){
        $data = $_POST["image"];
        $image_name = "company_logo.png";
        $storage_folder = 'images';
        $final_path = $storage_folder.'/'. $image_name;

        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);

        file_put_contents($final_path, $data);
    }
}
?>