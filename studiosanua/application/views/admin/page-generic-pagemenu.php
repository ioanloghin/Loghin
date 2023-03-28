<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/lightbox.css');?>">
	<script src="<?php echo base_url('assets/js/lightbox.js');?>"></script>
	<script>
	$( document ).ready(function() {
		// =============================================================================
		$('#AddItem').on('click', function(e) {
			e.preventDefault();
			
			var address = $(this).attr('href');
			var req = $.ajax({
				type: "get",
				url: address,
				async: true,
				timeout: 3000
			});

			req.done(function (html_code, textStatus, jqXHR) {
				$('#ListItems > tbody').append(html_code);
			});

			req.fail(function (jqXHR, textStatus, errorThrown){
				
			});
			
			return false;
		}).mouseup(function(){
			$(this).blur();
		});
		
		// =============================================================================
		$('#ListItems').on('click', '.linkRemoveItemAjax', function(e) {
			e.preventDefault();
			var address = $(this).attr('href');
			
			bootbox.confirm("Are you sure to want to delete" , function(result) {
				if (result)
				{
					var req = $.ajax({
						type: "get",
						url: address,
						async: true,
						timeout: 3000
					});
		
					req.done(function (str_item_id, textStatus, jqXHR) {
						$('#item-id-'+str_item_id).hide();
						$('#ItemDetails-'+str_item_id).hide();
					});
		
					req.fail(function (jqXHR, textStatus, errorThrown){
						
					});
				}
			});
			
			return false;
		}).mouseup(function(){
			$(this).blur();
		});
		
		// =============================================================================
		$('#AddSubItem').on('click', function(e) {
			e.preventDefault();
			
			var address = $(this).attr('href');
			var req = $.ajax({
				type: "get",
				url: address,
				async: true,
				timeout: 3000
			});

			req.done(function (html_code, textStatus, jqXHR) {
				$('#ListSubItems > tbody').append(html_code);
			});

			req.fail(function (jqXHR, textStatus, errorThrown){
				
			});
			
			return false;
		}).mouseup(function(){
			$(this).blur();
		});
		
		// =============================================================================
		$('#ListSubItems').on('click', '.linkRemoveSubItemAjax', function(e) {
			e.preventDefault();
			var address = $(this).attr('href');
			
			bootbox.confirm("Are you sure to want to delete" , function(result) {
				if (result)
				{
					var req = $.ajax({
						type: "get",
						url: address,
						async: true,
						timeout: 3000
					});
		
					req.done(function (str_item_id, textStatus, jqXHR) {
						$('#subitem-id-'+str_item_id).hide();
					});
		
					req.fail(function (jqXHR, textStatus, errorThrown){
						
					});
				}
			});
			
			return false;
		}).mouseup(function(){
			$(this).blur();
		});
	});
	</script>
	<script>
    lightbox.option({
      'positionFromTop': 20
    })
	</script>
</head>

