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
			<a href="<?php echo base_url('template/topmenu/'.$l['lang']);?>" type="button" class="btn btn-xs <?php echo $form_lang==$l['lang']?'btn-warning':'btn-default'; ?>"><?php echo $l['lang']; ?></a>
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
			<table class="table borderless">
				<?php for($i=1; $i<=5; ++$i): ?>
				<tr>
					<td>
						<label for="InputTitle">Item <?php echo $i;?></label>
						<input type="text" name="topmenu-item-<?php echo $i;?>" class="form-control" id="InputTitle" aria-describedby="titleHelp" placeholder="Enter the title page" value="<?php echo ${'topmenu_item_'.$i};?>">
					</td>
				</tr>
				<?php endfor; ?>
				<tr>
					<td>
						<button type="submit" class="btn btn-primary">Save</button>
					</td>
				</tr>
			</table>
		</form>
    </div>


<?php $this->load->view('admin/template-footer'); ?>