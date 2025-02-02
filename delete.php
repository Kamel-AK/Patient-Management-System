<?php
    if (isset($_GET["patient_id"]) && !empty($_GET)) {
        $id = $_GET["patient_id"];
        include "db.php";
        $query = "DELETE FROM `patients` WHERE patient_id = '$id'";
        $result = mysqli_query($conn,$query);
        header("Location: data.php");
        exit();
    }
?>