<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
	<script src="<?php echo base_url('assets/textboxio-all/textboxio/textboxio.js');?>"></script>
	<script>
		$(document).ready(function(e) {
            var editor = textboxio.replace('#editor');
        });
	</script>
</head>

<body>
	<?php $this->load->view('admin/template-header'); ?>
	
    <hgroup>
        <div class="btn-group" style="float:right;">
			<?php foreach($content_langs as $l): ?>
			<a href="<?php echo base_url('pageinfo/pagecontent/'.$page_name.'/'.$l['lang']);?>" type="button" class="btn btn-xs <?php echo $form_lang==$l['lang']?'btn-warning':'btn-default'; ?>"><?php echo $l['lang']; ?></a>
			<?php endforeach; ?>
		</div>
        <h1><?php echo $title; ?></h1>
    </hgroup>


	<div class="content-section">
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
    	
		<?php if(isset($content_lists)): ?>
            <div class="form-group">
                <table class="table borderless">
                    <tr>
                        <td>
                            <select id="Category1" class="form-control">
                            	<option<?php echo (isset($menu1_id)&&$menu1_id==0)?' selected':'';?> value="0">- default -</option>
                                <?php foreach($content_lists as $item): ?>
                                <option<?php echo (isset($menu1_id)&&$menu1_id==$item['item_id'])?' selected':'';?> value="<?php echo $item['item_id'];?>"><?php echo $item['label'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <?php $wasFound=false; foreach($content_lists as $item): if(count($item['subitems'])): ?>
                            <select<?php if(isset($menu1_id)&&$menu1_id==$item['item_id']){$wasFound=true;}else{echo ' style="display:none;"';} ?> id="SubCategoriesFor<?php echo $item['item_id'];?>" class="form-control subcategories">
                            	<option<?php echo (isset($menu2_id)&&$menu2_id==0)?' selected':'';?> value="0">- default -</option>
                                <?php foreach($item['subitems'] as $subitem): ?>
                                <option<?php echo (isset($menu2_id)&&$menu2_id==$subitem['subitem_id'])?' selected':'';?> value="<?php echo $subitem['subitem_id'];?>"><?php echo $subitem['label'];?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php endif; endforeach; ?>
                            <span id="NoSubcategory" style="line-height:30px;<?php echo ($wasFound)?'display:none;':'';?>">No subcategory</span>
                        </td>
                        <td>
                            <button id="SelectBtn" type="submit" class="btn btn-success">Select</button>
                        </td>
                    </tr>
                </table>
                <script>
				$('#Category1').on('change', function() {
					$('.subcategories').hide();
					$('#NoSubcategory').hide();
					if ($('#SubCategoriesFor'+$(this).val()).length)
					{
						$('#SubCategoriesFor'+$(this).val()).show();
					}
					else
					{
						$('#NoSubcategory').show();
					}
				});
				$('#SelectBtn').on('click', function() {
					var id1 = $('#Category1').val();
					var id2 = 0;
					if ($('#SubCategoriesFor'+id1).length)
					{
						id2 = $('#SubCategoriesFor'+id1).val();
					}
					window.location.href = "<?php echo base_url('pageinfo/pagecontent/'.$page_name.'/'.$form_lang);?>/"+id1+"/"+id2;
				});
				</script>
            </div>
        </div>
        <br>
        <div class="content-section">
        <?php endif; ?>
        
        <form method="post" action="">
        	<input type="hidden" name="menu1_id" value="<?php echo isset($menu1_id)?$menu1_id:0;?>">
            <input type="hidden" name="menu2_id" value="<?php echo isset($menu2_id)?$menu2_id:0;?>">
            <div class="form-group">
                <textarea id="editor" rows="20" name="content" class="form-control"><?php echo $content;?></textarea>
                <small id="keywordsHelp" class="form-text text-muted">Rich text content.</small>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

<?php $this->load->view('admin/template-footer'); ?>