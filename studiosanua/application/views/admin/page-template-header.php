<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
	<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
	$(document).ready(function(e) {
		CKEDITOR.replace('mytextarea', {
			height:180,
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
			<a href="<?php echo base_url('template/pageheader/'.$l['lang']);?>" type="button" class="btn btn-xs <?php echo $form_lang==$l['lang']?'btn-warning':'btn-default'; ?>"><?php echo $l['lang']; ?></a>
			<?php endforeach; ?>
		</div>
        <h1><?php echo $title; ?></h1>
    </hgroup>

	<div class="content-section black">
		<br>
    	<div class="alert alert-danger" role="alert"<?php echo !validation_errors()?' style="display:none;"':'';?>><?php echo validation_errors(); ?></div>
        <?php if ($successful):?>
        <div class="alert alert-success" role="alert">Successfully saved.</div>
		<script>
		$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
			$(".alert-success").slideUp(500);
		});
		</script>
        <?php endif; ?>
    	<form method="post" action="" enctype="multipart/form-data">
        	<table class="table borderless">
            	<tr>
                	<td style="height:135px;">
                    	<img style="max-width:191px; max-height:129px;" src="<?php echo $logo_img;?>"><br>
                        <input type="file" name="logo-image" class="form-control">
                    </td>
                    <td style="height:135px;">
                    	<label>Company name/Domain/Register</label>
                    	<input style="margin-bottom:8px;" type="text" name="company_name" class="form-control" value="<?php echo $company_name;?>">
                        <input style="margin-bottom:8px;" type="text" name="company_domain" class="form-control" value="<?php echo $company_domain;?>">
                        <input type="text" name="company_register" class="form-control" value="<?php echo $company_register;?>">
                    </td>
                    <td>
                    	<textarea id="mytextarea" rows="5" name="content" class="form-control"><?php echo $content;?></textarea>
                    </td>
                </tr>
            </table>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
    </div>


<?php $this->load->view('admin/template-footer'); ?>