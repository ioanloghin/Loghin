<?php
//------------------------------------------------------------------------------------------------------------------------ //
define('ANTIHACK', TRUE);
include_once('../system/helpers/includes.php');
include_once('../system/helpers/url.php');
script_include('[vital]', '../');
//------------------------------------------------------------------------------------------------------------------------ //

$GET = new safe_get();
$GET->set_var('type', 0, 'intvar');

switch($GET->get_var('type'))
{
	case 1:
		ob_start();
		?>
		<fieldset style="margin-top:20px;">
			<legend>Family Members</legend>
			<div class="cleft" style="height:15px;"></div>
			<label>Loghin User Name:</label>
			<div class="field_box rad3"><input class="field size rad3" name="firstname0" type="text" value="" /></div>
			<div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
			<div class="cleft" style="height:5px;"></div>
			
			<div style="margin-left:183px; width:260px; margin-bottom:5px; text-align:center;">sau</div>
			
			<label>User Name (provizoriu):</label>
			<div class="field_box rad3"><input class="field size rad3" name="firstname0" type="text" value="" /></div>
			<div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
			<div class="cleft" style="height:5px;"></div>
			
			<label>First Name:</label>
			<div class="field_box rad3"><input class="field size rad3" name="firstname0" type="text" value="" /></div>
			<div class="error_box"><p class="info">&nbsp;</p></div>
			<div class="cleft" style="height:5px;"></div>
			
			<label>Last Name:</label>
			<div class="field_box rad3"><input class="field size rad3" name="lastname0" type="text" value="" /></div>
			<div class="error_box"><p class="info">&nbsp;</p></div>
			<div class="cfix"></div>
			<div class="cleft" style="height:5px;"></div>
			
			<label>Gender:</label>
			<div class="radio_box rad3"><input id="gender1_1" type="radio" name="gender1" value="1" /><label for="gender1_1">Male</label><input id="gender1_2" type="radio" name="gender1" value="2" /><label for="gender1_2">Female</label></div>
			<div class="error_box"><p class="info">&nbsp;</p></div>
			<div class="cfix"></div>
			<div class="cleft" style="height:5px;"></div>
			
			<label>Parental Grade:</label>
			<div class="field_box rad3"><select class="size" name="lastname0"><option>select </option></select></div>
			<div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
			<div class="cfix"></div>
			<div class="cleft" style="height:5px;"></div>
			
			<label>&nbsp;</label>
			<div class="radio_box rad3"><input id="life1_1" type="radio" name="life1" value="1" /><label for="life1_1">Life</label><input id="life1_2" type="radio" name="life1" value="2" /><label for="life1_2">Died</label></div>
			<div class="error_box"><p class="info">&nbsp;</p></div>
			<div class="cfix"></div>
			<div class="cleft" style="height:5px;"></div>
			
			<label>Birthday:</label>
			<div class="field_box left rad3"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
			<div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
			<div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
			<div class="error_box"><p class="info">&nbsp;</p></div>
			<div class="cfix"></div>
			<div class="cleft" style="height:5px;"></div>
			
			<label>Death Date:</label>
			<div class="field_box left rad3"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
			<div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
			<div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
			<div class="error_box"><p class="info">Apare la selectare decedat</p></div>
			<div class="cfix"></div>
			<div class="cleft" style="height:5px;"></div>
			
			<label>Add Photo:</label>
			<div class="field_box rad3"><input size="13" class="size" name="lastname0" type="file" /></div>
			<div class="error_box"><p class="info">&nbsp;</p></div>
			<div class="cfix"></div>
			<div class="cleft" style="height:5px;"></div>
		</fieldset>
		<?php
		$html_code = ob_get_clean();
		ob_end_flush();
		$html_code = str_replace("\n", '', $html_code);
		sleep(1);
		echo $html_code;
		break;
	case 2:
		
		break;
}
?>