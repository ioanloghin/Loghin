<?php



/* Show home page */

showContent();



function showContent() {


	global $TEMPLATE, $PREFS;

     include_once 'Circular.class.php';
	/* Require UserBar classes */
	include_once 'CI_SESS.class.php';
	include_once 'CI_DB.class.php';
	include_once 'CI_Model.class.php';
	include_once 'User_model.class.php';
	include_once 'Myaccount_model.class.php';
	include_once 'Userbar_model.class.php';
	include_once 'Userbar_controller.class.php';
	
	

$TEMPLATE->setTemplate('contentsave.tpl');


if(isset($_POST['submit']))
{

$cheading      = $_POST['cheading'];
$discription   = $_POST['discription'];
$cdate         = date('yy/mm/');


$filename = $_FILES['image']['name'];
	
	// Select file type
	$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	// valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");

if(move_uploaded_file($_FILES["image"]["tmp_name"],'uploads/'.$filename)){
   $grouplayout = $PREFS->DB->query("INSERT INTO `lg_contentsave` (`heading`, `discription`, `image`,`ctime`) VALUES ('$cheading', '$discription','$filename', '$cdate')");
   
      echo "<script> alert('Data Add Succesfully') 
       window.location.href = 'index.php';
        </script>";
}
}
}




?>