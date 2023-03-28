<?php

/* Includes */
include 'fns/fns.validate.php';


/* Show sugestionsAdd */
sugestionsAdd($id);

/**
 * Show sugestionsAdd function
 * 
 * @param number $id - unique setting group id
 */
function sugestionsAdd($id)
{
	global $DB, $PREFS, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate("sugestions.tpl");



	/* Result group data */

if(isset($_POST['submit']))
{

$cheading      = $_POST['cheading'];
$discription   = $_POST['discription'];
$cdate         = date('Y/m/d');

 
$filename = $_FILES['image']['name'];
	
	// Select file type
	$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	// valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");

if(move_uploaded_file($_FILES["image"]["tmp_name"],'uploads/'.$filename)){
   $grouplayout =  $DB->query("INSERT INTO `lg_contentsave` (`heading`, `discription`, `image`,`ctime`) VALUES ('$cheading', '$discription','$filename', '$cdate')");
   
    	/* Set message and redirect to settings */
	$TEMPLATE->setMessage("info", __('Sugestions_saved'));
	redirect(VIR_CP_PATH .'index.php?m=editSugestions');

	return true;
    
}
	else {
		/* Set message */
		$TEMPLATE->setMessage("error", __('Something_Wrong'), 1);
		return;
	}
}


}

