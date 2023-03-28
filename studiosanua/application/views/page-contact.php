<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template-head');
?>
	<?php $this->load->view('template-header'); ?>

	<div id="content">
		<div id="contact" class="width clear">
        	<div class="alert alert-danger" role="alert"<?php echo !validation_errors()?' style="display:none;"':'';?>><?php echo validation_errors(); ?></div>
            <?php if ($successful):?>
            <div class="alert alert-success" role="alert">The message was sent.</div>
            <script>
            $(".alert-success").fadeTo(2000, 500).fadeOut(500, function(){
                $(".alert-success").fadeOut(500);
            });
            </script>
            <?php endif; ?>
        
            <div class="left tight">
                <h2 class="title"><?php echo $section1_title;?></h2>
                <?php echo $section1_content;?>
                
                <h2 class="title"><?php echo $section2_title;?></h2>
                <?php echo $section2_content;?>
            </div>

            <div class="right large">
                <form action="" method="post">
                    
                    <h2 class="title"><?php echo $section3_title;?></h2>
                    <div class="black">
                    	<?php echo $section3_content;?>
                    </div>
                    
                    <h2 class="title"><?php echo $section4_title;?></h2>
                        <div class="formfield">
                        <input class="inputText" type="text" name="name" value="" required placeholder="<?php echo $contact_placeholder_fullname;?>" />
                    </div>
                    <div class="formfield">
                        <input class="inputText" type="text" name="phone" value="" required placeholder="<?php echo $contact_placeholder_phone;?>" />
                    </div>
                    <div class="formfield">
                        <input class="inputText" type="email" name="email" value="" required placeholder="<?php echo $contact_placeholder_email;?>" />
                    </div>
                    <div class="formfield big">
                        <textarea class="inputTextarea" name="message" required placeholder="<?php echo $contact_placeholder_message;?>"></textarea>
                    </div>
                    <div class="formaction clear">
                        <a class="button blue right submit" href="javascript:void(0);"><strong><?php echo $contact_button_send;?></strong></a>
                    </div>
                    <input type="hidden" name="isContact" value="1" />
                    
                </form>
            </div>

		</div>
	</div>
	
<script type="text/javascript">$.conf = { 'path': "http://contabilitate.loghin.com/", 'pic_path': "http://contabilitate.loghin.com/uploads/", 'intervalTime': 15 };</script>

<?php $this->load->view('template-footer'); ?>