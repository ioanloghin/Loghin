<?php

if(isset($_POST['country'])){

$servername = "localhost";
$username = "loghin_ioanchis";
$password = "QAwmnx7|pMC%";
$database = "loghin_data";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//  echo "Connected successfully";




        $country = $_POST["country"];
         
       
          $query=mysqli_query($conn,"SELECT * FROM data_language1 INNER JOIN data_country ON data_language1.id = data_country.language_id WHERE data_country.name = '$country'");
          $row=mysqli_fetch_array($query);
            if(mysqli_num_rows($query)>0)
            {
                    
                    // echo "<option>". $row['short_title'] . "</option>";
                     echo json_encode(array(
                      "statusCode"=>200,
                      "value"=>$row['short_title'],
                      "value1"=>$row['language'],
                      "value2"=>$row['multiple_lang'],
                     
                    
              ));
        } 
        else{
            echo json_encode(array("statusCode"=>203));
        }
    }




?>



