<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
<script>
$(document).ready(function(e) {
    // =============================================================================
	$('#ListItems').on('click', '.linkRemoveItemAjax', function(e) {
		e.preventDefault();
		var address = $(this).attr('href');
		
		bootbox.confirm("Are you sure to want to delete" , function(result) {
			if (result)
			{
				window.location.href = address;
			}
		});
		
		return false;
	}).mouseup(function(){
		$(this).blur();
	});
});
</script>
</head>

<body>
	<?php $this->load->view('admin/template-header'); ?>
	
    <hgroup>
        <h1><?php echo $title; ?></h1>
    </hgroup>
    
	<div class="content-section">
    	<div class="alert alert-danger" role="alert"<?php echo !validation_errors()?' style="display:none;"':'';?>><?php echo validation_errors(); ?></div>
        <?php if ($successful):?>
        <div class="alert alert-success" role="alert">Successfully saved.</div>
		<script>
		$(".alert-success").fadeTo(2000, 500).fadeOut(500, function(){
			$(".alert-success").fadeOut(500);
		});
		</script>
        <?php endif; ?>
    	<form method="post" action="" role="form">
        	<table class="table table-striped table-hover">
            	<thead>
                	<tr>
                    	<th style="width:70px;">Lang</th>
                        <th style="width:200px;">Label</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody id="ListItems">
        			<?php foreach($langs as $l): ?>
            		<tr>
                    	<td>
                            <input style="width:60px;" type="text" name="lang-<?php echo $l['lang'];?>" class="form-control input-sm" id="InputLang" aria-describedby="langHelp" placeholder="Enter lang" value="<?php echo $l['lang'];?>" disabled maxlength="2">
                        </td>
                        <td>
                            <input style="width:190px;" type="text" name="label-<?php echo $l['lang'];?>" class="form-control input-sm" id="InputLabel" aria-describedby="labelHelp" placeholder="Enter label" value="<?php echo $l['label'];?>" maxlength="255">
						</td>
                        <td><?php if ($l['primary_lang']=='1'):?> <small id="descriptionHelp" class="form-text text-muted">This is <strong>primary</strong> lang. Can not be removed.</small><?php else: ?><a href="<?php echo base_url('languages/remove/'.$l['lang']);?>" name="del" class="btn btn-sm btn-danger linkRemoveItemAjax">Remove</a><?php endif;?></td>
                        </tr>
            	<?php endforeach; ?>
            	</tbody>
            </table>
            <button type="submit" name="save" class="btn btn-sm btn-primary">Save</button>
		</form>
    </div>
    <br>
    <div class="content-section">
    	<form method="post" action="" role="form">
        	<table>
            	<thead>
                	<tr>
                    	<th style="width:70px;">Lang</th>
                        <th style="width:200px;">Label</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
            		<tr>
                    	<td><div class="form-group">
                            <input style="width:60px;" type="text" name="new_lang" class="form-control input-sm" id="exampleInputEmail1" aria-describedby="emailHelp" value="" required maxlength="2">
                        </div></td>
                        <td><div class="form-group">
                            <input style="width:190px;" type="text" name="new_label" class="form-control input-sm" id="exampleInputEmail1" aria-describedby="emailHelp" value="" maxlength="255">
                        </div></td>
                        <td><div class="form-group"><button type="submit" name="add" class="btn btn-sm btn-success">Add</button></div></td>
					</tr>
            	</tbody>
            </table>
            
		</form>
    </div>


<?php $this->load->view('admin/template-footer'); ?>