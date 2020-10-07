<?php
session_start();
require 'db.php';
if(isset($_REQUEST["pid"])) {
    $pid=$_REQUEST["pid"];

    $id=$_SESSION["id".$pid];
    delete($id);
}
?>