<body>
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete one track, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

	<?php $this->load->view('admin/template-header'); ?>
	
    <hgroup>
		<div class="btn-group" style="float:right;">
			<?php foreach($content_langs as $l): ?>
			<a href="<?php echo base_url('pageinfo/pagemenu/'.$page_name.'/'.$item_id.'/'.$l['lang']);?>" type="button" class="btn btn-xs <?php echo $form_lang==$l['lang']?'btn-warning':'btn-default'; ?>"><?php echo $l['lang']; ?></a>
			<?php endforeach; ?>
		</div>
        <h1><?php echo $title; ?></h1>
    </hgroup>
   
    
	<div class="content-section">

        <table class="table table-striped table-hover" id="ListItems">
            <thead>
                <tr>
                    <th style="width:180px;">Label</th>
                    <th>Link</th>
                    <th style="width:160px;text-align:right;"><a id="AddItem" href="<?php echo base_url('pageinfo/menu_add_item/'.$page_name.'/'.$form_lang);?>" class="btn btn-xs btn-primary">Add</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($menu_items as $r): ?>
                <tr id="item-id-<?php echo $r['item_id'];?>"<?php echo $r['item_id']==$item_id?' style="background:#d9edf7;"':''; ?>>
                    <td><?php echo $r['label'];?></td>
                    <td><?php echo $r['link'];?></td>
                    <td style="text-align:right;">
                    	<a class="btn btn-xs btn-default" href="<?php echo base_url('pageinfo/menu_up_item/'.$page_name.'/'.$r['item_id'].'/'.$form_lang);?>"><i class="fa fa-sort-asc" aria-hidden="true"></i></a>
                        <a class="btn btn-xs btn-default" href="<?php echo base_url('pageinfo/menu_down_item/'.$page_name.'/'.$r['item_id'].'/'.$form_lang);?>"><i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                        <span style="display:inline-block;padding:0 4px;opacity:.2;">|</span>
                    	<a class="btn btn-xs btn-default" href="<?php echo base_url('pageinfo/pagemenu/'.$page_name.'/'.$r['item_id'].'/'.$form_lang);?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a class="btn btn-xs btn-default linkRemoveItemAjax" href="<?php echo base_url('pageinfo/menu_del_item/'.$page_name.'/'.$r['item_id'].'/'.$form_lang);?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                    </td>
                 </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if($item_id>0):?>
    <br>
    <div id="ItemDetails-<?php echo $item_id;?>" class="content-section">
		<div class="alert alert-danger" role="alert"<?php echo !validation_errors()?' style="display:none;"':'';?>><?php echo validation_errors(); ?></div>
        <?php if ($successful):?>
        <div class="alert alert-success" role="alert">Successfully saved.</div>
		<script>
		$(".alert-success").fadeTo(2000, 500).fadeOut(500, function(){
			$(".alert-success").fadeOut(500);
		});
		</script>
        <?php endif; ?>
    	<form method="post" action="" role="form" enctype="multipart/form-data">
        	<div class="row">
            	<div class="col-xs-12 col-sm-6">
                	<table class="table borderless">
                        <tbody>
                            <tr>
                            	<td colspan="2">
                                	<label>Label</label>
                                    <input type="text" name="field_label" class="form-control input-sm" value="<?php echo $field_label;?>">
                                </td>
                            </tr>
                            <tr>
                            	<td colspan="2">
                                	<label>Link</label>
                                    <input type="text" name="field_link" class="form-control input-sm" value="<?php echo $field_link;?>">
                                </td>
                            </tr>
                            <?php if($menu_config['show_item_icon']):?>
                            <tr>
                            	<td colspan="2">
                                	<label>Icon</label>
                                    <select name="field_icon" class="form-control input-sm">
                                    	<option></option>
                                    	<option<?php echo $field_icon=='home'?' selected':'';?>>home</option>
                                        <option<?php echo $field_icon=='graph'?' selected':'';?>>graph</option>
                                        <option<?php echo $field_icon=='gift'?' selected':'';?>>gift</option>
                                        <option<?php echo $field_icon=='tag'?' selected':'';?>>tag</option>
                                        <option<?php echo $field_icon=='user'?' selected':'';?>>user</option>
                                        <option<?php echo $field_icon=='stats'?' selected':'';?>>stats</option>
                                        <option<?php echo $field_icon=='find'?' selected':'';?>>find</option>
                                        <option<?php echo $field_icon=='print'?' selected':'';?>>print</option>
                                    </select>
                                </td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-sm-6"<?php echo !$menu_config['show_subitems']?' style="display:none"':'';?>>
                	<table id="ListSubItems" class="table table-striped table-hover">
                        <thead>
                            <tr>
                            	<?php if($menu_config['show_subitem_icon']):?>
                                <th>Icon</th>
                                <?php endif;?>
                                <th>Title</th>
                                <th>Link</th>
                                <th style="text-align:right;"><a id="AddSubItem" href="<?php echo base_url('pageinfo/menu_add_subitem/'.$page_name.'/'.$item_id.'/'.$form_lang);?>" class="btn btn-xs btn-primary">Add</a></th>
                            </tr>
                        </thead>
                        <tbody>
							<?php foreach($menu_subitems as $sr): ?>
                            <tr id="subitem-id-<?php echo $sr['subitem_id'];?>">
                            	<?php if($menu_config['show_subitem_icon']):?>
                                <td>
                                	<select name="subitem-field-<?php echo $sr['subitem_id'];?>-icon">
                                    	<option></option>
                                    	<option<?php echo $sr['icon']=='home'?' selected':'';?>>home</option>
                                        <option<?php echo $sr['icon']=='graph'?' selected':'';?>>graph</option>
                                        <option<?php echo $sr['icon']=='gift'?' selected':'';?>>gift</option>
                                        <option<?php echo $sr['icon']=='tag'?' selected':'';?>>tag</option>
                                        <option<?php echo $sr['icon']=='user'?' selected':'';?>>user</option>
                                        <option<?php echo $sr['icon']=='stats'?' selected':'';?>>stats</option>
                                        <option<?php echo $sr['icon']=='find'?' selected':'';?>>find</option>
                                        <option<?php echo $sr['icon']=='print'?' selected':'';?>>print</option>
                                    </select>
                                </td>
                                <?php endif;?>
                                <td>
									<input type="hidden" name="subitems[]" value="<?php echo $sr['subitem_id'];?>">
                                    <input type="text" name="subitem-field-<?php echo $sr['subitem_id'];?>-label" class="form-control input-sm" value="<?php echo $sr['label'];?>">
                                </td>
                                <td>
                                    <input type="text" name="subitem-field-<?php echo $sr['subitem_id'];?>-link" class="form-control input-sm" value="<?php echo $sr['link'];?>">
                                </td>
                                <td style="text-align:right;">
                                	<a class="btn btn-xs btn-default linkRemoveSubItemAjax" href="<?php echo base_url('pageinfo/menu_del_subitem/'.$page_name.'/'.$sr['subitem_id'].'/'.$form_lang);?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                                </td>
                            </tr>
							<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        	<div class="form-group" style="text-align:center;"><button type="submit" name="save" class="btn btn-sm btn-success" value="1">Save</button></div>
		</form>
    </div>
	<?php endif; ?>

<?php $this->load->view('admin/template-footer'); ?>