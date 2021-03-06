<?php
include 'header.php';
// requires
require_once("../assets/php/auth_login_helper.php");
require_once("../assets/php/dbessential.php");
require_once("../assets/php/dbfetchInfo.php");
require_once("../assets/php/dbAPI.php");
// this page displays all of the options of either users or pins for the admin to update
echo("<form action='./singleObjectEdit.php' method='post'>");
$action = $_POST['action'];
$object = $_POST['object'];
echo("<input type='radio' name='action' value='$action' checked hidden>");
echo("<input type='radio' name='object' value='$object' checked hidden>");
$namefield = "";
if($object == "users")
{
    $namefield = "username";
}
else if($object == "pins")
{
    $namefield = "name";
}
$fetchCurrent = "select " . $namefield . " from " . $object;
$currentResults = performActionOnDB($fetchCurrent);
echo("<input type='radio' name='namefield' value='$namefield' checked hidden>");
echo("<h3>Which existing " . $object . " item do you want to edit? </h3>");
while($row = $currentResults->fetch_assoc())
{
    // display all users or pins that can be updated
    echo("<input type='radio' name='updatingObject' value='{$row[$namefield]}' required> {$row[$namefield]} </br>");
}
echo("</br></br>");
if($action == "delete")
{
    echo("<input type='radio' name='fieldSet' value='deleting' checked required> the selected user will be deleted</br>");
}
// update button
echo("<input type='submit' value='Continue to $action'>");
echo("</form>");

// cancel button and go back to the main menu
echo("<form action='./cmsForm.php' method='post'><br />");
echo("<input type='submit' value='Cancel'>");
echo("</form>");
include 'footer.php';
?>

