<?php
    // This code snippet is responsible for inserting patient data into the database.
    // It retrieves the necessary parameters from the URL and performs an insert operation using prepared statements.

    // Include the database connection file
    include_once "db.php";
    echo "sending data : ";
    // Check if first name, last name, and file number are provided
    if($_GET["first_name"] && !empty($_GET["first_name"]) && !isset($_GET["second_name"]) && $_GET["last_name"] && !empty($_GET["last_name"]) && $_GET["file_number"] && !empty( $_GET["file_number"])){
        $first_name = $_GET["first_name"];
        $last_name = $_GET["last_name"];
        $file_number = $_GET["file_number"];
        // Prepare the SQL statement for inserting data into the "patients" table
        $stmt =$conn->prepare("insert into patients (first_name,last_name,file_number) values (? , ? , ?)");
        $stmt->bind_param("ssi",$first_name,$last_name,$file_number);
        $stmt->execute();
    }
    // Check if all required parameters are provided
    elseif ($_GET["first_name"] && !empty($_GET["first_name"]) && $_GET["second_name"] && !empty($_GET["second_name"]) && $_GET["last_name"] && !empty($_GET["last_name"]) && $_GET["file_number"] && !empty( $_GET["file_number"])) {
        $first_name = $_GET["first_name"];
        $second_name = $_GET["second_name"];
        $last_name = $_GET["last_name"];
        $file_number = $_GET["file_number"];
        // Prepare the SQL statement for inserting data into the "patients" table
        $stmt =$conn->prepare("insert into patients (first_name,second_name,last_name,file_number) values (? ,?, ? , ?)");
        $stmt->bind_param("sssi",$first_name,$second_name,$last_name,$file_number);
        $stmt->execute();
    }


?>