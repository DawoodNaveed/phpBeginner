<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="searchstyle.css">
</head>
<body>

<?php
$q = ($_GET['q']);
$servername = "localhost";
$username = "root";
$password = "Dawood123";
$dbname = "myDB";
$result_per_page=10;
// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

mysqli_select_db($con,"my_db");
$sql="SELECT * FROM Books WHERE publisher  like '%".$q."%' OR p_name like '%".$q."%' OR ISBN like '%".$q."%'";
$result = mysqli_query($con,$sql);
echo '<div class="container">';
echo '<div class="row">';
while($row = mysqli_fetch_array($result)) {

    echo "<div class='col-sm-4'>";
    echo '<img src="'.$row["image"].'" " width="170" height="170" />';
    echo '<br>';
    echo "<span> Name: " . $row['p_name'] . "</span>";
    echo '<br>';
    echo "<span> ISBN: " . $row['ISBN'] . "</span>";
    echo '<br/>';
    echo "<span>Publisher: " . $row['publisher'] . "</span>";
    echo "</div>";
}
echo '</div>';
echo '</div>';
mysqli_close($con);
?>
</body>
</html>