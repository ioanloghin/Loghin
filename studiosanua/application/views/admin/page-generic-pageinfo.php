<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
</head>

<body>
	<?php $this->load->view('admin/template-header'); ?>
	
    <hgroup>
        <div class="btn-group" style="float:right;">
			<?php foreach($content_langs as $l): ?>
			<a href="<?php echo base_url('pageinfo/meta/'.$page_name.'/'.$l['lang']);?>" type="button" class="btn btn-xs <?php echo $form_lang==$l['lang']?'btn-warning':'btn-default'; ?>"><?php echo $l['lang']; ?></a>
			<?php endforeach; ?>
		</div>
        <h1><?php echo $title; ?></h1>
    </hgroup>

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
    	<form method="post" action="">
        	<input type="hidden" name="meta_lang" value="<?php echo $form_lang;?>">
            <div class="form-group">
            	<label for="InputTitle">Title</label>
            	<input type="text" name="meta_title" class="form-control" id="InputTitle" aria-describedby="titleHelp" placeholder="Enter the title page" value="<?php echo $meta_title;?>">
                <small id="titleHelp" class="form-text text-muted">Unique titles help search engines understand that your content is unique and valuable, and also drive higher click-through rates. <br>We generally recommend keeping your titles under 60 characters long.</small>
            </div>
            <div class="form-group">
            	<label for="InputDescription">Description</label>
            	<textarea rows="5" name="meta_description" class="form-control" id="InputDescription" aria-describedby="descriptionHelp" placeholder="Enter the description page"><?php echo $meta_description;?></textarea>
                <small id="descriptionHelp" class="form-text text-muted">It is best to keep meta descriptions between 150 and 160 characters.</small>
            </div>
            <div class="form-group">
            	<label for="InputKeywords">Keywords</label>
            	<input type="text" name="meta_keywords" class="form-control" id="InputKeywords" aria-describedby="keywordsHelp" placeholder="Enter the keywords of page" value="<?php echo $meta_keywords;?>">
                <small id="keywordsHelp" class="form-text text-muted">7 to 8 general keywords with comma separated is good to put on all pages of your site.</small>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
		</form>
    </div>


<?php $this->load->view('admin/template-footer'); ?>