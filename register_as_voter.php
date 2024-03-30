<?php
 require_once "config.php";
// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $firstName = $_POST["firstName"];
    $lastname = $_POST["lastname"];
    $emailaddress = $_POST["emailaddress"];
    $gender = $_POST["gender"];
    $identitytype= $_POST["identitytype"];
    $votersid = $_POST["votersid"];
   

    // Prepare and execute an SQL statement to insert the data into the table
    $sql = "INSERT INTO voter (first_name, last_name, email, gender, identity_type, voter_id) VALUES ('$firstName', '$lastname', '$emailaddress', '$gender', '$identitytype', '$votersid')";

    if ($link->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
    header("location: homepage.html");
}
// Perform your database operations here

// Close the connection
$link->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register As Voter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 100%; padding: 8% 30% 10% 30%; }
        h2{
            font-weight: bold;
            text-shadow: 5px;
        }
    </style>
</head>
<body>
    <div class="wrapper col-12">
        <h2>Register as Voter</h2>
        <p>Please fill in your credentials to register.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="#" method="POST" >
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstName" class="form-control" required>
                
            </div>    
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" required>
                
            </div>    
            <div class="form-group">
                <label>Email Address</label>
                <input type="text" name="emailaddress" class="form-control" required>
                
            </div>    
               
            <div class="form-group">
                <label>Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option selected disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
            </div>
            
            <div class="form-group">
                <label>Identity Type</label>
                <select class="form-select" id="identity_type" name="identitytype" required onchange="showVotersIDField()">
                  <option selected disabled>Select Identity Type</option>
                  <option value="National ID Card">National ID Card</option>
                  <option value="Passport">Passport</option>
                </select>
            </div>
            <div class="mb-3" id="voters_id_field" style="display: none;">
                <label for="voters_id" class="form-label">Voters ID</label>
                <input type="text" class="form-control" id="voters_id" name="votersid">
              </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register">
            </div>
            
        </form>
    </div>
    <script>
        function showVotersIDField() {
      const identityType = document.getElementById("identity_type").value;
      const votersIDField = document.getElementById("voters_id_field");
      
      if (identityType === "National ID Card" || identityType === "Passport") {
          votersIDField.style.display = "block";
      } else {
        votersIDField.style.display = "none";
      }
    }
    </script>
</body>
</html>