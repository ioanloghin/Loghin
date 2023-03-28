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
	<?php $this->load->view('admin/template-header'); ?>
	
    <hgroup>
		<div class="btn-group" style="float:right;">
			<?php foreach($content_langs as $l): ?>
			<a href="<?php echo base_url('homepage/gallery/'.$item_id.'/'.$l['lang']);?>" type="button" class="btn btn-xs <?php echo $form_lang==$l['lang']?'btn-warning':'btn-default'; ?>"><?php echo $l['lang']; ?></a>
			<?php endforeach; ?>
		</div>
        <h1><?php echo $title; ?></h1>
    </hgroup>
   
    
	<div class="content-section">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<table class="table table-striped table-hover" id="ListItems">
					<thead>
						<tr>
							<th>Title</th>
							<th style="width:160px;text-align:right;"><a id="AddItem" href="<?php echo base_url('homepage/gallery_add_item/'.$form_lang);?>" class="btn btn-xs btn-primary">Add</a></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($gallery_items as $r): ?>
						<tr id="item-id-<?php echo $r['category_id'];?>"<?php echo $r['category_id']==$item_id?' style="background:#d9edf7;"':''; ?>>
							<td><?php echo $r['title'];?></td>
							<td style="text-align:right;">
                            	<a class="btn btn-xs btn-default" href="<?php echo base_url('homepage/gallery_up_item/'.$r['category_id'].'/'.$form_lang);?>"><i class="fa fa-sort-asc" aria-hidden="true"></i></a>
                                <a class="btn btn-xs btn-default" href="<?php echo base_url('homepage/gallery_down_item/'.$r['category_id'].'/'.$form_lang);?>"><i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                            	<span style="display:inline-block;padding:0 4px;opacity:.2;">|</span>
								<a class="btn btn-xs btn-default" href="<?php echo base_url('homepage/gallery/'.$r['category_id'].'/'.$form_lang);?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<a class="btn btn-xs btn-default linkRemoveItemAjax" href="<?php echo base_url('homepage/gallery_del_item/'.$r['category_id'].'/'.$form_lang);?>"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						 </tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
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
				<div class="col-xs-12 col-sm-12">
					<table class="table borderless">
						<tr>
							<td>
								<label>Title</label>
								<input type="text" name="field_title" class="form-control input-sm" value="<?php echo $field_title;?>">
							</td>
							<td>
								<label>Link</label>
								<input type="text" name="field_url" class="form-control input-sm" value="<?php echo $field_url;?>">
							</td>
						</tr>
					</table>
				</div>
                <div class="col-xs-12 col-sm-12">
                	<table id="ListSubItems" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:180px;">Image</th>
                                <th>Title/Link</th>
								<th>Description</th>
                                <th style="text-align:right;"><a id="AddSubItem" href="<?php echo base_url('homepage/gallery_add_subitem/'.$item_id.'/'.$form_lang);?>" class="btn btn-xs btn-primary">Add</a></th>
                            </tr>
                        </thead>
                        <tbody>
							<?php foreach($gallery_subitems as $sr): ?>
                            <tr id="subitem-id-<?php echo $sr['slideshow_id'];?>">
                                <td>
									<?php if($sr['image']):?>
									<a href="<?php echo $sr['image'];?>" data-lightbox="image-<?php echo $sr['slideshow_id'];?>" data-title="<?php echo $sr['title'];?>">
										<img src="<?php echo $sr['image'];?>" height="30">
									</a>
									<?php else:?>
										<span style="color:#AAA;"><i class="fa fa-picture-o fa-lg"></i></span>
									<?php endif;?>
									<br>
									<input type="file" name="subitem-field-<?php echo $sr['slideshow_id'];?>-image" class="form-control input-sm" style="margin-top:5px;">
								</td>
								<td>
									<input type="hidden" name="subitems[]" value="<?php echo $sr['slideshow_id'];?>">
                                    <input type="text" name="subitem-field-<?php echo $sr['slideshow_id'];?>-title" class="form-control input-sm" placeholder="Enter title" title="Title" value="<?php echo $sr['title'];?>">
									<input style="margin-top:5px;" type="text" name="subitem-field-<?php echo $sr['slideshow_id'];?>-url" class="form-control input-sm" placeholder="Enter link" title="Link" value="<?php echo $sr['url'];?>">
                                </td>
                                <td>
                                    <textarea rows="3" name="subitem-field-<?php echo $sr['slideshow_id'];?>-desc" class="form-control input-sm"><?php echo $sr['desc'];?></textarea>
                                </td>
                                <td style="text-align:right;">
                                	<a class="btn btn-xs btn-default" href="<?php echo base_url('homepage/gallery_up_subitem/'.$item_id.'/'.$sr['slideshow_id'].'/'.$form_lang);?>"><i class="fa fa-sort-asc" aria-hidden="true"></i></a>
                                    <a class="btn btn-xs btn-default" href="<?php echo base_url('homepage/gallery_down_subitem/'.$item_id.'/'.$sr['slideshow_id'].'/'.$form_lang);?>"><i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                    <span style="display:inline-block;padding:0 4px;opacity:.2;">|</span>
                                	<a class="btn btn-xs btn-default linkRemoveSubItemAjax" href="<?php echo base_url('homepage/gallery_del_subitem/'.$sr['slideshow_id'].'/'.$form_lang);?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                                </td>
                            </tr>
							<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        	<div class="form-group" style="text-align:center;"><button type="submit" name="save2" class="btn btn-sm btn-success" value="1">Save</button></div>
		</form>
    </div>
	<?php endif; ?>

<?php $this->load->view('admin/template-footer'); ?>