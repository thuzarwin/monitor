<?php 
session_start();
?><?php 
if (!isset($_SESSION['isAdmin'])){
	$_SESSION['loginError'] == '1';
	echo "Login failed.";
	exit;
}
if ($_SESSION['isAdmin'] != 'Y'){
	$_SESSION['loginError'] == '1';
	echo "Login failed.";
	exit;
}
require_once 'database_connection.php';
require_once 'sunny_function.php';
if ($_SESSION["$monitorUserListC2Name"] != 'root'){
	$_SESSION['loginError'] == '1';
	echo "Login failed.";
	exit;
}
?>
<?php 
if (!isset($_POST['submitDelete'])){
	echo "e ..... what are you doing?"; 
	exit;
}

$idAndEmailAddressSplited = explode(":", $_POST["radio"]);
$oldEmailAddress = $idAndEmailAddressSplited[1];
$userToBeDeletedId = $idAndEmailAddressSplited[0];
$newEmailAddress = $_POST["newEmailAddress"];

debugOk('del$newEmailAddress:'.$newEmailAddress);
debugOk('del$oldEmailAddress:'.$oldEmailAddress);
require_once 'email_address_mgmt_change_ing.php';

$query = "DELETE FROM $monitorUserList WHERE $monitorUserListC1Name = '$userToBeDeletedId' ";
debugOk($query);
mysql_query($query,$session) or die("ERR: <b>$query</b>: ".mysql_error());	

header("Location: user_mgmt.php"); /// Redirect browser 
exit;// Make sure that code below does not get executed when we redirect. 

?>