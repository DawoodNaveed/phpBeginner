<?php
// Start the session
require 'conn.php';
session_start();
?>
<?php

function insert_book()
{
    $conn = Singleton::getInstance();
    if(!$conn)
    {
        echo "error";
    }
    else
    {
        echo "success";
    }

   $bookName=$_SESSION['name'];
   $publisher=$_SESSION['publisher'];
   $ISBN=$_SESSION["ISBN"];
   $img=$_SESSION['image'];
   try {
       $sql = "INSERT INTO Books (p_name, publisher,ISBN, image)
   VALUES ('$bookName','$publisher', '$ISBN', '$img')";
       // use exec() because no results are returned
      $conn->exec($sql);
       echo "New record created successfully";
   }
   catch
   (PDOException $e) {
       $conn->close();
   }
}





function get_products($limit,&$count)
{
    $servername = "localhost";
    $username = "root";
    $password = "Dawood123";
    $dbname = "myDB";
    $result_per_page=10;
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $myArr = array();
    $i=0;
    $sql = "SELECT * FROM Books LIMIT ".$limit.','.$result_per_page;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $myArr["id".$i]=$row["id"];
            $myArr["p_name".$i]=$row["p_name"];
            $myArr["publisher".$i]=$row["publisher"];
            $myArr["ISBN".$i]=$row["ISBN"];
            $myArr["image".$i]=$row["image"];
            $i++;
        }
    } else {
        echo "0 results";
    }
    $count=$i;
    return $myArr;
    $conn->close();
}
function edit_book()
{
    $name=$_SESSION["name"];
    $id=$_SESSION["edit_id"];
    $publisher=$_SESSION["publisher"];
    $image=$_SESSION["image"];
    $ISBN=$_SESSION["ISBN"];
    $conn = Singleton::getInstance();
    $sql = "UPDATE Books SET p_name=?,publisher=?,image=?, ISBN=? WHERE id=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$name, $publisher,$image, $ISBN, $id]);
    header("Location: viewbooks.php");
}
function delete($id)
{
    $conn = Singleton::getInstance();
    $count=$conn->prepare("DELETE FROM Books WHERE id=:id");
    $count->bindParam(":id",$id,PDO::PARAM_INT);
    $count->execute();
    header("Location: viewbooks.php");
}
function get_products_count(&$count)
{

    $servername = "localhost";
    $username = "root";
    $password = "Dawood123";
    $dbname = "myDB";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $myArr = array();
    $i=0;
    $sql = "SELECT * FROM Books";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $i++;
        }
    } else {
        echo "0 results";
    }
    $count=$i;
    $conn->close();
}
?>


