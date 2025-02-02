<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="data-style.css">
    <link rel="icon" href="Untitled-1.svg">
    <title>DATA Base </title>
</head>
<body>
    <div class="container">
        <h2>patients list<small>   just for Doctor</small></h2>
        <ul class="responsive-table">
          <li class="table-header" style="background-color: rgba(95, 126, 149, 0.35)">
                <div class="col col-5">Delete</div>
                <div class="col col-3">File Number</div>
                <div class="col col-2">Last Name</div>
                <div class="col col-2">Second Name</div>
                <div class="col col-2">First Name</div>
                <div class="col col-1">User Id</div>  
          </li>

            <?php
                  include"db.php";
                  $query=" SELECT * FROM `patients` ORDER BY first_name COLLATE utf8mb4_general_ci";
                  $result = mysqli_query($conn,$query);
                  if (mysqli_num_rows($result)>0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                              echo "<li class='table-row'>";
                               $idodo = $row["patient_id"];
                              echo " <div class='col col-5' data-label='Action'><button onclick='deleto($idodo)' class='button1'>Delete</button></div>";

                              echo " <div class='col col-5' data-label='User Password'>",$row["file_number"],"</div>";
                                echo " <div class='col col-4' data-label='User Name'>",$row["last_name"],"</div>";
                               echo " <div class='col col-3' data-label='User Name'>",$row["second_name"],"</div>";
                               echo " <div class='col col-2' data-label='User Name'>",$row["first_name"],"</div>";
                              echo " <div class='col col-1' data-label='User Id'>",$row["patient_id"],"</div>";
                              echo "</li>";
                        }
                        mysqli_close($conn);
                  }
            ?>

        </ul>
      </div>
</body>
</html>
<script>
      function deleto(params) {
            if (confirm("هل انت متاكد؟") == true)
                  window.location.href = "delete.php?patient_id=" + params;
    }
</script>