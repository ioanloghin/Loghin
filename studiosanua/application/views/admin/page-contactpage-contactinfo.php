<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
	<!--<script src='<?php echo base_url('assets/js/tinymce/tinymce.min.js');?>'></script>
	<script>
	tinymce.init({
		plugins : "table,lists",
		selector: '#InputContent2,#InputContent3'
	});
	</script>-->
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
	$(document).ready(function(e) {
		CKEDITOR.replace('InputContent2', {
			height:160,
			toolbar: [
			{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save' ] },
			{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
			'/',
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
			{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
			{ name: 'links', items: [ 'Link', 'Unlink' ] },
			{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
			'/',
			{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
			{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
			{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
			{ name: 'others', items: [ '-' ] },
			{ name: 'about', items: [ 'About' ] }
		]
		});
		CKEDITOR.replace('InputContent3', {
			height:120,
			toolbar: [
			{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save' ] },
			{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
			'/',
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
			{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
			{ name: 'links', items: [ 'Link', 'Unlink' ] },
			{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
			'/',
			{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
			{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
			{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
			{ name: 'others', items: [ '-' ] },
			{ name: 'about', items: [ 'About' ] }
		]
		});
    });
	</script>
</head>

<body>
	<?php $this->load->view('admin/template-header'); ?>
	
    <hgroup>
        <div class="btn-group" style="float:right;">
			<?php foreach($content_langs as $l): ?>
			<a href="<?php echo base_url('contactpage/contactinfo/'.$l['lang']);?>" type="button" class="btn btn-xs <?php echo $form_lang==$l['lang']?'btn-warning':'btn-default'; ?>"><?php echo $l['lang']; ?></a>
			<?php endforeach; ?>
		</div>
        <h1><?php echo $title; ?></h1>
    </hgroup>

	<form method="post" action="">
    	<div class="content-section">
    		<div class="alert alert-danger" role="alert"<?php echo !validation_errors()?' style="display:none;"':'';?>><?php echo validation_errors(); ?></div>
        	<?php if ($successful):?>
        	<div class="alert alert-success" role="alert">Successfully saved.</div>
			<script>
			$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
				$(".alert-success").slideUp(500);
			});
			</script>
        	<?php endif; ?>
            <div class="form-group">
            	<label for="InputTitle1">Contact email</label>
            	<input type="text" name="email" class="form-control" placeholder="Enter the contact email" value="<?php echo $email;?>">
            </div>
            <div class="form-group">
            	<label for="InputTitle1">Contact email (CC)</label>
            	<input type="text" name="email_cc" class="form-control" placeholder="Enter the contact email CC" value="<?php echo $email_cc;?>">
                <small id="title1Help" class="form-text text-muted">For multiple email addresses, write them separated by commas. <strong>Example</strong>: contact@domain.com, office@domain.com</small>
            </div>
            <button type="submit" name="save" class="btn btn-primary" value="1">Save</button>
        </div>
        <br>
		<div class="content-section">
            <div class="form-group">
            	<label for="InputTitle1">Title (map)</label>
            	<input type="text" name="meta_title1" class="form-control" id="InputTitle1" aria-describedby="title1Help" placeholder="Enter the map title" value="<?php echo $meta_title1;?>">
                <small id="title1Help" class="form-text text-muted">Title for map section.</small>
            </div>
            <div class="form-group">
            	<label for="InputContent1">Map embeded code</label>
            	<textarea rows="5" name="meta_content1" class="form-control" id="InputContent1" aria-describedby="descriptionHelp" placeholder="Enter the description page"><?php echo $meta_content1;?></textarea>
                <small id="descriptionHelp" class="form-text text-muted">It is best to keep meta descriptions between 150 and 160 characters. <strong>Same for all languages.</strong></small>
            </div>
            <button type="submit" name="save" class="btn btn-primary" value="1">Save</button>
        </div>
        <br>
        <div class="content-section">
			<div class="form-group">
            	<label for="InputTitle2">Title (schedule)</label>
            	<input type="text" name="meta_title2" class="form-control" id="InputTitle2" aria-describedby="title2Help" placeholder="Enter the schedule title" value="<?php echo $meta_title2;?>">
                <small id="title2Help" class="form-text text-muted">Title for schedule section.</small>
            </div>
            <div class="form-group">
            	<label for="InputContent2">Schedule content</label>
            	<textarea rows="5" name="meta_content2" class="form-control" id="InputContent2" aria-describedby="descriptionHelp" placeholder="Enter the description page"><?php echo $meta_content2;?></textarea>
                <small id="descriptionHelp" class="form-text text-muted">Write your working hours.</small>
            </div>
            <button type="submit" name="save" class="btn btn-primary" value="1">Save</button>
		</div>
        <br>
        <div class="content-section">
			<div class="form-group">
            	<label for="InputTitle3">Title (contacts)</label>
            	<input type="text" name="meta_title3" class="form-control" id="InputTitle3" aria-describedby="title3Help" placeholder="Enter the contacts title" value="<?php echo $meta_title3;?>">
                <small id="title3Help" class="form-text text-muted">Title for contacts section.</small>
            </div>
            <div class="form-group">
            	<label for="InputContent3">Contacts content</label>
            	<textarea rows="5" name="meta_content3" class="form-control" id="InputContent3" aria-describedby="descriptionHelp" placeholder="Enter the description page"><?php echo $meta_content3;?></textarea>
                <small id="descriptionHelp" class="form-text text-muted">Write your contact information. (email, phone, fax, address, etc.)</small>
            </div>
            <button type="submit" name="save" class="btn btn-primary" value="1">Save</button>
		</div>
        <br>
        <div class="content-section">
            <div class="form-group">
            	<label for="InputTitle4">Title (form)</label>
            	<input type="text" name="meta_title4" class="form-control" id="InputTitle4" aria-describedby="title4Help" placeholder="Enter the contact form title" value="<?php echo $meta_title4;?>">
                <small id="title4Help" class="form-text text-muted">Title for contact form.</small>
            </div>
            <div class="form-group">
            	<label for="InputTitle4">Placeholder Fullname</label>
            	<input type="text" name="contact_placeholder_fullname" class="form-control" value="<?php echo $contact_placeholder_fullname;?>">
            </div>
            <div class="form-group">
            	<label for="InputTitle4">Placeholder Phone</label>
            	<input type="text" name="contact_placeholder_phone" class="form-control" value="<?php echo $contact_placeholder_phone;?>">
            </div>
            <div class="form-group">
            	<label for="InputTitle4">Placeholder Email</label>
            	<input type="text" name="contact_placeholder_email" class="form-control" value="<?php echo $contact_placeholder_email;?>">
            </div>
            <div class="form-group">
            	<label for="InputTitle4">Placeholder Message</label>
            	<input type="text" name="contact_placeholder_message" class="form-control" value="<?php echo $contact_placeholder_message;?>">
            </div>
            <div class="form-group">
            	<label for="InputTitle4">Button send</label>
            	<input type="text" name="contact_button_send" class="form-control" value="<?php echo $contact_button_send;?>">
            </div>
			<hr>
            <button type="submit" name="save" class="btn btn-primary" value="1">Save</button>
        </div>
    </form>

<?php $this->load->view('admin/template-footer'); ?>