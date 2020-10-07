<?php

session_start();
?>
<?php include 'db.php';?>
<?php
$image=$name=$id=$ISBN=$publisher="";
$priceCheck=$nameCheck=$imageCheck=$publisherCheck=$ISBNCheck=$imageCheck=false;
if(isset($_REQUEST["pid"]))
{
    $pid=$_REQUEST["pid"];

    $id=$_SESSION["id".$pid];
    echo $id;
    $_SESSION["edit_id"]=$id;




    $conn = Singleton::getInstance();

    $sql = "SELECT `id`, `p_name`,`ISBN`,`publisher`, `image` FROM `Books` WHERE `id` = :id";

//Prepare our SELECT statement.
    $statement = $conn->prepare($sql);

//The Primary Key of the row that we want to select

//Bind our value to the paramater :id.
    $statement->bindValue(':id', $id);

//Execute our SELECT statement.
    $statement->execute();

//Fetch the row.
    $row = $statement->fetch(PDO::FETCH_ASSOC);

//If $row is FALSE, then no row was returned.
    if($row === false){
        echo $id . ' not found!';
    } else{

        $name= $row['p_name'];
        $image=$row['image'];
        $_SESSION["image"]=$image;
        $ISBN=$row['ISBN'];
        $publisher=$row['publisher'];

    }

}

?>


<!DOCTYPE HTML>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

    </script>
    <style>
        .error {color: #ff0000;}
    </style>
</head>
<body>

<?php
// define variables and set to empty values
$nameErr = $imageErr = $publisherErr = $ISBNErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
        else
        {
            $nameCheck=true;
        }
    }
    if (empty($_POST["publisher"])) {
        $publisherErr = "publisher is required";
    } else {
        $publisher = test_input($_POST["publisher"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$publisher)) {
            $publisherErr = "Only letters and white space allowed";
        }
        else
        {
            $publisherCheck=true;
        }
    }
    if (empty($_POST["ISBN"])) {
        $ISBNErr = "ISBN is required";
    } else {
        $ISBN = test_input($_POST["ISBN"]);
        // check if name only contains letters and whitespace
        $ISBNCheck=true;

    }

    if (!empty($_POST["img"])) {
        $image = test_input($_POST["img"]);
        $_SESSION["image"]=$image;
        // check if name only contains letters and whitespace

    }



}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>BOOK DETAILS Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    Publisher: <input type="text" name="publisher" value="<?php echo $publisher;?>">
    <span class="error">* <?php echo $publisherErr;?></span>
    <br><br>
    ISBN: <input type="text" name="ISBN" value="<?php echo $ISBN;?>">
    <span class="error">* <?php echo $ISBNErr;?></span>
    <br><br>
    Image:
    <br/>
    <img src="<?php echo $image ?>"/>
    <br/><br/>
    <input type="file" name="img"/>

    <br><br>
    <input type="submit" name="submit" value="EDIT">
</form>
</body>
</html>
<?php
if($publisherCheck===true && $nameCheck===true&& $ISBNCheck===true)
{


    $_SESSION["name"] = $name;
    $_SESSION["publisher"]=$publisher;
    $_SESSION["ISBN"]=$ISBN;
    edit_book();
    $publisherCheck===false;
    $nameCheck===false;
}
