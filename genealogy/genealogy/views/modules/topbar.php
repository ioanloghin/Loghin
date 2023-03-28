<div class="fix">

	<div class="AGH_menu">
		<?php
        echo 'Welcome, ';
        if($MyUser->logged())
            echo '<strong>'.$MyUser->get_profile_name().'</strong>';
        else
            echo 'Guest | <a href="#">&Icirc;nregistrare</a>';
        
        echo ' | <a href="#">Limba rom&acirc;n&#259;</a>';
		?>
        <select class="langSelect right">
            <?php
            $title = array('ro' => 'Romanian', 'it' => 'Italian', 'ru' => 'Russian', 'en' => 'English', 'de' => 'German');
			if($MyUser->logged() && count($acc_api->getCountry($MyUser->account_id())) > 0)
			{
				foreach($acc_api->getCountry($MyUser->account_id()) as $row_c => $row_l)
				{
					echo '<optgroup label="'.$row_c.'">';
					foreach($row_l as $r_l)
						echo '<option value="'.$r_l.'">'.$title[$r_l].'</option>';
					echo '</optgroup>';
				}
			}
			else
				echo '<option value="ro">Romanian</option>';
            ?>
        </select>
        <?php
		
        if($MyUser->logged())
        {
            ?>
                 | <a href="<?php echo anchor('login', 'out');?>">Log out</a>
                 <a class="approvalIcon" href="<?php echo anchor("tree", "approvals");?>"><img src="<?php echo base_image(template, "icons/approvals.png");?>" /></a>
            <?php
        }
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