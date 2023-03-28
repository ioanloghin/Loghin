<div class="fix">
	<div class="AGH_menu">
    <?php
	echo 'Welcome,  ';
	if($MyUser->logged())
		echo '<strong>'.$MyUser->get_firstname().' '.$MyUser->get_lastname().'</strong>';
	else
		echo 'Guest | <a href="#">&Icirc;nregistrare</a>';
	
	echo ' | <a href="#">Limba rom&acirc;n&#259;</a>';
	
	if($MyUser->logged())
		echo ' | <a href="'.anchor('login', 'out').'">Log out</a>';
	else
	{
		?>
		<form method="post" action="<?php echo anchor('login', 'in');?>" class="top_login">
			<fieldset>
            	<?php
				if(isset($POST) && $POST->errors())
				{
					echo '<div class="errors">';
					foreach($POST->errors() as $error)
						echo $error.'<br />';
					echo '</div>';
				}
				?>
            	<input type="hidden" name="antirefresh" value="<?php echo isset($POST) ? $POST->antirefresh('return') : 1;?>" />
				<input type="text" class="input3" name="usr" value="<?php echo isset($POST) ? $POST->get_var('usr', 'post|db', TRUE) : NULL;?>" placeholder="Username" />
				<input type="password" class="input3" name="psw" placeholder="Password" />
				<input type="submit" class="button3" name="auth" value="Sign In" />
			</fieldset>
		</form>
		<?php
    }
    ?>
    </div>
</div>