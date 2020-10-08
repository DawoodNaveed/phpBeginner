<?php
// Start the session
session_start();
?>
<?php require'db.php'?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .error {color: #ff0000;}
    </style>
</head>
<body>

<?php
// define variables and set to empty values
$nameErr = $imageErr = $publisherErr = $ISBNErr = "";
$name = $publisher=$ISBN =$image="";
$priceCheck=$nameCheck=$imageCheck=$publisherCheck=$ISBNCheck=false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        } else {
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
        } else {
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

        if (empty($_POST["image"])) {
                $imageErr = "Image is required";
        } else {
                  $image = test_input($_POST["image"]);
                  $imageCheck=true;
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


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h2>BOOK DETAILS Form</h2>
    <p><span class="error">* required field</span></p>
    Name:<br>
    <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    Publisher:<br>
    <input type="text" name="publisher" value="<?php echo $publisher;?>">
    <span class="error">* <?php echo $publisherErr;?></span>
    <br><br>
    ISBN:
    <br><input type="text" name="ISBN" value="<?php echo $ISBN;?>">
    <span class="error">* <?php echo $ISBNErr;?></span>
    <br><br>
    Image:
    <input type="file" name="image" />

    <br><br>
    <input type="submit" name="submit" value="Submit">
    <a href="viewbooks.php">View Books</a>
    <a href="search.php">Search</a>
</form>



</body>
</html>
<?php
echo $imageCheck;
echo $nameCheck;
echo $ISBNCheck;
echo $publisherCheck;
if($publisherCheck===true && $nameCheck===true&& $ISBNCheck===true)
{
    echo 'Helo';
    $_SESSION["name"] = $name;
    $_SESSION["publisher"]=$publisher;
    $_SESSION["ISBN"]=$ISBN;
    $_SESSION["image"]="$image";
    insert_book();
    $priceCheck===false;
    $nameCheck===false;
}

    //add();

?>





