<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    echo "helo";
      $servername = "localhost";
      $username = "root";
      $password = "Dawood123";
      $dbname = "myDB";

// Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } if (isset($_POST['']))
      $myArr = array();
      $i=0;
      $sql = "SELECT * FROM Products";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $data["id"]=$row["id"];
              $data["p_name"]=$row["p_name"];
              $data["image"]=$row["image"];
              $i++;
          }
      } else {
          echo "0 results";
      }
      return $myArr;
      $conn->close();
  }

?>