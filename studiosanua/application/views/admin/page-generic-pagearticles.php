<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
	<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js');?>"></script>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css');?>" />

	<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
	$(document).ready(function(e) {
		CKEDITOR.replace('field_content', {
			height:400,
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
	<link rel="stylesheet" href="<?php echo base_url('assets/css/lightbox.css');?>">
	<script src="<?php echo base_url('assets/js/lightbox.js');?>"></script>
	<script>
	$( document ).ready(function() {
		// =============================================================================
		/*$('#AddItem').on('click', function(e) {
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
		});*/
		
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
			<a href="<?php echo base_url('pageinfo/publications/'.$page_name.'/'.$item_id.'/'.$l['lang'].'/'.$page_index);?>" type="button" class="btn btn-xs <?php echo $form_lang==$l['lang']?'btn-warning':'btn-default'; ?>"><?php echo $l['lang']; ?></a>
			<?php endforeach; ?>
		</div>
        <h1><?php echo $title; ?></h1>
    </hgroup>
   
    
	<div class="content-section">
        <table class="table table-striped table-hover" id="ListItems">
            <thead>
                <tr>
                	<th style="width:100px;">Visibility</th>
                    <th style="width:180px;">Title</th>
                    <th style="width:100px;">Category</th>
                    <th>Short desc</th>
                    <th style="width:80px;text-align:right;"><a id="AddItem" href="<?php echo base_url('pageinfo/article_add_item/'.$page_name.'/'.$form_lang.'/'.$page_index);?>" class="btn btn-xs btn-primary">Add</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($articles as $r): ?>
                <tr id="item-id-<?php echo $r['article_id'];?>"<?php echo $r['article_id']==$item_id?' style="background:#d9edf7;"':''; ?>>
                	<td><?php echo $r['public']=='1'?'<strong>public</strong>':'<em style="color:orange;">private</em>';?></td>
                    <td><?php echo $r['title'];?></td>
                    <td><?php echo ucfirst($r['identifier']);?></td>
                    <td class="nowrap"><?php echo substr($r['description'], 0, 200);?></td>
                    <td style="text-align:right;">
                    	<a class="btn btn-xs btn-default" href="<?php echo base_url('pageinfo/publications/'.$page_name.'/'.$r['article_id'].'/'.$form_lang.'/'.$page_index);?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a class="btn btn-xs btn-default linkRemoveItemAjax" href="<?php echo base_url('pageinfo/article_del_item/'.$page_name.'/'.$r['article_id'].'/'.$form_lang.'/'.$page_index);?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                    </td>
                 </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->pagination->create_links(); ?>
    </div>
    <?php if($item_id>0):?>
    <br>
    <div id="ItemDetails-<?php echo $item_id;?>" class="content-section black">
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
        	<div class="row">
            	<div class="col-xs-12 col-sm-12">
                	<table class="table borderless">
                        <tbody>
                        	<tr>
                            	<td>
                                	<label>Public</label>
                                    <select name="field_public" class="form-control input-sm">
                                    	<option value="0"<?php echo $field_public=='0'?' selected':'';?>>Private</option>
                                        <option value="1"<?php echo $field_public=='1'?' selected':'';?>>Public</option>
                                    </select>
                                </td>
                                <td>
                                	<label>Category</label>
                                    <select name="field_identifier" class="form-control input-sm">
                                    	<option value="news"<?php echo $field_identifier=='news'?' selected':'';?>>News</option>
                                        <option value="events"<?php echo $field_identifier=='events'?' selected':'';?>>Events</option>
                                        <option value="testimonials"<?php echo $field_identifier=='testimonials'?' selected':'';?>>Testimonials</option>
                                    </select>
                                </td>
                                <td>
                                	<label>Publish date</label>
                                    <div class="input-append date form_datetime">
                                        <input id="DateTime" readonly class="form-control input-sm form_datetime" name="field_date" value="<?php echo $field_date;?>" />
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                    <script>
										$("#DateTime").datetimepicker({
											format: 'yyyy-mm-dd hh:ii:ss',
											autoclose: true
										});
									</script>
                                </td>
                            </tr>
                            <tr>
                            	<td colspan="3">
                                	<label>Title</label>
                                    <input type="text" name="field_title" class="form-control input-sm" value="<?php echo $field_title;?>">
                                </td>
                            </tr>
                            <tr>
                            	<td colspan="3">
                                	<label>Short description</label>
                                    <textarea rows="3" type="text" name="field_desc" class="form-control input-sm"><?php echo $field_desc;?></textarea>
                                </td>
                            </tr>
                            <tr>
                            	<td colspan="3">
                                	<label>Content</label>
                                    <textarea rows="20" type="text" id="field_content" name="field_content" class="form-control input-sm"><?php echo $field_content;?></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        	<div class="form-group" style="text-align:center;"><button type="submit" name="save" class="btn btn-sm btn-success" value="1">Save</button></div>
		</form>
    </div>
	<?php endif; ?>

<?php $this->load->view('admin/template-footer'); ?>