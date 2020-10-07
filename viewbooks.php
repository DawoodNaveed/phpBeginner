<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<?php
require 'db.php';
echo '<a id="a1" href="addBooks.php">ADD Book FORM</a>'
//$count=0;
//$i=0;
//$productArray=get_products($count);
////echo '<span>' .$product_name . '</span>';
//$delete="Delete";
//$edit="EDIT";
//while($i<$count)
//{
//    $_SESSION["id".$i]=$productArray["id".$i];
//    echo '<br/>';
//    echo '<div id="div'.$i.'">';
//    echo '<img src="'.$productArray["image".$i].'" " width="170" height="170" />';
//    echo '<br/>';
//    echo '<span>Name :'.$productArray["p_name".$i] . '</span>';
//    echo  '<br/>';
//    echo '<span>Publisher :'.$productArray["publisher".$i] . '</span>';
//    echo  '<br/>';
//    echo '<span>ISBN :'.$productArray["ISBN".$i] . '</span>';
//    echo  '<br/>';
//    echo '<br/>';
//    echo '<a href="delete.php?pid='.$i.'">Delete</a>';
//    echo '<a href="edit.php?pid='.$i.'">Edit</a>';
//    //echo '<button id="delete"'.$i.' onclick="alert("Hello")">'.$delete.'</button>';
//
//    echo '</div>';
//    $i++;
//
//}
//?>
<?php
if(!isset($_GET['page']))
{
    $page=1;
}
else
{
    $page=$_GET['page'];
}
$result_per_page=10;
$count=0;
get_products_count($count);
$number_of_pages=ceil($count/$result_per_page);
$this_page_first_result=($page-1)*$result_per_page;
$count1=0;$i=0;
$productArray=get_products($this_page_first_result,$count1);
$delete="Delete";
$edit="EDIT";
echo '<div class="container">';
echo '<div class="row">';
while($i<$count1)
{
    $_SESSION["id".$i]=$productArray["id".$i];
    echo '<br/>';

    echo '<div class="col-sm-4" id="div'.$i.'">' ;

    echo '<img src="'.$productArray["image".$i].'" " width="170" height="170" />';
    echo '<br/>';
    echo '<span>Name :'.$productArray["p_name".$i] . '</span>';
    echo  '<br/>';
    echo '<span>Publisher :'.$productArray["publisher".$i] . '</span>';
    echo  '<br/>';
    echo '<span>ISBN :'.$productArray["ISBN".$i] . '</span>';
    echo  '<br/>';
    echo '<br/>';
    echo '<a href="delete.php?pid='.$i.'">Delete</a>';
    echo '<a href="edit.php?pid='.$i.'">Edit</a>';


    echo '</div>';
    $i++;

}
echo '</div>';
echo '</div>';
echo '<br>';
for($page=1;$page<=$number_of_pages;$page++)
{
    echo '<a id="page1" href="viewbooks.php?page='. $page .'">' . $page .'</a>';
}
?>
