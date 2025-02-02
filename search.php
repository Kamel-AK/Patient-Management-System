<?php

    // This code snippet is responsible for handling the search functionality in the application.
    // It retrieves search parameters from the URL and performs a Levenshtein distance search in the database to find matching patients.
    // The results are then returned as JSON data.
    
    // Include the database connection file
    include_once "db.php";
    // Check if first name is provided
    if($_GET["first_name"] && !empty($_GET["first_name"])){
        $first_name = $_GET["first_name"];
        $stmt =$conn->prepare("SELECT *
        FROM patients
        WHERE LEVENSHTEIN(first_name, ?) < 3
           OR LEVENSHTEIN(second_name, ?) < 3
           OR LEVENSHTEIN(last_name, ?) < 3
        ORDER BY CASE WHEN first_name = ? THEN 0 ELSE 1 END,
                 CASE WHEN second_name = ? THEN 0 ELSE 1 END,
                 CASE WHEN last_name = ? THEN 0 ELSE 1 END,
                 LEVENSHTEIN(first_name, ?) ASC;");
        $stmt->bind_param("sssssss",$first_name,$first_name,$first_name,$first_name,$first_name,$first_name,$first_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $json_data = array();
        while ($row = $result->fetch_assoc()) {
            $json_data[] = $row;
        }
        echo json_encode($json_data);
    }
    // Check if first name and second name are provided
    elseif($_GET["first_name"] && !empty($_GET["first_name"]) && $_GET["second_name"] && !empty($_GET["second_name"])){
        $first_name = $_GET["first_name"];
        $second_name = $_GET["second_name"];
        $stmt =$conn->prepare("SELECT *
        FROM patients
        WHERE LEVENSHTEIN(first_name, ?) < 3
           OR LEVENSHTEIN(second_name, ?) < 3
        ORDER BY CASE WHEN first_name = ? THEN 0 ELSE 1 END,
                 CASE WHEN second_name = ? THEN 0 ELSE 1 END,
                 LEVENSHTEIN(first_name, ?) ASC
                 LEVENSHTEIN(second_name, ?) ASC;");
        $stmt->bind_param("ssssss",$first_name,$second_name,$first_name,$second_name,$first_name,$second_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $json_data = array();
        while ($row = $result->fetch_assoc()) {
            $json_data[] = $row;
        }
        echo json_encode($json_data);
    }
    // Check if first name, second name, and last name are provided
    elseif($_GET["first_name"] && !empty($_GET["first_name"]) && $_GET["second_name"] && !empty($_GET["second_name"]) && $_GET["last_name"] && !empty($_GET["last_name"])){
        $first_name = $_GET["first_name"];
        $second_name = $_GET["second_name"];
        $last_name = $_GET["last_name"];
        $stmt =$conn->prepare("SELECT *
        FROM patients
        WHERE LEVENSHTEIN(first_name, ?) < 3
           OR LEVENSHTEIN(second_name, ?) < 3
           OR LEVENSHTEIN(last_name, ?) < 3
        ORDER BY CASE WHEN first_name = ? THEN 0 ELSE 1 END,
                 CASE WHEN second_name = ? THEN 0 ELSE 1 END,
                 CASE WHEN last_name = ? THEN 0 ELSE 1 END,
                 LEVENSHTEIN(first_name, ?) ASC,
                 LEVENSHTEIN(second_name, ?) ASC,
                 LEVENSHTEIN(last_name, ?) ASC;");
        $stmt->bind_param("sssssssss", $first_name, $second_name, $last_name, $first_name, $second_name, $last_name, $first_name, $second_name, $last_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $json_data = array();
        while ($row = $result->fetch_assoc()) {
            $json_data[] = $row;
        }
        echo json_encode($json_data);
    }
    // Check if first name and last name are provided
    elseif ($_GET["first_name"] && !empty($_GET["first_name"]) && $_GET["last_name"] && !empty($_GET["last_name"])){
        $first_name = $_GET["first_name"];
        $last_name = $_GET["last_name"];
        $stmt =$conn->prepare("SELECT *
        FROM patients
        WHERE LEVENSHTEIN(first_name, ?) < 3
           OR LEVENSHTEIN(last_name, ?) < 3
        ORDER BY CASE WHEN first_name = ? THEN 0 ELSE 1 END,
                 CASE WHEN last_name = ? THEN 0 ELSE 1 END,
                 LEVENSHTEIN(first_name, ?) ASC
                 LEVENSHTEIN(last_name, ?) ASC;");
        $stmt->bind_param("sssssss",$first_name,$last_name,$first_name,$last_name,$first_name,$last_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $json_data = array();
        while ($row = $result->fetch_assoc()) {
            $json_data[] = $row;
        }
        echo json_encode($json_data);
    }
?>